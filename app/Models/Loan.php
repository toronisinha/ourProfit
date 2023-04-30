<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'amount',
        'percentage',
        'day_profit',
        'total_profit',
        'paid_amount',
        'date_from',
        'timeframe',
        'status', // 1=>active, 2=>done
    ];

    const TIME_FRAMES = [
        7 => '7 Days',
        15 => '15 Days',
        30 => 'Monthly',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    
}
