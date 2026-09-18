<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class DemandeAdmin extends Model
{
    protected $table = 'demande_admin';
    protected $fillable=['id_individu','status','demande_at','rejected_at'];
    #[Override]
    protected function casts():array
    {
        return[
            'demande_at'=>'datetime',
            'rejected_at'=>'datetime',
        ];
    }
    public function individu():BelongsTo
    {
        return $this->belongsTo(individu::class,'id_individu','id_individu');
    }
}
