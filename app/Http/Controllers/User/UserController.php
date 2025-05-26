<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // public function home()
    // {
    //     $Products = Product::select('categories.name as category_name','products.id','products.name','products.price','products.description','products.image')
    //     ->leftJoin('categories','products.category_id','categories.id')
    //     ->orderBy('created_at', 'desc')->get();
    //     return view('user.home.list',compact('Products'));
    // }

    public function home()
{
    $categories = Category::get();
    $Products = Product::select(
            'categories.name as category_name',
            'products.id',
            'products.name',
            'products.price',
            'products.description',
            'products.image'
        )
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->when(request('searchKey'),function($quest){//search product item using searchKey
            $quest = $quest->where('products.name','like','%' .request("searchKey") . '%');
        })
        ->when(request('sortingType') , function($quest){//softing
            $softrule = explode(',',request('sortingType'));
            $softName = 'products.' . $softrule[0]; // products.name // products.price // products.created_at
            $softBy = $softrule[1]; //asc and desc
            $quest = $quest->orderBy($softName,$softBy);
        })
        ->when(request('categoryId'), function($quest){//search category
            $quest->where('products.category_id' , request('categoryId'));
        })
        ->when(request("minPrice") != null && request("maxPrice") != null, function($quest){ // min = true || max = true
            $quest = $quest->whereBetween("products.price",[request('minPrice'),request('maxPrice')]);
        })
        ->when(request('minPrice') == null && request("maxPrice") != null, function($quest){ // min = false || max = true
            $quest = $quest->where('products.price','<=',request("maxPrice"));
        })
        ->when(request('minPrice') != null && request("maxPrice") == null, function($quest){ // min = true || max = false
            $quest = $quest->where('products.price','>=',request('minPrice'));
        })
        ->orderBy('products.created_at', 'desc')// check 2 orderBy Keyword 
        ->get();

    return view('user.home.list', compact('Products','categories'));
}

}
