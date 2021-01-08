<?php


namespace App\Models;

use App\Models\User;
use App\Models\Product;

class Order extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'price',
        'card_number',
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sub_orders')->withPivot('total_price', 'single_price', 'ordered_quantity');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
