<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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


    public function cartsDelete(Request $request){
        // logger(); debug for api
        $cart_id = $request->cartId;
        Cart::where('id',$cart_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart Deleted Successfully'
        ],200);
    }

    public function productList(){
        $productData = Product::get();
        return response()->json($productData,200);
    }

    public function payment(Request $request){
        return view('user.home.payment');
    }

    public function cartTempo(Request $request){
        $orderList = [];

        foreach($request->all() as $items){
            array_push($orderList,[
                'user_id' => $items ['user_id'],
                'product_id' => $items ['productId'],
                'count' => $items['qty'],
                'status' => 0,
                'order_code' => $items['orderCode']
            ]);

            Session::put('tempoCart',$orderList);
            return response()->json([
                'status' => 'success'
            ],200);
        }
    }
}
