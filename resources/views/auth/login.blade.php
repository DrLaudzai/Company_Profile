@extends('layouts.auth')

@section('title', 'Login')

@section('left_title', 'Welcome Back')
@section('left_desc', 'Secure access to company management system.')

@section('form_title', 'Login Account')

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<div class="switch">
    Don't have an account?
    <a href="{{ route('register') }}">Register</a>
</div>
@endsection