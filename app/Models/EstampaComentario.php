<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstampaComentario extends Model
{
    protected $table = 'estampa_comentarios';
    public $timestamps = false;

    protected $fillable = ['estampa_id', 'usuario_id', 'comentario', 'status'];
}
