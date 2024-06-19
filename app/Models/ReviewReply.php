<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReply extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function vendor()
    {
        return $this->belongsTo(Admin::class, 'vendor_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getReview()
    {
        return $this->belongsTo(Review::class,'review_id');
    }
}
