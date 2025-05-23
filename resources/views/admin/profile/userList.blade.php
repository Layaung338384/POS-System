@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">


        <h2 class="text-danger fw-bold"><a href="{{route("userlist")}}" class="text-decoration-none">User List Page</a></h2>

        {{-- <div class="d-flex justify-content-end mb-3">
             <a href="{{route('adminlist')}}" class="text-white btn btn-danger btn-sm ">Admin List</a>
            <form action="{{ route('userlist') }}" method="GET" class="d-flex align-items-center" style="gap: 10px;">
                @csrf
                <input type="text" name="searchUser" value="{{ request('searchUser') }}" placeholder="Enter Search..." class="form-control">
                <button type="submit" class="btn btn-dark text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div> --}}

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Hello link -->
            <a href="{{route('adminlist')}}" class="text-white btn b btn-danger btn-sm ">Admin List</a>

            <!-- Right side: Search form -->
            <form action="{{ route('userlist') }}"  method="GET" class="d-flex align-items-center" style="gap: 10px;">
                @csrf
                <input type="text" name="searchUser" value="{{ request('searchUser') }}"  placeholder="Enter Search..." class="form-control">
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
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created</th>
                        <th scope="col">Plaform</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userList as $items)
                            <tr class="text-center">
                                <td> {{ $items->id }} </td>
                                <td class="text-bold "> {{ $items->name }} </td>
                                <td class="text-bold "> {{ $items->email }} </td>
                                <td class="text-bold "> {{ $items->phone }} </td>
                                <td class="text-bold "> {{ $items->address }} </td>
                                <td class="text-bold "> <span class="text-danger">{{ $items->role }}</span> </td>
                               <td>{{ $items->created_at->format('j-F-Y') }}</td>
                               <td>
                                    @if ($items->provider == 'google') <i class=" text-primary fa-brands fa-google"></i> @endif
                                    @if ($items->provider == 'github') <i class=" text-primary fa-brands fa-github"></i> @endif
                                    @if ($items->provider == 'simple') <i class=" text-primary fa-solid fa-right-to-bracket"></i> @endif
                               </td>
                                <td>
                                    @if ($items->role != 'superadmin')
                                        <a href="{{route("admindelete",$items->id)}}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=""> {{ $userList->links() }} </div>
            </div>
        </div>
    </div>


@endsection
