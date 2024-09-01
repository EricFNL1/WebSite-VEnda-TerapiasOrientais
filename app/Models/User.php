<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    // Função para verificar se o usuário é administrador
    public function isAdmin()
    {
        return $this->role === 'admin'; // Verifique se a coluna 'role' existe no seu banco de dados
    }
}
