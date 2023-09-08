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

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">User Permission</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User List</a></li>
                                <li class="breadcrumb-item active">User Permission</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @dd($branches); --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route("users.permission.store", ["user" => $user->id]) }}" method="post">
                                @csrf 
                            
                                <table class="table table-sm text-left">
                                    <thead>
                                        <tr>
                                            <th style="width:150px;">Module</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($permissions as $module => $permission)
                                        <tr>
                                            <td>{{$module}}</td>
                                            <td class="d-flex justify-content-start flex-wrap">
                                                @foreach ($permission as $name => $value )
                                                <div class="p-2">
                                                    <div class="pretty p-switch p-fill">
                                                        <input type="checkbox" name="permission[]" @if($user->can($value)) checked @endif  value="{{$value}}" />
                                                        <div class="state p-success">
                                                            <label>{{$name}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @empty                                        
                                        @endforelse 
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </td>
                                        </tr>                                       
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
@endsection

@push('js')
@endpush
