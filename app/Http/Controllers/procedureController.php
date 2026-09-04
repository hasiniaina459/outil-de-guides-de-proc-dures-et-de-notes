<?php

namespace App\Http\Controllers;

use App\Models\procedure;
use App\Models\service;
use App\Models\note;
use Illuminate\Http\Request;
use App\Mail\NewNoteNotification;
use App\Models\individu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class procedureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $procedures=procedure::all();
        return view('procedures.index',compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services=service::all();
        return view('procedures.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,procedure $procedures,note $note)
    {
        $validate=$request->validate(
            [
            'procedure_title'=>'required|string',
            'description'=>'nullable|string|max:255',
            'remove_date'=>'nullable|date',
            'service'=>'required|array|min:1',
            'service.*'=>'exists:service,id_service',
            ]
        );
        $validate['add_date']=now();
        $validate['procedure_status']=$request->boolean('procedure_status', false);
        $procedures=procedure::create($validate);
        $procedures->services()->attach($validate['service']);
        $note = note::create([
            'note_title' => 'Note for procedure: ' . $validate['procedure_title'],
            'content' => 'This is a note associated with the procedure: ' . $validate['procedure_title'],
            'note_date' => now(),
            'note_status' => false,
            'rappel_create' => false,
            'id_procedure' => $procedures->id_procedure,
        ]);
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
        return redirect()->route('procedures.index')->with('success','procedure créée avec succés');
    }

    /**
     * Display the specified resource.
     */
    public function show(procedure $procedures)
    {
        $procedures->load('services');
        return view('procedures.show',compact('procedures'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(procedure $procedures)
    {
        $services=service::all();
        $procedures->load('services');
        return view('procedures.edit',compact('procedures','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, procedure $procedures,individu $individus)
    {
        $validate = $request->validate(
            [
                'procedure_title' => 'required|string',
                'description' => 'nullable|string|max:255',
                'remove_date' => 'nullable|date',
                'service' => 'required|array|min:1',
                'service.*' => 'exists:service,id_service',
            ]
        );
        $validate['add_date'] = now();
        $validate['procedure_status'] = $request->boolean('procedure_status', false);
        $procedures->update($validate);
        $procedures->services()->sync($validate['service']);
        $note = $procedures->note;
        if ($note) {
            $note->update([
                'note_title' => 'Note for procedure: ' . $validate['procedure_title'],
                'content' => 'This is a note associated with the procedure: ' . $validate['procedure_title'],
                'note_date' => now(),
                'note_status' => false,
                'rappel_create' => false,
            ]);
            $note->services()->sync($validate['service']);
        }
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
        return redirect()->route('procedures.index')->with('success', 'procedure modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(procedure $procedures)
    {
        $procedures->delete();
        return redirect()->route('procedures.index')->with('success', 'procedure supprimé avec succés');
    }
}
