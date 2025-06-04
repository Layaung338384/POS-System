<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\paymentHistory;

class OrderController extends Controller
{
    //direct order page and carry data
    public function orderListPage(){
        $orderListData = Order::select('orders.id','orders.created_at','orders.status','orders.order_code','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->when(request("searchKey"), function($querr){
                $querr->whereAny(['orders.order_code','users.name'], 'like' , '%' . request('searchKey') . '%');
            })
        ->orderBy('orders.created_at','desc')
        ->groupBy('orders.order_code')
        ->get();
        return view('admin.order.orderList',compact('orderListData'));
    }

    public function details($orderCode){
        $order = Order::select('orders.count as orderCount','users.phone as user_phone','users.email as user_email','orders.created_at','orders.order_code as order_code','products.id as product_id','products.stock as available_stock','products.price as product_price','products.name as product_name','products.image as product_image','users.name as user_name','users.nickname as user_nickname')
        ->leftJoin('users','orders.user_id','users.id')
        ->leftJoin('products','orders.product_id','products.id')
        ->where('order_code',$orderCode)->get();


        $payslip = paymentHistory::where('order_code',$orderCode)->first();

        $confrimStatus = [];
        $status = true;

        foreach($order as $items){
            array_push($confrimStatus,$items->available_stock < $items->orderCount ? false : true);
        }

        foreach($confrimStatus as $items){
            if($items == false){
                $status = false; break;
            }
        }

        return view("admin.order.details",compact("order",'payslip','status'));
    }

    public function changeStatus(Request $request){
        Order::where('order_code',$request['orderCode'])->update([
            'status' => $request['status']
        ]);
        return response()->json([
            'status' => 'success'
        ],200);
    }

    public function confirm(Request $request) {
        $orderList = $request->input('orderList');

        if (!empty($orderList)) {
            // Get the order code from the first item
            $orderCode = $orderList[0]['order_code'] ?? null;

            if ($orderCode) {
                Order::where('order_code', $orderCode)->update([
                    'status' => 1
                ]);
            }

            foreach ($orderList as $item) {
                Product::where('id', $item['product_id'])->decrement('stock', (int)$item['product_count']);
            }

            return response()->json([
                'status' => 'success'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid order list'
        ], 400);
    }

    public function reject(Request $request){
        Order::where('order_code',$request['orderCode'])->update([
            'status' => 2
        ]);
        return response()->json([
                'status' => 'success'
        ], 200);
    }

    public function saleInfo()
{
    $saleInfo = Order::select(
                        'orders.order_code',
                        'orders.status as Status',
                        'orders.created_at as createdAt',
                        'users.name as userName',
                        'products.name as productName',
                        'payment_histories.total_amt as totalAmount'
                    )
                    ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                    ->leftJoin('products', 'orders.product_id', '=', 'products.id')
                    ->leftJoin('payment_histories', 'orders.order_code', '=', 'payment_histories.order_code')
                    ->when(request("searchKey"), function($querr){
                        $querr->whereAny(['orders.order_code','users.name','products.name'], 'like' , '%' . request('searchKey') . '%');
                    })
                    ->where('orders.status', 1)
                    ->groupBy('orders.order_code')
                    ->orderBy('orders.created_at', 'desc')
                    ->paginate(10);

    return view("admin.saleInfo.saleifomation", compact('saleInfo'));
}








    // public function saleInfo(){
    //     $saleInfo = Order::select('orders.order_code','orders.status as Status','orders.created_at as createdAt','users.name as userName',
    //                 'products.name as productName','payment_histories.total_amt as totalAmount')
    //                 ->leftJoin('users','orders.user_id','users.id')
    //                 ->leftJoin('products','orders.product_id','products.id')
    //                 ->leftJoin('payment_histories','orders.order_code','payment_histories.orders_code')
    //                 ->orderBy('created_at','desc')
    //                 ->groupBy('orders.order_code')
    //                 ->where('orders.status',1)
    //                 ->get();

    //     dd($saleInfo);
    //     return view("admin.saleInfo.saleifomation",compact($saleInfo));
    // }

}
