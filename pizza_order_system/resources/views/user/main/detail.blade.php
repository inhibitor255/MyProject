@extends('user.layouts.master')

@section('title', 'Product Detail Page')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5 mt-3">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100 img-thumbnail" src="{{ asset('storage/' . $pizza->image) }}"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="userId" value="{{ auth()->user()->id }}" id="userId">
            <input type="hidden" name="productId" value="{{ $pizza->id }}" id="productId">

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1"><i class="fa-solid fa-eye"></i> {{ $pizza->view_count + 1 }}</small>
                    </div>
                    <div class="d-flex mb-3">
                        <h5 class="pt-1">
                            <i class="fa-solid fa-tag"></i> {{ $pizza->category->name }}
                        </h5>

                        <h5 class="pt-1 ms-3">
                            <i class="fa-solid fa-hourglass-start"></i> {{ $pizza->waiting_time }}
                        </h5>
                    </div>

                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} Kyats</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="orderCount"
                                class="form-control bg-dark text-white border-0 text-center rounded-sm" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning px-3" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-dark text-warning pr-3 p-2 rounded">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzas as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}" alt=""
                                    style="height: 250px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#pizzaDetailPage', [$p->id]) }}"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small><i class="fa-solid fa-eye"></i> {{ $p->view_count + 1 }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // increase view count
            $.ajax({
                type: "get",
                url: "/users/ajax/increase/view/count",
                data: {
                    "productId": $('#productId').val(),
                },
                dataType: "json",
            });

            // want product add number to the cart
            $("#addCartBtn").click(function() {
                let source = {
                    "userId": $('#userId').val(),
                    "productId": $('#productId').val(),
                    "qty": $('#orderCount').val(),
                };
                $.ajax({
                    type: "get",
                    url: "/users/ajax/add/cart",
                    data: source,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            // Redirect to a new URL
                            window.location.href = "http://127.0.0.1:8000/users/home/page";
                        }
                    }
                });
            });
        });
    </script>
@endsection
