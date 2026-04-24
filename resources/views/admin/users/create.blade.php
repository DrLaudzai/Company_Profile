@extends('layouts.admin')

@section('title', 'Create User')

@section('content')

<div class="card form-card">
    <h3>Create New User</h3>

    <form method="POST" action="{{ route('users.store') }}" class="custom-form">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('users.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-primary">Create</button>
        </div>
    </form>
</div>

@endsection