@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">

        {{-- <h2 class="text-dark fw-bold"><a href="{{route('productList')}}" class="text-decoration-none">Product List Page</a></h2> --}}

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Hello link -->

            <div class="d-flex align-items-center mb-3" style="gap: 15px;">
                <a href="{{ route('productList') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-list me-1"></i> All Products
                </a>

                <a href="{{ route('productList', 'lowamt') }}" class="btn btn-outline-danger btn-sm">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Low Stock
                </a>
            </div>



            {{-- <a href="" class="text-white btn b btn-secondary btn-sm "><i class="fa-solid fa-database"></i>Product Count( {{ count($product) }} )</a>
            <a href="{{route('productList')}}" class="text-dark btn  btn-outline-primary btn-sm ">All Product</a>
            <a href="{{route('productList','lowamt')}}" class="text-dark btn btn-outline-danger btn-sm ">Less Amount Stock</a> --}}
            <!-- Right side: Search form -->
            <form action="" method="GET" class="d-flex align-items-center" style="gap: 10px;">
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
                        {{-- <th>ID</th> --}}
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Category</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($product) != 0)
                            @foreach ($product as $items)
                                <tr class="text-center">
                                    {{-- <td> {{$items->id}} </td> --}}
                                    <td> <img src="{{asset("product/" . $items->image)}}" style="width:100px" class="img-thumbnail shadow-sm rounded" alt=""> </td>
                                    <td class="text-bold "> {{ $items->name }} </td>
                                    <td class="text-bold "> {{ $items->price }} </td>
                                    <td class="text-bold ">
                                        <button type="button" class="btn btn-secondary position-relative">
                                            {{$items->stock}}
                                            @if ($items->stock <= 5)
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    Low amount Stock
                                                </span>
                                            @endif
                                        </button>
                                    </td>
                                    <td class="text-bold "> {{ $items->category->name }} </td>
                                {{-- <td>{{ $items->created_at->format('j-F-Y') }}</td> --}}
                                    <td>
                                        <a href="{{route("productDetails",$items->id)}}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{route('productupdatePage',$items->id)}}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="{{ route('productDelete', $items->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <td colspan="7">
                                <h3 class="text-center">There is No data</h3>
                            </td>
                        @endif
                    </tbody>
                </table>
                <div class="justify-content-end"> {{ $product->links() }} </div>
            </div>
        </div>
    </div>


@endsection
