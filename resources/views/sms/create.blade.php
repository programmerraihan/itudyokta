@extends(auth('branch')->check() ? 'branch.branch_master' : 'admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('sms-provider.index')}}" class="btn btn-sm btn-success">SMS Provider List</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Add New SMS Provider</h4>
                        </div>
                        <div class="card-body">
                            
                            <form action="{{route('sms-provider.store')}}" method="post">
                                @csrf
                                @if (auth('branch')->check())
                                    <input type="hidden" name="branch_id" value="{{auth('branch')->user()->id}}" />
                                @endif
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="name">Provider Name*</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Provider Name" aria-describedby="helpId" required>
                                        <small id="helpId" class="text-muted">Provider Company Name</small>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="url">Provider URL*</label>
                                        <input type="url" name="provider_url" id="url" class="form-control" placeholder="Provider URL" aria-describedby="helpId" required>
                                        <small id="helpId" class="text-muted">SMS Send Api URL</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sms_check_url">SMS Check URL*</label>
                                    <input type="url" name="sms_check_url" id="sms_check_url" class="form-control" placeholder="SMS Check URL" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">SMS check url</small>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="phone">Phone Field Name*</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Field Name" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="message">Message Field Name*</label>
                                        <input type="text" name="message" id="message" class="form-control" placeholder="Message Field Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="active" id="active"> <label for="active">Active</label>
                                </div>
                                <button class="btn btn-sm btn-info" id="add_more" type="button">Add Extra Field</button>
                                <div id="extra_field" class="mt-2">
                                    <div class="form-row" id="extra_field_01">
                                        <div class="form-group col-md-5 col-sm-12">
                                            <input type="text" name="key[]" placeholder="Key" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-5 col-sm-12">
                                            <input type="text" name="value[]" placeholder="Value" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-2 col-sm-12">
                                            <button type="button" class="btn btn-xs remove btn-danger" data-id="extra_field_01">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                </div>
                            </form>                                                    
                        </div>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        
        $(document).ready(function() {
            $(document).on('click', '.remove', function() {
                $('#' + $(this).data('id')).remove();
            });

            $('#add_more').click(function () {
                let id = Number(Math.random() * 1233).toFixed(0);
                let template = `<div class="form-row" id="extra_field_${id}">
                                        <div class="form-group col-md-5 col-sm-12">
                                            <input type="text" name="key[]" placeholder="Key" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-5 col-sm-12">
                                            <input type="text" name="value[]" placeholder="Value" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-2 col-sm-12">
                                            <button type="button" class="btn btn-xs remove btn-danger" data-id="extra_field_${id}">Remove</button>
                                        </div>
                                    </div>`;
                $("#extra_field").append(template);
            });

        });
    </script>
@endpush