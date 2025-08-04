@extends('layouts.admin')

@section('content')
<div class="card p-4">
    <h3>⚙️ Application Settings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>App Name</label>
            <input type="text" name="app_name" class="form-control" 
                   value="{{ old('app_name', $setting->app_name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Recipient Email</label>
            <input type="email" name="recipient_email" class="form-control" 
                   value="{{ old('recipient_email', $setting->recipient_email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            @if(!empty($setting->logo))
                <img src="{{ asset('uploads/'.$setting->logo) }}" alt="logo" height="60" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
    </form>
</div>
@endsection
