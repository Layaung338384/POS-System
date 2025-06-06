<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\paymentHistory;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home(){
        $total_sell_count = number_format(paymentHistory::sum('total_amt'));
        $pending_request_count = Order::where('status',0)->count('status');
        $user_count = number_format(User::where('role','user')->count('id'));
        return view("admin.home.list",compact('total_sell_count','pending_request_count','user_count'));
    }
}
