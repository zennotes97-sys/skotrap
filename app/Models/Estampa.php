<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estampa extends Model
{
    protected $table = 'estampas';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'preco',
        'imagem',
        'tecnica',
        'produto',
        'categoria_id',
        'criado_por',
        'atualizado_por',
        'destaque',
        'ativo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function comentarios()
    {
        return $this->hasMany(EstampaComentario::class, 'estampa_id');
    }

    public function curtidas()
    {
        return $this->hasMany(EstampaCurtida::class, 'estampa_id');
    }

    public function promocoes()
    {
        return $this->hasMany(Promocao::class, 'estampa_id');
    }
}
