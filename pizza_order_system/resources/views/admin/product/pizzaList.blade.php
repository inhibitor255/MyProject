@extends('admin.layouts.master')

@section('title', 'Admin Product List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('createMessage'))
                        <div class="create-noti col-4  offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('createMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('updateMessage'))
                        <div class="update-noti col-4  offset-8">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('updateMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteMessage'))
                        <div class="delete-noti col-4  offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('deleteMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h4>Search Key : <b class=" text-danger">{{ request('searchData') }}</b></h4>
                        </div>
                        <div class="navbar bg-body-tertiary col-4 offset-5   ">
                            <div class="container-fluid">
                                <form class="d-flex" role="search" action="{{ route('product#searchData') }}"
                                    method="POST">
                                    @csrf
                                    <input class="form-control me-2" type="search" value="{{ request('searchData') }}"
                                        placeholder="Search" name="searchData">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class=" offset-10 col-1 bg-white shadow-sm rounded text-center">
                            <h3 class="my-2">
                                <i class="zmdi zmdi-pizza mr-2"></i>{{ $pizzas->total() }}
                            </h3>
                        </div>
                    </div>

                    @if ($pizzas->total() != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td class=" col-2">
                                                <img src="{{ asset('storage/' . $pizza->image) }}" alt=""
                                                    class=" img-thumbnail shadow-sm">
                                            </td>
                                            <td class=" col-3">
                                                {{ $pizza->name }}
                                            </td>
                                            <td class=" col-2">
                                                {{ $pizza->price }}
                                            </td>
                                            <td class=" col-2">
                                                {{ $pizza->category_id }}
                                            </td>
                                            <td class=" col-2">
                                                <small><i class="zmdi zmdi-eye"></i></small> {{ $pizza->view_count }}
                                            </td>
                                            <td class=" col-2">
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#detailPage', [$pizza->id]) }}"
                                                        class="item">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('product#editPage', [$pizza->id]) }}" class="item">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a href="{{ route('product#delete', [$pizza->id]) }}" class="item">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="spacer"></tr>
                                </tbody>
                            </table>

                            <div class=" mt-3">
                                {{ $pizzas->links() }}
                            </div>
                        @else
                        </div>
                        <h3 class="text-secondary text-center mt-5">There is no Pizza here!</h3>
                        <!-- END DATA TABLE -->
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
