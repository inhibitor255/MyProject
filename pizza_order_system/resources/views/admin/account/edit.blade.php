@extends('admin.layouts.master')

@section('title', 'Account Edit Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">
                                    Account Profile <i class="zmdi zmdi-info"></i>
                                </h3>
                            </div>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (auth()->user()->image == null)
                                            <div class="image">
                                                <img src="{{ asset('image/default-user.jpg') }}" style="width: 300px"
                                                    alt="User Picture" class=" img-thumbnail shadow-sm" />
                                            </div>
                                        @else
                                            <div class="image">
                                                <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}"
                                                    style="width: 300px" alt="User Picture" />
                                            </div>
                                        @endif

                                        <div class=" mt-3">
                                            <input type="file" class="form-control" name="" id="">
                                        </div>

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-dark btn-sm col"><i
                                                    class="zmdi zmdi-edit"></i> Update
                                                Profile
                                            </button>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Enter Admin Name"
                                                value="{{ old('name', auth()->user()->name) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Enter Admin Email"
                                                value="{{ old('email', auth()->user()->email) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input type="number" name="phone" id="phone" class="form-control"
                                                placeholder="Enter Admin Phone"
                                                value="{{ old('phone', auth()->user()->phone) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="address" cols="10" rows="3" class="form-control"
                                                placeholder="Enter Admin Address">{{ old('address', auth()->user()->address) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <input type="text" name="role" id="role" class="form-control"
                                                value="{{ old('role', auth()->user()->role) }}" disabled>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
