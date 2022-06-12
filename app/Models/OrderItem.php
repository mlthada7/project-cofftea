<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $with = ['item'];

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
    ];

    public function item()
    {
        // Mengambil info product berdasarkan 'product_id'
        return $this->belongsTo(Product::class, 'product_id');
    }
}
