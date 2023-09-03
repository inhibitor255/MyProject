@extends('user.layouts.master')

@section('title', 'Contact Page')

@section('content')
    <div class="row">
        <div class="container col-6 offset-3 bg-dark text-white mt-5 rounded mb-3 ">
            <h2>Contact Us</h2>
            <p>Have any questions or feedback? Reach out to us!</p>

            {{-- Display success message if contact form is submitted --}}
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form method="POST" action="{{ route('contact#submitForm') }}" class="mb-3">
                @csrf
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <span class="text-danger sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror " id="email"
                        name="email" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                        <span class="text-danger sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-danger sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
    </div>
@endsection
