@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')

<div class="user-cards">
    <div class="user-card">
        <h3>Welcome</h3>
        <p>{{ auth()->user()->name }}</p>
    </div>

    <div class="user-card">
        <h3>Email</h3>
        <p>{{ auth()->user()->email }}</p>
    </div>

    <div class="user-card">
        <h3>Member Since</h3>
        <p>{{ auth()->user()->created_at->format('d M Y') }}</p>
    </div>
</div>

<div class="user-panel">
    <h3>Your Activity</h3>
    <p>This is your personal dashboard area.</p>
</div>

<div class="user-card">
    <h3>Your Account ID</h3>
    <p>#{{ auth()->user()->id }}</p>
</div>

<div class="user-card">
    <h3>Total Login</h3>
    <p>Coming Soon</p>
</div>


@endsection