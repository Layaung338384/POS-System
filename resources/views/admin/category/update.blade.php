@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1>Category Update</h1>

        <div class="">
        <div class="row">
            <div class="col-4 offset-1">
                <div class="card">
                    <div class="card-body mb-3 shadow">
                        <form action="{{route('update')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $updatePage->id }}">
                                <input type="text" class="form-control" value="{{old('CategoryName' , $updatePage->name)}}  @error('CategoryName') is-invalid @enderror" placeholder="Enter CategoryName" name="CategoryName">
                                @error('CategoryName')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <input type="submit" value="Update" class="btn btn-outline-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


@endsection
