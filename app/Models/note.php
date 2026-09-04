<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class note extends Model
{
    protected $table='note';
    protected $primaryKey = 'id_note';
    protected $fillable = ['note_title','content','note_status','note_date','rappel_create','id_procedure'];

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
}
