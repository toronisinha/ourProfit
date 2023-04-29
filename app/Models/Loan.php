<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'parcentage',
        'total',
        'date_from',
        'date_to',
        'phone_numbar',
        'email',
        'month',
        'time',
        'profit'
    ];

    const TIME_FRAMES = [
        7 => '7 Days',
        15 => '15 Days',
        30 => 'Monthly',
    ];

    public function Customer(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }

    
}
