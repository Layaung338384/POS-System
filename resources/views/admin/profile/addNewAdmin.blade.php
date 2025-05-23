@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="">
            <a class="btn btn-danger" href="{{route("accountlist")}}">Back</a>
        <div class="row">
            <div class="col-6 offset-3 mt-5">
                <div class="card shadow">

                    <div class="card-header">
                        <h3 class="text-primary">Create New Admin Account</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{route("createAdmin")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input value="{{old("name")}}" type="text" name="name" class="form-control @error('name') is-invalid
                            @enderror" id="exampleFormControlInput1" placeholder="Enter Name...">
                            @error('name')
                                <small class="invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input value="{{old("email")}}" type="email" name="email" class="form-control @error('email') is-invalid
                            @enderror" id="exampleFormControlInput1" placeholder="Enter Email...">
                            @error('email')
                                <small class="invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid
                            @enderror" id="exampleFormControlInput1" placeholder="Enter Password...">
                            @error('password')
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
                        <input type="submit" value="Create" class="w-100 btn btn-primary">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
