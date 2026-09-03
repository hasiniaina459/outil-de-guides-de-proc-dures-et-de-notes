<?php

namespace App\Console\Commands;

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
            ->where('rappel_create', false)
            ->where('note_date', '<=', now()->subHours(8))
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
                'remind_number' => (rappel::max('remind_number') ?? 0) + 1,
            ]);

            $rappel->individus()->attach($individus->pluck('id_individu'));

            $note->update(['rappel_created' => true]);
        }

        $this->info($notes->count() . ' rappel(s) créé(s).');
    }
}
