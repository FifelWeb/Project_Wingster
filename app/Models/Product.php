<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;

    protected $table = "products";

    protected $fillable = [
        'barcode',
        'name',
        'price',
        'gambar_product',
        'isi_product'
    ];

    public function itemTransaction()
    {
        return $this->hasManyThrough(ItemTransaction::class, Transaction::class, 'id_product', 'id_transaction', 'id');
    }
}
