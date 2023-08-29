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
                    @if (session('createMessage'))
                        <div class="create-noti col-4  offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('createMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('updateMessage'))
                        <div class="update-noti col-4  offset-8">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('updateMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteMessage'))
                        <div class="delete-noti col-4  offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('deleteMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row my-2">
                        <div class=" offset-10 col-1 bg-white shadow-sm rounded text-center">
                            <h3 class="my-2">
                                <i class="zmdi zmdi-receipt mr-2"></i> {{ $orders->count() }}
                            </h3>
                        </div>
                    </div>

                    <div class="d-flex col-5">
                        <label for="" class="form-label col-4">
                            Order Status
                        </label>
                        <select name="status" id="orderStatus" class=" form-select shadow-sm ">
                            <option value="">
                                All</option>
                            <option value="0">
                                Pending</option>
                            <option value="1">
                                Accept</option>
                            <option value="2">
                                Reject</option>
                        </select>
                    </div>

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
                                                    {{ $order->user->id }}
                                                </td>
                                                <td class=" col-1">
                                                    {{ $order->user->name }}
                                                </td>
                                                <td class=" col-2">
                                                    {{ $order->order_code }}
                                                </td>
                                                <td>
                                                    {{ $order->total_price }} Kyats
                                                </td>
                                                <td class=" col-3">
                                                    {{ $order->created_at->diffForHumans() }} at
                                                    {{ $order->created_at->format('g:i a') }}
                                                </td>
                                                <td>
                                                    <select name="status" id="" class=" form-select shadow-sm">
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

            $('#orderStatus').change(function(e) {
                let orderStatus = $("#orderStatus").val();

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/admins/order/ajax/status",
                    data: {
                        "status": orderStatus,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let list = ``;
                        for (let i = 0; i < response.length; i++) {
                            const order = response[i];
                            list += `

                                            <tr class="tr-shadow">
                                                <td class=" col-1">
                                                   ${order.user_id}
                                                </td>
                                                <td class=" col-1">
                                                    ${order.user_name}
                                                </td>
                                                <td class=" col-2">
                                                    ${order.order_code}
                                                </td>
                                                <td>
                                                    ${order.total_price} Kyats
                                                </td>
                                                <td class=" col-3">
                                                    ${order.created_at}
                                                </td>
                                                <td>
                                                    <select name="status" id="" class=" form-select shadow-sm">
                                                        <option value="0" ${ order.status == 0 ? 'selected':''}>Pending</option>
                                                        <option value="1" ${ order.status == 1 ? 'selected':''}>Accept</option>
                                                        <option value="2" ${ order.status == 2 ? 'selected':''}>Reject</option>
                                                    </select>
                                                </td>
                                            </tr>

                                `;
                        }
                        $('#data-list').html(list);
                    }
                });
            });

        });
    </script>
@endsection
