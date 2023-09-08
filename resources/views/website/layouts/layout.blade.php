<!doctype html>
<html lang="en">

<head>
    <title>
        @hasSection('title')
            @yield("title") | আইটি উদোক্ত্যা
        @else 
            আইটি উদোক্ত্যা
        @endif
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;800&family=Ysabeau+Infant:wght@300;400;600;700;800&family=Ysabeau+SC:wght@400;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            /* font-family: 'Ysabeau Infant', sans-serif; */
            /* font-family: 'Ysabeau SC', sans-serif; */
        }

        .hover-shadow:hover {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }

        @media (min-width: 1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 1200px;
            }
        }
    </style>

    @stack('css')

</head>

<body>

    <div class="container shadow p-2">
        <div class="w-100 p-1 bg-light text-dark clearfix">
           <a href="{{ route("login_from_branch") }}" class="text-decoration-none text-danger float-end" style="margin-left: 50px;">Branch Login</a>
           <a href="{{ route("login_from_student") }}" class="text-decoration-none text-danger float-end">Student Login</a> 
        </div>
        <?php
            $branch = request()->branch != 'main' ? request()->branch : null;
            if($branch) {
                $branch = \App\Models\Branch::where("slug", $branch)->first();
            }
        ?>
        @if($branch)
        <div class="banner m-auto">
            <img src="{{ asset('admin/center/website_banner/' . $branch->website_banner) }}" class="img-fluid" alt="Banner" />
        </div>
        @else 
        <div class="banner m-auto">
            <img src="{{ asset('image/banner.gif') }}" class="img-fluid" alt="Banner" />
        </div>
        @endif

        {{-- navbar --}}
        @include("website.layouts.navbar")

        @stack("slider")

        <div class="mt-3">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row">
                       @yield("content")
                    </div>
                </div>


                <div class="col-md-3 col-sm-12">
                    @include("website.layouts.sidebar")
                </div>
            </div>
        </div>


        <!-- footer -->
        <?php
            $system = \App\Models\SystemSetting::where('status', 1)->first();
        ?>
        <footer class="bg-light text-dark mt-5 p-3 rounded">
            <div class="d-flex justify-content-between">
                <div>
                    <p>All Right Reserved @ 2020</p>
                </div>
                <div>
                    <h5 class="m-0 p-1">Office Address</h5>
                    <p class="m-0 p-1">{{ $system->address1 }}</p>
                    <p class="m-0 p-1">{{ $system->phone2 }}</p>
                    <p class="m-0 ">{{ $system->gmail1 }}</p>
                </div>
                <div>
                    Developed By: <a href="{{ route("website.home") }}">ItUdyokta</a>
                </div>
            </div>
        </footer>

    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>

</html>
