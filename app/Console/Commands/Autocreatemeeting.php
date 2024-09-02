<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BookSession;
use Illuminate\Support\Str;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Notifications\MeetingDetailsMail;

class Autocreatemeeting extends Command
{
    protected $signature = 'custom:meeting';
    protected $description = 'Command description';

    public function handle()
    {
        $random = Str::random(40);
        $users = User::orderBy('id', 'desc')->get();

        foreach ($users as $user) {
            $bookSessions = BookSession::where('user_id', $user->id)->where('status', 1)->get();

            foreach ($bookSessions as $book) {
                $sessionDateTime = Carbon::parse($book->book_session_date . ' ' . $book->book_session_time, $book->book_session_time_zone);
                $currentDateTime = Carbon::now($book->book_session_time_zone);
                $start_time = $sessionDateTime->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');

                try {
                    $meeting = Zoom::createMeeting([
                        "agenda" => $book->book_session,
                        "topic" => $book->book_session,
                        "type" => 2, // Scheduled meeting
                        "duration" => $book->minutes,
                        "timezone" => $book->book_session_time_zone,
                        "password" => $random,
                        "start_time" => $start_time,
                        "pre_schedule" => false,
                        "schedule_for" => $book->user->email,
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
                    $mentor = User::find($book->mentor_id);

                    $user->notify(new MeetingDetailsMail($meetingDetails));
                    $mentor->notify(new MeetingDetailsMail($meetingDetails));
                } catch (\Exception $e) {
                    $this->error('Error creating meeting: ' . $e->getMessage());
                }
                // if ($currentDateTime->greaterThanOrEqualTo($sessionDateTime)) {
                    
                // }
            }
        }

        info('Auto create meeting command executed successfully.');
    }
}
