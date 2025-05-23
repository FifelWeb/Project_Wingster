<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_menu',
        'description',
        'price',
        'image',
        'category_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

