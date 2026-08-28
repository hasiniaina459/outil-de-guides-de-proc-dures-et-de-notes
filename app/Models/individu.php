<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class individu extends Model
{
    protected $table='individu';
    protected $primaryKey='id_individu';
    protected $fillable=['name','firstname','phone','email','address','id_service'];
    // COMPOSER : un individu est dans un seul service
    public function services():BelongsTo
    {
        return $this->belongsTo(service::class,'id_service','id_service');
    }
    // RECEVOIR : un individu peut recevoir plusieurs rappels
    public function rappels():BelongsToMany
    {
        return $this->belongsToMany(rappel::class,'recevoir_table','id_individu','id_rappel');
    }
}
