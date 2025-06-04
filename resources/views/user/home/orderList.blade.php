@extends('user.layout.master')

@section('content')
    <div class="container" style="margin: 150px">
        <div class="row">
            <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Order Code</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $items)
                            <tr class="">
                                <td class="text-bold "> {{ $items->created_at }} </td>
                                <td class="text-bold "> {{ $items->order_code }} </td>
                               <td>
                                 @if ($items->status == 0)
                                    <span class="btn btn-sm btn-warning shadow">Pending</span>
                                @elseif ($items->status == 1)
                                    <span class="btn btn-sm btn-success shadow">Confirm</span> <span class="text-danger"><i cla ss="fa-solid fa-hourglass-start"></i>(Waiting Time <b>3</b> days)</span>
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
