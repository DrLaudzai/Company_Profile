<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>

<div class="user-navbar">

    <div class="nav-left">
        <a href="{{ route('task.index') }}" class="logo">
            MyCompany
        </a>

        <a href="{{ route('task.index') }}" class="nav-link">Tasks</a>
        <a href="/dashboard" class="nav-link">Dashboard</a>
    </div>

    <div class="nav-right">

        <button onclick="toggleDark()" class="btn-dark">🌙</button>

        <span class="badge-role {{ auth()->user()->role == 'admin' ? 'badge-admin' : 'badge-user' }}">
            {{ auth()->user()->role }}
        </span>

        <span class="username">{{ auth()->user()->name }}</span>

        {{-- Avatar klik ke profile --}}
        <a href="{{ route('profile.edit') }}">
            <img src="{{ auth()->user()->avatar 
                ? asset('storage/' . auth()->user()->avatar) 
                : 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}" 
                class="avatar">
        </a>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn-logout">Logout</button>
        </form>

    </div>

</div>

<div class="user-container">
    @yield('content')
</div>

{{-- GLOBAL SCRIPT --}}
<script>
function toggleDark() {
    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
}

if(localStorage.getItem('darkMode') === 'enabled'){
    document.body.classList.add('dark-mode');
}
</script>

{{-- PENTING: INI BUAT TASKS --}}
@yield('scripts')

</body>
</html>