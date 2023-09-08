@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            @if ($message = Session::get('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{-- @dd($message) --}}
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body bg-soft-success ">
                            <h4 class="card-title mb-4">Teacher Detail </h4>
                            <hr />

                            <form action="{{ route('employee.store') }} " method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body badge-soft">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Name <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="name">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="initial_name">Initial Name <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="text" name="initial_name" class="form-control"
                                                                id="initial_name">

                                                            @error('initial_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="department">Department <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="text" name="department" class="form-control"
                                                                id="department">

                                                            @error('department')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formrow-Web-input">Designation <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="text" name="designation" class="form-control"
                                                                id="designation">

                                                            @error('designation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email" name="email" class="form-control"
                                                                id="address">

                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formrow-Web-input">Phon Number <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="number" name="phon_number" class="form-control"
                                                                id="formrow-Web-input">

                                                            @error('phon_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address">Room No <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" name="room_no" class="form-control"
                                                                id="address">

                                                            @error('room_no')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formrow-Web-input">Emergency Contact <span
                                                                    class="text-danger">*</span> </label>
                                                            <input type="number" name="emergency_number"
                                                                class="form-control" id="formrow-Web-input">

                                                            @error('emergency_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group mb-4">
                                                    <label for="horizontal-firstname-input199 " class="col-form-label"
                                                        accept="image/*"> Profile Image <span class="text-danger">*</span>
                                                    </label>
                                                    <hr />
                                                    <input type="file" name="profile_image" accept="image/*"
                                                        class="form-control-file" />
                                                    @error('profile_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group  mb-4">
                                                    <label class="col-form-label"> Publication Status </label>
                                                    <hr />
                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" checked type="radio"
                                                                name="status" id="inlineCheckbox1" value="1">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox1">Published</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status"
                                                                id="inlineCheckbox2" value="0">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox2">Unpublished</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body pb-1">
                                                <div class="form-group ">
                                                    <button type="submit" class="btn btn-primary w-md btn-block">Create
                                                        New
                                                        Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
