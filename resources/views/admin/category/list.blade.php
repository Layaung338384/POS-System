@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1>Category List</h1>
    </div>

    <div class="">
        <div class="row">
            <div class="col-4 offset-1">
                <div class="card">
                    <div class="card-body mb-3 shadow">
                        <form action="{{route('categoryCreate')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control  @error('CategoryName') is-invalid @enderror" placeholder="Enter CategoryName" name="CategoryName" value="{{old('CategoryName')}}">
                                @error('CategoryName')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <input type="submit" value="Create" class="btn btn-outline-success">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                `<table class="table table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $items)
                            <tr>
                                <td> {{ $items->id }} </td>
                                <td class="text-bold "> {{ $items->name }} </td>
                               <td>{{ $items->created_at->format('j F Y') }}</td>
                                <td>
                                    <a href="{{ route("updatePage", $items->id) }}" class="btn btn-primary">Update</a>
                                    <a href="{{ route('categoryDelete', $items->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
