@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Register</button>
    <div class="text-center mt-2">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
</form>
@endsection
