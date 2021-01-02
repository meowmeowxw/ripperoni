<?php


namespace App\Models;


class Order extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'price',
        'card_number',
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sub_orders')->withPivot('price', 'quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
