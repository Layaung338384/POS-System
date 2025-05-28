<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    //paymentListPage
    public function paymentPage(){
        $paymentData = Payment::orderBy('created_at','desc')->paginate(3);
        return view('admin.payment.payment',compact('paymentData'));
    }

    //payment create
    public function paymentCreate(Request $request){
        $this->checkPaymentVlidation($request);

        $data = $this->requestPaymentData($request);

        Payment::create($data);
        Alert::success('Created Success Title', 'Payment Created Successfully!');
        return back();

    }

    //payment update pahge
    public function updatePage($id){
        $updateDate = Payment::find($id)->first();
        return view('admin.payment.update',compact("updateDate"));
    }

    //payment delete
    public function delete($id){
        Payment::where('id',$id)->delete();
        Alert::success('Deleted Success Title', 'Payment Delete Successfully!');
        return back();
    }

    public function update(Request $request){
        $data = $this->requestPaymentData($request);

        Payment::where('id',$request->updateDataId)->update($data);
        Alert::success('Updated Success Title', 'Payment Update Successfully!');
        return to_route('paymentPage');
    }

    private function requestPaymentData($request){
        return [
            'type' => $request->type,
            'account_number' => $request->accountNumber,
            'account_name' => $request->accountName
        ];
    }

    private function checkPaymentVlidation($request){
        $request->validate([
            'type' => 'required',
            'accountNumber' => 'required|numeric',
            'accountName' => 'required'
        ]);
    }
}
