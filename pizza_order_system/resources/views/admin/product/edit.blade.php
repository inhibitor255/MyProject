@extends('admin.layouts.master')

@section('title', 'Pizza Edit Page')

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
                                    Update Pizza <i class="zmdi zmdi-info"></i>
                                </h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#edit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editData->id }}">
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="image">
                                            <img src="{{ asset('storage/' . $editData->image) }}" style="width: 300px"
                                                alt="User Picture" />
                                        </div>

                                        <div class=" mt-3">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                name="image" id="">
                                            @error('image')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-dark btn-sm col"><i
                                                    class="zmdi zmdi-edit"></i> Update {{ $editData->name }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class=" col-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Pizza Name" value="{{ old('name', $editData->name) }}">
                                            @error('name')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="control-label mb-1">Description</label>
                                            <textarea name="description" id="description" cols="10" rows="3"
                                                class="form-control @error('description') is-invalid @enderror" placeholder="Enter Pizza description">{{ old('description', $editData->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="categoryId" class="control-label mb-1">Category</label>
                                            <select name="category" id="" class=" form-select">
                                                <option value="">
                                                    Choose your Category
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($editData->category_id == $category->id) selected @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="price" class="control-label mb-1">Price</label>
                                            <input type="number" name="price" id="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Enter Pizza price"
                                                value="{{ old('price', $editData->price) }}">
                                            @error('price')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                            <input type="number" name="waitingTime" id="waitingTime"
                                                class="form-control @error('waitingTime') is-invalid @enderror"
                                                placeholder="Enter Pizza waitingTime"
                                                value="{{ old('waitingTime', $editData->waiting_time) }}">
                                            @error('waitingTime')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="viewCount" class="control-label mb-1">View Count</label>
                                            <input type="number" name="viewCount" id="viewCount" class="form-control"
                                                value="{{ old('viewCount', $editData->view_count) }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="createdAt" class="control-label mb-1">Created At</label>
                                            <input type="text" name="createdAt" id="createdAt" class="form-control"
                                                value="{{ old('createdAt', $editData->created_at->diffForHumans()) }}"
                                                disabled>
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
