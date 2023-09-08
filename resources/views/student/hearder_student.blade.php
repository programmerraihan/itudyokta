<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src=" {{ asset('backend/assets/images/logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            {{-- <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> --}}


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            @php
                $id = Auth::guard('student')->user()->id;
              
                // $system = \App\Models\SystemSetting::where('status', 1)
                //     ->where('branch_id', $id)
                //     ->first();
                
                $student = \App\Models\Student::where('status', 1)
                    ->where('id', $id)
                    ->select('image', 'name')
                    ->first();
                // dd($student);
            @endphp


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                    @if (empty($student->image))
                        <img class="rounded-circle header-profile-user"src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.123rf.com%2Fclipart-vector%2Fpassport_photo.html&psig=AOvVaw03gjvCAHJhhuDt4oNrxAgd&ust=1683785303020000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCPCa85iL6v4CFQAAAAAdAAAAABAE"
                            alt="" alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('admin/image/student/' . $student->image) }}" alt="Header Avatar">
                    @endif

                    {{-- <img class="rounded-circle header-profile-user"
                        src="{{ asset('admin/image/student/' . $student->image) }}" alt="Header Avatar"> --}}


                    <span class="d-none d-xl-inline-block ml-1">{{ auth('student')->user()->name ?? 'null' }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    {{-- <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a> --}}
                    {{-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i>
                        My Wallet</a>
                    <a class="dropdown-item d-block" href="#"><span
                            class="badge badge-success float-right">11</span><i
                            class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i
                            class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item text-danger" href="{{ route('student.logout') }}"><i
                            class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>
