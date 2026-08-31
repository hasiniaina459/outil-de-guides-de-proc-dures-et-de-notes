<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class service extends Model
{
    protected $table='service';
    protected $primaryKey = 'id_service';
    protected $fillable = ['service_name','description'];
    //COMPOSER:un service est composer de plusieur individu 
    public function individus():HasMany
    {
        return $this->hasMany(individu::class,'id_service','id_service');
    }
    //RATTACHER:un service a au moin un procedure
    public function procedures():BelongsToMany
    {
        return $this->belongsToMany(procedure::class,'rattacher','id_service', 'id_procedure');
    }
    //ENVOYER:une service a au moin une note
    public function notes():BelongsToMany
    {
        return $this->belongsToMany(note::class,'envoyer','id_service', 'id_note');
    }
}
