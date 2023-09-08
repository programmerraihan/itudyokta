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
                            <h4 class="card-title">Update SMS Provider</h4>
                        </div>
                        <div class="card-body">
                            
                            <form action="{{route('sms-provider.update', ['sms_provider' => $provider->id])}}" method="post">
                                @csrf @method('PUT')                                

                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="name">Provider Name*</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{$provider->name}}" placeholder="Provider Name" aria-describedby="helpId" required>
                                        <small id="helpId" class="text-muted">Provider Company Name</small>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="url">Provider URL*</label>
                                        <input type="url" name="provider_url" id="url" class="form-control" value="{{$provider->provider_url}}" placeholder="Provider URL" aria-describedby="helpId" required>
                                        <small id="helpId" class="text-muted">SMS Send Api URL</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sms_check_url">SMS Check URL*</label>
                                    <input type="url" name="sms_check_url" id="sms_check_url" class="form-control" value="{{$provider->sms_check_url}}" placeholder="SMS Check URL" aria-describedby="helpId">
                                    <small id="helpId" class="text-muted">SMS check url</small>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="phone">Phone Field Name*</label>
                                        <input type="text" name="phone" id="phone" value="{{$extra->phone}}"  class="form-control" placeholder="Phone Field Name" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="message">Message Field Name*</label>
                                        <input type="text" name="message" id="message" value="{{$extra->message}}"  class="form-control" placeholder="Message Field Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" @if($provider->active) checked @endif name="active" id="active"> <label for="active">Active</label>
                                </div>
                                <button class="btn btn-sm btn-info" id="add_more" type="button">Add Extra Field</button>
                                <div id="extra_field" class="mt-2">
                                    @forelse ($extra->extra as $key => $value)
                                        <div class="form-row" id="extra_field_{{$key}}">
                                            <div class="form-group col-md-5 col-sm-12">
                                                <input type="text" name="key[]" value="{{$key}}" placeholder="Key" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-5 col-sm-12">
                                                <input type="text" name="value[]" value="{{$value}}" placeholder="Value" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-2 col-sm-12">
                                                <button type="button" class="btn btn-xs remove btn-danger" data-id="extra_field_{{$key}}">Remove</button>
                                            </div>
                                        </div>
                                    @empty                                        
                                    @endforelse
                                    
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