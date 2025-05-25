@extends('user.layout.master')

@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-6">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('changeUserPwd') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Old Password</label>
                        <input type="password" name="oldpassword"
                               class="form-control @error('oldpassword') is-invalid @enderror"
                               placeholder="Enter OldPassword...">
                        @error('oldpassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="newpassword"
                               class="form-control @error('newpassword') is-invalid @enderror"
                               placeholder="Enter NewPassword...">
                        @error('newpassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirmpassword"
                               class="form-control @error('confirmpassword') is-invalid @enderror"
                               placeholder="Enter ConfirmPassword...">
                        @error('confirmpassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="submit" value="Change" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
