<?php


namespace App\Models;

use App\Models\Category;
use App\Models\Order;

class Product extends \Illuminate\Database\Eloquent\Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    protected $dates = ['deleted_at'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'sub_orders')->withPivot('price', 'quantity');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
