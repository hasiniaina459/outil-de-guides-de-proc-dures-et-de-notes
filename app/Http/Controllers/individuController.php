<?php

namespace App\Http\Controllers;

use App\Models\individu;
use App\Models\service;
use Illuminate\Http\Request;

class individuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $individus = individu::with('service')->get();
        return view('individus.index', compact('individus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $services = service::all();
        return view('individus.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate(
            ['name' => 'required|string|max:50',
            'firstname' => 'nullable|string|max:100',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'address' => 'required|string|max:100',
            'password'=>'required|string|min:8',
            'id_service'=>'required|exists:service,id_service'
            ]
        );
        $validate['password'] = bcrypt($validate['password']);
        individu::create($validate);
        return redirect()->route('individus.index')->with('success', 'individu ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(individu $individus)
    {
        $individus->load('service', 'rappels');
        return view('individus.show', compact('individus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(individu $individus)
    {
        $services=service::all();
        $individus->load('service', 'rappels');
        return view('individus.edit', compact('individus', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, individu $individus)
    {
        $validate = $request->validate(
            [
                'name' => 'required|string|max:50',
                'firstname' => 'nullable|string|max:100',
                'phone' => 'nullable|string',
                'email' => 'nullable|string',
                'address' => 'required|string|max:100',
                'password' => 'required|string|min:8',
                'id_service' => 'required|exists:service,id_service'
            ]
        );
        $validate['password'] = bcrypt($validate['password']);
        $individus->update($validate);
        return redirect()->route('individus.index')->with('success', 'individu modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(individu $individus)
    {
        $individus->delete();
        return redirect()->route('individus.index')->with('success', 'individu supprimé avec succès.');
    }
}
