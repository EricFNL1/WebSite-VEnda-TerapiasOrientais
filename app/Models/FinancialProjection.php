<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialProjection extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'projected_revenue', 'projection_date'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
