<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    //add to card validation
    // private function checkAddtoCard($request){
    //     $request->validate([
    //         'productId' => 'required|exists:products,id',
    //         'userId' => 'required|exists:users,id',
    //         'count' => 'required|integer|min:1'
    //     ]);
    // }
}
