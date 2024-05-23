<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTimeSlot extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'time_slot', 'type'];
}
