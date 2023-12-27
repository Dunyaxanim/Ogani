<!DOCTYPE html>
<html lang="en">

<head>
    @include('front.partials._head')
</head>

<body>
<header class="header">
    @include('front.partials._topheader')
    @include('front.partials._header')
</header>

    @include('front.partials._hero')

    <main>
        @yield('_content')
    </main>

    @include('front.partials._footer')
    @include('front.partials._scripts')
</body>

</html>