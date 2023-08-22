@extends('user.layouts.master')

@section('title', 'User Home Page')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">

                <div class="bg-light p-4 mb-30">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter
                            by price</span></h5>
                    <form>

                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 pt-2">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal mb-2">{{ count($categories) }}</span>
                        </div>
                        <hr>
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#homePage') }}" class=" text-dark btn position-relative">
                                All
                            </a>
                            <span class="text-bg-secondary rounded p-2">Total Pizzas</span>
                        </div>
                        <hr>
                        @foreach ($categories as $category)
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', [$category->id]) }}" class=" text-dark">
                                    <label class="" for="price-1">{{ $category->name }}</label>
                                </a>
                                <span class="badge text-bg-secondary">{{ count($category->products) }}</span>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class=" form-select">
                                        <option value="">
                                            Choose One Option...
                                        </option>
                                        <option value="asc">
                                            Ascending
                                        </option>
                                        <option value="desc">
                                            Descending
                                        </option>
                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div id="data-list" class="row">
                        @if (count($pizzas) != 0)
                            @foreach ($pizzas as $pizza)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}"
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetailPage', [$pizza->id]) }}"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $pizza->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $pizza->price }} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1 class=" text-center text-danger bold shadow-lg p-3">
                                There is no Pizzas with such Category.
                            </h1>
                        @endif
                    </div>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                let sortingOptionValue = $(this).val();
                if (sortingOptionValue == 'asc') {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/users/ajax/pizza/list",
                        data: {
                            "status": "asc"
                        },
                        dataType: "json",
                        success: function(response) {
                            let list = ``;
                            for (let i = 0; i < response.length; i++) {
                                const pizza = response[i];
                                list += `

                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${pizza.image}') }}"
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetailPage', [$pizza->id]) }}"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">${pizza.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${pizza.price} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#data-list').html(list);
                        }
                    });
                } else if (sortingOptionValue == 'desc') {
                    $.ajax({
                        type: "get",
                        url: "http://127.0.0.1:8000/users/ajax/pizza/list",
                        data: {
                            "status": "desc"
                        },
                        dataType: "json",
                        success: function(response) {
                            let list = ``;
                            for (let i = 0; i < response.length; i++) {
                                const pizza = response[i];
                                list += `

                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${pizza.image}') }}"
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetailPage', [$pizza->id]) }}"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">${pizza.name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${pizza.price} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                `;
                            }
                            $('#data-list').html(list);
                        }
                    });
                }
            });






        });
    </script>
@endsection
