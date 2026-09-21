<?php

namespace App\Http\Controllers;

use App\Models\procedure;
use App\Models\service;
use App\Models\individu;
use App\Models\note;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Auth\IndividuAuthController;
use Illuminate\Support\Facades\Auth;

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
        $this->autoriserConsultation();
        $services=service::all();
        return view('procedures.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->autoriserConsultation();
        $validate=$request->validate(
            [
            'procedure_title'=>'required|string',
            'description'=>'required|string|max:255',
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
            'content' => 'Description: ' . $validate['description'],
            'note_date' => now(),
            'categorie' => ['nouvelle'],
            'note_status' => false,
            'rappel_create' => false,
            'id_procedure' => $procedures->id_procedure,
        ]);
        $note->services()->attach($validate['service']);
        $note->load('services.individus');
        $note->notifyvalid();
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
        $this->autoriserConsultation();
        $services=service::all();
        $procedures->load('services');
        return view('procedures.edit',compact('procedures','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, procedure $procedures)
    {
        $this->autoriserConsultation();
        $validate = $request->validate(
            [
                'procedure_title' => 'required|string',
                'description' => 'required|string|max:255',
                'remove_date' => 'nullable|date',
                'service' => 'required|array|min:1',
                'service.*' => 'exists:service,id_service',
            ]
        );
        $validate['add_date'] = now();
        $validate['procedure_status'] = $request->boolean('procedure_status', false);
        $procedures->update($validate);

        $Upcon=$procedures->wasChanged(['procedure_title','description']);
        $servicesAvant=$procedures->services()->pluck('service.id_service')->sort()->values();
        $procedures->services()->sync($validate['service']);
        $servicesApres=collect($validate['service'])->sort()->values();
        $servicesModifies=$servicesAvant->toArray() !== $servicesApres->toArray();
        $note = $procedures->note;
        if ($note && ($Upcon || $servicesModifies)) {
            $note->update([
                'note_title' => 'Note for procedure: ' . $validate['procedure_title'],
                'content' => 'This is a note associated with the procedure: ' . $validate['procedure_title'],
                'note_date' => now(),
                'categorie' => ['nouvelle'],
                'note_status' => false,
                'rappel_create' => false,
            ]);
            $note->services()->sync($validate['service']);
            $note->notifyvalid();
            }    
        return redirect()->route('procedures.index')->with('success', 'procedure modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(procedure $procedures)
    {
        $this->autoriserConsultation();
        $procedures->delete();
        return redirect()->route('procedures.index')->with('success', 'procedure supprimé avec succés');
    }

    public function historique()
    {
        $procedures = procedure::orderBy('add_date', 'desc')->get();
        return view('procedures.historique', compact('procedures'));
    }

    public function historiqueDownload()
    {
        $procedures = procedure::orderBy('add_date', 'desc')->get();
        $pdf = Pdf::loadView('procedures.historique-pdf', compact('procedures'));
        return $pdf->download('historique-procedures.pdf');
    }

    private function autoriserConsultation(): void
    {
        $current = auth('individu')->user();
        if (!$current instanceof individu || !$current->estAdmin()) {
            abort(403, "action non autoriséé");
        }
    }
}
