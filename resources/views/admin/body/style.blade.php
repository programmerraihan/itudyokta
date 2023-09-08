   {{-- <!-- App favicon -->
   <link rel="shortcut icon" href="  {{ asset('backend/assets/images/favicon.png') }}">


   <!-- Summernote css -->
   <link href="{{ asset('assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- DataTables -->
   <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
       type="text/css" />
   <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
       rel="stylesheet" type="text/css" />

   <!-- Responsive datatable examples -->
   <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
       rel="stylesheet" type="text/css" />


   <link href="{{ asset('/') }}backend/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css"
       rel="stylesheet" type="text/css">
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"
       rel="stylesheet" type="text/css">
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css"
       rel="stylesheet" type="text/css">
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css"
       rel="stylesheet" type="text/css" />





   <!-- Bootstrap Css -->
   <link href="  {{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
       type="text/css" />
   <!-- Icons Css -->
   <link href="  {{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
   <!-- App Css-->
   <link href="  {{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}

   <!-- App favicon -->
   <link rel="shortcut icon" href="{{ asset('/') }}backend/assets/images/favicon.ico">
   <!-- Summernote css -->
   <link href="{{ asset('/') }}backend/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet"
       type="text/css" />

   <link href="{{ asset('/') }}backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
       rel="stylesheet" type="text/css" />
   <link href="{{ asset('/') }}backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
       rel="stylesheet" type="text/css" />
   <link href="{{ asset('/') }}backend/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css"
       rel="stylesheet" type="text/css">
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"
       rel="stylesheet" type="text/css">
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css"
       rel="stylesheet" type="text/css">
   <link href="{{ asset('/') }}backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css"
       rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="{{ asset('/') }}assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">
   <!-- Bootstrap Css -->
   <link href="{{ asset('/') }}backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
       type="text/css" />
   <!-- Icons Css -->
   <link href="{{ asset('/') }}backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
   <!-- App Css-->
   <link href="{{ asset('/') }}backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />




   <style type="text/css">
       fieldset {
           min-width: 0px;
           padding: 15px;
           margin: 7px;
           border: 2px solid #a66df5;
       }

       legend {
           float: none;
           background-image: linear-gradient(to bottom right, #8ba9f6, #eb87ff);
           padding: 4px;
           width: 50%;
           color: #000;
           border-radius: 7px;
           font-size: 17px;
           font-weight: 700;
           text-align: center;
       }
   </style>
   @yield('css')
