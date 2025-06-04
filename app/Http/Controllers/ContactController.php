<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function contactPage(){
        return view('user.home.contact');
    }

    public function contact(Request $request){
        $this->checkReportValidation($request);
        Contact::create([
            'user_id' => $request->userId,
            'title' => $request->title,
            'message' => $request->message
        ]);

        Alert::success('Success Report', 'Admin Will Contact You Soon');
        return to_route('userHome');
    }

    public function checkReportValidation($request){
        $request->validate([
            'title' => 'required|max:30',
            'message' => 'required'
        ]);
    }

    //fix code not mine (but concept and idea is mine i jus change clean code)
    public function cusReport(){
        $report = Contact::select(
                'contacts.*',
                'users.name as user_name',
                'users.phone as user_phone'
            )
            ->leftJoin('users', 'contacts.user_id', 'users.id')
            ->when(request('searchKey'), function($query) {
                $search = request('searchKey');
                $query->where(function($q) use ($search) {
                    $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('contacts.title', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        return view('admin.customerReport.customerReport', compact('report'));
    }

    public function showCusReport(Request $request, $id){
        $showCusReport = Contact::findOrFail($id);
        $userName = $request->userName;
        $userPhone = $request->userPhone;

        return view("admin.customerReport.showcustomerReport", compact('showCusReport', 'userName', 'userPhone'));
    }


    public function cusReportDelete($id){
        Contact::find($id)->delete();

        Alert::success('Success Delete Report', 'Good Job! You Handle the Customer Issues');
        return to_route('cusReport');
    }



}
