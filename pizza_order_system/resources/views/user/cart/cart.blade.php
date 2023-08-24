@extends('user.layouts.master')

@section('title', 'Product Detail Page')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total in Kyats</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="align-middle text-warning bold">
                                    <b class="bold">{{ $cart->product->name }}</b>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <input id="productPrice" type="text"
                                            class="form-control form-control-sm bg-dark text-white border-0 text-center"
                                            value="{{ $cart->product->price }}" disabled>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input id="productQty" type="text"
                                            class="form-control form-control-sm bg-dark text-white border-0 text-center"
                                            value="{{ $cart->qty }}" disabled>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input class=" form-control-sm bg-dark text-white text-center" type="number"
                                        name="" id="productTotal" value="{{ $cart->product->price * $cart->qty }}"
                                        disabled>
                                </td>
                                <td class="align-middle">
                                    <a href="">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span
                        class="bg-dark text-white pr-3 p-2 rounded">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{ $cartTotalPrice }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delievery</h6>
                            <h6 class="font-weight-medium">2000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ $cartTotalPrice + 2000 }}</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('.fa-minus').click(function() {
                let parentNode = $(this).parents("tr");
                let price = parseInt(parentNode.find('#productPrice').val());
                let qty = parseInt(parentNode.find('#productQty').val()) - 1;

                let productTotal = price * qty;
                console.log(productTotal, price, qty);

                parentNode.find('#productTotal').val(productTotal);
            });

            $('.fa-plus').click(function() {
                let parentNode = $(this).parents("tr");
                let price = parseInt(parentNode.find('#productPrice').val());
                let qty = parseInt(parentNode.find('#productQty').val()) + 1;

                let productTotal = price * qty;
                console.log(productTotal, price, qty);
                parentNode.find('#productTotal').val(productTotal);
            });

        });
    </script>
@endsection
