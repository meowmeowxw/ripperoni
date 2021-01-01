<?php


namespace App\Models;

use App\Models\Category;

class Product extends \Illuminate\Database\Eloquent\Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
