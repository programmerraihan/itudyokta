<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar="init" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" style="overflow: scroll; height:100vh; ">
            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
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

                        <li><a href="{{ route('about.index') }}">About</a></li>
                        <li><a href="{{ route('contact.index') }}">Contact</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-web"></i>
                        <span>Home </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('home.slide') }}">Home Slide</a></li>
                        <li><a href="{{ route('speech.index') }}">Our Speech </a></li>
                        {{-- <li><a href="{{ route('course.index') }}">Course</a></li> --}}
                        <li><a href="{{ route('service.index') }}">Our Services </a></li>
                        <li><a href="{{ route('project.index') }}">Our Project </a></li>
                        <li><a href="{{ route('director.index') }}">Directors </a></li>
                        <li><a href="{{ route('gallery.index') }}">Gallery </a></li>
                        <li><a href="{{ route('testimonial.index') }}">Testimonial </a></li>
                        <li><a href="{{ route('achievement.index') }}">Our Achievement </a></li>
                        <li><a href="{{ route('notice.index') }}"> Notice </a></li>
                        <li><a href="{{ route('center.index') }}"> Center </a></li>

                    </ul>
                </li>

                @canany(['branch-view', 'branch-create', 'branch-update', 'branch-delete', 'branch-approved'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-layout"></i>
                            <span>Branch </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('branch-create')
                                <li><a href="{{ route('add.branch') }}">New Branch</a></li>
                            @endcan
                            @can('branch-view')
                                <li><a href="{{ route('branch.list') }}">Branch List</a></li>
                            @endcan
                            @can('branch-approved')
                                <li><a href="{{ route('branch.pending') }}">Pending Branch</a></li>
                            @endcan

                        </ul>
                    </li>
                @endcanany

                @canany(['session-view', 'student-unit-view', 'batch-view', 'schedule-view'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-grid-alt"></i>
                            <span>Academic Modul </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('session-view')
                                <li><a href="{{ route('session.index') }}">Session</a></li>
                            @endcan
                            @can('student-unit-view')
                                <li><a href="{{ route('studentUnit.index') }}"> Student Unit</a></li>
                            @endcan
                            @can('batch-view')
                                <li><a href="{{ route('batch.index') }}">Batch</a></li>
                            @endcan
                            @can('schedule-view')
                                <li><a href="{{ route('schedule.index') }}">Class Schedule</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['asset-view', 'damage-view', 'asset-create', 'stock-list'])
                    <li class="menu-title " style="color: #ffd0ad"> &nbsp Admin
                        Section </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-project-diagram"></i>
                            <span>Assets </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('asset-view')
                                <li><a href="{{ route('assets.index') }}">Asset List</a></li>
                            @endcan
                            @can('asset-create')
                                <li><a href="{{ route('assets.create') }}">Add Asset</a></li>
                            @endcan
                            @can('damage-view')
                                <li><a href="{{ route('damage.index') }}">Damage List</a></li>
                            @endcan
                            @can('stock-list')
                                <li><a href="{{ route('assets.stock') }}">Stock List</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['purchase-create', 'purchase-view', 'product-stock-list', 'product-view', 'purchase-unit-view',
                    'purchase-supplier-view', 'sale-index', 'sale-create'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-project-diagram"></i>
                            <span>Procurement </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can("sale-view")
                            <li><a href="{{ route('sales.index') }}">Sales List</a></li>
                            @endcan
                            @can("sale-create")
                            <li><a href="{{ route('sales.create') }}">Add Sales</a></li>
                            @endcan
                            @can('purchase-create')
                                <li><a href="{{ route('add.purchase') }}">Add Purchase Expense</a></li>
                            @endcan
                            @can('purchase-view')
                                <li><a href="{{ route('purchase.manage') }}">Manage Purchase </a></li>
                            @endcan
                            @can('product-stock-list')
                                <li><a href="{{ route('product.stock') }}">Product Stock List </a></li>
                            @endcan

                            @can('product-view')
                                <li><a href="{{ route('product.index') }}"> Product </a></li>
                            @endcan
                            @can('purchase-unit-view')
                                <li><a href="{{ route('unit.index') }}">Purchase Unit </a></li>
                            @endcan
                            @can('purchase-supplier-view')
                                <li><a href="{{ route('supplier.index') }}"> Purchase Supplier </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['student-fee-collection', 'student-fee-generate', 'invoice-list', 'account-head-view',
                    'account-head-category-view', 'account-head-type-view', 'registration-fee-list'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-wallet"></i>
                            <span>Account Income</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('student-fee-generate')
                                <li><a href="{{ route('student.fee.generate') }}">Student Fee Generate</a></li>
                            @endcan
                            @can('student-fee-collection')
                                <li><a href="{{ route('student.fee.index') }}">Student Fee Collection</a></li>
                            @endcan
                            @can('invoice-list')
                                <li><a href="{{ route('student.invoice-ok') }}">Invoice List</a></li>
                            @endcan
                            @can('account-head-view')
                                <li><a href="{{ route('account.head.index') }}">Account Head</a></li>
                            @endcan
                            @can('account-head-category-view')
                                <li><a href="{{ route('account.category.index') }}">Account Head Category </a></li>
                            @endcan
                            @can('account-head-type-view')
                                <li><a href="{{ route('account.head.type.index') }}">Account Head Type </a></li>
                            @endcan
                            @can('registration-fee-list')
                                <li><a href="{{ route('course-commission') }}">Registration Fee List</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['expense-view', 'expense-create', 'expense-type-view'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="far fa-paper-plane"></i>
                            <span>Account Expense </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('expense-create')
                                <li><a href="{{ route('add.expense') }}"> Expense Entry </a></li>
                            @endcan
                            @can('expense-view')
                                <li><a href="{{ route('expense.manage') }}">Expense List</a></li>
                            @endcan
                            @can('expense-type-view')
                                <li><a href="{{ route('expenseType.index') }}">Expense Type</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @canany(['student-ledger-report', 'procurement-all-report', 'income-all-report', 'expense-all-report',
                    'due-student-report', 'draft-student-report'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="far fa-file"></i>
                            <span>Report Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('student-ledger-report')
                                <li><a href="{{ route('collection.student.report') }}"> Student Ladger </a></li>
                            @endcan
                            @can('procurement-all-report')
                                <li><a href="{{ route('procurement.all') }}"> Procurement All </a></li>
                            @endcan
                            @can('income-all-report')
                                <li><a href="{{ route('income.all') }}"> Income All </a></li>
                            @endcan
                            @can('expense-all-report')
                                <li><a href="{{ route('expense.all') }}"> Expense All </a></li>
                            @endcan
                            @can('due-student-report')
                                <li><a href="{{ route('collection.student.report.all') }}">Due Student</a></li>
                            @endcan
                            @can('draft-student-report')
                                <li><a href="{{ route('draft.student.list') }}">Draft Student </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany



                <li class="menu-title " style="color: #ffd0ad"> &nbsp Teacher
                    Section </li>
                @canany(['teacher-category-view', 'teacher-view'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-users"></i>
                            <span> Teacher</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('teacher-category-view')
                                <li><a href="{{ route('teacher.category.index') }}">Teacher Category</a></li>
                            @endcan
                            @can('teacher-view')
                                <li><a href="{{ route('teacher.index') }}">Teacher List</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['course-category-view', 'course-view'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-cubes"></i>
                            <span> Courses </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('course-category-view')
                                <li><a href="{{ route('category.index') }}">Category List</a></li>
                            @endcan
                            @can('course-view')
                                <li><a href="{{ route('course.index') }}">Course List</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <li class="menu-title " style="color: #ffd0ad"> &nbsp Student
                    Section </li>
                @canany(['student-create', 'student-pending-list', 'student-view', 'student-id-card',
                    'student-admit-card', 'student-registration-card', 'student-certificate', 'student-testmonial',
                    'student-mark-sheet'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-user-graduate"></i>
                            <span>Student </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('student-create')
                                <li><a href="{{ route('add.student') }}">Add Student </a></li>
                            @endcan

                            @can('student-view')
                                <li><a href="{{ route('student.index') }}">Student Approved List </a></li>
                            @endcan
                            @can('student-pending-list')
                                <li><a href="{{ route('student.pending') }}">Student Pending List</a></li>
                            @endcan
                            @can('student-id-card')
                                <li><a href="{{ route('add.card') }}">Student ID Card </a></li>
                            @endcan
                            @can('student-admit-card')
                                <li><a href="{{ route('add.admit.card') }}">Student Admit Card </a></li>
                            @endcan
                            @can('student-registration-card')
                                <li><a href="{{ route('add.registration.card') }}">Registration Card </a></li>
                            @endcan
                            @can('student-certificate')
                                <li><a href="{{ route('add.certificate.card') }}">Student Certificate </a></li>
                            @endcan
                            @can('student-testimonial')
                                <li><a href="{{ route('add.testimonial.card') }}">Student Testimonial </a></li>
                            @endcan
                            @can('student-mark-sheet')
                                <li><a href="{{ route('add.markSheet.card') }}">Student Mark Sheet </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['student-attendance-entry', 'student-present-absent', 'student-attendance-in-out'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-bullhorn" aria-hidden="true"></i>
                            <span>Attendance Module</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('student-attendance-entry')
                                <li><a href="{{ route('student_attendance.index') }}">Student Attendance Entry </a></li>
                            @endcan
                            @can('student-present-absent')
                                <li><a href="{{ route('student_present_absent.generate') }}">Students Present and Absent</a>

                                </li>
                            @endcan
                            @can('student-attendance-in-out')
                                <li><a href="{{ route('student_in_out.generate') }}">Students Attendance In-Out</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['exam-view', 'submitted-assesment-view', 'question-view'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-question-circle"></i>
                            <span> MCQ EXAM </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('exam-view')
                                <li><a href="{{ route('assessment.exam.index') }}">Exam </a></li>
                            @endcan
                            @can('question-view')
                                <li><a href="{{ route('assessment.question.index') }}">Question</a></li>
                            @endcan
                            @can('submitted-assesment-view')
                                <li><a href="{{ route('submitted.assessment.index') }}">Submitted Assessment</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['assignment-view', 'assignment-create', 'student-submitted'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-layer"></i>
                            <span> Assignment </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('assignment-create')
                                <li><a href="{{ route('add.assignment') }}">Add Assignment </a></li>
                            @endcan
                            @can('assignment-view')
                                <li><a href="{{ route('assignment.manage') }}">Assignment List </a></li>
                            @endcan
                            @can('student-submitted')
                                <li><a href="{{ route('student.submitted.assignment') }}">Student Submitted </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['home-work-view', 'home-work-create'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-hourglass"></i>
                            <span> Home Work </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('home-work-create')
                                <li><a href="{{ route('add.homework') }}">Add Home Work </a></li>
                            @endcan
                            @can('home-work-view')
                                <li><a href="{{ route('homework.manage') }}">List Home Work</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['student-result', 'student-result-show', 'online-exam'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-bars"></i>
                            <span> Results Module </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('student-result')
                                <li><a href="{{ route('student_result.index') }}">Student Result</a></li>
                            @endcan
                            @can('student-result-show')
                                <li><a href="{{ route('student_result.show') }}">Student Result Show</a></li>
                            @endcan
                            @can('online-exam')
                                <li><a href="{{ route('admin.offline-exam') }}">Online Exam</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['requisitions-request-list', 'requisitions-complete-list'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-question-circle"></i>
                            <span> Requisitions</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('requisitions-request-list')
                                <li><a href="{{ route('show.requisition') }}">Requisitions Request List </a></li>
                            @endcan
                            @can('requisitions-complete-list')
                                <li><a href="{{ route('complete.requisition') }}">Requisitions Complete List </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['student-send-sms-single', 'student-send-sms', 'show-sms', 'branch-sms-all', 'branch-sms-show',
                    'due-student-sms', 'due-student-show'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-sms"></i>
                            <span> SMS </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('student-send-sms')
                                <li><a href="{{ route('sms.index') }}">Student Send SMS</a></li>
                            @endcan
                            @can('student-send-sms-single')
                                <li><a href="{{ route('sms.single.index') }}">Student Send SMS Single</a></li>
                            @endcan
                            @can('show-sms')
                                <li><a href="{{ route('show.sms') }}">Show SMS</a></li>
                            @endcan
                            @can('branch-sms-all')
                                <li><a href="{{ route('branch.sms') }}">Branch SMS all</a></li>
                            @endcan
                            @can('branch-sms-show')
                                <li><a href="{{ route('branch.sms.show') }}">Branch SMS Show</a></li>
                            @endcan
                            @can('due-student-sms')
                                <li><a href="{{ route('due.student.sms') }}">Due Student SMS </a></li>
                            @endcan
                            @can('due-student-show')
                                <li><a href="{{ route('due.store.show') }}">Due Student Show </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany


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
                <li class="menu-title " style="color: #ffd0ad"> &nbsp System
                    Setting </li>
                @canany(['user-create', 'user-view', 'manage-bank'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-user-friends"></i>
                            <span>User Manager </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('user-view')
                                <li><a href="{{ route('users.index') }}">User List</a></li>
                            @endcan
                            @can('user-create')
                                <li><a href="{{ route('users.create') }}">Add User</a></li>
                            @endcan
                            @can('manage-bank')
                                <li><a href="{{ route('bank.index') }}">Manage Bank</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['back-up', 'division', 'district', 'city', 'general-setting', 'sms-setting'])
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-viruses"></i>
                            <span>System Setting </span>
                        </a>

                        <ul class="sub-menu" aria-expanded="false">
                            @can('back-up')
                                <li><a href="{{ route('download.local') }}">Back Up </a></li>
                            @endcan
                            @can('division')
                                <li><a href="{{ route('division.index') }}">Division </a></li>
                            @endcan
                            @can('district')
                                <li><a href="{{ route('district.index') }}">District </a></li>
                            @endcan
                            @can('city')
                                <li><a href="{{ route('city.index') }}">City </a></li>
                            @endcan
                            @can('general-setting')
                                <li><a href="{{ route('system.index') }}">General Setting </a></li>
                            @endcan
                            @can('sms-setting')
                                <li><a href="{{ route('sms-provider.index') }}">SMS Setting </a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                <li class="menu-title " style="color: #ffd0ad"> &nbsp STITBD @2023</li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
