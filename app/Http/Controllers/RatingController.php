<?php

namespace App\Http\Controllers;

use App\Models\Rating;
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

        Alert::success('Success!', 'Thanks For Your Feedback Rating');
        return back();
    }

}
