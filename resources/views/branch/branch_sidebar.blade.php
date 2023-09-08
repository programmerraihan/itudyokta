<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar="init" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" style="overflow: scroll; height:100vh; ">
            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('branch.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right">03</span>
                        <span>Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-dice-d20"></i>
                        <span>Forntend CMS </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('branch.about.index') }}">About</a></li>
                        <li><a href="{{ route('branch.contact.index') }}">Contact</a></li>
                        <li><a href="{{ route('branch.blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('branch.gallery.index') }}"> Gallery </a></li>
                        <li><a href="{{ route('branch.notice.index') }}"> Notice </a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-web"></i>
                        <span>Home </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route('branch.add.slide') }}">Add Slide</a></li> --}}
                        <li><a href="{{ route('branch.index.slide') }}">Slide List</a></li>
                        <li><a href="{{ route('branch.speech.index') }}">Our Speech </a></li>
                        {{-- <li><a href="{{ route('branch.course.index') }}">Course</a></li> --}}
                        <li><a href="{{ route('branch.service.index') }}">Our Services </a></li>
                        <li><a href="{{ route('branch.project.index') }}">Our Project </a></li>
                        <li><a href="{{ route('branch.director.index') }}">Directors </a></li>
                        <li><a href="{{ route('branch.testimonial.index') }}">Testimonial </a></li>
                        <li><a href="{{ route('branch.achievement.index') }}">Our Achievement </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-grid-alt"></i>
                        <span>Academic Modul </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{ route('branch.session.index') }}">Session</a></li>
                        <li><a href="{{ route('branch.studentUnit.index') }}"> Student Unit</a></li> --}}
                        <li><a href="{{ route('branch.batch.index') }}">Batch</a></li>
                        <li><a href="{{ route('branch.schedule.index') }}">Class Schedule</a></li>

                    </ul>
                </li>


                <li class="menu-title " style="color: #ffd0ad"> &nbsp Teacher
                    Section </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span> Teacher</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.teacher.category.index') }}">Teacher Category</a></li>
                        <li><a href="{{ route('branch.teacher.index') }}">Teacher List</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cubes"></i>
                        <span> Courses </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.category.index') }}">Category List</a></li>
                        <li><a href="{{ route('branch.course.index') }}">Course List</a></li>


                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span> Marksheet Manage</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Add Mark</a></li>
                    </ul>
                </li> --}}

                <li class="menu-title " style="color: #ffd0ad"> &nbsp Admin
                    Section </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-project-diagram"></i>
                        <span>Assets </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('assets.index') }}">Asset List</a></li>
                        <li><a href="{{ route('assets.create') }}">Add Asset</a></li>
                        <li><a href="{{ route('damage.index') }}">Damage List</a></li>
                        <li><a href="{{ route('assets.stock') }}">Stock List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-project-diagram"></i>
                        <span>Procurement </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('sales.index') }}">Sales List</a></li>
                        <li><a href="{{ route('sales.create') }}">Add Sales</a></li>
                        <li><a href="{{ route('branch.add.purchase') }}">Add Purchase Expense</a></li>
                        <li><a href="{{ route('branch.purchase.manage') }}">Manage Purchase </a></li>

                        <li><a href="{{ route('branch.product.stock') }}">Product Stock List </a></li>

                        <li><a href="{{ route('branches-product.index') }}"> Product </a></li>
                        <li><a href="{{ route('branches-unit.index') }}">Purchase Unit </a></li>
                        <li><a href="{{ route('branches-supplier.index') }}"> Purchase Supplier </a></li>


                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-wallet"></i>
                        <span>Account Income</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.student.fee.generate') }}">Student Fee Generate</a></li>
                        <li><a href="{{ route('branch.student.fee.index') }}">Student Fee Collection</a></li>
                        <li><a href="{{ route('branch.student.fee.invoice') }}">Invoice List</a></li>


                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-paper-plane"></i>
                        <span>Account Expense </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.add.expense') }}"> Expense Entry </a></li>
                        <li><a href="{{ route('branch.expense.manage') }}">Expense List</a></li>
                        <li><a href="{{ route('branches-expenseType.index') }}">Expense Type</a></li>
                        <li><a href="{{ route('branches-bank.index') }}">Bank Type</a></li>
                        {{-- <li><a href="#">Head Wise Expense</a></li>
                        <li><a href="#"> Expense Report</a></li>
                        <li><a href="#"> Other Report</a></li> --}}

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-file"></i>
                        <span>Report Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.collection.student.report') }}"> Student Ladger </a></li>
                        <li><a href="{{ route('branch.procurement.all') }}"> Procurement All </a></li>
                        <li><a href="{{ route('branch.income.all') }}"> Income All </a></li>
                        <li><a href="{{ route('branch.expense.all') }}"> Expense All </a></li>
                        <li><a href="{{ route('branch.collection.student.report.all') }}">Due Student</a></li>
                        <li><a href="{{ route('branch.draft.student.list') }}">Draft Student </a></li>


                    </ul>
                </li>

                <li class="menu-title " style="color: #ffd0ad"> &nbsp Student
                    Section </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-graduate"></i>
                        <span>Student </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="#">Student Category</a></li>
                        <li><a href="#">Add Student </a></li> --}}

                        <li><a href="{{ route('branch.add.student') }}">Add Student </a></li>
                        <li><a href="{{ route('branch.student.index') }}">Student List </a></li>


                        <li><a href="{{ route('branch.student.pending') }}">Student Pending List</a></li>
                        <li><a href="{{ route('branch.add.card') }}">Student ID Card </a></li>
                        <li><a href="{{ route('branch.add.admit.card') }}">Student Admit Card </a></li>
                        <li><a href="{{ route('branch.add.registration.card') }}">Registration Card </a></li>
                        {{-- <li><a href="{{ route('branch.add.certificate.card') }}">Certificate Student </a></li> --}}

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-bars"></i>
                        <span> Results Module </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="#">Question Group</a></li>
                        <li><a href="#">Add Question</a></li>
                        <li><a href="#">Question Bank</a></li> --}}
                        {{-- <li><a href="{{route('assessment.exam.create')}}">Exam</a></li> --}}
                        {{-- <li><a href="{{ route('assessment.exam.index') }}">Exam </a></li>
                        <li><a href="{{ route('assessment.question.index') }}">Question</a></li> --}}
                        <li><a href="{{ route('branch.mcq.show') }}">MCQ Result</a></li>
                        <li><a href="{{ route('branch.student_result.show') }}">Student Result Show</a></li>
                        <li><a href="{{ route('offline-exam.index') }}">Offline Exam</a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                        <span>Attendance Module</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('student_attendance_branch.index') }}">Student Attendance Entry
                            </a>
                        </li>
                        <li><a href="{{ route('branch.student_present_absent.generate') }}">Students Present and
                                Absent</a>
                        </li>
                        <li><a href="{{ route('branch.student_in_out.generate') }}">Students Attendance In-Out</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-question-circle"></i>
                        <span> Requisitions</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.requisition.index') }}">Requisitions Index</a></li>
                        <li><a href="{{ route('branch.show.requisition') }}">Requisitions Show</a></li>
                        <li><a href="{{ route('branch.complete.requisition') }}">Requisitions Complete</a></li>





                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-layer"></i>

                        <span> Home Work </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('branch.add.homework') }}"> Add Home Work </a></li>
                        <li><a href="{{ route('branch.homework.manage') }}"> List Home Work </a></li>
                        <li><a href="{{ route('branch.homework.completed') }}"> Home Work completed </a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-hourglass"></i>
                        <span> Assignment </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.assignment.add') }}">Add Assignment</a></li>
                        <li><a href="{{ route('branch.assignment.manage') }}">Assignment List</a></li>
                        <li><a href="{{ route('branch.student.submitted.assignment') }}">Ass Completed </a></li>

                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-sms"></i>
                        <span> SMS </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{ route('branch.sms.index') }}">Student Send SMS</a></li>
                        <li><a href="{{ route('branch.sms.single.index') }}">Student Send SMS Single</a></li>
                        <li><a href="{{ route('branch.show.sms') }}">Show SMS</a></li>
                        {{-- <li><a href="{{ route('branch.branch.sms') }}">Branch SMS all</a></li>
                        <li><a href="{{ route('branch.branch.sms.show') }}">Branch SMS Show</a></li> --}}
                        <li><a href="{{ route('branch.due.student.sms') }}">Due Student SMS </a></li>
                        <li><a href="{{ route('branch.due.store.show') }}">Due Student Show </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-vr-cardboard"></i>
                        <span> Live Class</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Zoom Live </a></li>
                        <li><a href="#">Google Met </a></li>

                    </ul>
                </li>
                {{-- <li class="menu-title " style="color: #ffd0ad"> &nbsp System
                    Setting </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-friends"></i>
                        <span>User Manager </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Staff</a></li>
                        <li><a href="#">Department</a></li>
                        <li><a href="#">Role</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cogs"></i>
                        <span>Profile Setting </span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Staff</a></li>
                        <li><a href="#">Teacher</a></li>
                    </ul>
                </li> --}}


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-viruses"></i>
                        <span>System Setting </span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('branch.division.index') }}">Division </a></li>
                        <li><a href="{{ route('branch.district.index') }}">District </a></li>
                        <li><a href="{{ route('branch.city.index') }}">City </a></li>
                        <li><a href="{{ route('branch.system.index') }}">General Setting </a></li>
                        <li><a href="{{ route('sms-provider.index') }}">SMS Setting </a></li>

                    </ul>
                </li>

                <li class="menu-title " style="color: #ffd0ad"> &nbsp STITBD @2022</li>

                &nbsp
                &nbsp
                &nbsp
                &nbsp
                &nbsp
                &nbsp
                &nbsp
                &nbsp




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
