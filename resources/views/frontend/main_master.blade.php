<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

@include('frontend.body.styles')

<body id="top">
   
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>


    @yield('mian')

    @include('frontend.body.footer')

    @include('frontend.body.script')
    @yield('js')

</body>

</html>
