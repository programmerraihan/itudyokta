<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\Frontend\BranchFrontendController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\OfflineExamController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\DamageController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Admin Route
// Route::group(base_path('routes/admin.php'));

//test api
// Route::get('/testapi', [BranchController::class, 'apiTest']);
/* ------------------ Admin Route --------------*/

Route::get('test', function() {
    Artisan::call('migrate', [
        '--path' => 'database/migrations/2023_07_20_230604_add_website_banner_column_to_branches_table.php'
    ]);
});

Route::get('/backupdatabase', function () {
    $exitCode = Artisan::call('db:backup');
});

// Route::get("/invoice", function() {
//     return view("invoice");
// });

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'index'])->name('login_from');
    Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
});
/* ------------------ End Admin Route --------------*/

/**
 * websiste module
 */
Route::prefix("web/{branch?}")->group(function () {
    Route::get("", [WebsiteController::class, "index"])->name("website.home");
    Route::get("speech/{id}/details", [WebsiteController::class, "speechDetails"])->name("speech.details");
    Route::get("course/{id}/details", [WebsiteController::class, "courseDetails"])->name("course.details");
    Route::get("about", [WebsiteController::class, "about"])->name("website.about");
    Route::get("courses", [WebsiteController::class, "course"])->name("website.course");
    Route::get("admission", [WebsiteController::class, "admission"])->name("website.admission");
    Route::get("online-exam", [WebsiteController::class, 'onlineExam'])->name("website.online-exam");
    Route::get("online-exam/{id}/details", [WebsiteController::class, 'onlineExamTest'])->name("website.online-exam.test");
    Route::get("online-exam/{id}/details", [WebsiteController::class, 'onlineExamTest'])->name("website.online-exam.test");
    Route::get("online-exam/{id}/start-exam", [WebsiteController::class, 'onlineExamStart'])->name("website.online-exam.start");
    Route::post("online-exam/{id}", [WebsiteController::class, 'onlineExamSubmit'])->name("website.online-exam.submit");
    Route::get("result", [WebsiteController::class, 'result'])->name("website.result");
    Route::get("center-registration", [WebsiteController::class, 'centerRegistration'])->name("website.centerRegistration");
    Route::get("blog", [WebsiteController::class, 'blog'])->name("website.blog");
    Route::get("blog-detail/{id}", [WebsiteController::class, 'blogDetail'])->name("website.blog_detail");
    Route::get("contact-us", [WebsiteController::class, 'contactUs'])->name("website.contactUs");
    Route::get("notice", [WebsiteController::class, 'notice'])->name("website.notice");
    Route::get("notice/{id}", [WebsiteController::class, 'noticeDetails'])->name("website.notice.details");
});


// /**
//  * branch module
//  */
// Route::prefix("branch/{name?}")->group(function () {
//     Route::get("", [WebsiteController::class, "index"])->name("website.home");
//     Route::get("speech/{id}/details", [WebsiteController::class, "speechDetails"])->name("speech.details");
//     Route::get("course/{id}/details", [WebsiteController::class, "courseDetails"])->name("course.details");
//     Route::get("about", [WebsiteController::class, "about"])->name("website.about");
//     Route::get("courses", [WebsiteController::class, "course"])->name("website.course");
//     Route::get("admission", [WebsiteController::class, "admission"])->name("website.admission");
//     Route::get("online-exam", [WebsiteController::class, 'onlineExam'])->name("website.online-exam");
//     Route::get("online-exam/{id}/details", [WebsiteController::class, 'onlineExamTest'])->name("website.online-exam.test");
//     Route::get("online-exam/{id}/details", [WebsiteController::class, 'onlineExamTest'])->name("website.online-exam.test");
//     Route::get("online-exam/{id}/start-exam", [WebsiteController::class, 'onlineExamStart'])->name("website.online-exam.start");
//     Route::post("online-exam/{id}", [WebsiteController::class, 'onlineExamSubmit'])->name("website.online-exam.submit");
//     Route::get("result", [WebsiteController::class, 'result'])->name("website.result");
//     Route::get("center-registration", [WebsiteController::class, 'centerRegistration'])->name("website.centerRegistration");
//     Route::get("blog", [WebsiteController::class, 'blog'])->name("website.blog");
//     Route::get("blog-detail/{id}", [WebsiteController::class, 'blogDetail'])->name("website.blog_detail");
//     Route::get("contact-us", [WebsiteController::class, 'contactUs'])->name("website.contactUs");
//     Route::get("notice", [WebsiteController::class, 'notice'])->name("website.notice");
//     Route::get("notice/{id}", [WebsiteController::class, 'noticeDetails'])->name("website.notice.details");
// });

/**
 * user module
 */
Route::prefix("users")->group(function () {
    Route::get("/{user}/permssions", [UserController::class, "permission"])->name("users.permission");
    Route::post("/{user}/permssions", [UserController::class, "permissionStore"])->name("users.permission.store");
});
Route::resource("users", UserController::class);

/**
 * sale module
 */
Route::get("sales/{sale}/invoice", [SaleController::class, "invoice"])->name("sales.invoice");
Route::get("sales-due-collection/{sale}", [SaleController::class, "dueCollection"])->name("sales.dueCollection");
Route::post("sales-due-collection/{sale}", [SaleController::class, "dueCollectionStore"])->name("sales.dueCollected");
Route::resource("sales", SaleController::class);

/**
 * asset stock
 */
Route::get('assets/stock', [AssetController::class, 'stock'])->name("assets.stock");

/**
 * asset section
 */
Route::resource("assets", AssetController::class);

/**
 * damage section
 */
Route::resource("damage", DamageController::class);

/**
 * sms providers
 */
Route::get('sms-provider-update/{sms_provider}/{status}', [SmsController::class, 'active'])->name('sms-provider.active');
Route::resource('sms-provider', SmsController::class);

Route::get("admin/offline-exam", [OfflineExamController::class, 'list'])->name('admin.offline-exam');
Route::get("admin/offline-exam/{id}", [OfflineExamController::class, 'approved'])->name('admin.offline-exam.approved');
Route::get("admin/offline-exam/{id}/show", [OfflineExamController::class, 'adminShow'])->name('admin.offline-exam.show');
Route::get("admin/offline-exam/{id}/edit", [OfflineExamController::class, 'onlineExamEdit'])->name('admin.offline-exam.edit');
Route::put("admin/offline-exam/{id}/update", [OfflineExamController::class, 'onlineExamUpdate'])->name('admin.offline-exam.update');
Route::post('/admin/offline-exam/delete/{id}', [OfflineExamController::class, 'onlineExamDestroy'])->name('admin.offline-exam.destroy');
Route::post("admin/offline-exam/date-store", [OfflineExamController::class, 'dateStore'])->name('admin.offline-exam.dateStore');
Route::resource('offline-exam', OfflineExamController::class);

/**
 * reset password
 */
Route::post('change-password', [ExtraController::class, 'changePassword'])->name('change.password');
Route::get('set-new-password', [ExtraController::class, 'setNewPassword'])->name('set.new.password');
Route::post('set-new-password', [ExtraController::class, 'storeNewPassword'])->name('store.new.password');


// Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

/* ------------------ Student Route --------------*/
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentController::class, 'index'])->name('login_from_student');
    Route::post('/login/owner', [StudentController::class, 'login'])->name('student.login');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard')->middleware('student');
    Route::get('/logout', [StudentController::class, 'studentLogout'])->name('student.logout')->middleware('student');
    Route::get('/register', [StudentController::class, 'studentRegister'])->name('student.register');
    Route::post('/register/owner', [StudentController::class, 'studentRegisterCreate'])->name('student.register.create');
});
/* ------------------ End Student Route --------------*/

/* ------------------ Branch Route --------------*/
Route::prefix('branches')->group(function () {
    Route::get('/login', [BranchController::class, 'index'])->name('login_from_branch');
    Route::post('/login/owners', [BranchController::class, 'login'])->name('branch.login');
    Route::get('/dashboard', [BranchController::class, 'dashboard'])->name('branch.dashboard')->middleware('branch');
    Route::get('/logout', [BranchController::class, 'branchLogout'])->name('branch.logout')->middleware('branch');
    // Route::get('/register', [BranchController::class, 'branchRegister'])->name('branch.register');
    // Route::post('/register/owner', [BranchController::class, 'branchRegisterCreate'])->name('branch.register.create');
    Route::post('/store-branch', [BranchController::class, 'store'])->name('store.branch');
});
/* ------------------ End Branch Route --------------*/

/* ------------------ Frontend Route --------------*/

Route::get('student-exam-test/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'studentExamTest'])->name('student.exam.test');
Route::post('assessment/question/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'assessmentQuestion'])->name('assessment.question');
Route::post('assessment/answer/submit', [App\Http\Controllers\Frontend\FrontendController::class, 'answerSubmit'])->name('answer.submit');

Route::controller(FrontendController::class)->group(function () {
    // Route::get('/', function() {
    //     return redirect()->route("website.home", ['branch' => 'main']);
    // })->name('home');
    Route::get('/', 'index')->name('home');

    Route::get('/course/details/{id}', 'courseDetail')->name('course_detail');
    Route::get('/blog/details/{id}', 'blogDetail')->name('blog_detail');

    Route::get('/service/details/{id}', 'serviceDetail')->name('service_detail');
    Route::get('/project/details/{id}', 'projectDetail')->name('project_detail');
    Route::get('/speech/details/{id}', 'speechDetail')->name('speech_detail');
    Route::get('/notice/details/{id}', 'noticeDetail')->name('notice_detail');
    Route::get('/about', 'indexAbout')->name('about');
    Route::get('/center-registration', 'indexCenter')->name('center');
    Route::get('/course', 'indexCourse')->name('course');

    Route::get('/result', 'indexResult')->name('result');
    Route::get('/online-exam', 'indexOnlineExam')->name('online-exam');
    Route::get('/blog', 'indexBlog')->name('blog');
    Route::get('/contact', 'indexContact')->name('contact');
    //branch fronted Controller
    Route::get('/branch/{slug}', 'branchIndex')->name('branch.index');
    Route::get('/branch/{slug}/about', 'branchAbout')->name('branch.about');
    Route::get('/branch/{slug}/course', 'branchCourse')->name('branch.course');

    // Route::get('/branch/{param}',  'branchCourseDetail')->name('branch.course.details');

    Route::get('/branch/{slug}/contact', 'branchContact')->name('branch.contact');
    Route::get('/branch/{slug}/blog', 'branchBlog')->name('branch.blog');
    Route::get('/branch/{slug}/admission', 'branchAdmission')->name('branch.admission');
    Route::get('/branch/{slug}/result', 'branchResult')->name('branch.result');
    Route::get('/branch/{slug}/online-exam', 'branchOnlineExam')->name('branch.online-exam');
    // Route::get('/project/details/{id}',  'projectDetail')->name('project_detail');
    Route::get('certificate/{id}', 'resultSubmit')->name('result.submit');
});

Route::controller(BranchFrontendController::class)->group(function () {
    Route::get('/branch/{slug}/course/details/{id}', 'branchCourseDetail')->name('branch.course.details');
    Route::get('/branch/{slug}/speech/details/{id}', 'branchSpeechDetail')->name('branch.speech_detail');
    Route::get('/branch/{slug}/notice/details/{id}', 'branchNoticeDetail')->name('branch.notice_detail');
    Route::get('/branch/{slug}/service/details/{id}', 'branchServiceDetail')->name('branch.service_detail');
    Route::get('/branch/{slug}/project/details/{id}', 'branchProjectDetail')->name('branch.project_detail');
    Route::get('/branch/{slug}/speech/details/{id}', 'branchSpeechDetail')->name('branch.speech_detail');

    Route::get('/branch/{slug}/blog/details/{id}', 'branchBlogDetail')->name('branch.blog_detail');
});

/* ------------------ StudentAdmission Route --------------*/
Route::controller(\App\Http\Controllers\Frontend\StudentAdmissionController::class)->group(function () {
    Route::get('/admission', 'index')->name('admission');
    Route::get('student/course/price', 'coursePrice')->name('student.course.price');
    Route::get('branch/wish/batch', 'branchBatch')->name('branch.wish.batch');
    Route::get('batch/wish/schedule', 'batchSchedule')->name('batch.wish.schedule');
});

/* ------------------ End Frontend Route --------------*/

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

// Admin all Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'edit')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
});

//-------Course Title Controller --------//
Route::controller(\App\Http\Controllers\Frontend\CourseTitleController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/course-index', 'index')->name('course.index')->middleware("permission:course-view");
        Route::get('/add-course', 'addCourse')->name('add.course')->middleware("permission:course-create");
        Route::post('/store-course', 'store')->name('store.course')->middleware("permission:course-create");
        Route::get('/course-detail/{id}', 'detail')->name('course.detail')->middleware("permission:course-view");
        Route::get('/course-status/{id}', 'updateStatus')->name('course.update-status')->middleware("permission:course-approved");
        Route::get('/course-edit/{id}', 'edit')->name('course.edit')->middleware("permission:course-update");
        Route::post('/course-update/{id}', 'update')->name('course.update')->middleware("permission:course-update");
        Route::post('/course-delete/{id}', 'destroy')->name('course.destroy')->middleware("permission:course-delete");
    });
});

//------Admission  Controller --------//
Route::controller(\App\Http\Controllers\Admin\StudentController::class)->group(function () {
    // Route::get('generate-pdf','generatePDF');
    Route::get('student/course/price', 'coursePrice')->name('student.course.price');
    Route::get('course-wish-batch', 'coursesBatch')->name('courseWishBatchGet');
    Route::get('batch/wish/schedule', 'batchSchedule')->name('batch.wish.schedule');
    Route::get('branch-wish-course', 'branchCourses')->name('branchWishCourse');

    Route::post('/store/frontend', 'storeFrontend')->name('store.student.frontend');

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/student-index', 'show')->name('student.index')->middleware('permission:student-view');
        Route::get('/student-pending-index', 'pending')->name('student.pending')->middleware('permission:student-pending-list');
        Route::get('/add-student', 'addStudent')->name('add.student')->middleware('permission:student-create');

        Route::post('/store/student', 'store')->name('store.student')->middleware('permission:student-create');
        // Route::post('/store-student',       'store')->name('store.student');
        Route::get('/student-detail/{id}', 'detail')->name('student.detail')->middleware('permission:student-view');
        Route::get('/student-status/{id}', 'updateStatus')->name('student.update-status')->middleware('permission:student-approved');
        Route::get('/student-edit/{id}', 'edit')->name('student.edit')->middleware('permission:student-update');

        Route::get('/student-download/{id}', 'download')->name('student.download');

        Route::post('/student-update/{id}', 'update')->name('student.update')->middleware('permission:student-update');
        Route::post('/student-delete/{id}', 'destroy')->name('student.destroy')->middleware('permission:student-delete');
    });
});

//------Branch  Controller --------//
Route::controller(\App\Http\Controllers\Admin\BranchController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/branch-pending', 'pending')->name('branch.pending');
        Route::get('/branch-list', 'list')->name('branch.list')->middleware(['permission' => 'can:branch-view']);
        Route::get('/add-branch', 'addBranch')->name('add.branch');
        Route::get('/branch-status/{id}', 'updateStatus')->name('branch.update-status');
        Route::get('/branch-edit/{id}', 'edit')->name('branch.edit');
        Route::get('/branch-detail/{id}', 'detail')->name('branch.detail');
        Route::post('/branch-update/{id}', 'update')->name('branch.update');
        Route::post('/branch-delete/{id}', 'destroy')->name('branch.destroy');
        // Route::get('division/wish/district',                        'divisionDistrict')->name('division.wish.district');
        // Route::get('district/wish/city',                            'districtCity')->name('district.wish.city');
        // Route::get('institute_division/wish/institute_district',    'insDivisionDistrict')->name('institute_division.wish.institute_district');
        // Route::get('institute_district/wish/institute_city',        'insDistrictCity')->name('institute_district.wish.institute_city');
    });

    Route::get('division/wish/district', 'divisionDistrict')->name('division.wish.district');
    Route::get('district/wish/city', 'districtCity')->name('district.wish.city');
    Route::get('institute_division/wish/institute_district', 'insDivisionDistrict')->name('institute_division.wish.institute_district');
    Route::get('institute_district/wish/institute_city', 'insDistrictCity')->name('institute_district.wish.institute_city');
});

//-------Home Slide  Controller--------//
Route::controller(\App\Http\Controllers\Frontend\HomeSliderController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/home-slide', 'homeSlider')->name('home.slide');
        Route::get('/add-slide', 'addSlider')->name('add.slide');
        Route::post('/store-slider', 'store')->name('store.slider');
        Route::get('/slider-status/{id}', 'updateStatus')->name('slider.update-status');
        Route::get('/slider-edit/{id}', 'edit')->name('slider.edit');
        Route::post('/slider-update/{id}', 'update')->name('slider.update');
        Route::post('/slider-delete/{id}', 'delete')->name('slider.destroy');
    });
});

//-------Our Speech Controller --------//
Route::controller(\App\Http\Controllers\Frontend\OurSpeechController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/speech-index', 'index')->name('speech.index');
        Route::get('/add-speech', 'addSpeech')->name('add.speech');
        Route::post('/store-speech', 'store')->name('store.speech');
        Route::get('/speech-edit/{id}', 'edit')->name('speech.edit');
        Route::post('/speech-update/{id}', 'update')->name('speech.update');
        Route::post('/speech-delete/{id}', 'delete')->name('speech.destroy');
    });
});

//-------Course Category Controller --------//
Route::controller(\App\Http\Controllers\Frontend\CourseCategoryController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/category-index', 'index')->name('category.index')->middleware("permission:course-category-view");
        Route::get('/add-category', 'addCategory')->name('add.category')->middleware("permission:course-category-create");
        Route::post('/store-category', 'store')->name('store.category')->middleware("permission:course-category-create");
        Route::get('/category-status/{id}', 'updateStatus')->name('category.update-status')->middleware("permission:course-category-approved");
        Route::get('/category-edit/{id}', 'edit')->name('category.edit')->middleware("permission:course-category-update");
        Route::post('/category-update/{id}', 'update')->name('category.update')->middleware("permission:course-category-update");
        Route::post('/category-delete/{id}', 'destroy')->name('category.destroy')->middleware("permission:course-category-delete");
    });
});

//-------Our Services Controller --------//
Route::controller(\App\Http\Controllers\Frontend\OurServiceController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/service-index', 'index')->name('service.index');
        Route::get('/add-service', 'addService')->name('add.service');
        Route::post('/store-service', 'store')->name('store.service');
        Route::get('/service-status/{id}', 'updateStatus')->name('service.update-status');
        Route::get('/service-edit/{id}', 'edit')->name('service.edit');
        Route::post('/service-update/{id}', 'update')->name('service.update');
        Route::post('/service-delete/{id}', 'destroy')->name('service.destroy');
    });
});

//-------Our Project  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\OurProjectController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/project-index', 'index')->name('project.index');
        Route::get('/add-project', 'addProject')->name('add.project');
        Route::post('/store-project', 'store')->name('store.project');
        Route::get('/project-status/{id}', 'updateStatus')->name('project.update-status');
        Route::get('/project-edit/{id}', 'edit')->name('project.edit');
        Route::post('/project-update/{id}', 'update')->name('project.update');
        Route::post('/project-delete/{id}', 'destroy')->name('project.destroy');
    });
});

//-------Our Directors  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\DirectorController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/director-index', 'index')->name('director.index');
        Route::get('/add-director', 'addDirector')->name('add.director');
        Route::post('/store-director', 'store')->name('store.director');
        Route::get('/director-status/{id}', 'updateStatus')->name('director.update-status');
        Route::get('/director-edit/{id}', 'edit')->name('director.edit');
        Route::post('/director-update/{id}', 'update')->name('director.update');
        Route::post('/director-delete/{id}', 'destroy')->name('director.destroy');
    });
});

//-------Gallery  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\GalleryStudentController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/gallery-index', 'index')->name('gallery.index');
        Route::get('/add-gallery', 'addGallery')->name('add.gallery');
        Route::post('/store-gallery', 'store')->name('store.gallery');
        Route::get('/gallery-status/{id}', 'updateStatus')->name('gallery.update-status');
        Route::get('/gallery-edit/{id}', 'edit')->name('gallery.edit');
        Route::post('/gallery-update/{id}', 'update')->name('gallery.update');
        Route::post('/gallery-delete/{id}', 'destroy')->name('gallery.destroy');
    });
});

//-------Our Achievement Controller  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\OurAchievementController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/achievement-index', 'index')->name('achievement.index');
        Route::get('/add-achievement', 'addAchievement')->name('add.achievement');
        Route::post('/store-achievement', 'store')->name('store.achievement');
        Route::get('/achievement-status/{id}', 'updateStatus')->name('achievement.update-status');
        Route::get('/achievement-edit/{id}', 'edit')->name('achievement.edit');
        Route::post('/achievement-update/{id}', 'update')->name('achievement.update');
        Route::post('/achievement-delete/{id}', 'destroy')->name('achievement.destroy');
    });
});

//-------Notice Controller  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\NoticeController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/notice-index', 'index')->name('notice.index');
        Route::get('/add-notice', 'addNotice')->name('add.notice');
        Route::post('/store-notice', 'store')->name('store.notice');
        Route::get('/notice-status/{id}', 'updateStatus')->name('notice.update-status');
        Route::get('/notice-edit/{id}', 'edit')->name('notice.edit');
        Route::post('/notice-update/{id}', 'update')->name('notice.update');
        Route::post('/notice-delete/{id}', 'destroy')->name('notice.destroy');
    });
});

//-------Notice Controller  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\NoticeController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/notice-index', 'index')->name('notice.index');
        Route::get('/add-notice', 'addNotice')->name('add.notice');
        Route::post('/store-notice', 'store')->name('store.notice');
        Route::get('/notice-status/{id}', 'updateStatus')->name('notice.update-status');
        Route::get('/notice-edit/{id}', 'edit')->name('notice.edit');
        Route::post('/notice-update/{id}', 'update')->name('notice.update');
        Route::post('/notice-delete/{id}', 'destroy')->name('notice.destroy');
    });
});

//------Registration Center Controller --------//
Route::controller(\App\Http\Controllers\Frontend\RegistrationCenterController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/center-index', 'index')->name('center.index');
        Route::get('/add-center', 'addCenter')->name('add.center');
        Route::post('/store-center', 'store')->name('store.center');
        Route::get('/center-status/{id}', 'updateStatus')->name('center.update-status');
        Route::get('/center-edit/{id}', 'edit')->name('center.edit');
        Route::post('/center-update/{id}', 'update')->name('center.update');
        Route::post('/center-delete/{id}', 'destroy')->name('center.destroy');
    });
});

//------contact Center Controller --------//
Route::controller(\App\Http\Controllers\Frontend\ContactController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/contact-index', 'index')->name('contact.index');
        Route::get('/add-contact', 'addContact')->name('add.contact');
        Route::post('/store-contact', 'store')->name('store.contact');
        Route::get('/contact-status/{id}', 'updateStatus')->name('contact.update-status');
        Route::get('/contact-edit/{id}', 'edit')->name('contact.edit');
        Route::post('/contact-update/{id}', 'update')->name('contact.update');
        Route::post('/contact-delete/{id}', 'destroy')->name('contact.destroy');
    });
});

//------Registration Center Controller --------//
Route::controller(\App\Http\Controllers\Frontend\AboutController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/about-index', 'index')->name('about.index');
        Route::get('/add-about', 'addAbout')->name('add.about');
        Route::post('/store-about', 'store')->name('store.about');
        Route::get('/about-status/{id}', 'updateStatus')->name('about.update-status');
        Route::get('/about-edit/{id}', 'edit')->name('about.edit');
        Route::post('/about-update/{id}', 'update')->name('about.update');
        Route::post('/about-delete/{id}', 'destroy')->name('about.destroy');
    });
});

//------Blog  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\BlogController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/blog-index', 'index')->name('blog.index');
        Route::get('/blog/get/list', 'getBlog')->name('blog.get');
        Route::get('/add-blog', 'addBlog')->name('add.blog');
        Route::post('/store-blog', 'store')->name('store.blog');
        Route::get('/blog-status/{id}', 'updateStatus')->name('blog.update-status');
        Route::get('/blog-edit/{id}', 'edit')->name('blog.edit');
        Route::post('/blog-update/{id}', 'update')->name('blog.update');
        Route::get('/blog-delete/{id}', 'destroy')->name('blog.destroy');
    });
});

//------Division  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\DivisionController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/division-index', 'index')->name('division.index')->middleware("permission:division");
        Route::get('/add-division', 'addDivision')->name('add.division');
        Route::post('/store-division', 'store')->name('store.division');
        Route::get('/division-status/{id}', 'updateStatus')->name('division.update-status');
        Route::get('/division-edit/{id}', 'edit')->name('division.edit');
        Route::post('/division-update/{id}', 'update')->name('division.update');
        Route::post('/division-delete/{id}', 'destroy')->name('division.destroy');
    });
});

//------District  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\DistrictController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/district-index', 'index')->name('district.index')->middleware("permission:district");
        Route::get('/add-district', 'addDistrict')->name('add.district');
        Route::post('/store-district', 'store')->name('store.district');
        Route::get('/district-status/{id}', 'updateStatus')->name('district.update-status');
        Route::get('/district-edit/{id}', 'edit')->name('district.edit');
        Route::post('/district-update/{id}', 'update')->name('district.update');
        Route::post('/district-delete/{id}', 'destroy')->name('district.destroy');
    });
});

//------City  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\CityController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/city-index', 'index')->name('city.index')->middleware("permission:city");
        Route::get('/add-city', 'addCity')->name('add.city');
        Route::post('/store-city', 'store')->name('store.city');
        Route::get('/city-status/{id}', 'updateStatus')->name('city.update-status');
        Route::get('/city-edit/{id}', 'edit')->name('city.edit');
        Route::post('/city-update/{id}', 'update')->name('city.update');
        Route::post('/city-delete/{id}', 'destroy')->name('city.destroy');
    });
});

//-------Testimonial Student Controller  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\TestimonialStudentController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/testimonial-index', 'index')->name('testimonial.index');
        Route::get('/add-testimonial', 'addTestimonial')->name('add.testimonial');
        Route::post('/store-testimonial', 'store')->name('store.testimonial');
        Route::get('/testimonial-status/{id}', 'updateStatus')->name('testimonial.update-status');
        Route::get('/testimonial-edit/{id}', 'edit')->name('testimonial.edit');
        Route::post('/testimonial-update/{id}', 'update')->name('testimonial.update');
        Route::post('/testimonial-delete/{id}', 'destroy')->name('testimonial.destroy');
    });
});

//------District  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\DistrictController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/district-index', 'index')->name('district.index');
        Route::get('/add-district', 'addDistrict')->name('add.district');
        Route::post('/store-district', 'store')->name('store.district');
        Route::get('/district-status/{id}', 'updateStatus')->name('district.update-status');
        Route::get('/district-edit/{id}', 'edit')->name('district.edit');
        Route::post('/district-update/{id}', 'update')->name('district.update');
        Route::post('/district-delete/{id}', 'destroy')->name('district.destroy');
    });
});

//-------System Setting  Controller --------//
Route::controller(\App\Http\Controllers\Frontend\SystemSettingController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/system-index', 'index')->name('system.index')->middleware("permission:system-index");
        Route::get('/add-system', 'addSystem')->name('add.system');
        Route::post('/store-system', 'store')->name('store.system');
        Route::get('/system-status/{id}', 'updateStatus')->name('system.update-status');
        Route::get('/system-edit/{id}', 'edit')->name('system.edit');
        Route::post('/system-update/{id}', 'update')->name('system.update');
        Route::post('/system-delete/{id}', 'destroy')->name('system.destroy');
    });
});

//-------Purchase Product Controller --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //-------Software Supplier Controller --------//
    Route::resource('/supplier', App\Http\Controllers\Admin\Purchase\SupplierController::class);
    Route::get('/update-supplier-status/{id}', [App\Http\Controllers\Admin\Purchase\SupplierController::class, 'updateStatus'])->name('supplier.update-status');
    //-------Software Unit Controller --------//
    Route::resource('/unit', App\Http\Controllers\Admin\Purchase\UnitController::class);
    Route::get('/update-unit-status/{id}', [App\Http\Controllers\Admin\Purchase\UnitController::class, 'updateStatus'])->name('unit.update-status');
    //-------Software Product Controller --------//
    Route::resource('/product', App\Http\Controllers\Admin\Purchase\ProductController::class);
    Route::get('/update-product-status/{id}', [App\Http\Controllers\Admin\Purchase\ProductController::class, 'updateStatus'])->name('product.update-status');
    //-------All Purchase  Controller--------//
    Route::get('/add-new-purchase', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'add'])->name('add.purchase')->middleware("permission:purchase-create");
    Route::post('/new-purchase', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'create'])->name('purchase.store')->middleware("permission:purchase-create");
    Route::get('/manage-purchase', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'manage'])->name('purchase.manage')->middleware("permission:purchase-view");

    Route::get('/purchase-list', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'list'])->name('purchase.list');

    Route::get('/purchase-status/{id}', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'updateStatus'])->name('purchase.update-status');
    Route::get('/purchase-detail/{id}', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'detail'])->name('purchase.detail');
    Route::get('/purchase-edit/{id}', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'edit'])->name('purchase.edit')->middleware("permission:purchase-update");
    Route::post('/purchase-update/{id}', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'update'])->name('purchase.update')->middleware("permission:purchase-update");
    Route::post('/purchase-delete/{id}', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'delete'])->name('purchase.destroy')->middleware("permission:purchase-delete");
    Route::get('/get-all-data-for-Purchase', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'getAllPurchaseData'])->name('get-all-data-for-Purchase');

    Route::get('/product-stock', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'stockProduct'])->name('product.stock')->middleware("permission:product-stock-list");

    Route::get('/product-stock-detail/{product}', [App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'stockProductDetail'])->name('product.stock.detail');
});

//------Session  Controller --------//
Route::controller(\App\Http\Controllers\Admin\SessionController::class)->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/session-index', 'index')->name('session.index')->middleware(['permission:session-view']);
        Route::get('/add-session', 'addSession')->name('add.session')->middleware(['permission:session-create']);
        Route::post('/store-session', 'store')->name('store.session')->middleware(['permission:session-create']);
        Route::get('/session-status/{id}', 'updateStatus')->name('session.update-status')->middleware(['permission:session-approved']);
        Route::get('/session-edit/{id}', 'edit')->name('session.edit')->middleware(['permission:session-update']);
        Route::post('/session-update/{id}', 'update')->name('session.update')->middleware(['permission:session-update']);
        Route::post('/session-delete/{id}', 'destroy')->name('session.destroy')->middleware(['permission:session-delete']);
    });
});

//------Student UnitController --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/student-Unit-index', [App\Http\Controllers\Admin\StudentUnitController::class, 'index'])
    ->name('studentUnit.index')
    ->middleware(['permission:student-unit-view']);
    Route::get('/add-student-Unit', [App\Http\Controllers\Admin\StudentUnitController::class, 'addStudentUnit'])
    ->name('add.studentUnit')
    ->middleware(['permission:student-unit-create']);
    Route::post('/store-student-Unit', [App\Http\Controllers\Admin\StudentUnitController::class, 'store'])
    ->name('store.studentUnit')
    ->middleware(['permission:student-unit-create']);
    Route::get('/student-Unit-status/{id}', [App\Http\Controllers\Admin\StudentUnitController::class, 'updateStatus'])->name('studentUnit.update-status')->middleware(['permission:student-unit-approved']);;
    Route::get('/student-Unit-edit/{id}', [App\Http\Controllers\Admin\StudentUnitController::class, 'edit'])->name('studentUnit.edit')->middleware(['permission:student-unit-update']);;
    Route::post('/student-Unit-update/{id}', [App\Http\Controllers\Admin\StudentUnitController::class, 'update'])->name('studentUnit.update')->middleware(['permission:student-unit-update']);;
    Route::post('/student-Unit-delete/{id}', [App\Http\Controllers\Admin\StudentUnitController::class, 'destroy'])->name('studentUnit.destroy')->middleware(['permission:student-unit-delete']);;
});

//------Batch Controller --------//
Route::get('getBatches', [App\Http\Controllers\Admin\BatchController::class, 'getBatches'])->name('getBatches'); // For All
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/batch-index', [App\Http\Controllers\Admin\BatchController::class, 'index'])->name('batch.index')->middleware(['permission:batch-view']);
    Route::get('/add-Batch', [App\Http\Controllers\Admin\BatchController::class, 'addBatch'])->name('add.batch')->middleware(['permission:batch-create']);
    Route::post('/batch-Unit', [App\Http\Controllers\Admin\BatchController::class, 'store'])->name('store.batch')->middleware(['permission:batch-create']);
    Route::get('/batch-status/{id}', [App\Http\Controllers\Admin\BatchController::class, 'updateStatus'])->name('batch.update-status')->middleware(['permission:batch-approved']);
    Route::get('/batch-edit/{id}', [App\Http\Controllers\Admin\BatchController::class, 'edit'])->name('batch.edit')->middleware(['permission:batch-update']);
    Route::post('/batch-update/{id}', [App\Http\Controllers\Admin\BatchController::class, 'update'])->name('batch.update')->middleware(['permission:batch-update']);
    Route::post('/batch-delete/{id}', [App\Http\Controllers\Admin\BatchController::class, 'destroy'])->name('batch.destroy')->middleware(['permission:batch-delete']);
    // Route::get('getBatches', [App\Http\Controllers\Admin\BatchController::class, 'getBatches'])->name('getBatches'); // For All
});

//-------Class Schedule Student Controller  Controller --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::controller(\App\Http\Controllers\Admin\ClassScheduleController::class)->group(function () {
        Route::get('/schedule-index', 'index')->name('schedule.index')->middleware(['permission:schedule-view']);
        Route::get('/add-schedule', 'addSchedule')->name('add.schedule')->middleware(['permission:schedule-create']);
        Route::post('/store-schedule', 'store')->name('store.schedule')->middleware(['permission:schedule-create']);
        Route::get('/schedule-status/{id}', 'updateStatus')->name('schedule.update-status')->middleware(['permission:schedule-approved']);
        Route::get('/schedule-edit/{id}', 'edit')->name('schedule.edit')->middleware(['permission:schedule-update']);
        Route::post('/schedule-update/{id}', 'update')->name('schedule.update')->middleware(['permission:schedule-update']);
        Route::post('/schedule-delete/{id}', 'destroy')->name('schedule.destroy')->middleware(['permission:schedule-delete']);
    });
});

//------Teacher Category Controller --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/teacher-category-index', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'index'])->name('teacher.category.index')->middleware("permission:teacher-category-view");
    Route::get('/add-teacher-category', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'addCategory'])->name('add.teacher.category')->middleware("permission:teacher-category-create");
    Route::post('/teacher-category-Unit', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'store'])->name('store.teacher.category')->middleware("permission:teacher-category-create");
    Route::get('/teacher-category-status/{id}', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'updateStatus'])->name('teacher.category.update-status')->middleware("permission:teacher-category-approved");
    Route::get('/teacher-category-edit/{id}', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'edit'])->name('teacher.category.edit')->middleware("permission:teacher-category-update");
    Route::post('/teacher-category-update/{id}', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'update'])->name('teacher.category.update')->middleware("permission:teacher-category-update");
    Route::post('/teacher-category-delete/{id}', [App\Http\Controllers\Admin\Teacher\TeacherCategoryController::class, 'destroy'])->name('teacher.category.destroy')->middleware("permission:teacher-category-approved");
});

//------Teacher Controller  --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/teacher-index', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'index'])->name('teacher.index')->middleware("permission:teacher-view");
    Route::get('/add-teacher', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'addTeacher'])->name('add.teacher')->middleware("permission:teacher-create");
    Route::post('/teacher-Unit', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'store'])->name('store.teacher')->middleware("permission:teacher-create");
    Route::get('/teacher-status/{id}', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'updateStatus'])->name('teacher.update-status')->middleware("permission:teacher-approved");
    Route::get('/teacher-edit/{id}', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'edit'])->name('teacher.edit')->middleware("permission:teacher-update");
    Route::post('/teacher-update/{id}', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'update'])->name('teacher.update')->middleware("permission:teacher-update");
    Route::post('/teacher-delete/{id}', [App\Http\Controllers\Admin\Teacher\TeacherController::class, 'destroy'])->name('teacher.destroy')->middleware("permission:teacher-delete");
});

//-------bank Controller --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('/bank', App\Http\Controllers\Admin\BankController::class);
    Route::get('/update-bank-status/{id}', [App\Http\Controllers\Admin\BankController::class, 'updateStatus'])->name('bank.update-status');
});

//-------Expense  Controller --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //------Expense Type Controller --------//
    Route::resource('/expenseType', App\Http\Controllers\Admin\Expense\ExpenseTypeController::class);
    Route::get('/update-expenseType-status/{id}', [App\Http\Controllers\Admin\Expense\ExpenseTypeController::class, 'updateStatus'])->name('expenseType.update-status');
    //-------Expense  Controller--------//
    Route::get('/add-new-expense', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'add'])->name('add.expense')->middleware("permission:expense-create");
    Route::post('/new-expense', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'create'])->name('expense.store')->middleware("permission:expense-create");
    Route::get('/manage-expense', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'manage'])->name('expense.manage')->middleware("permission:expense-view");
    Route::get('/expense-status/{id}', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'updateStatus'])->name('expense.update-status')->middleware("permission:expense-approved");
    Route::get('/expense-detail/{id}', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'detail'])->name('expense.detail')->middleware("permission:expense-view");
    Route::get('/expense-edit/{id}', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'edit'])->name('expense.edit')->middleware("permission:expense-update");
    Route::post('/expense-update/{id}', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'update'])->name('expense.update')->middleware("permission:expense-update");
    Route::post('/expense-delete/{id}', [App\Http\Controllers\Admin\Expense\ExpenseController::class, 'delete'])->name('expense.destroy')->middleware("permission:expense-delete");
});

//================ Home Work Controller ==================//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/add-new-homework', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'add'])->name('add.homework')->middleware("permission:home-work-create");
    Route::post('/new-homework', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'create'])->name('homework.store')->middleware("permission:home-work-create");
    Route::get('/manage-homework', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'manage'])->name('homework.manage')->middleware("permission:home-work-view");
    Route::get('/pending-homework', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'pending'])->name('homework.pending');
    Route::get('/homework-status/{id}', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'updateStatus'])->name('homework.update-status')->middleware("permission:home-work-approved");
    Route::get('/homework-detail/{id}', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'detail'])->name('homework.detail')->middleware("permission:home-work-view");
    Route::get('/homework-edit/{id}', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'edit'])->name('homework.edit')->middleware("permission:home-work-update");
    Route::post('/homework-update/{id}', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'update'])->name('homework.update')->middleware("permission:home-work-update");
    Route::post('/homework-delete/{id}', [App\Http\Controllers\Admin\HomeWork\HomeWorkController::class, 'destroy'])->name('homework.destroy')->middleware("permission:home-work-delete");
});

//-------Assignment Module Route Group   --------
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/add-assignment', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'add'])->name('add.assignment')->middleware("permission:assignment-create");
    Route::post('/new-assignment', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'create'])->name('assignment.store')->middleware("permission:assignment-create");
    Route::get('/assignment-manage', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'manage'])->name('assignment.manage')->middleware("permission:assignment-view");
    Route::get('/assignment-status/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'updateStatus'])->name('assignment.update-status')->middleware("permission:assignment-approved");
    Route::get('/assignment-detail/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'detail'])->name('assignment.detail')->middleware("permission:assignment-view");
    Route::get('/assignment-edit/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'edit'])->name('assignment.edit')->middleware("permission:assignment-update");
    Route::post('/assignment-update/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'update'])->name('assignment.update')->middleware("permission:assignment-update");
    Route::post('/assignment-delete/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'delete'])->name('assignment.destroy')->middleware("permission:assignment-delete");
    
    Route::get('/student-submitted-assignment', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'ssa'])->name('student.submitted.assignment');
    Route::post('/student-submitted-download', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'assignmentDownload'])->name('student.submitted.download');
    Route::get('/student-assignment-result-edit/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'assignmentEditNumber'])->name('student.assignment.result.edit');
  
    Route::post('/assignmentUpdate-number/{id}', [App\Http\Controllers\Admin\Assignment\AssignmentController::class, 'assignmentUpdate'])->name('assignmentUpdate.number');


});

//-------Card  Module Route Group   --------//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/add-card', [App\Http\Controllers\Admin\Card\CardController::class, 'add'])->name('add.card')->middleware("permission:student-id-card");
    Route::post('/id-card-generate', [App\Http\Controllers\Admin\Card\CardController::class, 'idCardGenerate'])->name('id.card.generate');

    Route::get('/add-admit-card', [App\Http\Controllers\Admin\Card\CardController::class, 'addAdmit'])->name('add.admit.card')->middleware("permission:student-admit-card");
    Route::post('/admit-card-generate', [App\Http\Controllers\Admin\Card\CardController::class, 'admitCardGenerate'])->name('admit.card.generate');

    Route::get('/add-registration-card', [App\Http\Controllers\Admin\Card\CardController::class, 'addRegistration'])->name('add.registration.card')->middleware("permission:student-registration-card");
    Route::post('/registration-card-generate', [App\Http\Controllers\Admin\Card\CardController::class, 'registrationCardGenerate'])->name('registration.card.generate');

    Route::get('/add-certificate-card', [App\Http\Controllers\Admin\Card\CardController::class, 'addCertificate'])->name('add.certificate.card')->middleware("permission:student-certificate");
    Route::get("/certificate-print/{id}", [App\Http\Controllers\Admin\Card\CardController::class, "printCertificate"])->name("certificate.print");
    Route::post('/certificate-card-generate', [App\Http\Controllers\Admin\Card\CardController::class, 'certificateCardGenerate'])->name('certificate.card.generate');

    Route::get('/add-testimonial-card', [App\Http\Controllers\Admin\Card\CardController::class, 'addTestimonial'])->name('add.testimonial.card')->middleware("permission:student-testimonial");
    Route::post('/testimonial-card-generate', [App\Http\Controllers\Admin\Card\CardController::class, 'testimonialCardGenerate'])->name('testimonial.card.generate');

    Route::get('/add-markSheet-card', [App\Http\Controllers\Admin\Card\CardController::class, 'addMarkSheet'])->name('add.markSheet.card')->middleware('permission:student-mark-sheet');
    Route::post('/markSheet-card-generate', [App\Http\Controllers\Admin\Card\CardController::class, 'markSheetCardGenerate'])->name('markSheet.card.generate');
});

//================ AssessmentExamController ==================//
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //================ AssessmentExamController ==================//
    Route::get('assessment/exam', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'index'])->name('assessment.exam.index')->middleware("permission:exam-view");
    Route::get('assessment/exam/get', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'getAssessmentExam'])->name('getAssessmentExam');

    Route::get('assessment/exam/create', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'create'])->name('assessment.exam.create')->middleware("permission:exam-create");
    Route::post('assessment/exam/store', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'store'])->name('assessment.exam.store')->middleware("permission:exam-create");

    Route::get('assessment/exam/edit/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'edit'])->name('assessment.exam.edit')->middleware("permission:exam-update");
    Route::post('assessment/exam/update/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'update'])->name('assessment.exam.update')->middleware("permission:exam-update");
    Route::get('assessment/exam/status/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'status'])->name('assessment.exam.status')->middleware("permission:exam-approved");
    Route::post('assessment/exam/delete/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentExamController::class, 'delete'])->name('assessment.exam.delete')->middleware("permission:exam-delete");

    //================ AssessmentQuestionController ==================//
    Route::get('assessment/question', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'index'])->name('assessment.question.index')->middleware("permission:question-view");
    Route::get('assessment/question/get', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'getAssessmentQuestion'])->name('assessment.question.get');
    Route::get('assessment/question/create', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'create'])->name('assessment.question.create')->middleware("permission:question-create");

    Route::post('assessment/questions/store', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'store'])->name('assessment.question.store')->middleware("permission:question-create");
    
    Route::get('assessment/question/edit/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'edit'])->name('assessment.question.edit')->middleware("permission:question-update");
    Route::post('assessment/question/update/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'update'])->name('assessment.question.update')->middleware("permission:question-update");
    Route::get('assessment/question/status/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'status'])->name('assessment.question.status')->middleware("permission:question-approved");
    Route::post('assessment/question/delete/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'delete'])->name('assessment.question.delete')->middleware("permission:question-delete");
    Route::get('assessment/question/detail/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'detail'])->name('assessment.question.detail')->middleware("permission:question-view");
    Route::get('assessment/question/examTest/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'examTest'])->name('assessment.question.examTest');
    Route::get('/question-add-btn', [App\Http\Controllers\Admin\Assessment\AssessmentQuestionController::class, 'questionAddBtn'])->name('question.add.btn');

    //================ AssessmentResultController ==================//
    Route::get('submitted/assessments', [App\Http\Controllers\Admin\Assessment\AssessmentResultController::class, 'index'])->name('submitted.assessment.index')->middleware("permission:submitted-assesment-view");
    Route::get('submitted/assessment/get', [App\Http\Controllers\Admin\Assessment\AssessmentResultController::class, 'getSubmittedAssessment'])->name('submitted.assessment.get');
    Route::get('submitted/assessment/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentResultController::class, 'edit'])->name('submitted.assessment.edit')->middleware("permission:submitted-assesment-update");
    Route::post('submitted/assessment/update/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentResultController::class, 'update'])->name('submitted.assessment.update')->middleware("permission:submitted-assesment-update");
    Route::post('submitted/assessment/delete/{id}', [App\Http\Controllers\Admin\Assessment\AssessmentResultController::class, 'delete'])->name('submitted.assessment.delete')->middleware("permission:submitted-assesment-delete");

    //===============StudentAttendanceController===================//
    Route::get('student_present_absent/generate', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'PresentAbsentGenerate'])->name('student_present_absent.generate')->middleware("permission:student-present-absent");
    Route::post('student_present_absent/view', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'PresentAbsentView'])->name('student_present_absent.view');
    Route::get('student_in_out/generate', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'InOutGenerate'])->name('student_in_out.generate')->middleware("permission:student-attendance-in-out");
    Route::post('student_in_out/view', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'InOutView'])->name('student_in_out.view');
    Route::post('student_attendance/view', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'view'])->name('student_attendance.view');
    Route::resource('student_attendance', App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class);

    //===============Result Controller===================//
    // Route::get('student_present_absent/generate', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'PresentAbsentGenerate'])->name('student_present_absent.generate');
    // Route::post('student_present_absent/view', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'PresentAbsentView'])->name('student_present_absent.view');
    // Route::get('student_in_out/generate', [App\Http\Controllers\Admin\Attendance\StudentAttendanceController::class, 'InOutGenerate'])->name('student_in_out.generate');

    Route::post('student_result_in/view', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'InOutView'])->name('student_result_in.view');
    Route::post('student_result/view', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'view'])->name('student_result.view');
    Route::get('student_result/index', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'index'])->name('student_result.index');
    Route::post('student_result/store', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'store'])->name('student_result.store');
    Route::get('student_result/show', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'show'])->name('student_result.show');
    Route::post('student_result/update', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'update'])->name('student_result.update');
    Route::post('/student_result-delete/{id}', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'destroy'])->name('student_result.destroy');
    Route::post('store-issue-date', [App\Http\Controllers\Admin\Result\StudentResultController::class, 'storeIssueDate'])->name('store-issue-date');

    //===============StudentFeeController===================//
    Route::get('student-fee/collection', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'index'])->name('student.fee.index');
    Route::get('student_fee/getSections', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'getSections'])->name('getSections');
    Route::get('student_fee/getStudents', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'getStudents'])->name('getStudents');
    Route::get('student_fee/gen_stu_for_fee', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'gen_stu_for_fee'])->name('gen_stu_for_fee');
    Route::get('student_fee/generate', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'FeeGenerate'])->name('student.fee.generate');
    Route::post('student_fee/save', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'FeeSave'])->name('fee_save');
    // Route::get('student_fee/collection',[StudentFeeController::class, 'FeeCollection'])->name('fee_collection');
    Route::get('student/fee/create', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'create'])->name('student.payment.create');
    Route::post('student/fee/collect', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'feeCollect'])->name('student.fee.collect.all');

    Route::get('student-fee/invoice', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'invoice'])->name('student.invoice-ok')->middleware("permission:invoice-list");
    Route::get('course-commission-income', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'courseCommission'])->name('course-commission')->middleware('permission:registration-fee-list');
    Route::get('student-fee/detail/{memo_no}', [App\Http\Controllers\Admin\Accounts\StudentFeeController::class, 'detail'])->name('student.fee.detail');

    //------Account Head  Type Controller --------//
    Route::controller(\App\Http\Controllers\Admin\Accounts\AccountHeadTypeController::class)->group(function () {
        Route::get('/account-head-type-index', 'index')->name('account.head.type.index')->middleware("permission:account-head-type-view");
        Route::get('/add-account-head-type', 'addAddAccount')->name('add.account.head.type')->middleware("permission:account-head-type-create");
        Route::post('/store-account-head-type', 'store')->name('store.account.head.type')->middleware("permission:account-head-type-create");
        Route::get('/account-head-type-status/{id}', 'updateStatus')->name('account.head.type.update-status')->middleware("permission:account-head-type-approved");
        Route::get('/account-head-type-edit/{id}', 'edit')->name('account.head.type.edit')->middleware("permission:account-head-type-update");
        Route::post('/account-head-type-update/{id}', 'update')->name('account.head.type.update')->middleware("permission:account-head-type-update");
        Route::post('/account-head-type-delete/{id}', 'destroy')->name('account.head.type.destroy')->middleware("permission:account-head-type-delete");
    });

    //------Account Head Category Controller --------//
    Route::controller(\App\Http\Controllers\Admin\Accounts\AccountHeadCategoryController::class)->group(function () {
        Route::get('/account-category-index', 'index')->name('account.category.index')->middleware("permission:account-head-category-view");
        Route::get('/add-account-category', 'addAddAccount')->name('add.account.category')->middleware("permission:account-head-category-create");
        Route::post('/store-account-category', 'store')->name('store.account.category')->middleware("permission:account-head-category-create");
        Route::get('/account-category-status/{id}', 'updateStatus')->name('account.category.update-status')->middleware("permission:account-head-category-approved");
        Route::get('/account-category-edit/{id}', 'edit')->name('account.category.edit')->middleware("permission:account-head-category-update");
        Route::post('/account-category-update/{id}', 'update')->name('account.category.update')->middleware("permission:account-head-category-update");
        Route::post('/account-category-delete/{id}', 'destroy')->name('account.category.destroy')->middleware("permission:account-head-category-delete");
    });

    //------Account Head  Controller --------//
    Route::controller(\App\Http\Controllers\Admin\Accounts\AccountHeadController::class)->group(function () {
        Route::get('/account-head-index', 'index')->name('account.head.index')->middleware("permission:account-head-view");
        Route::get('/add-account-head', 'addAddAccount')->name('add.account.head')->middleware("permission:account-head-create");
        Route::post('/store-account-head', 'store')->name('store.account.head')->middleware("permission:account-head-creatte");
        Route::get('/account-head-status/{id}', 'updateStatus')->name('account.head.update-status')->middleware("permission:account-head-approved");
        Route::get('/account-head-edit/{id}', 'edit')->name('account.head.edit')->middleware("permission:account-head-update");
        Route::post('/account-head-update/{id}', 'update')->name('account.head.update')->middleware("permission:account-head-update");
        Route::post('/account-head-delete/{id}', 'destroy')->name('account.head.destroy')->middleware("permission:account-head-delete");
    });

    //------Account Report  Controller --------//
    Route::get('collection/student/report', [\App\Http\Controllers\Admin\Accounts\ReportController::class, 'collectionReport'])->name('collection.student.report')->middleware("permission:student-ledger-report");
    Route::get('collection/student/report/get', [\App\Http\Controllers\Admin\Accounts\ReportController::class, 'collectionGet'])->name('collection.student.report.get');

    Route::get('collection/student/report/print', [\App\Http\Controllers\Admin\Accounts\ReportController::class, 'collectionPrint'])->name('collection.student.report.print');
    Route::get('/procurement-reports', [App\Http\Controllers\Admin\Accounts\ReportController::class, 'procurementAll'])->name('procurement.all')->middleware("permission:procurement-all-report");

    Route::get('/all-procurement-report', [App\Http\Controllers\Admin\Accounts\ReportController::class, 'procurementReport'])->name('report.procurement');
    Route::get('/income-reports', [App\Http\Controllers\Admin\Accounts\ReportController::class, 'incomeAll'])->name('income.all')->middleware("permission:income-all-report");

    Route::get('/all-income-report', [App\Http\Controllers\Admin\Accounts\ReportController::class, 'incomeReport'])->name('report.income');
    Route::get('/expense-reports', [App\Http\Controllers\Admin\Accounts\ReportController::class, 'expenseAll'])->name('expense.all')->middleware("permission:expense-all-report");

    Route::get('/all-expense-report', [App\Http\Controllers\Admin\Accounts\ReportController::class, 'expenseReport'])->name('report.expense');
    Route::get('student/report/all', [\App\Http\Controllers\Admin\Accounts\ReportController::class, 'collectionReportAll'])->name('collection.student.report.all')->middleware("permission:due-student-report");

    Route::get('draft/student/list', [\App\Http\Controllers\Admin\Accounts\ReportController::class, 'draftStudent'])->name('draft.student.list')->middleware("permission:draft-student-report");
    Route::post('due/student/list/', [\App\Http\Controllers\Admin\Accounts\ReportController::class, 'dueStudentList'])->name('due.student.list');

    //------Account Head  Controller --------//
    Route::controller(\App\Http\Controllers\Admin\Sms\SmsSendController::class)->group(function () {
        Route::get('/sms-index', 'index')->name('sms.index')->middleware("permission:student-send-sms");
        Route::post('/store-sms', 'store')->name('store.sms');
        Route::get('/sms-single-index', 'singleIndex')->name('sms.single.index');
        Route::post('/store-single-sms', 'singleStore')->name('store.single.sms');
        Route::get('/show.sms', 'show')->name('show.sms');

        Route::get('/all-branch-sms', 'branchSms')->name('branch.sms');
        Route::post('/all-branch-store', 'branchStore')->name('branch.store');
        Route::get('/branch-sms-show', 'branchSmsShow')->name('branch.sms.show');

        Route::get('due/student/sms', 'dueStudentSms')->name('due.student.sms');
        Route::post('/due-student-sms', 'dueStore')->name('due.store.sms');
        Route::get('/due-student-show', 'dueStudentShow')->name('due.store.show');
    });

    //------Account Head  Controller --------//
    Route::controller(\App\Http\Controllers\Admin\Requisition\RequisitionController::class)->group(function () {
        Route::get('/index-requisition', 'index')->name('show.requisition');

        Route::get('/complete-requisition', 'complete')->name('complete.requisition');

        Route::get('/detail-requisition/{id}', 'detail')->name('detail.requisition');
        Route::get('/update-status-requisition/{id}', 'status')->name('requisition.update-status');
    });
});

//****studentPanel****\\********//********Student Panel Route List Start ********\\********\\****studentPanel****//
//========== Student Panel Assignment Route List============//
Route::middleware('student')->prefix('student')->group(function () {
    Route::get('/assignment-submitted', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'add'])->name('add.assignment.submitted');
    Route::post('/new-submitted-assignment', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'create'])->name('submitted.assignment.store');
    Route::get('/manage-submitted-assignment', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'manage'])->name('submitted.assignment.manage');
    Route::get('/show-submitted-assignment', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'show'])->name('submitted.assignment.show');
    Route::get('/submitted-assignment-status/{id}', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'updateStatus'])->name('submitted.assignment.update-status');
    Route::get('/submitted-assignment-detail/{id}', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'detail'])->name('submitted.assignment.detail');
    Route::get('/submitted-assignment-edit/{id}', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'edit'])->name('submitted.assignment.edit');
    Route::post('/submitted-assignment-update/{id}', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'update'])->name('submitted.assignment.update');
    Route::post('/submitted-assignment-delete/{id}', [App\Http\Controllers\Student\Assignment\AssignmentSubmitController::class, 'destroy'])->name('submitted.assignment.destroy');
});

//========== Student Panel Homework Route List============//
Route::middleware('student')->prefix('student')->group(function () {
    Route::get('/homework-submitted', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'add'])->name('add.homework.submitted');
    Route::post('/new-submitted-homework', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'create'])->name('submitted.homework.store');
    Route::get('/manage-homework-assignment', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'manage'])->name('submitted.homework.manage');
    Route::get('/show-homework-assignment', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'showWork'])->name('submitted.homework.show');
    Route::get('/submitted-homework-status/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'updateStatus'])->name('submitted.homework.update-status');
    Route::get('/submitted-homework-detail/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'detail'])->name('submitted.homework.detail');
    Route::get('/submitted-homework-edit/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'edit'])->name('submitted.homework.edit');
    Route::post('/submitted-homework-update/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'update'])->name('submitted.homework.update');
    Route::post('/submitted-homework-delete/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'destroy'])->name('submitted.homework.delete');
});

//========== Student MCQ Exam ============//
Route::middleware('student')->prefix('student')->group(function () {
    Route::get('/mcq-submitted', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'index'])->name('student.mcq.submitted');
    Route::get('student-exam-test/{id}', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'studentMcqTest'])->name('student.mcq.test');
    Route::post('assessment/question/{id}', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'mcqQuestion'])->name('mcq.question');
    Route::post('assessment/answer/submit', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'mcqAnswerSubmit'])->name('mcq.answer.submit');
    Route::get('submitted/assessments', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'indexMcq'])->name('submitted.mcq.index');
});

//========== Student Course Info ============//
Route::middleware('student')->prefix('student')->group(function () {
    Route::get('/student-course-index', [App\Http\Controllers\Student\Course\StudentCourseController::class, 'index'])->name('student.course.index');
    Route::get('/student-course/details/{id}', [App\Http\Controllers\Student\Course\StudentCourseController::class, 'studentCourse'])->name('student.course_detail');
    // Route::get('student-exam-test/{id}', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'studentMcqTest'])->name('student.mcq.test');
    // Route::post('assessment/question/{id}', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'mcqQuestion'])->name('mcq.question');
    // Route::post('assessment/answer/submit', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'mcqAnswerSubmit'])->name('mcq.answer.submit');
    // Route::get('submitted/assessments', [App\Http\Controllers\Student\Mcq\StudentMcqController::class, 'indexMcq'])->name('submitted.mcq.index');
});

Route::get('student_student-result/show', [App\Http\Controllers\Student\Result\StudentResultShowController::class, 'show'])->name('student.student_result.show');

Route::get('student-from-show', [App\Http\Controllers\Student\Result\StudentResultShowController::class, 'from'])->name('student.from.show');
Route::get('student-from-show/{id}', [App\Http\Controllers\Student\Result\StudentResultShowController::class, 'detail'])->name('from.student.detail');

//****studentPanel****\\********//********Student Panel Route List End ********\\********\\****studentPanel****//

//********\\********//********branchPanel Route List Start ********\//********\\********//
//========== branchPanel Route List============//
Route::middleware('branch')->prefix('branches')->group(function () {
    //========== branch home Slider  Panel  Route List============//
    Route::get('/index-slide', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'homeSlide'])->name('branch.index.slide');
    Route::get('/add-slide', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'branchAddSlider'])->name('branch.add.slide');
    Route::post('/add-slide', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'store'])->name('branch.store.slide');
    Route::get('/slider-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'updateStatus'])->name('branch.slider.update-status');
    Route::get('/slider-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'edit'])->name('branch.slider.edit');
    Route::post('/slider-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'update'])->name('branch.slider.update');
    Route::post('/slider-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesSliderController::class, 'delete'])->name('branch.slider.destroy');

    //========== branch Project  Panel  Route List============//
    Route::get('/project-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'index'])->name('branch.project.index');
    Route::get('/add-project', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'addProject'])->name('branch.add.project');
    Route::post('/store-project', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'store'])->name('branch.store.project');
    Route::get('/project-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'updateStatus'])->name('branch.project.update-status');
    Route::get('/project-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'edit'])->name('branch.project.edit');
    Route::post('/project-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'update'])->name('branch.project.update');
    Route::post('/project-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurProjectController::class, 'destroy'])->name('branch.project.destroy');

    //========== Branches  Achievement Controller Route List============//
    Route::get('/achievement-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'index'])->name('branch.achievement.index');
    Route::get('/add-achievement', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'addAchievement'])->name('branch.add.achievement');
    Route::post('/store-achievement', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'store'])->name('branch.store.achievement');
    Route::get('/achievement-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'updateStatus'])->name('branch.achievement.update-status');
    Route::get('/achievement-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'edit'])->name('branch.achievement.edit');
    Route::post('/achievement-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'update'])->name('branch.achievement.update');
    Route::post('/achievement-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurAchievementController::class, 'destroy'])->name('branch.achievement.destroy');

    //========== Branches  Achievement Controller Route List============//
    Route::get('/speech-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurSpeechController::class, 'index'])->name('branch.speech.index');
    Route::get('/add-speech', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurSpeechController::class, 'addSpeech'])->name('branch.add.speech');
    Route::post('/store-speech', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurSpeechController::class, 'store'])->name('branch.store.speech');
    Route::get('/speech-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurSpeechController::class, 'edit'])->name('branch.speech.edit');
    Route::post('/speech-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurSpeechController::class, 'update'])->name('branch.speech.update');
    Route::post('/speech-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurSpeechController::class, 'delete'])->name('branch.speech.destroy');

    //========== Branches Notice Controller Route List============//
    Route::get('/notice-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'index'])->name('branch.notice.index');
    Route::get('/add-notice', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'addNotice'])->name('branch.add.notice');
    Route::post('/store-notice', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'store'])->name('branch.store.notice');
    Route::get('/notice-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'updateStatus'])->name('branch.notice.update-status');
    Route::get('/notice-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'edit'])->name('branch.notice.edit');
    Route::post('/notice-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'update'])->name('branch.notice.update');
    Route::post('/notice-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesNoticeController::class, 'destroy'])->name('branch.notice.destroy');

    //========== Branches testimonial Controller Route List============//
    Route::get('/testimonial-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'index'])->name('branch.testimonial.index');
    Route::get('/add-testimonial', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'addTestimonial'])->name('branch.add.testimonial');
    Route::post('/store-testimonial', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'store'])->name('branch.store.testimonial');
    Route::get('/testimonial-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'updateStatus'])->name('branch.testimonial.update-status');
    Route::get('/testimonial-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'edit'])->name('branch.testimonial.edit');
    Route::post('/testimonial-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'update'])->name('branch.testimonial.update');
    Route::post('/testimonial-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesTestimonialStudentController::class, 'destroy'])->name('branch.testimonial.destroy');

    //========== Branches city Controller Route List============//
    Route::get('/city-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'index'])->name('branch.city.index');
    Route::get('/add-city', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'addCity'])->name('branch.add.city');
    Route::post('/store-city', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'store'])->name('branch.store.city');
    Route::get('/city-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'updateStatus'])->name('branch.city.update-status');
    Route::get('/city-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'edit'])->name('branch.city.edit');
    Route::post('/city-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'update'])->name('branch.city.update');
    Route::post('/city-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCityController::class, 'destroy'])->name('branch.city.destroy');

    //========== Branches District Controller Route List============//
    Route::get('/district-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'index'])->name('branch.district.index');
    Route::get('/add-district', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'addDistrict'])->name('branch.add.district');
    Route::post('/store-district', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'store'])->name('branch.store.district');
    Route::get('/district-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'updateStatus'])->name('branch.district.update-status');
    Route::get('/district-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'edit'])->name('branch.district.edit');
    Route::post('/district-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'update'])->name('branch.district.update');
    Route::post('/district-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDistrictController::class, 'destroy'])->name('branch.district.destroy');

    //========== Branches Division Controller Route List============//
    Route::get('/division-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'index'])->name('branch.division.index');
    Route::get('/add-division', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'addDivision'])->name('branch.add.division');
    Route::post('/store-division', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'store'])->name('branch.store.division');
    Route::get('/division-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'updateStatus'])->name('branch.division.update-status');
    Route::get('/division-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'edit'])->name('branch.division.edit');
    Route::post('/division-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'update'])->name('branch.division.update');
    Route::post('/division-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDivisionController::class, 'destroy'])->name('branch.division.destroy');

    //========== Branches Director Controller Route List============//
    Route::get('/director-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'index'])->name('branch.director.index');
    Route::get('/add-director', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'addDirector'])->name('branch.add.director');
    Route::post('/store-director', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'store'])->name('branch.store.director');
    Route::get('/director-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'updateStatus'])->name('branch.director.update-status');
    Route::get('/director-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'edit'])->name('branch.director.edit');
    Route::post('/director-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'update'])->name('branch.director.update');
    Route::post('/director-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesDirectorController::class, 'destroy'])->name('branch.director.destroy');

    //========== Branches Contact Controller Route List============//
    Route::get('/contact-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'index'])->name('branch.contact.index');
    Route::get('/add-contact', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'addContact'])->name('branch.add.contact');
    Route::post('/store-contact', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'store'])->name('branch.store.contact');
    Route::get('/contact-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'updateStatus'])->name('branch.contact.update-status');
    Route::get('/contact-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'edit'])->name('branch.contact.edit');
    Route::post('/contact-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'update'])->name('branch.contact.update');
    Route::post('/contact-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesContactController::class, 'destroy'])->name('branch.contact.destroy');

    //========== Branches about Controller Route List============//
    Route::get('/about-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'index'])->name('branch.about.index');
    Route::get('/add-about', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'addAbout'])->name('branch.add.about');
    Route::post('/store-about', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'store'])->name('branch.store.about');
    Route::get('/about-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'updateStatus'])->name('branch.about.update-status');
    Route::get('/about-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'edit'])->name('branch.about.edit');
    Route::post('/about-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'update'])->name('branch.about.update');
    Route::post('/about-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesAboutController::class, 'destroy'])->name('branch.about.destroy');

    //========== Branches blog Controller Route List============//
    Route::get('/blog-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'index'])->name('branch.blog.index');
    Route::get('/blog/get/list', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'getBlog'])->name('branch.blog.get');
    Route::get('/add-blog', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'addBlog'])->name('branch.add.blog');
    Route::post('/store-blog', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'store'])->name('branch.store.blog');
    Route::get('/blog-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'updateStatus'])->name('branch.blog.update-status');
    Route::get('/blog-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'edit'])->name('branch.blog.edit');
    Route::post('/blog-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'update'])->name('branch.blog.update');
    Route::get('/blog-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesBlogController::class, 'destroy'])->name('branch.blog.destroy');

    //========== Branches service  Controller Route List============//
    Route::get('/service-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'index'])->name('branch.service.index');
    Route::get('/add-service', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'addService'])->name('branch.add.service');
    Route::post('/store-service', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'store'])->name('branch.store.service');
    Route::get('/service-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'updateStatus'])->name('branch.service.update-status');
    Route::get('/service-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'edit'])->name('branch.service.edit');
    Route::post('/service-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'update'])->name('branch.service.update');
    Route::post('/service-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesOurServiceController::class, 'destroy'])->name('branch.service.destroy');

    //========== Branches gallery  Controller Route List============//
    Route::get('/gallery-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'index'])->name('branch.gallery.index');
    Route::get('/add-gallery', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'addGallery'])->name('branch.add.gallery');
    Route::post('/store-gallery', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'store'])->name('branch.store.gallery');
    Route::get('/gallery-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'updateStatus'])->name('branch.gallery.update-status');
    Route::get('/gallery-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'edit'])->name('branch.gallery.edit');
    Route::post('/gallery-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'update'])->name('branch.gallery.update');
    Route::post('/gallery-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesGalleryStudentController::class, 'destroy'])->name('branch.gallery.destroy');

    //========== Branches Course  Controller Route List============//
    Route::get('/course-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'index'])->name('branch.course.index');
    Route::get('/add-course', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'addCourse'])->name('branch.add.course');
    Route::post('/store-course', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'store'])->name('branch.store.course');
    Route::get('/course-detail/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'detail'])->name('branch.course.detail');
    Route::get('/course-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'updateStatus'])->name('branch.course.update-status');
    Route::get('/course-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'edit'])->name('branch.course.edit');
    Route::post('/course-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'update'])->name('branch.course.update');
    Route::post('/course-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseTitleController::class, 'destroy'])->name('branch.course.destroy');

    //========== Branches Course Category Controller Route List============//
    Route::get('/category-index', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'index'])->name('branch.category.index');
    Route::get('/add-category', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'addCategory'])->name('branch.add.category');
    Route::post('/store-category', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'store'])->name('branch.store.category');
    Route::get('/category-status/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'updateStatus'])->name('branch.category.update-status');
    Route::get('/category-edit/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'edit'])->name('branch.category.edit');
    Route::post('/category-update/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'update'])->name('branch.category.update');
    Route::post('/category-delete/{id}', [App\Http\Controllers\BranchPanel\Frontend\BranchesCourseCategoryController::class, 'destroy'])->name('branch.category.destroy');

    //==========  Branches Session  Controller Route List============//
    Route::get('/session-index', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'index'])->name('branch.session.index');
    Route::get('/add-session', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'addSession'])->name('branch.add.session');
    Route::post('/store-session', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'store'])->name('branch.store.session');
    Route::get('/session-status/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'updateStatus'])->name('branch.session.update-status');
    Route::get('/session-edit/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'edit'])->name('branch.session.edit');
    Route::post('/session-update/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'update'])->name('branch.session.update');
    Route::post('/session-delete/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesSessionController::class, 'destroy'])->name('branch.session.destroy');

    //==========  Branches schedule  Controller Route List============//
    Route::get('/schedule-index', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'index'])->name('branch.schedule.index');
    Route::get('/add-schedule', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'addSchedule'])->name('branch.add.schedule');
    Route::post('/store-schedule', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'store'])->name('branch.store.schedule');
    Route::get('/schedule-status/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'updateStatus'])->name('branch.schedule.update-status');
    Route::get('/schedule-edit/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'edit'])->name('branch.schedule.edit');
    Route::post('/schedule-update/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'update'])->name('branch.schedule.update');
    Route::post('/schedule-delete/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesClassScheduleController::class, 'destroy'])->name('branch.schedule.destroy');

    //==========  Branches Student Unit Controller Route List============//
    Route::get('/student-Unit-index', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'index'])->name('branch.studentUnit.index');
    Route::get('/add-student-Unit', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'addStudentUnit'])->name('branch.add.studentUnit');
    Route::post('/store-student-Unit', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'store'])->name('branch.store.studentUnit');
    Route::get('/student-Unit-status/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'updateStatus'])->name('branch.studentUnit.update-status');
    Route::get('/student-Unit-edit/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'edit'])->name('branch.studentUnit.edit');
    Route::post('/student-Unit-update/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'update'])->name('branch.studentUnit.update');
    Route::post('/student-Unit-delete/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesStudentUnitController::class, 'destroy'])->name('branch.studentUnit.destroy');

    //==========  Branches Batch  Controller Route List============//

    Route::get('/batch-index', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'index'])->name('branch.batch.index');
    Route::get('/add-batch', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'addBatch'])->name('branch.add.batch');
    Route::post('/batch-Unit', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'store'])->name('branch.store.batch');
    Route::get('/batch-status/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'updateStatus'])->name('branch.batch.update-status');
    Route::get('/batch-edit/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'edit'])->name('branch.batch.edit');
    Route::post('/batch-update/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'update'])->name('branch.batch.update');
    Route::post('/batch-delete/{id}', [App\Http\Controllers\BranchPanel\Academic\BranchesBatchController::class, 'destroy'])->name('branch.batch.destroy');

    //========== Branches Teacher Category  Controller Route List============//
    Route::get('/teacher-category-index', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherCategoryController::class, 'index'])->name('branch.teacher.category.index');
    Route::get('/add-teacher-category', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherCategoryController::class, 'addCategory'])->name('branch.add.teacher.category');
    Route::post('/teacher-category-Unit', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherCategoryController::class, 'store'])->name('branch.store.teacher.category');
    Route::get('/teacher-category-edit/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherCategoryController::class, 'edit'])->name('branch.teacher.category.edit');
    // Route::post('/teacher-category-update/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherCategoryController::class, 'update'])->name('branch.teacher.category.update');
    Route::post('/teacher-category-delete/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherCategoryController::class, 'destroy'])->name('branch.teacher.category.destroy');

    //========== Branches Teacher  Controller Route List============//
    Route::get('/teacher-index', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'index'])->name('branch.teacher.index');
    Route::get('/add-teacher', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'addTeacher'])->name('branch.add.teacher');
    Route::post('/teacher-Unit', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'store'])->name('branch.store.teacher');
    Route::get('/teacher-status/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'updateStatus'])->name('branch.teacher.update-status');
    Route::get('/teacher-edit/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'edit'])->name('branch.teacher.edit');
    Route::post('/teacher-update/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'update'])->name('branch.teacher.update');
    Route::post('/teacher-delete/{id}', [App\Http\Controllers\BranchPanel\Teacher\BranchesTeacherController::class, 'destroy'])->name('branch.teacher.destroy');

    //------- Branches Software Supplier Controller --------//
    Route::resource('/branches-supplier', App\Http\Controllers\BranchPanel\Purchase\BranchSupplierController::class);
    Route::get('/update-supplier-status/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchSupplierController::class, 'updateStatus'])->name('branch.supplier.update-status');

    //------- Branches Software Unit Controller --------//
    Route::resource('/branches-unit', App\Http\Controllers\BranchPanel\Purchase\BranchUnitController::class);
    Route::get('/update-unit-status/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchUnitController::class, 'updateStatus'])->name('branch.unit.update-status');

    //-------Branches Software Product Controller --------//
    Route::resource('/branches-product', App\Http\Controllers\BranchPanel\Purchase\BranchProductController::class);
    Route::get('/update-product-status/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchProductController::class, 'updateStatus'])->name('branch.product.update-status');

    //-------Branches All Purchase  Controller--------//
    Route::get('/add-new-purchase', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'add'])->name('branch.add.purchase');
    Route::post('/new-purchase', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'create'])->name('branch.purchase.store');
    Route::get('/manage-purchase', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'manage'])->name('branch.purchase.manage');
    Route::get('/purchase-status/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'updateStatus'])->name('branch.purchase.update-status');
    Route::get('/purchase-detail/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'detail'])->name('branch.purchase.detail');
    Route::get('/purchase-edit/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'edit'])->name('branch.purchase.edit');
    Route::post('/purchase-update/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'update'])->name('branch.purchase.update');
    Route::post('/purchase-delete/{id}', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'delete'])->name('branch.purchase.destroy');
    Route::get('/branch-get-all-data-for-Purchase', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'branchGetAllPurchaseData'])->name('branch-get-all-data-for-Purchase');

    Route::get('/product/stock/branch', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'stockProductBranch'])->name('branch.product.stock');

    Route::get('/branch/product/stock/detail/{product}', [App\Http\Controllers\BranchPanel\Purchase\BranchPurchaseController::class, 'stockProductDetailBranch'])->name('branch.product.stock.detail');

    //------Branches Expense Type Controller --------//
    Route::resource('/branches-expenseType', App\Http\Controllers\BranchPanel\Expense\BranchExpenseTypeController::class);
    Route::get('/update-expenseType-status/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseTypeController::class, 'updateStatus'])->name('branch.expenseType.update-status');

    //------ Branches Bank Type Controller --------//
    Route::resource('/branches-bank', App\Http\Controllers\BranchPanel\Expense\BranchBankController::class);
    Route::get('/update-bank-status/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchBankController::class, 'updateStatus'])->name('branch.bank.update-status');

    //-------Branches Expense  Controller--------// add
    Route::get('/add-new-expense', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'add'])->name('branch.add.expense');
    Route::post('/new-expense', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'create'])->name('branch.expense.store');
    Route::get('/manage-expense', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'manage'])->name('branch.expense.manage');
    Route::get('/expense-status/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'updateStatus'])->name('branch.expense.update-status');
    Route::get('/expense-detail/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'detail'])->name('branch.expense.detail');
    Route::get('/expense-edit/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'edit'])->name('branch.expense.edit');
    Route::post('/expense-update/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'update'])->name('branch.expense.update');
    Route::post('/expense-delete/{id}', [App\Http\Controllers\BranchPanel\Expense\BranchExpenseController::class, 'delete'])->name('branch.expense.destroy');

    //================ Branches Home Work Controller ==================//
    Route::get('/add-new-homework', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'add'])->name('branch.add.homework');
    Route::post('/new-homework', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'create'])->name('branch.homework.store');
    Route::get('/manage-homework', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'manage'])->name('branch.homework.manage');
    Route::get('/completed-homework', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'completed'])->name('branch.homework.completed');
    Route::get('/homework-status/{id}', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'updateStatus'])->name('branch.homework.update-status');
    Route::get('/homework-detail/{id}', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'detail'])->name('branch.homework.detail');
    Route::get('/homework-edit/{id}', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'edit'])->name('branch.homework.edit');
    Route::post('/homework-update/{id}', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'update'])->name('branch.homework.update');
    Route::post('/homework-delete/{id}', [App\Http\Controllers\BranchPanel\HomeWork\BranchHomeWorkController::class, 'destroy'])->name('branch.homework.destroy');

    //================ Branches  Assignment Work Controller ==================//
    Route::get('/add-assignment', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'add'])->name('branch.assignment.add');
    Route::post('/new-assignment', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'create'])->name('branch.assignment.store');
    Route::get('/assignment-manage', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'manage'])->name('branch.assignment.manage');
    Route::get('/completed-assignment', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'completed'])->name('branch.assignment.completed');
    Route::get('/assignment-status/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'updateStatus'])->name('branch.assignment.update-status');
    Route::get('/assignment-detail/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'detail'])->name('branch.assignment.detail');
    Route::get('/assignment-edit/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'edit'])->name('branch.assignment.edit');
    Route::post('/assignment-update/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'update'])->name('branch.assignment.update');
    Route::post('/assignment-delete/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'delete'])->name('branch.assignment.destroy');


    
    Route::get('branch/student-submitted-assignment', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'ssa'])->name('branch.student.submitted.assignment');
    Route::post('branch/student-submitted-download', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'assignmentDownload'])->name('branch.student.submitted.download');
    Route::get('branch/student-assignment-result-edit/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'assignmentEditNumber'])->name('branch.student.assignment.result.edit');
  
    Route::post('branch/assignmentUpdate-number/{id}', [App\Http\Controllers\BranchPanel\Assignment\BranchAssignmentController::class, 'assignmentUpdate'])->name('branch.assignmentUpdate.number');









    //------ Admit Card Branch  Controller --------//
    Route::get('/add-card', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'add'])->name('branch.add.card');
    Route::post('/id-card-generate', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'idCardGenerate'])->name('branch.id.card.generate');
    Route::get('/add-admit-card', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'addAdmit'])->name('branch.add.admit.card');
    Route::post('/admit-card-generate', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'admitCardGenerate'])->name('branch.admit.card.generate');

    Route::get('/add-registration-card', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'addRegistration'])->name('branch.add.registration.card');
    Route::post('/registration-card-generate', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'registrationCardGenerate'])->name('branch.registration.card.generate');

    Route::get('/add-certificate-card', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'addCertificate'])->name('branch.add.certificate.card');
    Route::post('/certificate-card-generate', [App\Http\Controllers\BranchPanel\Card\BranchCardController::class, 'certificateCardGenerate'])->name('branch.certificate.card.generate');

    //=============== Branch Student Attendance Controller===================//
    Route::get('student_present_absent/generate', [App\Http\Controllers\BranchPanel\Attendance\BranchStudentAttendanceController::class, 'PresentAbsentGenerate'])->name('branch.student_present_absent.generate');
    Route::post('student_present_absent/view', [App\Http\Controllers\BranchPanel\Attendance\BranchStudentAttendanceController::class, 'PresentAbsentView'])->name('branch.student_present_absent.view');
    Route::get('student_in_out/generate', [App\Http\Controllers\BranchPanel\Attendance\BranchStudentAttendanceController::class, 'InOutGenerate'])->name('branch.student_in_out.generate');
    Route::post('student_in_out/view', [App\Http\Controllers\BranchPanel\Attendance\BranchStudentAttendanceController::class, 'InOutView'])->name('branch.student_in_out.view');
    Route::post('student_attendance/view', [App\Http\Controllers\BranchPanel\Attendance\BranchStudentAttendanceController::class, 'view'])->name('branch.student_attendance.view');
    Route::resource('student_attendance_branch', App\Http\Controllers\BranchPanel\Attendance\BranchStudentAttendanceController::class);

    //-------System Setting  Controller --------//
    Route::controller(\App\Http\Controllers\BranchPanel\Frontend\BranchSystemSettingController::class)->group(function () {
        Route::get('/system-index', 'index')->name('branch.system.index');
        Route::get('/add-system', 'addSystem')->name('branch.add.system');
        Route::post('/store-system', 'store')->name('branch.store.system');
        Route::get('/system-status/{id}', 'updateStatus')->name('branch.system.update-status');
        Route::get('/system-edit/{id}', 'edit')->name('branch.system.edit');
        Route::post('/system-update/{id}', 'update')->name('branch.system.update');
        Route::post('/system-delete/{id}', 'destroy')->name('branch.system.destroy');
    });

    //===============Branch Student Fee Controller===================//
    Route::get('student-fee/collection', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'index'])->name('branch.student.fee.index');
    Route::get('student_fee/getSections', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'getSections'])->name('branch.getSections');
    Route::get('student_fee/getStudents', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'getStudents'])->name('branch.getStudents');
    Route::get('student_fee/gen_stu_for_fee', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'gen_stu_for_fee'])->name('branch.gen_stu_for_fee');
    Route::get('student_fee/generate', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'FeeGenerate'])->name('branch.student.fee.generate');
    Route::post('student_fee/save', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'FeeSave'])->name('branch.fee_save');
    Route::get('student/fee/create', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'create'])->name('branch.student.payment.create');
    Route::post('student/fee/collect', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'feeCollect'])->name('branch.student.fee.collect.all');

    Route::get('student-fee/invoice', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'invoice'])->name('branch.student.fee.invoice');
    Route::get('student-fee/detail/{memo_no}', [App\Http\Controllers\BranchPanel\Accounts\BranchStudentFeeController::class, 'detail'])->name('branch.student.fee.detail');

    //==================Report Controller ========================//
    Route::get('collection/student/report', [\App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'collectionReport'])->name('branch.collection.student.report');
    Route::get('collection/student/report/get', [\App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'collectionGet'])->name('branch.collection.student.report.get');
    Route::get('collection/student/report/print', [\App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'collectionPrint'])->name('branch.collection.student.report.print');

    Route::get('/procurement-reports', [App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'procurementAll'])->name('branch.procurement.all');
    Route::get('/all-procurement-report', [App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'procurementReport'])->name('branch.report.procurement');

    Route::get('/income-reports', [App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'incomeAll'])->name('branch.income.all');
    Route::get('/all-income-report', [App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'incomeReport'])->name('branch.report.income');

    Route::get('/expense-reports', [App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'expenseAll'])->name('branch.expense.all');
    Route::get('/all-expense-report', [App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'expenseReport'])->name('branch.report.expense');

    Route::get('student/report/all', [\App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'collectionReportAll'])->name('branch.collection.student.report.all');
    Route::get('draft/student/list', [\App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'draftStudent'])->name('branch.draft.student.list');
    Route::post('due/student/list/', [\App\Http\Controllers\BranchPanel\Accounts\BranchReportController::class, 'dueStudentList'])->name('branch.due.student.list');

    //======================Result Controller ==============================//
    Route::get('student_result/show', [App\Http\Controllers\BranchPanel\Result\BranchStudentResultController::class, 'show'])->name('branch.student_result.show');
    Route::get('mcq-result/branch', [App\Http\Controllers\BranchPanel\Result\BranchStudentResultController::class, 'resultShow'])->name('branch.mcq.show');

    //------Account Head  Controller --------//
    Route::controller(\App\Http\Controllers\BranchPanel\Sms\BranchSmsSendController::class)->group(function () {
        Route::get('/sms-index', 'index')->name('branch.sms.index');
        Route::post('/store-sms', 'store')->name('branch.store.sms');
        Route::get('/sms-single-index', 'singleIndex')->name('branch.sms.single.index');
        Route::post('/store-single-sms', 'singleStore')->name('branch.store.single.sms');
        Route::get('/show.sms', 'show')->name('branch.show.sms');

        Route::get('/all-branch-sms', 'branchSms')->name('branch.branch.sms');
        Route::post('/all-branch-store', 'branchStore')->name('branch.branch.store');
        Route::get('/branch-sms-show', 'branchSmsShow')->name('branch.branch.sms.show');

        Route::get('due/student/sms', 'dueStudentSms')->name('branch.due.student.sms');
        Route::post('/due-student-sms', 'dueStore')->name('branch.due.store.sms');
        Route::get('/due-student-show', 'dueStudentShow')->name('branch.due.store.show');
    });

    //==========Certificate Requisitions Controller Route List============//
    Route::get('/requisition-index', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'index'])->name('branch.requisition.index');
    Route::get('/requisition-student', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'getStudents'])->name('branch.requisition.students');
    Route::get('/show-requisition', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'show'])->name('branch.show.requisition');
    Route::post('/store-requisition', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'store'])->name('branch.store.requisition');

    Route::get('/requisition-detail/{id}', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'detail'])->name('branch.requisition.detail');

    Route::get('/requisition-edit/{id}', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'edit'])->name('branch.requisition.edit');
    Route::post('/requisition-update/{id}', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'update'])->name('branch.requisition.update');
    Route::post('/requisition-delete/{id}', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'destroy'])->name('branch.requisition.destroy');

    Route::get('/complete-requisition', [App\Http\Controllers\BranchPanel\Requisition\BranchesRequisitionController::class, 'complete'])->name('branch.complete.requisition');
});

Route::controller(\App\Http\Controllers\BranchPanel\Student\BranchStudentController::class)->group(function () {

    Route::post('branches/store-student', 'store')->name('branch.store.student');
    Route::middleware('branch')->prefix('branches')->group(function () {
        //------Admission  Controller --------//
        Route::get('student/course/price', 'coursePrice')->name('branch.student.course.price');
        Route::get('branch/wish/batch', 'branchBatch')->name('branch.branch.wish.batch');
        Route::get('batch/wish/schedule', 'batchSchedule')->name('branch.batch.wish.schedule');
        Route::get('/student-index', 'show')->name('branch.student.index');
        Route::get('/student-pending-index', 'pending')->name('branch.student.pending');

        Route::get('/add-student', 'addStudent')->name('branch.add.student');
        Route::get('/student-detail/{id}', 'detail')->name('branch.student.detail');
        Route::get('/student-status/{id}', 'updateStatus')->name('branch.student.update-status');
        Route::get('/student-edit/{id}', 'edit')->name('branch.student.edit');
        Route::get('/student-download/{id}', 'download')->name('branch.student.download');
        Route::post('/student-update/{id}', 'update')->name('branch.student.update');
        Route::post('/student-delete/{id}', 'destroy')->name('branch.student.destroy');
        Route::post('/student-course/{id}/commission', 'studentCommissionPay')->name('student.course.commission');
    });
});

//********\\********//********branchPanel Route List End ********//********\\********//

Route::get('/clear-all', function () {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    //    exec('composer dump-autoload');
    //    shell_exec('composer dump-autoload');
    //    exec('composer install');
    //    shell_exec('composer install');

    return "Cache is cleared";
});
Route::get('/composer_install', function () {
    //    exec('composer dump-autoload');
    //    shell_exec('composer dump-autoload');
    //    exec('composer install');
    //    shell_exec('composer install');

    return "Cache is cleared";
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    route::get('download/local', [\App\Http\Controllers\Admin\StorageController::class, 'downloadLocal'])->name('download.local');
    route::get('download/public/{filename}', [\App\Http\Controllers\Admin\StorageController::class, 'downloadPublic'])->name('download.public');
});

Route::get('pay', [\App\Http\Controllers\Admin\PaymentController::class, 'show'])->name('uddoktapay.payment-form');
Route::post('pay', [\App\Http\Controllers\Admin\PaymentController::class, 'pay'])->name('uddoktapay.pay');
Route::get('success', [\App\Http\Controllers\Admin\PaymentController::class, 'success'])->name('uddoktapay.success');
Route::get('cancel', [\App\Http\Controllers\Admin\PaymentController::class, 'cancel'])->name('uddoktapay.cancel');

//-------Home Slide  Controller--------//
// Route::controller(\App\Http\Controllers\Frontend\HomeSliderController::class)->group(function () {
//     Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//         //
//         Route::get('/home-slide',   [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class,       'homeSlider'])->name('home.slide');
//         Route::get('/add-slide',         'addSlider')->name('add.slide');

//         Route::post('/store-slider',       'store')->name('store.slider');

//         Route::get('/slider-status/{id}',       'updateStatus')->name('slider.update-status');
//         Route::get('/slider-edit/{id}',       'edit')->name('slider.edit');

//         Route::post('/slider-update/{id}',    'update')->name('slider.update');
//         Route::post('/slider-delete/{id}',    'delete')->name('slider.destroy');
//     });
// });

// Route::middleware('branch')->prefix('branch')->group(function () {

//     Route::get('/homework-submitted', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'add'])->name('add.homework.submitted');
//     Route::post('/new-submitted-homework', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class,  'create'])->name('submitted.homework.store');

//     Route::get('/manage-homework-assignment',  [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class,   'manage'])->name('submitted.homework.manage');

//     Route::get('/show-homework-assignment',  [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class,   'showWork'])->name('submitted.homework.show');

//     Route::get('/submitted-homework-status/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'updateStatus'])->name('submitted.homework.update-status');

//     Route::get('/submitted-homework-detail/{id}',  [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class,  'detail'])->name('submitted.homework.detail');
//     Route::get('/submitted-homework-edit/{id}',   [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'edit'])->name('submitted.homework.edit');

//     Route::post('/submitted-homework-update/{id}', [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class, 'update'])->name('submitted.homework.update');
//     Route::post('/submitted-homework-delete/{id}',  [App\Http\Controllers\Student\HomeWork\HomeWorkSubmitController::class,  'destroy'])->name('submitted.homework.delete');

// });
