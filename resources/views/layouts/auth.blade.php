<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="container">

    <div class="left">
        <h1>@yield('left_title')</h1>
        <p>@yield('left_desc')</p>
    </div>

    <div class="right">
        <h2>@yield('form_title')</h2>

        @yield('content')

    </div>

</div>

</body>
</html>