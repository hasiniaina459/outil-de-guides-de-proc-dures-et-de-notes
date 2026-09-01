<?php

namespace App\Http\Controllers;

use App\Models\procedure;
use App\Models\service;
use Illuminate\Http\Request;

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
    public function store(Request $request,procedure $procedures)
    {
        $validate=$request->validate(
            [
            'procedure_title'=>'required|string',
            'description'=>'nullable|string|max:255',
            'add_date'=>'required|date',
            'remove_date'=>'nullable|date',
            'service'=>'required|array|min:1',
            'service.*'=>'exists:service,id_service',
            ]
        );
        $validate['procedure_status']=$request->boolean('procedure_status', false);
        $procedures=procedure::create($validate);
        $procedures->services()->attach($validate['service']);
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
    public function update(Request $request, procedure $procedures)
    {
        $validate = $request->validate(
            [
                'procedure_title' => 'required|string',
                'description' => 'nullable|string|max:255',
                'add_date' => 'required|date',
                'remove_date' => 'nullable|date',
                'service' => 'required|array|min:1',
                'service.*' => 'exists:service,id_service',
            ]
        );
        $validate['procedure_status'] = $request->boolean('procedure_status', false);
        $procedures->update($validate);
        $procedures->services()->sync($validate['service']);
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
