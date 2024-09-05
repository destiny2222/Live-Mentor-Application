<?php

namespace App\Console\Commands;

use App\Models\Proposal;
use App\Models\User;
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
        // Retrieve all users
        $users = User::orderBy('id', 'desc')->get();

        foreach ($users as $user) {
            // Get all approved proposals for each user
            $proposals = Proposal::where('user_id', $user->id)->where('status', '1')->get();

            foreach ($proposals as $proposal) {
                // Get the meeting time and days from the proposal
                $meetingTime = $proposal->time;
                $meetingDays = $proposal->day;

                // Convert meeting days to Zoom's weekday format (1 = Monday, 7 = Sunday)
                $recurrenceDays = [];
                foreach ($meetingDays as $day) {
                    $recurrenceDays[] = Carbon::parse("next $day")->format('N'); // 1=Monday, 7=Sunday
                }

                // Schedule a Zoom meeting based on proposal time and recurring days
                try {
                    $meeting = Zoom::createMeeting([
                        "agenda" => $proposal->title,
                        'topic' => $proposal->title,
                        'duration' => 60,
                        'start_time' => Carbon::now()->format('Y-m-d') . 'T' . $meetingTime,
                        "timezone" => 'Asia/Dhaka', // Adjust to the correct timezone
                        "password" => 'your-password', // Set your password
                        "recurrence" => [
                            "type" => 1, // 1: Daily, 2: Weekly
                            "repeat_interval" => 1, // Repeat every week
                            "weekly_days" => implode(',', $recurrenceDays), // Recurrence days
                            "end_date_time" => Carbon::now()->addWeeks(count($meetingDays))->format('Y-m-d\TH:i:s\Z'), // End date for recurring meetings
                        ],
                        "pre_schedule" => true,
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

                    info('Meeting scheduled successfully for Proposal ID: ' . $proposal->id);
                } catch (\Exception $e) {
                    Log::error('Error scheduling meeting for Proposal ID: ' . $proposal->id . ' - ' . $e->getMessage());
                }
            }
        }

        info('Custom Zoom meeting scheduling completed.');
    }
}
