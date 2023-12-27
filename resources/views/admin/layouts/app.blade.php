<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials._head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        @include('admin.partials._header')

        @include('admin.partials._aside')

        @yield('_content')

        <aside class="control-sidebar control-sidebar-dark">

        </aside>
        @include('admin.partials._footer')
        @include('admin.partials._scripts')
        
    </div>


</body>

</html>
