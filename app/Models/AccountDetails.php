<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'aacount_number',
        'ifsc',
        'bank_name',
        'branch_name',
        'customer_name',
        'upi_id',
        'upi_number',
    ];
}
