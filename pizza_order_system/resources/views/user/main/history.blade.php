@extends('user.layouts.master')

@section('title', 'History Page')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">
                                    {{ $order->created_at->diffForHumans() }}
                                </td>
                                <td class="align-middle">
                                    {{ $order->order_code }}
                                </td>
                                <td class="align-middle">
                                    {{ $order->total_price }}
                                </td>
                                <td class="align-middle">
                                    @if ($order->status == 0)
                                        <span class=" text-warning"><i class="fa-regular fa-clock"></i> Pending...</span>
                                    @elseif($order->status == 1)
                                        <span class=" text-success"><i class="fa-regular fa-circle-check"></i>
                                            Confirm</span>
                                    @elseif($order->status == 2)
                                        <span class=" text-success"><i class="fa-regular fa-circle-xmark"></i> Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=" mt-3">
                    {{ $orders->links() }}
                </div class=" mt-3">
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script></script>
@endsection
