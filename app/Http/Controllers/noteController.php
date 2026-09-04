<?php

namespace App\Http\Controllers;

use App\Models\note;
use App\Models\service;
use Illuminate\Http\Request;
use App\Mail\NewNoteNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class noteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes=note::all();
        return view('notes.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services=service::all();
        return view('notes.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate(
            [
                'note_title'=>'required|string|max:100',
                'content'=>'required|string|max:255',
                'service'=>'required|array|min:1',
                'service.*'=>'exists:service,id_service'
            ]
        );
        $validate['note_date']=now();
        $validate['note_status']=$request->boolean('note_status', false);
        $note=note::create($validate);
        $note->services()->attach($validate['service']);

        $note->load('services.individus');
        $individus = $note->services->flatMap(function ($service) {
            return $service->individus;
        })->unique('id_individu')
            ->filter(function ($individu) {
                return in_array('email', $individu->notif_preference ?? []) && $individu->email;
            });

        foreach ($individus as $individu) {
            try {
                Mail::to($individu->email)->queue(new NewNoteNotification($note));
            } catch (\Throwable $e) {
                Log::error('Échec envoi email note', [
                    'individu_id' => $individu->id_individu,
                    'note_id' => $note->id_note,
                    'error' => $e->getMessage(),
                ]);
            }
        }
        return redirect()->route('notes.index')->with('success','note créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(note $notes)
    {
        $notes->load('services');
        return view('notes.show',compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(note $notes)
    {
        $services=service::all();
        $notes->load('services');
        return view('notes.edit', compact('services','notes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, note $notes)
    {
        $validate = $request->validate(
            [
                'note_title' => 'required|string|max:100',
                'content' => 'required|string|max:255',
                'service' => 'required|array|min:1',
                'service.*' => 'exists:service,id_service'
            ]
        );  
        $validate['note_date'] = now();
        $validate['note_status'] = $request->boolean('note_status', false);
        $notes->update($validate);
        $notes->services()->sync($validate['service']);
        return redirect()->route('notes.index')->with('success', 'note modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(note $notes)
    {

        $notes->delete();
        return redirect()->route('notes.index')->with('success', 'note supprimé');
    }
}
