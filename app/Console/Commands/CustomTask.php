<?php

namespace App\Console\Commands;

use App\Models\Proposal;
use App\Models\User;
use App\Notifications\MeetingDetailsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
                
                $proposals = Proposal::where('user_id', $user->id)->get();
                $this->info("Found " . $proposals->count() . " total proposals for user {$user->id}");
                
                $proposalsStatus4 = $proposals->where('status', '4');
                $this->info("Found " . $proposalsStatus4->count() . " proposals with status '4' for user {$user->id}");

                foreach ($proposalsStatus4 as $proposal) {
                    $this->info("Processing proposal: {$proposal->id}");
                    
                    $meetingTime = $proposal->time;
                    $meetingDays = is_array($proposal->day) ? $proposal->day : json_decode($proposal->day, true);
                    $currentDateTime = Carbon::now();

                    $this->info("Current date/time: {$currentDateTime}, Meeting days: " . json_encode($meetingDays));

                    // Find the next occurrence of the meeting
                    $nextMeetingDateTime = $this->findNextMeetingDateTime($currentDateTime, $meetingDays, $meetingTime);

                    if ($nextMeetingDateTime) {
                        $this->info("Next scheduled date/time: {$nextMeetingDateTime}");

                        try {
                            $meeting = Zoom::createMeeting([ 
                                "agenda" => $proposal->title,
                                'topic' => $proposal->title,
                                'duration'   => 60,
                                'start_time' => $nextMeetingDateTime->format('Y-m-d\TH:i:s'),
                                "timezone" => config('app.timezone'),
                                "password" => Str::random(8),
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
                            // dd($meeting);
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
                        $this->info("No valid meeting time found for proposal {$proposal->id}");
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            Log::error("Error in Zoom meeting scheduler: " . $e->getMessage());
        }

        $this->info('Zoom meeting scheduler completed.');
    }

    private function findNextMeetingDateTime(Carbon $currentDateTime, array $meetingDays, string $meetingTime)
    {
        $meetingDays = array_map('strtolower', $meetingDays);
        $nextMeeting = null;

        for ($i = 0; $i < 7; $i++) {
            $checkDate = $currentDateTime->copy()->addDays($i);
            $checkDay = strtolower($checkDate->format('l'));

            if (in_array($checkDay, $meetingDays)) {
                $meetingDateTime = Carbon::parse($checkDate->format('Y-m-d') . ' ' . $meetingTime);
                
                if ($meetingDateTime->gt($currentDateTime)) {
                    $nextMeeting = $meetingDateTime;
                    break;
                }
            }
        }

        return $nextMeeting;
    }
}