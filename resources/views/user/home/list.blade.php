@extends('user.layout.master')

@section('content')
    <div class="container-fluid fruite py-5 mt-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Global Products</h1>

                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-3">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill @if (! request("categoryId"))
                                    active
                                @endif" href="{{route('userHome')}}">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            @foreach ($categories as $cato)
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill @if (request("categoryId") == $cato->id)
                                        active
                                    @endif" href="{{ url('user/home?categoryId=' .  $cato->id) }}">
                                        <span class="text-dark" style="width: 130px;">{{ $cato->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        {{-- <div class="d-flex justify-content-end">
                            {{ $categories->links() }}
                        </div> --}}
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                                <div class="col-3">
                                    <div class="form">
                                        <form action="{{route("userHome")}}" method="get">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" name="searchKey" value="{{ request('searchKey') }}" class=" form-control"
                                                    placeholder="Enter Search Key...">
                                                <button type="submit" class=" btn"> <i
                                                        class="fa-solid fa-magnifying-glass"></i> </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <form action="{{route('userHome')}}" method="get">
                                                @csrf
                                                <input type="text" name="minPrice" value="{{request('minPrice')}}" placeholder="Minimum Price..."
                                                    class=" form-control my-2">
                                                <input type="text" name="maxPrice" value="{{request('maxPrice')}}" placeholder="Maximun Price..."
                                                    class=" form-control my-2">
                                                <input type="submit" value="Search" class=" btn btn-success my-2 w-100">
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <form action="{{route("userHome")}}" method="get">

                                                <select name="sortingType" class="form-control w-100 bg-white mt-3">
                                                    <option value="name,asc">Alphabet A-Z</option>
                                                    <option value="name,desc">Alphabet Z-A</option>
                                                    <option value="price,asc">Lowest-Highest</option>
                                                    <option value="price,desc">Highest-Lowest</option>
                                                    <option value="created_at,asc">Date Asc to Desc</option>
                                                    <option value="created_at,desc">Date Desc to Asc</option>
                                                </select>

                                                <input type="submit" value="Sort" class=" btn btn-success my-3 w-100">
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            <div class="col-9">
                                <div class="row g-4">
                                     @foreach ($Products as $items)

                                        <div class="col-4">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <a href="{{route("detailsPage",$items->id)}}"><img src="{{ asset('product/'. $items->image) }}" style="height: 250px"
                                                        class="img-fluid w-100 rounded-top" alt="">
                                                    </a>
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">{{ $items->category_name }}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $items->name }}</h4>
                                                    <p>{{ Str::words($items->description, 5, '...') }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"> {{$items->price}} mmk</p>
                                                        <form action="{{ route("addtoCardV2") }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                                            <input type="hidden" name="productId" value="{{$items->id}}">
                                                            <input type="hidden" name="qty"  value="{{ 1 }}">
                                                            <button type="submit"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Grapes</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                    eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Raspberries</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                    eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Oranges</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                    eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-6.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Apple</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                    eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Grapes</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                    eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-4.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>Apricots</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                                                    eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-5" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <   div class="col-lg-12">
                                <div class="row g-4">

                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="img/fruite-item-3.jpg" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">  </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4></h4>
                                                <p></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"></p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
