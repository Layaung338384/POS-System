@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header shadow p-3">
                <div class="">
                    <h3 class="text-primary">Account Information</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-3 p-3 offset-1">
                    {{-- Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'profile' --}}
                    <img src="{{ asset( Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'profile/' . Auth::user()->profile ) }}" id="output"  class="mb-5 w-75 img-profile" alt="">
                </div>
                <div class="col offest-1">
                    <div class="row mt-3">
                        <div class="col-2 h5">Name:</div>
                        <div class="col  text-dark h5"> {{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }} </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2 h5">Email:</div>
                        <div class="col  text-dark h5"> {{ Auth::user()->email }} </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2 h5">Phone:</div>
                        <div class="col  text-dark h5"> {{ Auth::user()->phone }} </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2 h5">Address:</div>
                        <div class="col  text-dark h5"> {{ Auth::user()->address }} </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2 h5">Role:</div>
                        <div class="col  text-dark h5"> {{ Auth::user()->role }} </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-auto mb-2">
                            <a class="btn btn-outline-secondary" href="{{ route("changePasswordPage") }}"><i class="fa-solid fa-lock"></i>Change Password</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route("editPage") }}"><i class="fa-solid fa-user-pen"></i>Edit Profile</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
