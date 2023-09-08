<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:user-view", ["only" => ["index"]]);
        $this->middleware("permission:user-create", ["only" => ["create", "store"]]);
        $this->middleware("permission:user-update", ["only" => ["edit", "update"]]);
        $this->middleware("permission:user-delete", ["only" => ["destroy"]]);
        $this->middleware("permission:user-set-permission", ["only" => ["permission"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
        return view("admin.users.index", compact("users"));
    }

    public function adminPermissionList() 
    {
        return [
            "Branch" => [
                "Branch View" => "branch-view", 
                "Branch Create" => "branch-create", 
                "Branch Update" => "branch-update", 
                "Branch Delete" => "branch-delete", 
                "Branch Approved" => "branch-approved",
            ],
            "User" => [
                "View" => "user-view", 
                "Create" => "user-create", 
                "Update" => "user-update", 
                "Delete" => "user-delete", 
                "Approved" => "user-approved",
            ],

            "Academic Module" => [
                "Session View" => "session-view", 
                "Session Create" => "session-create", 
                "Session Update" => "session-update", 
                "Session Delete" => "session-delete",
                "Session Approved" => "session-approved",
                "Student Unit View" => "student-unit-view", 
                "Student Unit Create" => "student-unit-create", 
                "Student Unit Update" => "student-unit-update", 
                "Student Unit Delete" => "student-unit-delete",
                "Student Unit Approved" => "student-unit-approved",
                "Batch View" => "batch-view",
                "Batch Create" => "batch-create",
                "Batch Update" => "batch-update",
                "Batch Delete" => "batch-delete",
                "Batch Approved" => "batch-approved",
                "Schedule View" => "schedule-view",
                "Schedule Create" => "schedule-create",
                "Schedule Update" => "schedule-update",
                "Schedule Delete" => "schedule-delete",
                "Schedule Approved" => "schedule-approved",
            ],
            "Assets" => [
                "Asset List" => "asset-view", 
                "Asset Create" => "asset-create",
                "Asset Update" => "asset-update",
                "Asset Delete" => "asset-delete",
                "Damage List" => "damage-view",
                "Damage Create" => "damage-create",
                "Damage Update" => "damage-update",
                "Damage Delete" => "damage-delete",
                "Stock List" => "stock-list",
            ],
            "Procurement" => [
                "Sale List" => "sale-view",
                "Sale Create" => "sale-create",
                "Sale Update" => "sale-update",
                "Sale Delete" => "sale-delete",
                "Add Purchase Expense" => "purchase-create",
                "Manage Purchase" => "purchase-view",
                "Purchase Update" => "purchase-update",
                "Purchase Delete" => "purchase-delete",
                "Product List" => "product-view",
                "Product Create" => "product-create",
                "Product Update" => "product-update",
                "Product Delete" => "product-delete",
                "Product Approved" => "product-approved",
                "Purchase Unit List" => "purchase-unit-view",
                "Purchase Unit Create" => "purchase-unit-create",
                "Purchase Unit Update" => "purchase-unit-update",
                "Purchase Unit Delete" => "purchase-unit-delete",
                "Purchase Unit Approved" => "purchase-unit-approved",
                "Purchase Supplier List" => "purchase-supplier-view",
                "Purchase Supplier Create" => "purchase-supplier-create",
                "Purchase Supplier Update" => "purchase-supplier-update",
                "Purchase Supplier Delete" => "purchase-supplier-delete",
                "Purchase Supplier Approved" => "purchase-supplier-approved",
                "Product Stock List" => "product-stock-list",
            ],
            "Account Income" => [
                "Student Fee Generate" => "student-fee-generate",
                "Student Fee Collection" => "student-fee-collection",
                "Invoice List" => "invoice-list",
                "Account Head List" => "account-head-view",
                "Account Head Create" => "account-head-create",
                "Account Head Update" => "account-head-update",
                "Account Head delete" => "account-head-delete",
                "Account Head Approved" => "account-head-approved",
                "Account Head Category" => "account-head-category-view",
                "Account Head Category Create" => "account-head-category-create",
                "Account Head Category Update" => "account-head-category-update",
                "Account Head Category Delete" => "account-head-category-delete",
                "Account Head Category Approved" => "account-head-category-approved",
                "Account Head Type List" => "account-head-type-view",
                "Account Head Type Create" => "account-head-type-create",
                "Account Head Type Update" => "account-head-type-update",
                "Account Head Type Delete" => "account-head-type-delete",
                "Account Head Type Approved" => "account-head-type-approved",
                "Registration Fee List" => "registration-fee-list",
            ],
            "Account Expense" => [
                "Expense List" => "expense-view",
                "Expense Create" => "expense-create",
                "Expense Update" => "expense-update",
                "Expense Delete" => "expense-delete",
                "Expense Approved" => "expense-approved",
                "Expense Type List" => "expense-type-view",
                "Expense Type Create" => "expense-type-create",
                "Expense Type Update" => "expense-type-update",
                "Expense Type Delete" => "expense-type-delete",
                "Expense Type Approved" => "expense-type-approved",
            ],
            "Report Managment" => [
                "Student Ledger" => "student-ledger-report",
                "Procurement All" => "procurement-all-report",
                "Income All" => "income-all-report", 
                "Expense All" => "expense-all-report",
                "Due Student" => "due-student-report",
                "Draft Student" => "draft-student-report",
            ],
            "Teacher" => [
                "Teacher Category List" => "teacher-category-view",
                "Teacher Category Create" => "teacher-category-create",
                "Teacher Category Update" => "teacher-category-update",
                "Teacher Category Delete" => "teacher-category-delete",
                "Teacher Category Approved" => "teacher-category-approved",
                "Teacher List" => "teacher-view",
                "Teacher Create" => "teacher-create",
                "Teacher Update" => "teacher-update",
                "Teacher Delete" => "teacher-delete",
                "Teacher Approved" => "teacher-approved",
            ],
            "Course" => [
                "Course Category List" => "course-category-view",
                "Course Category Create" => "course-category-create",
                "Course Category Update" => "course-category-update",
                "Course Category Delete" => "course-category-delete",
                "Course Category Approved" => "course-category-approved",
                "Course List" => "course-view",
                "Course Create" => "course-create",
                "Course Update" => "course-update",
                "Course Delete" => "course-delete",
                "Course Approved" => "course-approved",
            ],
            "Student" => [
                "Student List" => "student-view",
                "Student Create" => "student-create",
                "Student Update" => "student-update",
                "Student approved" => "student-approved",
                "Student Delete" => "student-delete",
                "Student Pending List" => "student-pending-list",
                "Student ID Card" => "student-id-card",
                "Student Admit Card" => "student-admit-card",
                "Student Registration Card" => "student-registration-card",
                "Student Certificate" => "student-certificate",
                "Student Testimonial" => "student-testimonial",
                "Student Mark Sheed" => "student-mark-sheet",
            ],
            "Attendance Module" => [
                "Student Attendance Entry" => "student-attendance-entry",
                "Student Present and Absent" => "student-present-absent",
                "Student Attendance In-Out" => "student-attendance-in-out",
            ],
            "MCQ Exam" => [
                "Exam View" => "exam-view",
                "Exam Create" => "exam-create",
                "Exam Update" => "exam-update",
                "Exam Approved" => "exam-approved",
                "Exam Delete" => "exam-delete",
                "Question View" => "question-view", 
                "Question Create" => "question-create",
                "Question Update" => "question-update",
                "Question Delete" => "question-delete",
                "Question Approved" => "question-approved",
                "Submitted Assesment View" => "submitted-assesment-view",
                "Submitted Assesment Update" => "submitted-assesment-update",
                "Submitted Assesment Delete" => "submitted-assesment-delete",
            ],
            "Assignment" => [
                "Assignment View" => "assignment-view",
                "Assignment Create" => "assignment-create",
                "Assignment Update" => "assignment-update", 
                "Assignment Delete" => "assignment-delete",
                "Assignment Approved" => "assignment-approved",
                "Student Submitted" => "student-submitted",
            ],
            "Home Work" => [
                "Home Work view" => "home-work-view",
                "Home Work Create" => "home-work-create",
                "Home Work Update" => "home-work-update",
                "Home Work Delete" => "home-work-delete",
                "Home Work Approved" => "home-work-approved",
            ],  
            "Results Module" => [
                "Student Result" => "student-result",
                "Student Result Show" => "student-result-show",
                "Online Exam" => "online-exam",
            ],
            "Requisitions" => [
                "Requisitions Request List" => "requisitions-request-list",
                "Requisitions Complete List" => "requisitions-complete-list",
            ],
            "SMS" => [
                "Student Send SMS Single" => "student-send-sms-single",
                "Student Send SMS" => "student-send-sms",
                "Show SMS" => "show-sms", 
                "Branch SMS All" => "branch-sms-all",
                "Branch SMS Show" => "branch-sms-show",
                "Due Student SMS" => "due-student-sms",
                "Due Student Show" => "due-student-show",
            ],
            "User Manager" => [
                "User List" => "user-view",
                "User Create" => "user-create",
                "User Update" => "user-update",
                "User Set Permission" => "user-set-permission",
                "User Delete" => "user-delete",
                "Manage Bank" => "manage-bank",
            ],
            "System Setting" => [
                "Back Up" => "back-up",
                "Division" => "division", 
                "District" => "district",
                "City" => "city",
                "General Setting" => "general-setting",
                "SMS Setting" => "sms-setting",
            ],
        ];
    }

    public function permission($user)
    {
        $user = User::findOrFail($user);
        $permissions = $this->adminPermissionList();
        return view("admin.users.permission", compact("permissions", "user"));
    }

    public function permissionStore(Request $request, $user) {
        $user = User::findOrFail($user);
        foreach ($user->permissions as $userPermission) {
            $user->revokePermissionTo($userPermission);
        }
        foreach ($request->permission as $value) {
            $permission = Permission::where('name', $value)->first();
            if(!$permission) {
                $permission = Permission::create(['name' => $value]);
            }
            // again set permission 
            $user->givePermissionTo($permission->name);
        }
        return redirect()->route("users.index")->with("message", "User permission updated!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            "username" => ["required", "unique:users,username"],
            "email" => ["required", "unique:users,email"],
            "password" => ["required", "min:8", "confirmed"],
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route("users.index")->with("message", "User create succesfull!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("admin.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => ["required", "string"],
            "username" => ["required", "unique:users,username," . $id ],
            "email" => ["required", "unique:users,email,". $id],
            "password" => ["nullable", "min:8", "confirmed"],
        ]);

        $user = User::findOrFail($id);
        $data = $request->all();
        $data['password'] = $user->password;
        if($request->password) {
            $data['password'] = Hash::make($data['password']);
        }
        
        $user->update($data);
        return redirect()->route("users.index")->with("message", "User update succesfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route("users.index")->with("message", "User deleted succesfull!");
    }
}
