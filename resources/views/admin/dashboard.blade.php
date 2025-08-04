@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">📊 Admin Dashboard {{ auth()->user()->role }}</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Complaints</h5>
                    <p class="card-text display-6">{{ $totalComplaints }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Users Registered</h5>
                    <p class="card-text display-6">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Form Fields</h5>
                    <p class="card-text display-6">{{ $totalFields }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
