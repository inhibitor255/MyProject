@extends('admin.layouts.master')

@section('title', 'Admin Product Create Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <button class="btn btn-dark" onclick=" history.back()">
                <i class="zmdi zmdi-arrow-left"></i>
            </button>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#listPage') }}"><button
                                class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Product</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="text" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Your Pizza name...">
                                    @error('name')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="category" id="" class=" form-select">
                                        <option value="">
                                            Choose your Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"
                                        placeholder="Enter your Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="image" type="file" value="{{ old('image') }}"
                                        class="form-control @error('image') is-invalid @enderror"
                                        placeholder="Pepparoni...">
                                    @error('image')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">price</label>
                                    <input id="cc-pament" name="price" type="number" value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter Your Price...">
                                    @error('price')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="waitingTime" type="number"
                                        value="{{ old('waitingTime') }}"
                                        class="form-control @error('waitingTime') is-invalid @enderror"
                                        placeholder="Enter Waiting Minutes...">
                                    @error('waitingTime')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create <i class="zmdi zmdi-plus"></i></span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
