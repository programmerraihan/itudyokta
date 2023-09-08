@extends(auth('branch')->check() ? 'branch.branch_master' : 'admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('sms-provider.create')}}" class="btn btn-sm btn-success">Add New SMS Provider</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h4 class="card-title">SMS Provider List</h4>
                        </div>
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    {{session('message')}}
                                </div>
                            @endif
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Provider Name</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($providers as $provider)
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{$provider->name}}</td>
                                        <td>{{optional(optional($provider)->branch)->name ?? "N/A"}}</td>
                                        <td>
                                            @if ($provider->active)
                                                <span class="badge badge-pill badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Dative</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route("sms-provider.active", ['sms_provider' => $provider->id, 'status' => !$provider->active ? 'on' : 'off'])}}" class="btn btn-sm @if (!$provider->active) btn-success @else btn-warning @endif">
                                                @if (!$provider->active)
                                                    Active
                                                @else
                                                    Deactive
                                                @endif
                                            </a>
                                            <a href="{{route("sms-provider.edit", ['sms_provider' => $provider->id])}}" class="btn btn-info btn-sm">Edit</a>
                                            <a href="javascript:void(0)" data-href="{{route('sms-provider.destroy', ['sms_provider' => $provider->id])}}" class="btn delete btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @empty                                        
                                    @endforelse 
                                </tbody>
                            </table>                                                        
                        </div>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" id="delete_form" method="post"> @csrf @method('DELETE')</form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete', function() {
                let href = $(this).data('href');
                $('#delete_form').attr('action', href).submit();
            });
        });
    </script>
@endpush

