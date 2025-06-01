@extends('user.layout.master')

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                        @foreach ($cart as $items)
                            <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('product/' . $items->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                        alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4"> {{$items->name}} </p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price">{{$items->price}} mmk</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control qty form-control-sm text-center border-0"
                                        value="{{$items->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 total">{{$items->price * $items->qty}} mmk</p>
                            </td>
                            <td>
                                <input type="hidden" class="productId" value="{{$items->product_id}}">
                                <input type="hidden" class="cartId" value="{{ $items->carts_id }}">

                                <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="text-danger mb-0" id="subtotal">{{ $total }} mmk</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Delivery </h5>
                                <div class="">
                                    <p class="mb-0"> 5000 mmk </p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 text-danger" id="finalTotal">{{ $total + 5000 }} mmk</p>
                        </div>
                        <button id="btn-checkout" @if (count($cart) == 0) disabled @endif
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
    <script>
        $(document).ready(function(){
            //btn plus
            $('.btn-plus').click(function(){
                $parentsNode = $(this).parents('tr');

                $price = $parentsNode.find('.price').text().replace('mmk','');
                $qty = $parentsNode.find('.qty').val();

                $total = $price * $qty;
                $parentsNode.find('.total').text($total + 'mmk');
                finalCirculation();
            });

            //btn minus
            $('.btn-minus').click(function(){
                $parentsNode = $(this).parents('tr');

                $price = $parentsNode.find('.price').text().replace('mmk','');
                $qty = $parentsNode.find('.qty').val();

                $total = $price * $qty;
                $parentsNode.find('.total').text($total + 'mmk');
                finalCirculation();
            });

            function finalCirculation() {
                let totalAmt = 0;

                $('#productTable tbody tr').each(function(index, item) {
                    // Get the text inside `.total`, remove 'mmk', trim spaces, convert to Number
                    let itemTotal = Number($(item).find('.total').text().replace('mmk', '').trim());
                    totalAmt += itemTotal;
                });

                $('#subtotal').html(`${totalAmt} mmk`);
                $('#finalTotal').html(`${totalAmt + 5000} mmk`);
            }

            $('.btn-remove').click(function (){
                $parentnode = $(this).parents('tr');
                $cartID = $parentnode.find('.cartId').val();

                $data = {
                    'cartId' : $cartID
                };

                $.ajax({
                    type : 'get',
                    url : '/user/product/cart/delete',
                    data : $data ,
                    dataType : 'json',
                    success : function(response){
                        response.status == 'success' ? location.reload() : '';
                    }
                });


            });

            $('#btn-checkout').click(function(){
                $orderList = [];
                $userId = $('#userId').val();
                $orderCode = 'CL-POS-' + Math.floor(Math.random() * 10000000);
                $totalAmount = $('#finalTotal').text().replace('mmk','') * 1;

                $('#productTable tbody tr').each(function(index, row) {
                    $productId = $(row).find('.productId').val();
                    $qty = $(row).find('.qty').val();

                    $orderList.push({
                        'user_id' : $userId,
                        'productId' : $productId,
                        'qty' : $qty,
                        'orderCode' : $orderCode,
                        'totalAmount' : $totalAmount
                    });
                });

                // console.log($orderList);

                $.ajax({
                    type : 'get',
                    url : '/user/cart/tempo',
                    data : { orderList: JSON.stringify($orderList) },
                    dataType : 'json',
                    success : function(res){
                        if(res.status == 'success'){
                            location.href = '/user/payment';
                        }
                    }
                });
            });

        });
    </script>
@endsection
