<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Mail\NewNoteNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Relations\HasMany;

class note extends Model
{
    protected $table='note';
    protected $primaryKey = 'id_note';
    protected $fillable = ['note_title','content','note_status','categorie', 'last_rappel_at','note_date','rappel_create','id_procedure'];

    protected function casts(): array
    {
        return [
            'note_date' => 'datetime',
            'categorie'=>'array',
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
    public function rappels():HasMany
    {
        return $this->hasMany(rappel::class,'id_note','id_note');
    }

    public function lecteurs():BelongsToMany
    {
        return $this->belongsToMany(individu::class,'lecture','id_note','id_individu')
            ->withPivot('read_at')
            ->withTimestamps();
    }

    public function unreadLecteurs():BelongsToMany
    {
        return $this->lecteurs()->wherePivotNull('read_at');
    }

    public function notifyvalid(): void
    {
        $this->load('services.individus');
        $individus = $this->services->flatMap(fn($service) => $service->individus)
            ->unique('id_individu')
            ->filter(fn($individu) => !empty(array_intersect(
                (array) $this->categorie,
                $individu->notif_preference ?? []
            )));
        $existingIds=$this->lecteurs()->pluck('individu.id_individu')->all();

        foreach ($individus as $individu) {
            if(!in_array($individu->id_individu,$existingIds)){
                $this->lecteurs()->attach($individu->id_individu,['read_at'=>null]);
            } else{
                $this->lecteurs()->updateExistingPivot($individu->id_individu,['read_at'=>null]);
            }
            try {
                Mail::to($individu->email)->queue(new NewNoteNotification($this,$individu));
            } catch (\Throwable $e) {
                Log::error('Échec envoi email note', [
                    'individu_id' => $individu->id_individu,
                    'note_id' => $this->id_note,
                    'error' => $e->getMessage(),
                ]);
            }
        }
        if($this->unreadLecteurs()->exists()){
            $this->update(['note_status'=>false]);
        } else {
            $this->update(['note_status'=>true]);
        }
    }
}
