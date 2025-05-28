@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1>Payment Update</h1>

        <div class="">
        <div class="row">
            <div class="col-4 offset-1">
                <div class="card">
                    <div class="card-body mb-3 shadow">
                        <form action="{{route('paymentUpdate')}}" method="POST">
                            @csrf
                            <input type="hidden" name="updateDataId" value="{{ $updateDate->id }}">
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{old('type' , $updateDate->type)}}  @error('type') is-invalid @enderror" placeholder="Enter Type" name="type">
                                @error('type')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                             <div class="mb-3">
                                <input type="text" class="form-control" value="{{old('accountNumber' , $updateDate->account_number)}}  @error('accountNumber') is-invalid @enderror" placeholder="Enter Account Number" name="accountNumber">
                                @error('accountNumber')
                                    <small class="text-danger  invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                             <div class="mb-3">
                                <input type="text" class="form-control" value="{{old('accountName' , $updateDate->account_name)}}  @error('accountName') is-invalid @enderror" placeholder="Enter Account Name" name="accountName">
                                @error('accountName')
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

