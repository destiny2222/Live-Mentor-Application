<?php

namespace App\Console\Commands;

use App\Models\Proposal;
use App\Models\User;
use App\Notifications\MeetingDetailsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Jubaer\Zoom\Facades\Zoom;

class CustomTask extends Command
{
    protected $signature = 'app:custom';
    protected $description = 'Command to schedule Zoom meetings for proposals';

    public function handle()
    {
        $this->info('Starting Zoom meeting scheduler...');
        
        try {
            $users = User::orderBy('id', 'desc')->get();
            $this->info('Found ' . $users->count() . ' users');
        
            foreach($users as $user){
                $this->info("Processing user: {$user->id}");
                
                $proposals = Proposal::where('user_id', $user->id)->where('status', '4')->get();
                $this->info("Found " . $proposals->count() . " proposals for user {$user->id}");

                foreach ($proposals as $proposal) {
                    $this->info("Processing proposal: {$proposal->id}");
                    
                    $meetingTime = $proposal->time;
                    $meetingDays = $proposal->day;
                    $currentDay = Carbon::now()->dayOfWeekIso;
                    $currentDateTime = Carbon::now();

                    $this->info("Current day: {$currentDay}, Meeting days: " . json_encode($meetingDays));

                    if (in_array($currentDay, $meetingDays)) {
                        $scheduledDateTime = Carbon::parse($currentDateTime->format('Y-m-d') . ' ' . $meetingTime);
                        $this->info("Scheduled date time: {$scheduledDateTime}");

                        if ($scheduledDateTime->isFuture()) {
                            $this->info("Attempting to create Zoom meeting...");
                            
                            try {
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
                                        "weekly_days" => $currentDay,
                                        "end_times" => 1,
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
                                
                                $this->info("Zoom meeting created successfully. Meeting ID: " . $meeting['data']['id']);

                                $meetingDetails = Zoom::getMeeting($meeting['data']['id']);
                        
                                if ($meetingDetails['data']['status'] == 'waiting') {
                                    $proposal->zoom_meeting_id = $meetingDetails['data']['id'];
                                    $proposal->zoom_meeting_password = $meetingDetails['data']['password'];
                                    $proposal->zoom_meeting_url = $meetingDetails['data']['join_url'];
                                    $proposal->zoom_meeting_status = $meetingDetails['data']['status'];
                                    $proposal->zoom_meeting_start_time = Carbon::parse($meetingDetails['data']['start_time'])->format('Y-m-d H:i:s');
                                    $proposal->save();

                                    $this->info("Meeting details saved to proposal");

                                    $tutor = User::find($proposal->tutor_id);
                                    $user->notify(new MeetingDetailsMail($meetingDetails));
                                    $tutor->notify(new MeetingDetailsMail($meetingDetails));

                                    $this->info("Notifications sent to user and tutor");
                                } else {
                                    $this->error("Meeting status is not 'waiting'. Status: " . $meetingDetails['data']['status']);
                                }
                            } catch (\Exception $e) {
                                $this->error("Error creating Zoom meeting: " . $e->getMessage());
                                Log::error("Error creating Zoom meeting for proposal {$proposal->id}: " . $e->getMessage());
                            }
                        } else {
                            $this->info("Meeting time has passed for proposal {$proposal->id}. Current time: {$currentDateTime}, Scheduled time: {$scheduledDateTime}");
                        }
                    } else {
                        $this->info("No meeting scheduled today for proposal {$proposal->id}");
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            Log::error("Error in Zoom meeting scheduler: " . $e->getMessage());
        }

        $this->info('Zoom meeting scheduler completed.');
    }
}