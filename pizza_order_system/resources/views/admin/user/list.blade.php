@extends('admin.layouts.master')

@section('title', 'Customers List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-3">
                            <h4>Search Key : <b class=" text-danger">{{ request('searchData') }}</b></h4>
                        </div>
                        <div class="navbar bg-body-tertiary col-4 offset-5   ">
                            <div class="container-fluid">
                                <form class="d-flex" role="search" action="{{ route('admin#userListPage') }}"
                                    method="POST">
                                    @csrf
                                    <input class="form-control me-2" type="search" value="{{ request('searchData') }}"
                                        placeholder="Search" name="searchData">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="customer-section">
                        <div class="row my-2">
                            <div class="col-3">
                                <span class="title-1 bold">Customer List</span>
                            </div>
                            <div class="col-2 offset-7 bg-white shadow-sm rounded text-center">
                                <h3 class="my-2">
                                    <i class="zmdi zmdi-account"></i> {{ $users->total() }}
                                </h3>
                            </div>
                        </div>

                        @if ($users->count() != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Auth</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTBody">
                                        @foreach ($users as $user)
                                            <tr class="tr-shadow userTr" id="userTr">

                                                <td class=" col-2">
                                                    @if ($user->image != null)
                                                        <div class="image">
                                                            <img src="{{ asset('storage/' . $user->image) }}" alt=""
                                                                class=" img-thumbnail shadow-sm" style="height: 80px">
                                                        </div>
                                                    @else
                                                        @if ($user->gender == 'male')
                                                            <div class="image">
                                                                <img src="{{ asset('image/default-user.jpg') }}"
                                                                    alt="" class=" img-thumbnail shadow-sm"
                                                                    style="height: 80px">
                                                            </div>
                                                        @else
                                                            <div class="image">
                                                                <img src="{{ asset('image/default-female-profile.avif') }}"
                                                                    alt="" class=" img-thumbnail shadow-sm"
                                                                    style="height: 80px">
                                                            </div>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class=" col-3">
                                                    {{ $user->name }}
                                                </td>
                                                <td class=" col-2">
                                                    {{ $user->email }}
                                                </td>
                                                <td class=" col-2">
                                                    {{ Str::ucfirst($user->gender) }}
                                                </td>
                                                <td>
                                                    {{ $user->phone }}
                                                </td>
                                                <td class=" col-2">
                                                    {{ $user->address }}
                                                </td>

                                                <td class="customerTd">
                                                    <input type="hidden" class="customerId" value="{{ $user->id }}">
                                                    <div class="table-data-feature">
                                                        <select class="custom-slect customerRole">
                                                            <option value="admin"
                                                                @if ($user->role == 'admin') selected @endif> Admin
                                                            </option>
                                                            <option value="user"
                                                                @if ($user->role == 'user') selected @endif>
                                                                Customer</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (auth()->user()->id != $user->id)
                                                        <div class="table-data-feature">
                                                            <a href="{{ route('admin#userEditPage', [$user->id]) }}"
                                                                class="item me-2">
                                                                <i class="zmdi zmdi-edit "></i>
                                                            </a>
                                                            <a href="{{ route('admin#delete', [$user->id]) }}"
                                                                class="item me-2">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="spacer"></tr>
                                    </tbody>
                                </table>

                                <div class=" mt-3">
                                    {{ $users->links() }}
                                </div>
                            @else
                            </div>
                            <h3 class="text-secondary text-center mt-5">There is no user here!</h3>
                            <!-- END DATA TABLE -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('.customerRole').change(function(e) {
                e.preventDefault();
                let parentNode = $(this).parents(".customerTd");
                let id = parentNode.find('.customerId').val();
                let role = parentNode.find('.customerRole').val();

                $.ajax({
                    type: "get",
                    url: "/admins/ajax/role/change",
                    data: {
                        "id": id,
                        "role": role,
                    },
                    dataType: "json",
                    success: function(response) {
                        // Redirect to a new URL
                        location.reload();
                    }
                });


            });


        });
    </script>
@endsection
