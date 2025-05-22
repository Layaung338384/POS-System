<?php

// namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Hash;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct Changepassword Page
    public function changePasswordPage(){
        return view('admin.profile.changepassword');
    }

    public function change(Request $request){
        //step-1 old pwd must be same with login pwd
        //step-2 new pwd and confirm pwd same
        //step-3 change pwd

        //check validation
        $this->checkpwdvalidation($request);

        $currentLoginPwd = auth()->user()->password; // hash pwd from dattbase

        //check old password and new password same or not
        if(Hash::check( $request->oldpassword , $currentLoginPwd)){
            //find user date and updatepassword
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->newpassword)
            ]);

            //back to admin page
            Alert::success('Success!', 'Password change successfully.');
            return to_route('adminHome');

        }else{
            Alert::error('Error', 'Old Password Do Not Match!');
            return back();
        }

    }

    //profile list
    public function list(){
        return view("admin.profile.accountProfile");
    }

    //profile editPage
    public function editPage(){
        return view('admin.profile.edit');
    }

    //profile edit
    public function edit(Request $request){
        $this->checkProfileValidate($request);
        $data = $this->requestDataProfile($request);

        if($request->hasFile('image')){

            //delete old img from profile when user change new img
            if(Auth::user()->profile != null){
                if(file_exists(public_path('/profile/' . Auth::user()->profile))){
                    unlink(public_path('/profile/' . Auth::user()->profile));
                }
            }

            //store image and update image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file("image")->move(public_path() . '/profile/', $fileName);
            $data['profile'] = $fileName;

        }else{
            $data['profile'] = Auth::user()->profile;
        }

        User::where('id', Auth::user()->id)->update($data);

        Alert::success('Success!', 'Profile change successfully.');
        return to_route('accountlist');

    }

    private function requestDataProfile($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    private function checkProfileValidate($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . Auth::user()->id ,
            'phone' => 'required|unique:users,phone,' . Auth::user()->id,
        ]);
    }

    private function checkpwdvalidation($request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirmpassword' => 'required|same:newpassword'
        ],);
    }
}
