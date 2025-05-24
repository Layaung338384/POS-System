@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">

        {{-- <h2 class="text-dark fw-bold"><a href="{{route('productList')}}" class="text-decoration-none">Product List Page</a></h2> --}}

        <a href="{{ route('productList') }}" class="btn btn-outline-primary mb-3 btn-sm">
            <i class="fa-solid fa-list me-1"></i> All Products
        </a>

        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                        {{-- <th>ID</th> --}}
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ asset('product/' . $products->image) }}" style="width:100px" class="img-thumbnail shadow-sm rounded" alt="">
                                </td>
                                <td class="text-bold"> {{ $products->name }} </td>
                                <td class="text-bold"> {{ $products->price }} </td>
                                <td class="text-bold">
                                    <button type="button" class="btn btn-secondary position-relative">
                                        {{ $products->stock }}
                                        @if ($products->stock <= 5)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                Low amount Stock
                                            </span>
                                        @endif
                                    </button>
                                </td>
                                <td class="text-bold"> {{ $products->category_name }} </td>
                                <td class="text-bold"> {{ $products->description }} </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-danger">Product Not Found</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
