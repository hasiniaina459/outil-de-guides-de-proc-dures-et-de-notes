<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class note extends Model
{
    protected $table='note';
    protected $primaryKey = 'id_note';
    protected $fillable = ['note_title','content','note_status','note_date','rappel_create'];
    //ENVOYER:une note est envoye à au moin un service
    public function services():BelongsToMany
    {
        return $this->belongsToMany(service::class,'envoyer', 'id_note', 'id_service');
    }
}
