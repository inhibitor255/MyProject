@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="card text-center col-6 offset-3">
                        <div class="card-header">
                            <b>Order's List Detail</b> <i class="zmdi zmdi-info ms-2"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                Customer Name <i class="zmdi zmdi-face"></i> : {{ strtoupper($order->user->name) }}
                            </h5>
                            <p class="card-text">
                                Order Code <i class="zmdi zmdi-code"></i> : <b>{{ $order->order_code }}</b>
                            </p>
                            <p class="card-text">Total Price <i class="zmdi zmdi-money-box"></i> :
                                <b>{{ $order->total_price }} Kyats</b>
                                <small class="text-warning">
                                    <i class="zmdi zmdi-alert-triangle"></i> include Delievery Charge (2000 Kyats)
                                </small>
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <i class="zmdi zmdi-calendar-alt"></i> {{ $order->created_at->format('Y-F-j') }}
                        </div>
                    </div>

                    <div class="">
                        @if ($orderLists->count() != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-list">
                                        @foreach ($orderLists as $orderList)
                                            <tr class="tr-shadow">
                                                <td>{{ $orderList->id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $orderList->product->image) }}"
                                                        class=" img-thumbnail shadow-sm me-3" alt=""
                                                        style="width: 100px;">
                                                </td>
                                                <td>
                                                    {{ $orderList->product->name }}
                                                </td>
                                                <td>{{ $orderList->product->price }}</td>
                                                <td>{{ $orderList->qty }}</td>
                                                <td>{{ $orderList->total }} Kyats</td>
                                            </tr>
                                        @endforeach
                                        <tr class="spacer"></tr>
                                    </tbody>
                                </table>
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
