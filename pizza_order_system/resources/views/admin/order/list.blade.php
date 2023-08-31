@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('order#changeStatus') }}" method="post">
                        @csrf
                        <div class="d-flex col-5 mb-2 input-group">
                            <label class="input-group-text" for="inputGroupSelect02">
                                <i class="zmdi zmdi-receipt mr-2"></i>{{ $orders->count() }}
                            </label>
                            <select name="status" id="orderStatus" class=" form-select shadow-sm ">
                                <option value="">
                                    All</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                    Accept</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>
                                    Reject</option>
                            </select>
                            <div class=" input-group-append">
                                <button class="btn btn-sm btn-dark input-group-text" type="submit">
                                    <i class="zmdi zmdi-search me-2"></i>Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="">
                        @if ($orders->count() != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Order Code</th>
                                            <th>Total Price</th>
                                            <th>Order Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-list">
                                        @foreach ($orders as $order)
                                            <tr class="tr-shadow">

                                                <td class=" col-1">
                                                    <div class="mt-2">
                                                        {{ $order->user->id }}
                                                    </div>
                                                </td>
                                                <td class=" col-1">
                                                    {{ $order->user->name }}
                                                </td>
                                                <td class=" col-2">
                                                    @if ($order->status == '1')
                                                        <a href="{{ route('order#listInfo', $order->order_code) }}"
                                                            class=" text-decoration-none text-success text-bold">
                                                            {{ $order->order_code }}
                                                        </a>
                                                    @elseif($order->status == '2')
                                                        <a href="{{ route('order#listInfo', $order->order_code) }}"
                                                            class=" text-decoration-none text-danger text-bold">
                                                            {{ $order->order_code }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('order#listInfo', $order->order_code) }}"
                                                            class=" text-decoration-none text-warning text-bold">
                                                            {{ $order->order_code }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $order->total_price }} Kyats
                                                </td>
                                                <td class=" col-3">
                                                    {{ $order->created_at->format('Y-F-j') }}
                                                </td>
                                                <td class="orderTd">
                                                    <input type="hidden" value="{{ $order->id }}" class="orderId">
                                                    <select name="status" id=""
                                                        class=" form-select shadow-sm subStatus">
                                                        <option value="0"
                                                            @if ($order->status == 0) selected @endif>
                                                            Pending</option>
                                                        <option value="1"
                                                            @if ($order->status == 1) selected @endif>
                                                            Accept</option>
                                                        <option value="2"
                                                            @if ($order->status == 2) selected @endif>
                                                            Reject</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="spacer"></tr>
                                    </tbody>
                                </table>
                                {{-- <div class=" mt-3">
                                    {{ $orders->appends(request()->query())->links() }}
                                </div> --}}
                            @else
                            </div>
                            <h3 class="text-secondary text-center mt-5">There is no user here!</h3>
                            <!-- END DATA TABLE -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // $('#orderStatus').change(function(e) {
            //     let orderStatus = $("#orderStatus").val();

            //     $.ajax({
            //         type: "get",
            //         url: "http://127.0.0.1:8000/admins/order/ajax/status",
            //         data: {
            //             "status": orderStatus,
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             let list = ``;
            //             for (let i = 0; i < response.length; i++) {
            //                 const order = response[i];
            //                 let date = new Date(order.created_at);
            //                 let monthNumber = date.getMonth() + 1;
            //                 const monthNames = [
            //                     "January", "February", "March", "April", "May", "June",
            //                     "July", "August", "September", "October", "November",
            //                     "December"
            //                 ];
            //                 list += `

        //                                 <tr class="tr-shadow">

        //                                     <td class=" col-1">
        //                                        ${order.user_id}
        //                                     </td>
        //                                     <td class=" col-1">
        //                                         ${order.user_name}
        //                                     </td>
        //                                     <td class=" col-2">
        //                                         ${order.order_code}
        //                                     </td>
        //                                     <td>
        //                                         ${order.total_price} Kyats
        //                                     </td>
        //                                     <td class=" col-3">
        //                                         ${date.getFullYear()}-${monthNames[monthNumber]}-${date.getDate()}
        //                                     </td>
        //                                     <td class="orderTd">
        //                                         <input type="hidden" value="${order.id}" class="orderId">
        //                                         <select name="status" id="" class="form-select shadow-sm subStatus">
        //                                             <option value="0" ${ order.status == 0 ? 'selected':''}>Pending</option>
        //                                             <option value="1" ${ order.status == 1 ? 'selected':''}>Accept</option>
        //                                             <option value="2" ${ order.status == 2 ? 'selected':''}>Reject</option>
        //                                         </select>
        //                                     </td>
        //                                 </tr>

        //                     `;
            //             }
            //             $('#data-list').html(list);
            //         }
            //     });
            // });

            $('.subStatus').change(function(e) {
                e.preventDefault();
                let parentNode = $(this).parents(".orderTd");
                let orderId = parentNode.find('.orderId').val();
                let subStatus = parentNode.find('.subStatus').val();

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/admins/order/ajax/status/change",
                    data: {
                        "id": orderId,
                        "status": subStatus,
                    },
                    dataType: "json",
                    success: function(response) {
                        // location.reload();
                    }
                });
            });
        });
    </script>
@endsection
