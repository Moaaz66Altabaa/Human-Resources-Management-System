<?php

namespace App\Console\Commands;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\User;
use App\Models\Attendence;
use App\Models\Company;
use Illuminate\Console\Command;
use Carbon\Carbon;


class CreateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = User::all();
        $st = Carbon::parse(Company::first()->start_time);
        $ft = Carbon::parse(Company::first()->finish_time);

        if (now()->day != 'Friday'){
            if(Holiday::whereDate('from' , '<=' , now())
                ->whereDate('to' , '>=' , now())->get()->isEmpty()) {

                foreach ($employees as $employee) {
                    $a = new Attendence();
                    $a->user_id = $employee->id;

                    $current_leave = $employee->leaves()->where('leave_user.status', 'approved')
                        ->whereDate('leave_user.from', '<=', now())
                        ->whereDate('leave_user.to', '>=', now())
                        ->first();

                    if ($current_leave) {
                        $a->status = 'on_vacation';
                        if ($current_leave->is_paid) {
                            $employee->hours_per_month = $employee->hours_per_month + $st->diff($ft)->h;
                            $employee->save();
                        }
                    }

                    $a->save();
                }
            }else{
                foreach ($employees as $employee) {
                    $employee->hours_per_month = $employee->hours_per_month + $st->diff($ft)->h;
                    $employee->save();
                }
                }
    }
    }
}
