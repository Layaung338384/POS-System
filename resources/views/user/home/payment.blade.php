@extends('user.layout.master')

@section('content')
    <div class="container" style="margin-top: 150px">
        <div class="row">
            <div class="card col-10 offset-1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="mb-4">Payment Method</h5>
                            @foreach ($payment as $items)
                                <div class="">
                                    <b> {{$items->type}} Name: ( {{$items->account_name}} ) </b>
                                </div>

                                Account Number: {{$items->account_number}}

                                <hr>
                            @endforeach
                        </div>
                        <div class="col-7">
                            <div class="card shadow">
                                <div class="card-header">
                                    Payment Info
                                </div>
                                <form action=" {{ route('productOrder') }} " method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row mt-3">
                                            <div class="col mb-3">
                                                <input type="text" readonly value="{{ Auth::user()->name }}" placeholder="User Name" name="name" class="form-control @error('name')
                                                    is-invalid
                                                @enderror ">

                                                @error('name')
                                                    <span class="text-danger fs-6"> {{$message}} </span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('phone') }}" placeholder="09xxxxx" name="phone" class="form-control @error('phone')
                                                    is-invalid
                                                @enderror ">

                                                @error('phone')
                                                    <span class="text-danger fs-6"> {{$message}} </span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <input type="text" value="{{ old('address') }}" placeholder="Eg(Mandalay)" name="address" class="form-control @error('address')
                                                    is-invalid
                                                @enderror ">

                                                @error('address')
                                                    <span class="text-danger fs-6"> {{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <select name="payment_type" id="" class="form-select @error('payment_type')
                                                    is-invalid
                                                @enderror">
                                                    <option value="">Choose Payment Method</option>
                                                    @foreach ($payment as $pay)
                                                        <option value="{{ $pay->type }}"  @if (old('payment_type') == $pay->id) selected
                                                        @endif > {{$pay->type}} </option>
                                                    @endforeach
                                                </select>
                                                @error('payment_type')
                                                    <span class="text-danger"> {{$message}} </span>
                                                    @enderror
                                            </div>
                                            <div class="col">
                                                <input type="file" class="form-control @error('payslipImage')
                                                    is-invalid
                                                @enderror " name="payslipImage" id="">

                                                @error('payslipImage')
                                                    <span class="text-danger"> {{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                {{-- <input type="hidden" name="orderCode" value="{{ $orderList[0]['order_code'] }}" >
                                                Order code : <span class="text-secondary"> {{$orderList[0]['order_code']}} </span> --}}
                                                <input type="hidden" name="orderCode" value="{{ $orderList[0]['orderCode'] }}">
                                                Order code : <span class="text-secondary"> {{ $orderList[0]['orderCode'] }} </span>

                                            </div>
                                            <div class="col">
                                                <input type="hidden" name="totalAmount" value="{{ $orderList[0]['totalAmount'] }}" >
                                                Total Ammount : <span class="text-secondary"> {{$orderList[0]['totalAmount']}} MMK</span>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                           <button class="btn btn-success w-100"><i class="fa-solid fa-cart-shopping"></i>  Order Now...</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
