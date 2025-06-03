@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Left side: Hello link -->
            <a href="{{route('adminorderListPage')}}" class="text-white btn b btn-secondary btn-sm ">Order Board</a>


            <!-- Right side: Search form -->
            <form action="{{ route('adminorderListPage') }}" method="GET" class="d-flex align-items-center" style="gap: 10px;">
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
                            <th scope="col">Date</th>
                            <th scope="col">Order Code</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Status</th>
                            <th>Status Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderListData as $items)
                            <tr class="text-center">
                                <input type="hidden" name="" value="{{ $items->order_code }}" class="orderCode">
                                <td class="text-bold">{{ $items->created_at ? $items->created_at->format('j-F-Y') : '' }} </td>

                                <td class="text-bold "><a href="{{route('AdminOrdeDetails',$items->order_code)}}">{{ $items->order_code }} </a></td>
                                <td class="text-bold text-danger"> {{ $items->user_name }} </td>
                                <td>
                                    <select name="" id="" class="form-select statusChangemode btn btn-sm btn-outline-primary">
                                        <option  value="0" @if ($items->status == 0) selected @endif >Pending</option>
                                        <option  value="1" @if ($items->status == 1) selected @endif >Confirm</option>
                                        <option  value="2" @if ($items->status == 2) selected @endif >Reject</option>
                                    </select>
                                </td>
                                <td>
                                    @if ($items->status == 0)
                                        <span><i class=" text-warning fa-regular fa-clock"></i></span>
                                    @endif

                                    @if ($items->status == 1)
                                        <span><i class=" text-success fa-solid fa-check"></i></span>
                                    @endif

                                    @if ($items->status == 2)
                                        <span><i class=" text-danger fa-solid fa-xmark"></i></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('statusChange')
<script>
    $(document).ready(function() {
        $('.statusChangemode').change(function() {
            var changeStatus = $(this).val();
            var orderCode = $(this).parents('tr').find('.orderCode').val();

            var status_data = {
                'status' : changeStatus,
                'orderCode' : orderCode
            };

            $.ajax({
                type : 'get',
                url : '/admin/order/changeStatus',
                data : status_data,
                dataType : 'json',
                success : function(res){
                    res.status == 'success' ? location.reload() : ''
                }
            });

        });
    });
</script>
@endsection

