@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Branding Settings</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.settings.branding.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>App Name</label>
            <input type="text" name="app_name" class="form-control" 
                   value="{{ $settings->app_name ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label>Recipient Email</label>
            <input type="email" name="recipient_email" class="form-control" 
                   value="{{ $settings->recipient_email ?? '' }}">
        </div>
        <div class="mb-3">
            <label>Logo</label><br>
            @if(!empty($settings->logo))
                <img src="{{ asset('storage/'.$settings->logo) }}" alt="Logo" width="100" class="mb-2">
            @endif
            <input type="file" name="logo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
