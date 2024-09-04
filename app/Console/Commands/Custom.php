<?php

namespace App\Console\Commands;

use App\Models\Proposal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Jubaer\Zoom\Facades\Zoom;

class Custom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:custom';

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
            $proposal = Proposal::where('user_id', $user->id)->where('prefer', ';group')->get();
            foreach($proposal as $proposals){
                $meeting = Zoom::createMeeting([ 
                    "agenda" => $proposals->title,
                    'topic' => $proposals->title,
                    'duration'   => 60,
                    'start_time' => Carbon::now()->format('Y-m-d') . 'T' . $MeetingTime,
                    "timezone" => 'Asia/Dhaka',
                    // 'start_time' => $MeetingDate . ' ' . $MeetingTime,
                    "password" => 'set your password', // set your password
                    "recurrence" => [
                        "type" => 1,
                        "repeat_interval" => 1,
                        "weekly_days" => implode(',', $recurrenceDays),
                        // "weekly_days" => $recurrenceDays,
                        "end_date_time" => count($MeetingDays),
                    ],
                    "template_id" => 'set your template id',
                    "pre_schedule" => true,
                    "schedule_for" =>$proposal->user->email,
                    "settings" => [
                        'join_before_host' => true, 
                        'host_video' => true,
                        'participant_video' => true,
                        'mute_upon_entry' => false, 
                        'waiting_room' => false,
                        'audio' => 'both', 
                        'auto_recording' => 'none', 
                        'approval_type' => 0, 
                    ],
                ]);
            }
            // foreach ($proposal as $proposals) {
            //     // schedule a zoom meeting based on proposal time and each days
            //     $MeetingTime = $proposals->time;
            //     $MeetingDays = json_decode($proposals->date);
    
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
