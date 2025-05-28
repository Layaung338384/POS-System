<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function details($id)
    {
        $products = Product::select(
                'categories.name as category_name',
                'products.id',
                'products.name',
                'products.price',
                'products.description',
                'products.image'
            )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->first();

        $productList = Product::select(
                'categories.name as category_name',
                'products.id',
                'products.name',
                'products.price',
                'products.description',
                'products.image'
            )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.name',$products['category_name'])
            ->where('products.id','!=',$products['id'])
            ->get();

        return view('user.home.details', compact('products','productList'));
    }

     public function addtoCard(Request $request){
        // $this->checkAddtoCard($request);
        Cart::create([
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'qty' => $request->count
        ]);

         Alert::success('Success!', 'Add to Card successfully.');
        return to_route('userHome');
    }

    public function addCart() {
    $cart = Cart::select(
            'products.id as product_id',
            'carts.id as carts_id',
            'products.image',
            'products.price',
            'products.name',
            'carts.qty'
        )
        ->leftJoin('products', 'carts.product_id', 'products.id')
        ->where('carts.user_id', Auth::user()->id)
        ->get();

        $total = 0;

        foreach($cart as $items){
            $total += $items->price * $items->qty;
        }

    return view('user.home.cart', compact('cart','total'));
}


}
