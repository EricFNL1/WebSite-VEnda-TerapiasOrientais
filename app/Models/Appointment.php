<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 'service_id', 'appointment_date', 'appointment_time', 'status', 'valor'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

