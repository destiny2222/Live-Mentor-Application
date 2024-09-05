<?php

namespace App\Console\Commands;

use App\Models\Proposal;
use App\Models\User;
use App\Notifications\MeetingDetailsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
    protected $description = 'Command to schedule Zoom meetings for proposals';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $users = User::orderBy('id', 'desc')->get();
    
    foreach($users as $user){
        $proposals = Proposal::where('user_id', $user->id)->where('status', '1')->get();

        foreach ($proposals as $proposal) {
            // Get the meeting time and days from the proposal
            $meetingTime = $proposal->time;
            $meetingDays = $proposal->day; // Assuming day is stored as an array

            // Get the current day (1 = Monday, 7 = Sunday)
            $currentDay = Carbon::now()->dayOfWeekIso;

            // Check if the current day matches any of the meeting days
            if (in_array($currentDay, $meetingDays)) {
                // Convert meeting days to Zoom's weekday format (1 = Monday, 7 = Sunday)
                $recurrenceDays = [];
                foreach ($meetingDays as $day) {
                    $recurrenceDays[] = Carbon::parse("next $day")->format('N'); // 1=Monday, 7=Sunday
                }

                // Schedule the Zoom meeting here
                $meeting = Zoom::create([ 
                    "agenda" => $proposal->title,
                    'topic' => $proposal->title,
                    'duration'   => 60,
                    'start_time' => Carbon::now()->format('Y-m-d') . 'T' . $meetingTime,
                    "timezone" => 'Asia/Dhaka',
                    "password" => 'your_password',
                    "recurrence" => [
                        "type" => 1,
                        "repeat_interval" => 1,
                        "weekly_days" => implode(',', $recurrenceDays),
                        "end_date_time" => count($meetingDays),
                    ],
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

                $meetingDetails = Zoom::getMeeting($meeting['data']['id']);
        
                    if ($meetingDetails['data']['status'] == 'waiting') {
                        // Save meeting details to the proposal
                        $proposal->zoom_meeting_id = $meetingDetails['data']['id'];
                        $proposal->zoom_meeting_password = $meetingDetails['data']['password'];
                        $proposal->zoom_meeting_url = $meetingDetails['data']['join_url'];
                        $proposal->zoom_meeting_status = $meetingDetails['data']['status'];
                        $proposal->zoom_meeting_start_time = Carbon::parse($meetingDetails['data']['start_time'])->format('Y-m-d H:i:s');
                        $proposal->save();
                    }

                    // Notify user and mentor
                    $tutor = User::find($proposal->tutor_id);
                    $user->notify(new MeetingDetailsMail($meetingDetails));
                    $tutor->notify(new MeetingDetailsMail($meetingDetails));
            } else {
                info('No meeting scheduled today for proposal ' . $proposal->id);
            }
        }
    }
}

}