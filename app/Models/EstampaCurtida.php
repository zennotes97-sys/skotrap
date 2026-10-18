<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstampaCurtida extends Model
{
    protected $table = 'estampa_curtidas';
    public $timestamps = false;

    protected $fillable = ['estampa_id', 'usuario_id'];
}
