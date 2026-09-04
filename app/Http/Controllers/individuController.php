<?php

namespace App\Http\Controllers;

use App\Models\individu;
use App\Models\service;
use App\Models\note;
use App\Models\rappel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function store(Request $request,note $notes)
    {
        $validate=$request->validate(
            ['name' => 'required|string|max:50',
            'firstname' => 'nullable|string|max:100',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'address' => 'required|string|max:100',
            'notif_preference' => 'required|array|min:1',
            'notif_preference.*' => 'in:email,sms,whatsapp',
            'password' => 'required|string|min:8|confirmed',
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
                'notif_preference' => 'required|array|min:1',
                'notif_preference.*' => 'in:email,sms,whatsapp',
                'address' => 'required|string|max:100',
                'password' => 'required|string|min:8|confirmed',
                'id_service' => 'required|exists:service,id_service'
            ]
        );
        if (!empty($validate['password'])) {
            $validate['password'] = bcrypt($validate['password']);
        } else {
            unset($validate['password']);
        }
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

    public function download(individu $individus)
    {
        $individus->load('service','rappels');
        $procedure=$individus->service
            ? $individus->service->procedures()->get()
            :collect();
        $procedure_eff=$procedure->where('procedure_status',true);
        $procedure_neff=$procedure->where('procedure_status',false);
        $remind_number=$individus->rappels->count();
        $pdf = pdf::loadView('individus.pdf', compact('individus','procedure_eff','procedure_neff','remind_number'));
        return $pdf->download('individus-' . $individus->id_individu . '.pdf');
    }
}
