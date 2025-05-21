@extends('authen.layout.master')

@section('content')
     <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                    <div class="col-lg-8 offset-2">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="{{route("register")}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="name" type="text" class="form-control form-control-user" id="exampleFirstName"
                                           value="{{old("name")}}" placeholder="Enter Name....">
                                           @error('name')
                                                <small class="text-danger"> {{$message}} </small>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="phone" type="text" class="form-control form-control-user" id="exampleLastName"
                                           value="{{old("phone")}}" placeholder="Enter Phone....">
                                           @error('phone')
                                                <small class="text-danger"> {{$message}} </small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       value="{{old("email")}}" placeholder=" Enter Email Address....">
                                       @error('email')
                                            <small class="text-danger"> {{$message}} </small>
                                        @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Enter Password...">
                                            @error('password')
                                                <small class="text-danger"> {{$message}} </small>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="password_confirmation" type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Enter Repeat Password...">
                                            @error('password_confirmation')
                                                <small class="text-danger"> {{$message}} </small>
                                            @enderror
                                    </div>
                                </div>
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button >
                                <hr>
                            </form>
                            <hr>
                            {{-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> --}}
                            <div class="text-center">
                                <a class="small" href="{{route("login")}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
