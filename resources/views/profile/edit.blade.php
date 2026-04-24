@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')

<div class="profile-wrapper">
    <div class="profile-card">
        <h2>Edit Profile</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="avatar-section">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="avatar-preview">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="avatar-preview">
                @endif

                <input type="file" name="avatar">
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ auth()->user()->email }}" disabled>
            </div>

            <!-- Tombol Container Flex -->
            <div class="button-group" style="display:flex; gap:10px; margin-top:20px;">
                <button type="submit" class="btn-save" style="flex:1; padding:10px 0;">Simpan Perubahan</button>
                <a href="{{ route('user.dashboard') }}" class="btn-back" style="flex:1; text-align:center; padding:10px 0; background:#3490dc; color:white; border-radius:4px; text-decoration:none;">
                    &larr; Kembali ke Dashboard
                </a>
            </div>

        </form>
    </div>
</div>

@endsection