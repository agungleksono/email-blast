<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Email Blast</title>

    @stack('prepend-style')
    @include('includes.style')
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
    }
    </style>
    @stack('addon-style')
</head>
<body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
<!-- <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"></a> -->
<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Email Blast</a>
<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<!-- <input class="form-control form-control-dark w-100" type="text" placeholder="" aria-label="Search"> -->
<div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <a class="nav-link px-3" href="#"></a>
    <!-- <a class="nav-link px-3" href="#">Sign out</a> -->
    </div>
</div>
</header>

<div class="container-fluid">
<div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('schedule') || request()->is('schedule/*') ? 'active' : '' }}" aria-current="page" href="{{ route('index.schedule') }}">
            <span data-feather="home"></span>
            Schedule
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('history') || request()->is('history/*') ? 'active' : '' }}" href="{{ url('history') }}">
            <span data-feather="file"></span>
            History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('email-template') || request()->is('email-template/*') ? 'active' : '' }}" href="{{ url('email-template') }}">
            <span data-feather="file"></span>
            Email Setting
            </a>
        </li>
        </ul>
    </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
        <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
            </div>
        </div> -->

        <!-- <h2>Section title</h2> -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        {{-- Content --}}
          @yield('content')

    </main>
</div>
</div>

    @stack('prepend-script')
    @include('includes.script')
    <script>
        new DataTable('#example', {
            scrollX: true
        });
    </script>
    @stack('addon-script')
</body>
</html>
