@extends('admin.layouts.master')

@section('title', 'Admin Category List Page')

@section('content')
    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    <span class="form-header">
                        <h4>Admin Dashboard Panel</h4>
                    </span>
                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="noti__item js-item-menu">
                                <i class="zmdi zmdi-notifications"></i>
                                <span class="quantity">3</span>
                                <div class="notifi-dropdown js-dropdown">
                                    <div class="notifi__title">
                                        <p>You have 3 Notifications</p>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c1 img-cir img-40">
                                            <i class="zmdi zmdi-email-open"></i>
                                        </div>
                                        <div class="content">
                                            <p>You got a email notification</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c2 img-cir img-40">
                                            <i class="zmdi zmdi-account-box"></i>
                                        </div>
                                        <div class="content">
                                            <p>Your account has been blocked</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c3 img-cir img-40">
                                            <i class="zmdi zmdi-file-text"></i>
                                        </div>
                                        <div class="content">
                                            <p>You got a new file</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>
                                    <div class="notifi__footer">
                                        <a href="#">All notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                    <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{ auth()->user()->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">{{ auth()->user()->name }}</a>
                                            </h5>
                                            <span class="email">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account
                                            </a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer my-3">
                                        <form action="{{ route('logout') }}" method="post"
                                            class=" d-flex justify-content-center">
                                            @csrf
                                            <button type="submit" class="btn btn-dark text-center col-10">
                                                <i class="zmdi zmdi-power"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER DESKTOP-->

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
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
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                                <form class="d-flex" role="search" action="{{ route('category#search') }}"
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
                            <h3 class="my-2"><i class="zmdi zmdi-collection-item mr-2"></i> {{ $categories->Total() }}
                            </h3>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>updated Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td class=" col-6">{{ $category->name }}</td>
                                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                                            <td>

                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#editPage', [$category->id]) }}"
                                                        class="item">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a href="{{ route('category#delete', [$category->id]) }}"
                                                        class="item">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class=" mt-3">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Category here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
