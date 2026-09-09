<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Mail\NewNoteNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class note extends Model
{
    protected $table='note';
    protected $primaryKey = 'id_note';
    protected $fillable = ['note_title','content','note_status','categorie','note_date','rappel_create','id_procedure'];

    protected function casts(): array
    {
        return [
            'note_date' => 'datetime',
        ];
    }
    //ENVOYER:une note est envoye à au moin un service
    public function services():BelongsToMany
    {
        return $this->belongsToMany(service::class,'envoyer', 'id_note', 'id_service');
    }
    public function procedures():BelongsTo
    {
        return $this->belongsTo(procedure::class,'id_procedure','id_procedure');
    }

    public function notifyvalid(): void
    {
        $this->load('services.individus');
        $individus = $this->services->flatMap(fn($service) => $service->individus)
            ->unique('id_individu')
            ->filter(fn($individu) => in_array($this->category, $individu->notif_preference ?? []));

        foreach ($individus as $individu) {
            try {
                Mail::to($individu->email)->queue(new NewNoteNotification($this));
            } catch (\Throwable $e) {
                Log::error('Échec envoi email note', [
                    'individu_id' => $individu->id_individu,
                    'note_id' => $this->id_note,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
