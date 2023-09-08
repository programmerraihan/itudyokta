<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        আইটি উদ্যোক্তা ফাউন্ডেশন
    </title>

    @php
        $system = \App\Models\SystemSetting::where('status', 1)->first();
        
    @endphp

    <link rel="shortcut icon" type="text/css" href=" {{ asset('frontend/image/logo/' . $system->logo) }}">


    <meta name="title" content="{{ $system->name }}" />
    <meta name="description" content="" />
    <meta name="keywords"
        content="IT UDYOKTA,A Project of SOFT HOST LTD Bangladesh Government Approved REGISTRATION NO. C-186066/2022...," />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <script type="text/javascript" src="{{ asset('frontend/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    

    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/fontawesome/css/all.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" type="text/css">
    <link href="../unpkg.com/aos%402.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/gallery.css') }}">


    <link href="../cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />

    @yield('css')


</head>
