<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Proposal;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CustomTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:custom-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Perform your custom task here
        $users = User::orderBy('id', 'desc')->get();
        foreach($users as $user){
            $proposal = Proposal::where('user_id', $user->id)->where('status', '4')->get();
            // foreach ($proposal as $proposals) {
            //     // schedule a zoom meeting based on proposal time and each days
            //     $MeetingTime = $proposals->time;
            //     $MeetingDays = json_decode($proposals->date);
    
            //     // tutor email 
            //     $course = Course::find($proposal->course_id);
            //     if (!$course) {
            //         return back()->with('error', 'No course found for the given proposal.');
            //     }
    
            //     $category = Category::find($course->category_id);
            //     if (!$category) {
            //         return back()->with('error', 'No category found for the given course.');
            //     }
    
                // $tutors = $category->tutors;
                // if ($tutors->isEmpty()) {
                //     return back()->with('error', 'No tutor found for the given proposal.');
                // }
                
                // $UserTutor = User::where('id', $tutors->id)->first();
                // info('Working'.  $category);
    
    
                // Convert meeting days to Zoom's weekday format
                // $recurrenceDays = [];
                // foreach ($MeetingDays as $day) {
                //     $recurrenceDays[] = Carbon::parse("next $day")->format('N'); // 1=Monday, 7=Sunday
                // }
    
    
                // You can use Zoom API or any other package to schedule a meeting
                // $meeting = Zoom::create([ 
                //     "agenda" => $proposals->title,
                //     'topic' => $proposals->title,
                //     'duration'   => 60,
                //     'start_time' => Carbon::now()->format('Y-m-d') . 'T' . $MeetingTime,
                //     "timezone" => 'Asia/Dhaka',
                //     // 'start_time' => $MeetingDate . ' ' . $MeetingTime,
                //     "password" => 'set your password', // set your password
                //     "recurrence" => [
                //         "type" => 1,
                //         "repeat_interval" => 1,
                //         "weekly_days" => implode(',', $recurrenceDays),
                //         // "weekly_days" => $recurrenceDays,
                //         "end_date_time" => count($MeetingDays),
                //     ],
                //     "template_id" => 'set your template id',
                //     "pre_schedule" => true,
                //     "schedule_for" =>$proposal->user->email,
                //     "settings" => [
                //         'join_before_host' => true, 
                //         'host_video' => true,
                //         'participant_video' => true,
                //         'mute_upon_entry' => false, 
                //         'waiting_room' => false,
                //         'audio' => 'both', 
                //         'auto_recording' => 'none', 
                //         'approval_type' => 0, 
                //     ],
                // ]);
            // }
        }
        info('Working'.  $proposal);
    }
}
