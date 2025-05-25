@extends('user.layout.master')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="card shadow w-75">
        <div class="card-header bg-white border-bottom">
            <h3 class="text-primary mb-0">Account Information</h3>
        </div>
        <div class="card-body row align-items-center">
            <div class="col-md-4 text-center p-4">
                <img  style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;" src="{{ asset(Auth::user()->profile == null ? 'user/img/avatar.jpg' : 'UserProfile/' . Auth::user()->profile) }}"
                    alt="Profile Picture"
                    class="rounded img-fluid shadow"
                    style="max-width: 250px; height: auto;">
            </div>
            <div class="col-md-8">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label h5">Name:</label>
                    <div class="col-sm-9 h5 text-dark">{{ Auth::user()->name ?? Auth::user()->nickname }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label h5">Email:</label>
                    <div class="col-sm-9 h5 text-dark">{{ Auth::user()->email }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label h5">Phone:</label>
                    <div class="col-sm-9 h5 text-dark">{{ Auth::user()->phone }}</div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label h5">Address:</label>
                    <div class="col-sm-9 h5 text-dark">{{ Auth::user()->address }}</div>
                </div>
                <div class="row mb-4">
                    <label class="col-sm-3 col-form-label h5">Role:</label>
                    <div class="col-sm-9 h5 text-danger">{{ Auth::user()->role }}</div>
                </div>
                <div class="d-flex gap-3">
                    @if (Auth::user()->provider == 'simple')
                        <a class="btn btn-outline-secondary" href="{{ route('changePwdPage') }}">
                            <i class="fa-solid fa-lock"></i> Change Password
                        </a>
                    @endif
                    <a class="btn btn-success" href="{{ route('profileUpdatePage') }}">
                        <i class="fa-solid fa-user-pen"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
