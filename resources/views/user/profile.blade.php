@extends('layouts.user')

@section('title', 'Profile')

@section('content')

<h2>Edit Profile</h2>



@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Name</label>
    <input type="text" name="name" value="{{ auth()->user()->name }}">

    <label>Avatar</label>
    <input type="file" name="avatar">

    <button type="submit">Update</button>
</form>

@if(auth()->user()->avatar)
    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" width="120">
@endif



@endsection