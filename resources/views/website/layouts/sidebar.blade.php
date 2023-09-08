<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp; <a href="{{ route("website.admission", ['branch' => request()->branch ?? 'main']) }}"><b>Admission</b></a>
    </li>
    <li class="list-group-item">
        <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp; <a href="{{ route("website.online-exam", ['branch' => request()->branch ?? 'main']) }}"><b>Online
                Exam</b></a>
    </li>
    <li class="list-group-item">
        <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp; <a href="{{ route("website.result", ['branch' => request()->branch ?? 'main']) }}"><b>Result</b></a>
    </li>
    <li class="list-group-item">
        <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp; <a href="{{ route("website.blog", ['branch' => request()->branch ?? 'main']) }}"><b>Blog</b></a>
    </li>
</ul>

<!-- notice board -->
<div class="card mt-3 shadow-sm">
    <div class="card-header bg-primary text-light">Notice Board</div>
    <div class="card-body bg-light">
        <ul class="list-group list-group-flush">
            @forelse ($notices as $notice)
                <li class="list-group-item bg-light">
                    <i class="fa fa-bell"></i>&nbsp;&nbsp;
                    <a href="{{ route('website.notice.details', ['id' => $notice->id, 'branch' => request()->branch ?? 'main']) }}" role="button" class="text-decoration-none text-dark">
                        {{$notice->title}}
                    </a>
                    <p class="p-0 m-0"><small><i class="fa fa-calendar"></i> {{date("d/m/y", strtotime($notice->created_at))}}</small></p>
                </li>
            @empty
            <li class="list-group-item bg-light text-center">
                Data Not Found!
            </li>
            @endforelse
        </ul>
    </div>
    <div class="card-footer">
        <a href="{{route('website.notice', ['branch' => request()->branch ?? 'main'])}}" class="btn btn-sm w-100 btn-primary">All Notice</a>
    </div>
</div>


<div class="card mt-3 shadow-sm">
    <div class="card-header bg-primary text-light">অফিসিয়াল লিংক</div>
    <div class="card-body bg-light">
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="http://www.moedu.gov.bd/" role="button" class="text-decoration-none text-dark">
                    শিক্ষা মন্ত্রণালয়
                </a>
            </li>
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="http://www.educationboardresults.gov.bd/" role="button"
                    class="text-decoration-none text-dark">
                    এসএসসি/এইচএসসি ফলাফল
                </a>
            </li>
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="http://banbeis.gov.bd/new/" role="button" class="text-decoration-none text-dark">
                    ব্যানবেজ
                </a>
            </li>
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="http://www.seqaep.gov.bd/" role="button" class="text-decoration-none text-dark">
                    সেকায়েপ
                </a>
            </li>

        </ul>
    </div>
</div>

<div class="card mt-3 shadow-sm">
    <div class="card-header bg-primary text-light">গুরুত্বপূর্ণ তথ্য</div>
    <div class="card-body bg-light">
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="http://www.ebook.gov.bd/" role="button" class="text-decoration-none text-dark">
                    ই-বুক
                </a>
            </li>
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="https://www.teachers.gov.bd/" role="button" class="text-decoration-none text-dark">
                    শিক্ষক বাতায়ন
                </a>
            </li>
            <li class="list-group-item bg-light">
                <i class="fa fa-arrow-circle-o-right"></i>&nbsp;&nbsp;
                <a target="_blank" href="http://mmc.e-service.gov.bd/" role="button" class="text-decoration-none text-dark">
                    মাল্টিমিডিয়া ক্লাসরুম ম্যানেজমেন্ট
                </a>
            </li>
        </ul>
    </div>
</div>
