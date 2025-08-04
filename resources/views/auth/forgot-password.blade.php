@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-warning w-100">Send Password Reset Link</button>
    <div class="text-center mt-2">
        <a href="{{ route('login') }}">Back to Login</a>
    </div>
</form>
@endsection
