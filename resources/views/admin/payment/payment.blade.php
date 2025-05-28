@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1>Payment List</h1>
    </div>

    <div class="">
        <div class="row">
            <div class="col-4 offset-1">
                <div class="card">
                    <div class="card-body mb-3 shadow">
                        <form action="{{route('paymentCreate')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control  @error('type') is-invalid @enderror" placeholder="Enter Type" name="type" value="{{old('type')}}">
                                @error('type')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control  @error('accountNumber') is-invalid @enderror" placeholder="Enter Account Number" name="accountNumber" value="{{old('accountNumber')}}">
                                @error('accountNumber')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control  @error('accountName') is-invalid @enderror" placeholder="Enter Account Name" name="accountName" value="{{old('accountName')}}">
                                @error('accountName')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <input type="submit" value="Create" class="btn btn-outline-success">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentData as $items)
                            <tr>
                                <td> {{ $items->id }} </td>
                                <td class="text-bold "> {{ $items->type }} </td>
                                <td class="text-bold "> {{ $items->account_number }} </td>
                                <td class="text-bold "> {{ $items->account_name }} </td>
                               <td>{{ $items->created_at->format('j-F-Y') }}</td>
                                <td>
                                    <a href="{{route('paymentUpdatePage',$items->id)}}" class="btn btn-primary">Update</a>
                                    <a href="{{route('paymentDelete',$items->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=""> {{ $paymentData->links() }} </div>
            </div>
        </div>
    </div>
@endsection
