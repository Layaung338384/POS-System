<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    // Show profile
    public function list()
    {
        return view('user.profile.list');
    }

    // Profile update page
    public function updatePage()
    {
        return view('user.profile.update');
    }

    // Profile update
    public function update(Request $request)
    {
        $this->checkProfileValidate($request);
        $updateData = $this->requestDataProfile($request);

        // Handle profile image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if (Auth::user()->profile && file_exists(public_path('/UserProfile/' . Auth::user()->profile))) {
                unlink(public_path('/UserProfile/' . Auth::user()->profile));
            }

            // Save new image
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('/UserProfile'), $fileName);
            $updateData['profile'] = $fileName;
        } else {
            // Keep old image if no new image uploaded
            $updateData['profile'] = Auth::user()->profile;
        }

        User::where('id', Auth::user()->id)->update($updateData);
        Alert::success('Success!', 'Profile updated successfully.');
        return to_route('profileList');
    }

    //change password page
    public function changePwdPage(){
        return view('user.profile.userChangePassword');
    }

    //change Password
    public function changeUserPwd(Request $request){
        $this->checkpwdValidation($request);

        $currentPwd = Auth::user()->password;

        if(Hash::check($request->oldpassword,$currentPwd )){
            User::where('id',auth()->user()->id)->update([
                'password' => Hash::make($request->newpassword)
            ]);

            Alert::success('Success!', 'Password Change successfully.');
            return to_route('profileList');

        }else{
            Alert::error('Error', 'Old Password Do Not Match!');
            return back();
        }
    }

    private function checkpwdValidation($request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword'
        ]);
    }


    // Get form data
    private function requestDataProfile($request)
    {
        return [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ];
    }

    // Validation
    private function checkProfileValidate($request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|unique:users,phone,' . Auth::id(),
        ]);
    }
}
