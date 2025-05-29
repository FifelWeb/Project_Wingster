<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'booking_date',
        'booking_time',
        'customer_name',
        'number_of_guests',
        'status',
    ];

    public function table() {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
