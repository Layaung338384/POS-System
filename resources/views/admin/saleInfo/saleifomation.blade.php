@extends('admin.layout.master')
@php use Carbon\Carbon; @endphp
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Hello link -->
            <a href="{{route('saleInfo')}}" class="text-white btn b btn-secondary btn-sm ">Sale Information</a>


            <!-- Right side: Search form -->
            <form action="{{ route('saleInfo') }}" method="GET" class="d-flex align-items-center" style="gap: 10px;">
                @csrf
                <input type="text" name="searchKey" value="{{ request('searchKey') }}" placeholder="Enter Search..." class="form-control">
                <button type="submit" class="btn btn-dark text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th scope="col">Order Code</th>
                            <th scope="col">Product</th>
                            <th scope="col">User</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saleInfo as $items)
                            <tr class="text-center">
                                <td class="text-bold">{{ $items->order_code }} </td>
                                <td class="text-bold">{{ $items->productName }} </td>
                                <td class="text-bold">{{ $items->userName }} </td>
                                <td class="text-bold text-danger"> {{ $items->totalAmount }}</td>
                                <td class="btn btn-sm rounded btn-success">@if ($items->Status == 1)
                                    <span>Confirm</span>
                                @endif  </td>
                                <td class="text-bold">{{ Carbon::parse($items->createdAt)->format('j-F-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <div class="">
                        <div class="float-end"> {{ $saleInfo->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

