<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;


    protected $table = 'menus';
    protected $fillable = [
        'name_menu',
        'description',
        'price',
        'image',
        'category_id',
        'is_available'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function reservations()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'menu_id');
    }
}

