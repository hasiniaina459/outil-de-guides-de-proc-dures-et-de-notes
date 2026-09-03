<?php

namespace App\Http\Controllers;

use App\Models\individu;
use App\Models\service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $services = service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);
        service::create($validated);
        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(service $services)
    {
        $services->load('individus','procedures','notes');
        return view('services.show',compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service $services)
    {
        return view('services.edit',compact('services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service $services)
    {

        $validated = $request->validate([
            'service_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);
        $services->update($validated);
        return redirect()->route('services.index')->with('success', 'Service mis à jour .');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $services)
    {
        $services->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimer .');
    }
}
