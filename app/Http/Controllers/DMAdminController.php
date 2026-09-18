<?php

namespace App\Http\Controllers;

use App\Mail\ApprovedNotification;
use App\Mail\rejectNotification;
use Illuminate\Http\Request;
use App\Models\DemandeAdmin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DMAdminController extends Controller
{
    public function create()
    {
        /** @var \App\Models\individu $individu */
        $individu = auth('individu')->user();
        return view('demandes.create',[
            'peutDemander'=>$individu->peutDemanderAdmin(),
            'estAdmin'=>$individu->estAdmin(),
        ]);
    }

    public function store()
    {
        /** @var \App\Models\individu $individu */
        $individu=auth('individu')->user();
        if(!$individu->peutDemanderAdmin()){
            return back()->with('error','vous ne pouvez pas soumettre de demande pour le moment .');
        }
        DemandeAdmin::create([
            'id_individu'=>$individu->id_individu,
            'status'=>'en_attente',
            'demande_at'=>now(),
        ]);

        return back()->with('success','votre demande a été envoyée aux administrateurs .');
    }

    public function index()
    {
        $demandes=DemandeAdmin::with('individu')
            ->where('status','en_attente')
            ->orderBy('demande_at')->get();
        return view('admin.demandes',compact('demandes'));
    }

    public function approve(DemandeAdmin $demande)
    {
        $individu=$demande->individu;
        $individu->update(['role'=>'admin']);
        $demande->delete();

        try{
            Mail::to($individu->email)->queue(new ApprovedNotification($individu));
        } catch(\Throwable $e){
            Log::error('Echec envoi email promotion admin',[
                'id_individu'=>$individu->id_individu,
                'error'=>$e->getMessage(),
            ]);
        }
        return back()->with('success',$individu->name . ' est maintenant administrateur .');
    }
    public function reject(DemandeAdmin $demande)
    {
        $individu=$demande->individu;
        $demande->update([
            'status'=>'rejetee',
            'rejected_at'=>now(),
        ]);
        try{
            Mail::to($individu->email)->queue(new rejectNotification($individu));
        } catch(\Throwable $e){
            Log::error('Echec envoie email refus',[
                'id_individu'=>$individu->id_individu,
                'error'=>$e->getMessage(),
            ]);
        }
        return back()->with('success','Demande rejetee');
    }
}