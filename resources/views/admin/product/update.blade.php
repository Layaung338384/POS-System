@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="">
        <div class="row">
            <div class="col-6 offset-3 mt-5">
                <div class="card shadow">

                    <div class="card-header">
                        <h3 class="text-primary">Update Product</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{route('updateProduct')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="oldImage" value="{{$productData->image}}">
                            <input type="hidden" name="productId" value="{{$productData->id}}">

                            <div class="col">
                                <img src="{{asset('product/' . $productData->image)}}" id="output" class="w-50 img-profile @if ('image') is-invalid
                                @endif " alt="">

                                <input type="file" name="image" class="form-control" onchange="loadFile(event)" id="">
                            @error('image')
                                <small class="invalid-feedback"> {{ $message }} </small>
                            @enderror
                            </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input value="{{old("name",$productData->name)}}" type="text" name="name" class="form-control @error('name') is-invalid
                                    @enderror" id="exampleFormControlInput1" placeholder="Enter Name...">
                                    @error('name')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                                    <select class="form-control"  name="CategoryId" id="">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $item)
                                            {{-- <option value="{{ $item->id }}" @if (old("CategoryId") == $item->id)
                                                selected
                                            @endif> {{$item->name}} </option> --}}

                                            <option value="{{ $item->id }}"
                                                @if (old("CategoryId", $productData->category_id) == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('CategoryId')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                 <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                                    <input value="{{old("price",$productData->price)}}" type="text" name="price" class="form-control @error('price') is-invalid
                                    @enderror" id="exampleFormControlInput1" placeholder="Enter Price...">
                                    @error('price')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stock</label>
                                    <input value="{{old("stock",$productData->stock)}}" type="text" name="stock" class="form-control @error('stock') is-invalid
                                    @enderror" id="exampleFormControlInput1" placeholder="Enter Stock...">
                                    @error('stock')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                         <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                                    <textarea name="description" id="" class="form-control @error('description') is-invalid
                                    @enderror" placeholder="Enter Description..." cols="30" rows="10"> {{old("description",$productData->description)}} </textarea>
                                    @error('description')
                                        <small class="invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            </div>
                        <input type="submit" value="Update Product" class="w-100 btn btn-primary">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
