@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="">
        <div class="row">
            <div class="col-6 offset-3 mt-5">
                <div class="card">
                    <div class="card-body shadow">
                        <form action="{{ route("changePassword") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                            <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid
                            @enderror" id="exampleFormControlInput1" placeholder="Enter OldPassword...">
                            @error('oldpassword')
                                <small class="invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">New Password</label>
                            <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid
                            @enderror" id="exampleFormControlInput1" placeholder="Enter NewPassword...">
                            @error('newpassword')
                                <small class="invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control @error('confirmpassword') is-invalid
                            @enderror" id="exampleFormControlInput1" placeholder="Enter ConfirmPassword...">
                            @error('confirmpassword')
                                <small class="invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <input type="submit" value="Change" class="btn btn-primary">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
