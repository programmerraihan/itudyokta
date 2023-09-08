<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar="init" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" style="overflow: scroll; height:100vh; ">
            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('student.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">03</span>
                        <span>Dashboards</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cubes"></i>
                        <span>MCQ Exam Student </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('student.mcq.submitted') }}">Our Course</a></li>
                        <li><a href="{{ route('submitted.mcq.index') }}">Result</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cubes"></i>
                        <span>Student From </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('student.from.show') }}">Student From</a></li>

                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cubes"></i>
                        <span>Course </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('student.course.index') }}">Our Course</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-hourglass"></i>
                        <span>Student Result </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('student.student_result.show') }}">Student Result </a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-hourglass"></i>
                        <span> Home Work </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('submitted.homework.show') }}">Teacher Send </a></li>
                        {{-- <li><a href="{{ route('add.homework.submitted') }}">Submitted Home Work </a></li> --}}
                        <li><a href="{{ route('submitted.homework.manage') }}">Your Home Work List</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-layer"></i>
                        <span> Assignment </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('submitted.assignment.show') }}">Teacher Send </a></li>
                        {{-- <li><a href="{{ route('add.assignment.submitted') }}">Submitted Assignment </a></li> --}}
                        <li><a href="{{ route('submitted.assignment.manage') }}"> Your Assignment List </a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-vr-cardboard"></i>
                        <span> Live Class</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="#">Google Met </a></li>

                    </ul>
                </li>

                <li class="menu-title " style="color: #ffd0ad"> &nbsp STITBD @2022</li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
