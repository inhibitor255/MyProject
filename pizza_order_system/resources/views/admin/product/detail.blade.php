@extends('admin.layouts.master')

@section('title', 'Product Detail Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Info <i class="zmdi zmdi-info"></i></h3>
                            </div>
                            @if (session('updateSuccess'))
                                <div class="create-noti col-8 offset-2 ">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="zmdi zmdi-check-circle"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-2 offset-1">
                                    <div class="image">
                                        <img src="{{ asset('storage/' . $detailData->image) }}" alt="Pizza Picture"
                                            class=" img-thumbnail shadow-sm" />
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class=" my-3 btn bg-danger text-white w-50 text-center fs-5 d-block ">
                                        {{ $detailData->name }}
                                    </div>
                                    <span class=" my-3 btn btn-dark">
                                        <i class="fs-5 zmdi zmdi-money me-2"></i>{{ $detailData->price }} Kyats
                                    </span>
                                    <span class=" my-3 btn btn-dark">
                                        <i class="fs-5 zmdi zmdi-time me-2"></i>{{ $detailData->waiting_time }} Mins
                                    </span>
                                    <span class=" my-3 btn btn-dark">
                                        <i class="fs-5 zmdi zmdi-eye me-2"></i>{{ $detailData->view_count }}
                                    </span>
                                    <span class=" my-3 btn btn-dark">
                                        <i class="zmdi zmdi-tag"></i> {{ $detailData->category->name }}
                                    </span>

                                    <span class=" my-3 btn btn-dark">
                                        <i class="fs-5 zmdi zmdi-time"></i>
                                        {{ $detailData->updated_at->diffForHumans() }}
                                    </span>

                                    <div class=" my-3 ">
                                        <div class=""><i class="fs-5 zmdi zmdi-collection-text me-2"></i> Detail</div>
                                        <small class=" text-sm text-muted">{{ $detailData->description }}</small>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
