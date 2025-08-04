@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <!-- Token dari link email -->
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
</form>
@endsection
