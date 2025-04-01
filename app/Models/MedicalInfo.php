<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'vital_signs',
        'reason',
        'medications',
        'consultation_date',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
