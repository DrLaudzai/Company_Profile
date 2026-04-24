@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<div class="card form-card">
    <h3>Company Settings</h3>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" 
        enctype="multipart/form-data" class="custom-form">
        @csrf

        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="company_name"
                value="{{ $setting->company_name ?? '' }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="company_email"
                value="{{ $setting->company_email ?? '' }}">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="company_phone"
                value="{{ $setting->company_phone ?? '' }}">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="company_address" rows="3">
                {{ $setting->company_address ?? '' }}
            </textarea>
        </div>

        <div class="form-group">
            <label>Logo</label>
            <input type="file" name="logo">

            @if(!empty($setting->logo))
                <img src="{{ asset('storage/' . $setting->logo) }}" 
                    width="100" style="margin-top:10px;">
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Save Settings</button>
        </div>

    </form>
</div>

@endsection