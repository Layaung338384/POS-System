<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Models\paymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function details($id)
    {
            $product = Product::select(
            'categories.name as category_name',
            'products.id',
            'products.name',
            'products.price',
            'products.description',
            'products.stock as available_stock',
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
            ->where('categories.name', $product['category_name'])
            ->where('products.id', '!=', $product['id'])
            ->get();

        $comments = Comment::select(
            'comments.id',
            'comments.user_id',
            'comments.message as cmtMessage',
            'users.name as user_name',
            'users.profile as user_profile',
            'users.nickname as user_nickname',
            'comments.created_at as created_at'
        )
        ->leftJoin('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.product_id', $id)
        ->orderBy('comments.created_at', 'desc')
        ->get();

        $rating = Rating::where('product_id',$id)->avg("count");

        $user_rating = Rating::where('product_id',$id)->where('user_id',Auth::user()->id)->first('count');

        $user_rating = $user_rating == null ? 0 : $user_rating['count'];

        $this->addActionLog(Auth::user()->id,$id,'seen');

        $view_count = ActionLog::where("post_id",$id)->where('action','seen')->get();

        return view('user.home.details', compact('product','productList','comments','rating','user_rating','view_count'));
    }

     public function addtoCard(Request $request){
        // $this->checkAddtoCard($request);
        Cart::create([
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'qty' => $request->count
        ]);

        $this->addActionLog(Auth::user()->id,$request->productId,'addtoCart');

        Alert::success('Success!', 'Add to Cart successfully.');
        return to_route('userHome');
    }

    public function addtoCardV2(Request $request){
        // $this->checkAddtoCard($request);
        Cart::create([
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'qty' => $request->qty
        ]);

        $this->addActionLog(Auth::user()->id,$request->productId,'addtoCart');

        Alert::success('Success!', 'Add to Cart successfully.');
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

        public function cartTempo(Request $request)
    {
        // Decode JSON data from request
        $orderList = json_decode($request->orderList, true);

        // Validate the data
        if (!is_array($orderList)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid order data.'
            ], 400);
        }

        // Add status = 0 to each item
        foreach ($orderList as &$item) {
            $item['status'] = 0;
        }

        // Save to session
        Session::put('tempoCart', $orderList);

        return response()->json([
            'status' => 'success'
        ], 200);
    }



    public function payment(Request $request){
    $payment = Payment::orderBy("type",'desc')->get();
    $orderList = Session::get('tempoCart');
    return view('user.home.payment', compact('payment', 'orderList'));
    }


    public function order(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payslipImage' => 'required',
            'payment_type' => 'required'
        ],);

        //request data and store payment history
        $paymentHistoryData = [
            'user_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_type,
            'order_code' => $request->orderCode,
            'total_amt' => $request->totalAmount
        ];

        if($request->hasFile('payslipImage')){
            $fileName = uniqid() . '_' . $request->file('payslipImage')->getClientOriginalName();
            $request->file('payslipImage')->move(public_path('payslip'), $fileName);
            $paymentHistoryData['payslip_image'] = $fileName;
        }

        paymentHistory::create($paymentHistoryData);


        //user order
        $orderProduct = Session::get('tempoCart');

        foreach ($orderProduct as $data) {
            Order::create([
                'user_id'    => $data['user_id'],
                'product_id' => $data['productId'],
                'count'      => $data['qty'],
                'order_code' => $data['orderCode'],
                'status'     => $data['status'] ?? 0, // optional: use default 0 if missing
            ]);

            Cart::where('user_id',$data['user_id'])->where('product_id',$data['productId'])->delete();
        }

        Alert::success('Success!', 'Order successfully!');
        return to_route('orderListPage');

    }

    public function orderlist(){
        $order = Order::where('user_id',Auth::user()->id)
        ->groupBy('order_code')->get();
        return view('user.home.orderList',compact('order'));
    }

    public function comment(Request $request){
        Comment::create([
            'product_id' => $request->productId,
            'message' => $request->comment,
            'user_id' => Auth::user()->id
        ]);

        $this->addActionLog(Auth::user()->id,$request->productId,'comment');

        return back();
    }

    public function commentDelete($id){
        Comment::where('id',$id)->delete();
        return back();
    }

    private function addActionLog($userId,$productId,$action){
        ActionLog::create([
            //post id is same as product id
            'user_id' => $userId,
            'post_id' => $productId,
            'action' => $action
        ]);
    }

}




// public function cartTempo(Request $request){
//         $orderList = [];

//         // foreach($request->all() as $items){
//             // array_push($orderList,[
//             //     'user_id' => $items ['user_id'],
//             //     'product_id' => $items ['productId'],
//             //     'count' => $items['qty'],
//             //     'status' => 0,
//             //     'order_code' => $items['orderCode'],
//             //     'totalAmount' => $items['totalAmount']
//             // ]);

//             $orderList = json_decode($request->orderList, true);

//             Session::put('tempoCart',$orderList);
//             return response()->json([
//                 'status' => 'success'
//             ],200);
//         }
//     }
