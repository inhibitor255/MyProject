@extends('user.layouts.master')

@section('title', 'Product Detail Page')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total in Kyats</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr id="tableRow">
                                <td>
                                    <img src="{{ asset('storage/' . $cart->product->image) }}"
                                        class=" img-thumbnail shadow-sm" alt="" style="width: 100px;">
                                </td>
                                <td class="align-middle text-warning bold">
                                    <b class="bold">{{ $cart->product->name }}</b>
                                    <input type="hidden" name="" id="productId" value="{{ $cart->product->id }}">
                                    <input type="hidden" name="" id="userId" value="{{ auth()->user()->id }}">
                                    <input type="hidden" id="cardId" value="{{ $cart->id }}">
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
                                    <button class="btn btn-sm btn-danger btnRemove" id="btnRemove"><i
                                            class="fa fa-times"></i>
                                    </button>
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
                            <h6 id="subTotalPrice">{{ $cartTotalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delievery</h6>
                            <h6 class="font-weight-medium">2000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotalPrice">{{ $cartTotalPrice + 2000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="checkoutBtn">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCartBtn">Clear
                            Cart</button>
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

            // when  - button click
            $('.btn-minus').click(function() {
                let parentNode = $(this).parents("tr");
                let price = parseInt(parentNode.find('#productPrice').val());
                let qty = parseInt(parentNode.find('#productQty').val());

                let productTotal = price * qty;
                parentNode.find('#productTotal').val(productTotal);

                summaryCalculation();
            });

            // when + button click
            $('.btn-plus').click(function() {
                let parentNode = $(this).parents("tr");
                let price = parseInt(parentNode.find('#productPrice').val());
                let qty = parseInt(parentNode.find('#productQty').val());

                let productTotal = price * qty;
                parentNode.find('#productTotal').val(productTotal);

                summaryCalculation();
            });

            // when click delete button for one row in table
            $('.btnRemove').click(function() {
                let parentNode = $(this).parents("tr");
                parentNode.remove();
                summaryCalculation();
                let cartId = parentNode.find('#cardId').val();

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/users/ajax/clear/cart/once",
                    data: {
                        "id": cartId
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    }
                });

            });

            // calculate Cart summary final total price
            function summaryCalculation() {
                let subTotal = 0;
                let Delievery = 2000;
                $('#dataTable tr#tableRow').each(function(index, element) {
                    subTotal += Number($(element).find('#productTotal').val());

                });
                $('#subTotalPrice').html(`${subTotal} Kyats`);
                $('#finalTotalPrice').html(`${subTotal + Delievery} Kyats`);
            };

            // check out current prices
            $('#checkoutBtn').click(function(e) {
                e.preventDefault();
                const timestamp = new Date().getTime();
                const randomNum = Math.floor(Math.random() * 10000);
                const uniqueID = `id_${timestamp}_${randomNum}`;
                let orderList = [];
                $('#dataTable tr#tableRow').each(function(index, element) {
                    orderList.push({
                        'user_id': $(element).find('#userId').val(),
                        'product_id': $(element).find('#productId').val(),
                        'qty': $(element).find('#productQty').val(),
                        'total': $(element).find('#productTotal').val(),
                        'order_code': uniqueID,
                    })
                });

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/users/ajax/order",
                    data: Object.assign({}, orderList),
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'true') {
                            // Redirect to a new URL
                            window.location.href = "http://127.0.0.1:8000/users/home/page";
                        }
                    }
                });
            });

            // clear entire cart list in database
            $("#clearCartBtn").click(function(e) {
                e.preventDefault();
                $('#dataTable tbody tr').remove();
                $('#subTotalPrice').html('0 Kyats');
                $('#finalTotalPrice').html('2000 Kyats');

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/users/ajax/clear/cart",
                    dataType: "json",
                });

            });

        });
    </script>
@endsection
