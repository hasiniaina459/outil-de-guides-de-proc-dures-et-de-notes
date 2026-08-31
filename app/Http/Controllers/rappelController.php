<?php

namespace App\Http\Controllers;

use App\Models\individu;
use App\Models\rappel;
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
        return view('rappels.create',compact('individus'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate(
            [
                'remind_date'=>'required|date',
                'remind_title'=>'required|string|max:100',
                'individu'=>'required|array|min:1',
                'individu.*'=>'exists:individu,id_individu'
            ]
        );
        $validate['remind_number'] = (rappel::max('remind_number') ?? 0) + 1;
        $rappels = rappel::create($validate);
        $rappels->individus()->attach($validate['individu']);
        return redirect()->route('rappels.index')->with('success','rappel créée');
    }

    /**
     * Display the specified resource.
     */
    public function show(rappel $rappels)
    {
        $rappels->load('individus');
        return view('rappels.show',compact('rappels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rappel $rappels)
    {
        $individus=individu::all();
        $rappels->load('individus');
        return view('rappels.edit', compact('rappels','individus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rappel $rappels)
    {
        $validate = $request->validate(
            [
                'remind_date' => 'required|date',
                'remind_title' => 'required|string|max:100',
                'individu' => 'required|array|min:1',
                'individu.*' => 'exists:individu,id_individu'
            ]
        );
        $validate['remind_number'] = (rappel::max('remind_number') ?? 0) + 1;
        $rappels->update($validate);
        $rappels->individus()->sync($validate['individu'] ?? []);
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
