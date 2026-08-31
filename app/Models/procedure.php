<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class procedure extends Model
{
    protected $table='procedure';
    protected $primaryKey = 'id_procedure';
    protected $fillable = ['procedure_title','description','add_date','remove_date','procedure_status'];
    //RATTACHER:un procedure est rattaché au moins un service
    public function services():BelongsToMany
    {
        return $this->belongsToMany(service::class,'rattacher', 'id_procedure', 'id_service');
    }
}
