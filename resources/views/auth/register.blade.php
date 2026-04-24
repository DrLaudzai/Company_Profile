@extends('layouts.auth')

@section('title', 'Register')

@section('left_title', 'Join Our Company')
@section('left_desc', 'Create your account to access our internal system.')

@section('form_title', 'Create Account')

@section('content')

{{-- Alert Success --}}
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="form-group">
        <input type="text" name="name" placeholder="Full Name"
            value="{{ old('name') }}"
            class="@error('name') is-invalid @enderror">

        @error('name')
            <small class="error-text">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder="Email Address"
            value="{{ old('email') }}"
            class="@error('email') is-invalid @enderror">

        @error('email')
            <small class="error-text">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" name="password" placeholder="Password"
            class="@error('password') is-invalid @enderror">

        @error('password')
            <small class="error-text">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
    </div>

    <button type="submit">Register</button>
</form>

<div class="switch">
    Already have an account?
    <a href="{{ route('login') }}">Login</a>
</div>

@endsection