@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input">
        <label class="form-check-label">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
    <div class="text-center mt-2">
        <a href="{{ route('password.request') }}">Forgot Password?</a>
    </div>
</form>
@endsection
