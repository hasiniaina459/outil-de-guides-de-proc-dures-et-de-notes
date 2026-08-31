<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Override;

class rappel extends Model
{
    protected $table='rappel';
    protected $primaryKey = 'id_rappel';
    protected $fillable = ['remind_date','remind_title','remind_number'];
    #[Override]
    protected function casts():array
    {
        return[
            'remind_number'=>'integer'
        ];
    }
    //RECEVOIR:un rappel peut etre envoyer plusieur fois à la même personne
    public function individus():BelongsToMany
    {
        return $this->belongsToMany(individu::class,'recevoir','id_rappel', 'id_individu');
    }
}
