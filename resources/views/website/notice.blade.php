@extends('website.layouts.layout')

@section('title', 'All Notice')

@section('content')
    <div class="col-sm-12">
        <div class="card mb-3 shadow">
            <div class="card-header bg-success text-light">All Notice</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($notices as $notice)
                        <li class="list-group-item">
                            <i class="fa fa-bell"></i>&nbsp;&nbsp;
                            <a href="{{ route('website.notice.details', ['id' => $notice->id, 'branch' => request()->branch ?? 'main']) }}" role="button" class="text-decoration-none text-dark">
                                {{ $notice->title }}
                            </a>
                            <p class="p-0 m-0"><small><i class="fa fa-calendar"></i>
                                    {{ date('d/m/y', strtotime($notice->created_at)) }}</small></p>
                        </li>
                    @empty
                        <li class="list-group-item text-center">
                            Data Not Found!
                        </li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer">
                {{ $notices->links() }}
            </div>
        </div>
    </div>
@endsection
