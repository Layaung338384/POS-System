<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
        'stock',
        'image'
    ];

    //a product has one category

    public function category(){
        return $this->belongsTo(Category::class);
    }


}
