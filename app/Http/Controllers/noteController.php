<?php

namespace App\Http\Controllers;

use App\Models\note;
use App\Models\service;
use Illuminate\Http\Request;

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
                'categorie'=> 'required|array|min:1',
                'categorie.*'=>'in:information,nouvelle,termine',
                'service'=>'required|array|min:1',
                'service.*'=>'exists:service,id_service'
            ]
        );
        $validate['note_date']=now();
        $validate['note_status']=$request->boolean('note_status', false);
        $note=note::create($validate);
        $note->services()->attach($validate['service']);
        $note->load('services.individus');
        $note->notifyvalid();
        return redirect()->route('notes.index')->with('success','note créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(note $notes)
    {
        $notes->load('services','rappels');
        return view('notes.show',compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(note $notes)
    {
        $services=service::all();
        $notes->load('services','rappels');
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
                'categorie' => 'required|array|min:1',
                'categorie.*' => 'in:information,nouvelle,termine',
                'service' => 'required|array|min:1',
                'service.*' => 'exists:service,id_service'
            ]
        );  
        $servicesAvant=$notes->services()->pluck('service.id_service')->sort()->values();
        $validate['note_date'] = now();
        $notes->update($validate);
        $notes->services()->sync($validate['service']);
        $servicesApres=collect($validate['service'])->sort()->values();
        $servicesModifies=$servicesAvant->toArray() !== $servicesApres->toArray();
        $contenuModifie=$notes->wasChanged(['note_title','content','categorie']);
        if($contenuModifie || $servicesModifies){
            $notes->notifyvalid();
        }
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
