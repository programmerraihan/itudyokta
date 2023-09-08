<?php

namespace App\Console;

use App\Models\StudentFee;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $next_due_date = Carbon::now()->addDays(2);
            $dueStudentList = StudentFee::with(['student', 'student.Branch'])->where('due' , ">", 0)->whereDate('next_due_date', $next_due_date)->get();
            foreach($dueStudentList as $student_list) {
                $message = optional(optional($student_list->student)->Branch)->name . " কম্পিউটার কোর্স ফি বাবদ  (".($student_list->due ?? 0).") বাকি আছে পরিশোধের শেষ তারিখ ".date('d/m/y', strtotime($student_list->next_due_date))." অনুগ্রহ করে আপনার বাকি টাকা পরিশোধ করুন ।";
                $phone = $student_list->student->mobile;
                $branch = $student_list->student->branch_id;
                if($phone) {
                    send_sms($phone, $message, ($branch ?? null));
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
