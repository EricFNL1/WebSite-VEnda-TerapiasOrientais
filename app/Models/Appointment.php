<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service',
        'appointment_date',
        'appointment_time',
        'status',
    ];
    
    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
