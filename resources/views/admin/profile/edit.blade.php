@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <a href="{{route("accountlist")}}" class="btn btn-danger mb-3">Back</a>
        <div class="card">
            <div class="card-header">
                <h3 class="text-primary"> {{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }} Profile ( <span class="text-danger fs-6-5">'{{ auth()->user()->role}}' Role</span> )</h3>
            </div>

            <form action="{{route("edit")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset( Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'profile/' . Auth::user()->profile ) }}" id="output" class="w-100 img-profile img-thumbnail " alt="">

                        <input type="file" name="image" class="form-control" onchange="loadFile(event)" id="">
                    </div>

                    <div class="col">
                        {{-- row1 --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input name="name" value="{{ old("name", Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Enter Name..">
                                    @error('name')
                                        <small class="text-danger invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input name="email" value="{{ old("email", Auth::user()->email ) }}" type="text" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Enter Email..">
                                    @error('email')
                                        <small class="text-danger invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- row2 --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                    <input name="phone" value="{{ old("phone", Auth::user()->phone ) }}" type="text" class="form-control @error('phone') is-invalid @enderror" id="exampleFormControlInput1" placeholder="09xxxxxxx">
                                    @error('phone')
                                        <small class="text-danger invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Address</label>
                                    <input name="address" value="{{ old("address", Auth::user()->address ) }}" type="text" class="form-control @error('address') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Enter Address..">
                                    @error('address')
                                        <small class="text-danger invalid-feedback">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update" >
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
