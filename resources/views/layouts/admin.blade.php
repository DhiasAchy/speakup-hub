<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <title>SpeakUp Hub Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')  {{-- ✅ Tambahkan ini --}}
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar .active {
            background: #007bff;
            color: white;
        }
        .content {
            padding: 20px;
        }
        .navbar-dark { background-color: #212529; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 col-lg-2 sidebar">
            <h4 class="text-center mb-4">SpeakUp Hub</h4>
            <a href="{{ route('admin.complaints.index') }}" class="{{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">📬 Complaints</a>
            <a href="{{ route('admin.form-builder') }}" class="{{ request()->routeIs('admin.form-builder') ? 'active' : '' }}">🛠️ Form Builder</a>
            {{-- <a href="#">👥 Users</a> --}}
            {{-- <a href="{{ route('admin.settings') }}">⚙️ Settings</a> --}}
            <div class="dropdown">
                <a class="dropdown-toggle {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ⚙️ Settings
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item {{ request()->routeIs('admin.settings.branding*') ? 'active' : '' }}" href="{{ route('admin.settings.branding') }}">Branding</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('admin.settings.email-recipients*') ? 'active' : '' }}" href="{{ route('admin.settings.email-recipients') }}">Email Recipients</a></li>
                </ul>
            </div>
            @auth
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
            @endauth
        </div>

        {{-- Main Content --}}
        <main class="col-md-9 col-lg-10 content">
            <nav class="navbar navbar-dark mb-4">
                <span class="navbar-text ms-3">
                    Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                </span>
            </nav>
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts') {{-- ✅ Tambahkan ini --}}
</body>
</html>
