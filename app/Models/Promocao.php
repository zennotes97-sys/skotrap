<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $table = 'promocoes';
    public $timestamps = false;

    protected $fillable = [
        'estampa_id',
        'tipo',
        'valor',
        'inicio',
        'fim',
        'ativo',
    ];

    public function estampa()
    {
        return $this->belongsTo(Estampa::class, 'estampa_id');
    }
}
