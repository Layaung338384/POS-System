@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('adminorderListPage') }}" class="text-black m-3"><i class="fa-solid fa-arrow-left"></i>Back</a>
            <div class="row">
                <div class="card col shadow m-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-5">Name:</div>
                            <div class="col-7"> {{$payslip->user_name}} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Phone:</div>
                            <div class="col-7">
                                @if ($payslip->phone != $order[0]->user_phone)
                                    {{ $payslip->phone }} /
                                @endif
                                {{ $order[0]->user_phone }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Address</div>
                            <div class="col-7"> {{$payslip->address}} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Order Code:</div>
                            <div class="col-7" id="orderCode"> {{ $order[0]->order_code }} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Order Date:</div>
                            <div class="col-7"> {{ $order[0]->created_at->format('j-F-Y') }} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Total Price:</div>
                            <div class="col-7"> {{ $payslip->total_amt }} MMK <span class="text-danger">(Contain Delivery Fees)</span> </div>
                        </div>
                    </div>
                </div>

                <div class="card col shadow m-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-5">Contact Phone:</div>
                            <div class="col-7"> {{$payslip->phone}} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Payment Method:</div>
                            <div class="col-7"> {{ $payslip->payment_method }} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Purchase Date:</div>
                            <div class="col-7"> {{ $payslip->created_at->format('j-F-Y h:m') }} </div>
                        </div>
                       <div class="row mb-3">
                            @if ($payslip->payslip_image)
                                <img style="width: 150px" src="{{ asset('payslip/' . $payslip->payslip_image) }}" class="img-thumbnail" alt="">
                            @else
                                <p>No data present</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6>
                                Order Board
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-hover shadow-sm" id="productTable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="col-2">Image</th>
                                        <th>Name</th>
                                        <th>Count</th>
                                        <th>Available Stock</th>
                                        <th>Product Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($order as $order_data)
                                     <tr>
                                        <input type="hidden" class="productId" value="{{ $order_data->product_id }}">
                                        <input type="hidden" class="productCount" value="{{ $order_data->orderCount }}">

                                        <td>
                                            <img class="w-75" src="{{ asset('product/' . $order_data->product_image) }}" alt="">
                                        </td>
                                        <td> {{ $order_data->product_name }} </td>
                                        <td> {{ $order_data->orderCount }} @if ($order_data->available_stock < $order_data->orderCount)
                                            <span class="text-danger">(out of stock)</span>
                                        @endif </td>
                                        <td> {{ $order_data->available_stock }} </td>
                                        <td> {{ $order_data->product_price }} </td>
                                        <td class="text-danger"> {{ $order_data->orderCount * $order_data->product_price}} MMK</td>
                                     </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="card-footer d-flex jus">
                    <div class="">
                        <input type="button" @if (!$status) disabled @endif id="btn-order-confirm" value="Confirm" class="btn btn-success shadow">
                        <input type="button" id="btn-order-delete" value="Reject" class="btn btn-danger shadow">
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('statusChange')
    <script>
        $(document).ready(function(){
             $('#btn-order-confirm').click(function(){
                $orderList = [];
                $orderCode = $('#orderCode').text();

                $('#productTable tbody tr').each(function(index, row) {

                    $productId = $(row).find('.productId').val();
                    $productCount = $(row).find('.productCount').val();


                    $orderList.push({
                        'product_id' : $productId,
                        'product_count' : $productCount,
                        'order_code' : $orderCode
                    });

                });

                $.ajax({
                    type : 'get',
                    url : '/admin/order/confirm',
                    data : { orderList: $orderList },
                    dataType : 'json',
                    success : function(res){
                        if(res.status == 'success'){
                            location.href = '/admin/order/orderlist';
                        }
                    }
                });

            });


            $('#btn-order-delete').click(function(){
                $orderList = [];

                $orderCode = $('#orderCode').text();
                $data = {
                    'orderCode' : $orderCode
                }

                $.ajax({
                    type : 'get',
                    url : '/admin/order/rejectOrder',
                    data : $data,
                    dataType : 'json',
                    success : function(res){
                        if(res.status == 'success'){
                            location.href = '/admin/order/orderlist';
                        }
                    }
                });

            });
        });
    </script>
@endsection
