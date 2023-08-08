@extends('admin.layouts.master')

@section('title', 'Password Change Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your New Password</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#passwordChange') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password"
                                        class="form-control @error('oldPassword') is-invalid @enderror @if (session('notMatch')) is-invalid @endif"
                                        placeholder="Write your old password here...">
                                    @error('oldPassword')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                    @if (session('notMatch'))
                                        <span class="text-danger sm">{{ session('notMatch') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror"
                                        placeholder="Write your new password here...">
                                    @error('newPassword')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="newPassword_confirmation" type="password"
                                        class="form-control @error('newPassword_confirmation') is-invalid @enderror"
                                        placeholder="Write your confirm password here...">
                                    @error('newPassword_confirmation')
                                        <span class="text-danger sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Change <i class="zmdi zmdi-skip-next"></i></span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
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
