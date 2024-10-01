<?php

// App\Models\Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'service', // Certifique-se de que este campo está aqui
        'appointment_date',
        'appointment_time',
        'status',
        'valor',
    ];

    // Defina o relacionamento com o modelo Service
 public function service()
{
    return $this->belongsTo(Service::class, 'service_id');
    
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isFinalized()
    {
        return $this->status === 'Finalizado';
    }
    
    
}
