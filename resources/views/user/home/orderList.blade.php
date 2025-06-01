@extends('user.layout.master')

@section('content')
    <div class="container" style="margin: 150px">
        <div class="row">
            <table class="table table-hover">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Order Code</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $items)
                            <tr class="text-center">
                                <td class="text-bold "> {{ $items->created_at }} </td>
                                <td class="text-bold "> {{ $items->order_code }} </td>
                               <td>
                                 @if ($items->status == 0)
                                    <span class="btn btn-sm btn-warning shadow">Pending</span>
                                @elseif ($items->status == 1)
                                    <span class="btn btn-sm btn-success shadow">Confirm</span>
                                @else
                                    <span class="btn btn-sm btn-danger shadow">Reject</span>
                                @endif
                               </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
