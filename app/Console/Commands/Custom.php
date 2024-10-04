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
    protected $signature = 'app:custom';
    protected $description = 'Command to schedule Zoom meetings for proposals';

    public function handle()
    {
        $users = User::orderBy('id', 'desc')->get();
        
        foreach($users as $user){
            $proposals = Proposal::where('user_id', $user->id)->where('status', '4')->get();

            foreach ($proposals as $proposal) {
                $meetingTime = $proposal->time;
                $meetingDays = $proposal->day;
                $currentDay = Carbon::now()->dayOfWeekIso;
                $currentDateTime = Carbon::now();

                if (in_array($currentDay, $meetingDays)) {
                    $scheduledDateTime = Carbon::parse($currentDateTime->format('Y-m-d') . ' ' . $meetingTime);

                    // Check if the meeting time is in the future
                    if ($scheduledDateTime->isFuture()) {
                        $recurrenceDays = [];
                        foreach ($meetingDays as $day) {
                            $recurrenceDays[] = Carbon::parse("next $day")->format('N');
                        }

                        $meeting = Zoom::create([ 
                            "agenda" => $proposal->title,
                            'topic' => $proposal->title,
                            'duration'   => 60,
                            'start_time' => $scheduledDateTime->format('Y-m-d\TH:i:s'),
                            "timezone" => 'Asia/Dhaka',
                            "password" => 'your_password',
                            "recurrence" => [
                                "type" => 1,
                                "repeat_interval" => 1,
                                "weekly_days" => implode(',', $recurrenceDays),
                                "end_times" => 1, // Set to occur only once
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
                            $proposal->zoom_meeting_id = $meetingDetails['data']['id'];
                            $proposal->zoom_meeting_password = $meetingDetails['data']['password'];
                            $proposal->zoom_meeting_url = $meetingDetails['data']['join_url'];
                            $proposal->zoom_meeting_status = $meetingDetails['data']['status'];
                            $proposal->zoom_meeting_start_time = Carbon::parse($meetingDetails['data']['start_time'])->format('Y-m-d H:i:s');
                            $proposal->save();

                            $tutor = User::find($proposal->tutor_id);
                            $user->notify(new MeetingDetailsMail($meetingDetails));
                            $tutor->notify(new MeetingDetailsMail($meetingDetails));

                            $this->info("Meeting scheduled for proposal {$proposal->id} at {$scheduledDateTime}");
                        }
                    } else {
                        $this->info("Meeting time has passed for proposal {$proposal->id}. Current time: {$currentDateTime}, Scheduled time: {$scheduledDateTime}");
                    }
                } else {
                    $this->info('No meeting scheduled today for proposal ' . $proposal->id);
                }
            }
        }
    }
}