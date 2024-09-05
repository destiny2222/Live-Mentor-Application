<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Course;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\MeetingDetailsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Jubaer\Zoom\Facades\Zoom;

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
    $random = Str::random(10);
    $users = User::orderBy('id', 'desc')->get();
    
    foreach ($users as $user) {
        $proposals = Proposal::where('user_id', $user->id)->where('prefer', 'group')->get();
        
        foreach ($proposals as $proposal) {
            if (!$proposal->zoom_meeting_id) {
                // Case 1: Meeting ID does not exist, so create a new meeting
                foreach ($proposal->day as $day) {  // Loop through each day in the day array
                    $startTime = Carbon::now()->next(Carbon::parse($day)->dayOfWeek)
                        ->setTimeFromTimeString($proposal->time)
                        ->setTimezone($proposal->timezone ?? 'UTC')
                        ->format('Y-m-d\TH:i:s\Z');
        
                    $meeting = Zoom::createMeeting([ 
                        'topic' => $proposal->title,
                        'type' => 2,
                        'duration' => 60,
                        'timezone' => 'UTC',
                        'start_time' => $startTime,
                        'password' => $random, 
                        'settings' => [
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
                }
            } else {
                // Case 2: Meeting ID exists, so update the status if necessary
                $meetings = Zoom::getMeeting($proposal->zoom_meeting_id);
        
                if ($meetings['data']['status'] != $proposal->status) {
                    $proposal->zoom_meeting_status = $meetings['data']['status'];
                    $proposal->save();
                }
            }
        }        
    }
    info('Working');
}
    
}