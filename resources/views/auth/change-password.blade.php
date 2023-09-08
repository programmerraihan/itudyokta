
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Recover Password | Online Shop Apu Sardar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Reset Password</h5>
                                            <p>Change Your Password</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('backend/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="{{ route('login') }}">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('backend/assets/images/logo.svg') }}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="p-2">
                                    
                                    @if (session('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">                                       
                                            {{session('message')}}
                                        </div>                                        
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">                                       
                                            {{session('error')}}
                                        </div>                                        
                                    @endif

                                    @if(session('time'))
                                    <div class="alert alert-info">
                                        Your verfication code valid till {{session('time')}}
                                    </div>
                                    @endif
                                    <form class="form-horizontal" method="POST" action="{{ route('store.new.password') }}">
                                        @csrf                     
                                        <input type="hidden" name="type" value="{{request()->type ?? "no"}}" />
                                        <div class="form-group">
                                            <label for="verification_code">Verification Code</label>
                                            <input type="text" class="form-control @error('verification_code') is-invalid @enderror"  name="verification_code"  id="verification_code" placeholder="Verification Code" :value="old('verification_code')" required autofocus />
                                            @error('verification_code')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password"  id="password" placeholder="New Password" :value="old('password')" required />
                                            @error('password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control"  name="password_confirmation"  id="password_confirmation" placeholder="Confirm Password" :value="old('password_confirmation')" required />
                                            
                                        </div>                    
                                        <div class="form-group row mb-0">
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                            </div>
                                        </div>    
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>Remember It ? <a href="{{ Route('register') }}" class="font-weight-medium text-primary"> Sign In here</a> </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
        
        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    </body>
</html>