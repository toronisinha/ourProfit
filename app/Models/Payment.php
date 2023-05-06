<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'loan_id',
        'payment_date',
        'payment_amount',
        'status',
        'comments'
    ];

    public function Customer()
    {
        return $this->belongsTo(Customer::class , 'customer_id');
    }
    
}
