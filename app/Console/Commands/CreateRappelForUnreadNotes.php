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
        $notes = note::where(function($query){
            $query->whereNull('last_rappel_at')
                ->orWhere('last_rappel_at','<=',now()->subMinutes(8));
        })
        ->where('note_date','<=',now()->subMinutes(8))
        ->withCount('rappels')
        ->with('unreadLecteurs')
        ->get();

        $rappelmax=4;
        $rappelsCount=0;
        foreach ($notes as $note){
            $individus=$note->unreadLecteurs;
            if($individus->isEmpty()){
                $note->update(['note_status'=>true,'last_rappel_at'=>now()]);
                continue;
            }
            if ($note->rappels_count >= $rappelmax) {
                $note->update(['last_rappel_at' => now()]);
                Log::warning("seuil limite atteint");
                continue;
            };

            $rappel = rappel::create([
                'remind_title' => 'Note non lue: ' . $note->note_title,
                'remind_date' => now(),
                'remind_number' => $note->rappels()->count() + 1,
                'id_note' => $note->id_note,
                'source' => 'auto',
            ]);
            $rappel->individus()->attach($individus->pluck('id_individu'));
            foreach($individus as $individu){
                try{
                    Mail::to($individu->email)->queue(new RappelNotification($rappel,$individu));
                } catch(\Throwable $e){
                    Log::error('echec envoi email rappel', [
                        'id_individu' => $individu->id_individu,
                        'id_rappel' => $rappel->id_rappel,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
            
            $note->update([
                'rappel_create' => true,
                'last_rappel_at' => now(),
            ]);
            
            $rappelsCount++;
        }
        $this->info($rappelsCount . 'rappel(s) créé .');
    }
}
