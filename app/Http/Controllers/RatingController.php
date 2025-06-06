<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    public function rating(Request $request){

        //the fitst one is update and second one is create
        Rating::updateOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
        ],[
            'count' => $request->productRating,
        ]);

        $this->addActionLog(Auth::user()->id,$request->product_id,'rating');

        Alert::success('Success!', 'Thanks For Your Feedback Rating');
        return back();
    }

    //actionlog
    private function addActionLog($userId,$productId,$action){
        ActionLog::create([
            //post id is same as product id
            'post_id' => $productId,
            'user_id' => $userId,
            'action' => $action
        ]);
    }

}
