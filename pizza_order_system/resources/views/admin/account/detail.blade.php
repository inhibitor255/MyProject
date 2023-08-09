@extends('admin.layouts.master')

@section('title', 'Password Change Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info <i class="zmdi zmdi-info"></i></h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (auth()->user()->image == null)
                                        <div class="image">
                                            <img src="{{ asset('image/default-user.jpg') }}" alt="John Doe"
                                                class=" img-thumbnail shadow-sm" />
                                        </div>
                                    @else
                                        <div class="image">
                                            <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                        </div>
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class=" my-3">
                                        <i class="zmdi zmdi-account me-2"></i> {{ auth()->user()->name }}
                                    </h4>
                                    <h4 class=" my-3">
                                        <i class="zmdi zmdi-email me-2"></i>{{ auth()->user()->email }}
                                    </h4>
                                    <h4 class=" my-3">
                                        <i class="zmdi zmdi-phone me-2"></i>{{ auth()->user()->phone }}
                                    </h4>
                                    <h4 class=" my-3">
                                        <i class="zmdi zmdi-gps-dot me-2"></i>{{ auth()->user()->address }}
                                    </h4>
                                    <h4 class=" my-3">
                                        <i
                                            class="zmdi zmdi-calendar-check me-2"></i>{{ auth()->user()->created_at->format('j-F-Y') }}
                                    </h4>
                                </div>
                                <div class="row ">
                                    <div class=" col-4 offset-2  mt-3">
                                        <button class=" btn btn-dark btn-sm">
                                            <i class="zmdi zmdi-edit"></i> Edit Profile
                                        </button>
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