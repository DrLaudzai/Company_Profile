<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="logo">
        <span>MyCompany</span>
        <button id="toggleSidebar">☰</button>
    </div>

    <ul class="menu">
        <li class="active">
            <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line"></i> <span>Dashboard</span></a>
        </li>
        <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <a href="{{ route('reports.index') }}">
                <i class="fa-solid fa-file-lines"></i>
                <span>Reports</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <a href="{{ route('settings.index') }}">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('task.*') ? 'active' : '' }}">
            <a href="{{ route('task.index') }}">
                <i class="fa-solid fa-gear"></i>
                <span>Task</span>
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>

<div class="main-content" id="mainContent">
    <div class="topbar">
        <h2>@yield('title')</h2>
        <div class="profile">
            {{ auth()->user()->name }}
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

<script>
    document.getElementById("toggleSidebar").addEventListener("click", function(){
        document.getElementById("sidebar").classList.toggle("collapsed");
        document.getElementById("mainContent").classList.toggle("expanded");
    });
</script>

</body>
</html>