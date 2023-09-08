<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | IT Udyokta Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    @include('admin.body.style')
</head>

<body data-sidebar="dark">
   
    <div id="layout-wrapper">

        @include('admin.body.hearder')
        @include('admin.body.sidebar')


        <div class="main-content">
            @yield('admin')



            @include('admin.body.footer')
        </div>
    </div>
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @include('admin.body.script')

    @stack('js')
</body>

</html>
