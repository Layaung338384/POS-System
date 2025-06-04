@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">

        <h2 class="text-dark fw-bold"><a href="{{route('cusReport')}}" class="text-decoration-none">Customer Report</a></h2>

        {{-- <div class="d-flex  justify-content-end mb-3">
            <form action="{{ route('adminlist') }}" method="GET" class="d-flex align-items-center" style="gap: 10px;">
                @csrf
                <input type="text" name="searchKey" placeholder="Enter Search..." class="form-control">
                <button type="submit" class="btn btn-dark text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div> --}}

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Hello link -->
            <a href="{{route('cusReport')}}" class="text-white btn b btn-secondary btn-sm ">Report List</a>


            <!-- Right side: Search form -->
            <form action="{{ route('cusReport') }}" method="GET" class="d-flex align-items-center" style="gap: 10px;">
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
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Title</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($report as $items)
                            <tr class="text-center">
                                <td class="text-bold "> {{ $items->user_name }} </td>
                                <td class="text-bold "> {{ $items->user_phone }} </td>
                                <td class="text-bold "> {{ $items->title }} </td>
                                <td class="text-bold "> {{  Str::words($items->message, 5, '...')  }} </td>
                                <td>
                                    <form method="POST" action="{{ route("showCusReport",$items->id) }}">
                                        @csrf
                                        <input type="hidden" name="userName" value="{{ $items->user_name }}">
                                        <input type="hidden" name="userPhone" value="{{ $items->user_phone }}" id="">
                                        <button class="btn btn-outline-success">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=""> {{ $report->links() }} </div>
            </div>
        </div>
    </div>


@endsection
