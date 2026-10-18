<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 1. Diz ao Laravel para usar a sua tabela 'usuarios'
    protected $table = 'usuarios';

    // 2. Desativa as colunas padrão 'created_at' e 'updated_at' do Laravel, 
    // já que o seu banco gerencia isso sozinho com 'data_criacao' e 'data_atualizacao'
    public $timestamps = false; 

    // 3. Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'pais',
        'cidade',
        'role',
        'ativo',
    ];

    // 4. Esconde a senha por segurança em retornos de arrays/JSON
    protected $hidden = [
        'senha',
    ];

    /**
     * IMPORTANTE: Diz ao Laravel que a coluna de senha no banco é 'senha' e não 'password'
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Opcional: Criar uma propriedade mágica para o 'is_admin' que usamos na View anterior
     */
    public function getIsAdminAttribute()
    {
        return $this->role === 'admin';
    }
}