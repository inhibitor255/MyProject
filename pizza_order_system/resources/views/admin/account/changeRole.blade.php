@extends('admin.layouts.master')

@section('title', 'Change Role Page')

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
                                    Change Role <i class="zmdi zmdi-info"></i>
                                </h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changeRole', [$account->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                                <div class="image">
                                                    <img src="{{ asset('image/default-user.jpg') }}" alt=""
                                                        class=" img-thumbnail shadow-sm">
                                                </div>
                                            @else
                                                <div class="image">
                                                    <img src="{{ asset('image/default-female-profile.avif') }}"
                                                        alt="" class=" img-thumbnail shadow-sm">
                                                </div>
                                            @endif
                                        @else
                                            <div class="image">
                                                <img src="{{ asset('storage/' . $account->image) }}" alt="John Doe" />
                                            </div>
                                        @endif

                                        <div class=" mt-3">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                name="image" id="" disabled>
                                            @error('image')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
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
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Admin Name" value="{{ old('name', $account->name) }}"
                                                disabled>
                                            @error('name')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <select name="role" id="gender"
                                                class=" form-select @error('gender') is-invalid @enderror">
                                                <option value="">Choose Role...</option>
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter Admin Email" value="{{ old('email', $account->email) }}"
                                                disabled>
                                            @error('email')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input type="number" name="phone" id="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Enter Admin Phone" value="{{ old('phone', $account->phone) }}"
                                                disabled>
                                            @error('phone')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gender" class="control-label mb-1">Gender</label>
                                            <select name="gender" id="gender"
                                                class=" form-select @error('gender') is-invalid @enderror" disabled>
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="address" cols="10" rows="3"
                                                class="form-control @error('address') is-invalid @enderror" placeholder="Enter Admin Address" disabled>{{ old('address', $account->address) }}</textarea>
                                            @error('address')
                                                <span class="text-danger sm">{{ $message }}</span>
                                            @enderror
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
