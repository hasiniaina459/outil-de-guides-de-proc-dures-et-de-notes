<?php

namespace App\Http\Controllers;

use App\Mail\RappelNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\individu;
use App\Models\rappel;
use App\Models\note;
use Illuminate\Http\Request;

class rappelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rappels=rappel::all();
        return view('rappels.index',compact('rappels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $individus=individu::all();
        $notes=note::where('note_status',false)->get();
        return view('rappels.create',compact('individus','notes'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate(
            [
                'remind_title'=>'required|string|max:100',
                'individu'=>'required|array|min:1',
                'individu.*'=>'exists:individu,id_individu',
                'id_note'=>'nullable|exists:note,id_note',
            ]
        );
        $validate['remind_date'] = now();
        $validate['remind_number'] = (rappel::max('remind_number') ?? 0) + 1;
        $validate['source']='manuel';
        $rappels = rappel::create($validate);
        if(!empty($validate['id_note'])){
            note::find($validate['id_note'])->update([
                'rappel_create'=>true,
                'last_rappel_at'=>now(),
            ]);
        }
        $rappels->individus()->attach($validate['individu']);
        
        $individus=individu::whereIn('id_individu',$validate['individu'])->get();
        foreach($individus as $individu){
            try {
                Mail::to($individu->email)->queue(new RappelNotification($rappels, $individu));
            } catch (\Throwable $e) {
                log::error('echec envoi email rappel', [
                    'id_individu' => $individu->id_individu,
                    'id_rappel' => $rappels->id_rappel,
                    'error' => $e->getMessage(),
                ]);
            }
        }
        return redirect()->route('rappels.index')->with('success','rappel créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(rappel $rappels)
    {
        $rappels->load('individus','notes');
        return view('rappels.show',compact('rappels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rappel $rappels)
    {
        $individus=individu::all();
        $rappels->load('individus','notes');
        $notes = note::where('note_status', false)->get();
        return view('rappels.edit', compact('rappels','individus','notes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rappel $rappels)
    {
        $validate = $request->validate(
            [
                'remind_date' => now(),
                'remind_title' => 'required|string|max:100',
                'individu' => 'required|array|min:1',
                'individu.*' => 'exists:individu,id_individu',
                'id_note' => 'nullable|exists:note,id_note',
            ]
        );
        $validate['remind_number'] = (rappel::max('remind_number') ?? 0) + 1;
        $rappels->update($validate);
        if (!empty($validate['id_note'])) {
            note::find($validate['id_note'])->update([
                'rappel_create' => true,
                'last_rappel_at' => now(),
            ]);
        }
        $rappels->individus()->sync($validate['individu'] ?? []);
        $individus = individu::whereIn('id_individu', $validate['individu'])->get();
        foreach ($individus as $individu) {
            try {
                Mail::to($individu->email)->queue(new RappelNotification($rappels, $individu));
            } catch (\Throwable $e) {
                log::error('echec envoi email rappel', [
                    'id_individu' => $individu->id_individu,
                    'id_rappel' => $rappels->id_rappel,
                    'error' => $e->getMessage(),
                ]);
            }
        }
        return redirect()->route('rappels.index')->with('success', 'rappel modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rappel $rappels)
    {
        $rappels->delete();
        return redirect()->route('rappels.index')->with('success', 'rappel supprimé');
    }
}
