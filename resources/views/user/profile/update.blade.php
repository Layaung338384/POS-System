@extends('user.layout.master')

@section('content')
<div class="container-fluid py-4 min-vh-100 d-flex flex-column">
    <a href="{{ route('accountlist') }}" class="btn btn-danger mb-3">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>

    <div class="card mt-5 shadow flex-grow-1">
        <div class="card-header bg-white border-bottom">
            <h4 class="text-primary mb-0">
                {{ Auth::user()->name ?? Auth::user()->nickname }}'s Profile
            </h4>
        </div>

        <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row align-items-start">
                    <!-- Profile Image -->
                    <div class="col-md-4 text-center">
                        <img src="{{ asset(Auth::user()->profile == null ? 'user/img/avatar.jpg' : 'UserProfile/' . Auth::user()->profile) }}"
                             id="output"
                             class="img-thumbnail w-50 rounded shadow mb-3"
                             style="max-width: 250px; max-heigh: 250px;" alt="Profile Image">
                        <input type="file" name="image" class="form-control" onchange="loadFile(event)">
                    </div>

                    <!-- Profile Fields -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" value="{{ old('name', Auth::user()->name ?? Auth::user()->nickname) }}"
                                       type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name..">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" value="{{ old('email', Auth::user()->email) }}"
                                       type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email..">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                       type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="09xxxxxxx">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Address</label>
                                <input name="address" value="{{ old('address', Auth::user()->address) }}"
                                       type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address..">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 text-start">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa-solid fa-user-pen"></i> Update Profile
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
