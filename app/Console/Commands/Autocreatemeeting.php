<?php

namespace App\Console\Commands;

use App\Models\BookSession;
use App\Models\User;
use App\Notifications\MeetingDetailsMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Jubaer\Zoom\Facades\Zoom;

class Autocreatemeeting extends Command
{
    protected $signature = 'custom:meeting';
    protected $description = 'Command description';

    public function handle()
    {
        $random = Str::random(10);
        $users = User::orderBy('id', 'desc')->get();
    
        foreach ($users as $user) {
            $bookSessions = BookSession::where('user_id', $user->id)->where('status', 1)->get();
    
            foreach ($bookSessions as $book) {
                // Check if the meeting ID already exists
                if (!$book->zoom_meeting_id) {
                    // Case 1: Meeting ID does not exist, create a new meeting
                    $sessionDateTime = Carbon::parse($book->book_session_date . ' ' . $book->book_session_time, $book->book_session_time_zone)
                        ->setTimezone('UTC')
                        ->format('Y-m-d\TH:i:s\Z');
    
                    // Debugging: Log the sessionDateTime before creating the meeting
                    Log::info('Session DateTime (before Zoom): ' . $sessionDateTime);
    
                    try {
                        $meeting = Zoom::createMeeting([
                            "topic" => $book->book_session,
                            "type" => 2, 
                            "duration" => $book->minutes,
                            "timezone" => 'UTC', // Ensure the timezone is set to UTC
                            "password" => $random,
                            "start_time" => $sessionDateTime,
                            "settings" => [
                                'join_before_host' => true,
                                'host_video' => false,
                                'participant_video' => false,
                                'mute_upon_entry' => true,
                                'waiting_room' => false,
                                'audio' => 'both',
                                'auto_recording' => 'none',
                                'approval_type' => 0,
                            ],
                        ]);
    
                        $meetingDetails = Zoom::getMeeting($meeting['data']['id']);
    
                        if ($meetingDetails['data']['status'] === 'waiting') {
                            Log::info('Meeting is waiting to start.');
                        }
    
                        // Save the meeting details to the database
                        $book->update([
                            'zoom_meeting_id' => $meetingDetails['data']['id'],
                            'zoom_meeting_password' => $random,
                            'zoom_meeting_start_time' => Carbon::parse($meetingDetails['data']['start_time'])->format('Y-m-d H:i:s'),
                            'zoom_meeting_url' => $meetingDetails['data']['join_url'],
                        ]);
    
                        // Notify user and mentor
                        $mentor = User::find($book->mentor_id);
                        $user->notify(new MeetingDetailsMail($meetingDetails));
                        $mentor->notify(new MeetingDetailsMail($meetingDetails));
    
                    } catch (\Exception $e) {
                        Log::error('Error creating meeting: ' . $e->getMessage());
                    }
                } else {
                    // Case 2: Meeting ID exists, update the status if necessary
                    try {
                        $meetingDetails = Zoom::getMeeting($book->zoom_meeting_id);
    
                        if ($meetingDetails['data']['status'] === 'waiting') {
                            Log::info('Meeting is waiting to start.');
                        } elseif ($meetingDetails['data']['status'] === 'started') {
                            Log::info('Meeting is in progress.');
                        } elseif ($meetingDetails['data']['status'] === 'ended') {
                            Log::info('Meeting has ended.');
    
                            // Fetch past meeting details if necessary
                            $pastMeetingDetails = Zoom::getPreviousMeetings($book->zoom_meeting_id);
                            Log::info('Past Meeting Details: ' . json_encode($pastMeetingDetails));
    
                            // Update the meeting details with past meeting info
                            $book->update([
                                'zoom_meeting_start_time' => Carbon::parse($pastMeetingDetails['data']['start_time'])->format('Y-m-d H:i:s'),
                                'zoom_meeting_url' => $pastMeetingDetails['data']['join_url'],
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('Error updating meeting: ' . $e->getMessage());
                    }
                }
            }
        }
    }
    
}
