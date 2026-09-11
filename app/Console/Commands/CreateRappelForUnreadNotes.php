<?php

namespace App\Console\Commands;

use App\Mail\RappelNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\note;
use App\Models\rappel;
use Illuminate\Console\Command;

class CreateRappelForUnreadNotes extends Command
{
    protected $signature = 'notes:check-unread';
    protected $description = 'Crée un rappel pour les notes non lues depuis plus de 8h';

    public function handle()
    {
        $notes = note::where('note_status', false)
            ->where(function ($query) {
                $query->whereNull('last_rappel_at')
                    ->orWhere('last_rappel_at', '<=', now()->subMinutes(8));
            })
            ->where('note_date', '<=', now()->subMinutes(8))
            ->with('services.individus')
            ->get();

        foreach ($notes as $note) {
            $individus = $note->services->flatMap(function ($service) {
                return $service->individus;
            })->unique('id_individu');

            if ($individus->isEmpty()) {
                continue;
            }

            $rappel = rappel::create([
                'remind_title' => 'Note non lue: ' . $note->note_title,
                'remind_date' => now(),
                'remind_number' => $note->rappels()->count()+1,
                'id_note' => $note->id_note,
                'source' => 'auto',
            ]);

            $rappel->individus()->attach($individus->pluck('id_individu'));
            foreach($individus as $individu){
                try{
                    Mail::to($individu->email)->queue(new RappelNotification($rappel,$individu));
                }catch(\Throwable $e){
                    log::error('echec envoi email rappel',[
                        'id_individu'=>$individu->id_individu,
                        'id_rappel'=>$rappel->id_rappel,
                        'error'=>$e->getMessage(),
                    ]);
                }
            }
            $note->update([
                'rappel_create' => true,
                'last_rappel_at' => now(),
            ]);
        }

        $this->info($notes->count() . ' rappel(s) créé(s).');
    }
}
