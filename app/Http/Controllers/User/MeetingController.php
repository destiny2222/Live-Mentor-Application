<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\User;
use App\Notifications\MeetingDetailsMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Jubaer\Zoom\Facades\Zoom;
use ZoomHelper;

class MeetingController extends Controller
{
    
    public function joinMeeting($meetingDetails)
    {
        $meetingDetails = Zoom::getMeeting($meetingDetails);
    
        return view('zoom.join', [
            'meetingId' => $meetingDetails['data']['id'],
            'apiKey' => config('services.zoom.api_key'),
            'signature' => ZoomHelper::generateSignature(config('services.zoom.api_key'), config('services.zoom.api_secret'), $meetingDetails, 0),
            'password' => $meetingDetails['data']['password'],
            'userEmail' => Auth::user()->email,
            'userName' => Auth::user()->name
        ]);
    }
    

    public function createMeeting(Request $request){
        $random = Str::random(10);
        $users = User::orderBy('id', 'desc')->get();

        foreach ($users as $user) {
            $bookSessions = BookSession::where('user_id', $user->id)->where('status', 1)->get();

            foreach ($bookSessions as $book) {
                // $sessionDateTime = Carbon::parse($book->book_session_date . ' ' . $book->book_session_time, $book->book_session_time_zone);
                // $currentDateTime = Carbon::now($book->book_session_time_zone);
                $start_time = Carbon::parse($book->book_session_date . ' ' . $book->book_session_time, $book->book_session_time_zone)
                           ->setTimezone('UTC')
                           ->format('Y-m-d\TH:i:s\Z');

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
                // dd($meeting);
                    $meetingDetails = Zoom::getMeeting($meeting['data']['id']);
                    $mentor = User::find($book->mentor_id);
                    // dd($mentor);

                    $user->notify(new MeetingDetailsMail($meetingDetails));
                    $mentor->notify(new MeetingDetailsMail($meetingDetails));
                    return back()->with('success',  'Success');
                } catch (\Exception $e) {
                    Log::error('Error creating meeting: ' . $e->getMessage());
                }
                // if ($currentDateTime->greaterThanOrEqualTo($sessionDateTime)) {
                    
                // }
            }
        }

    }

    public function getMeeting($meetingId)
    {
        $meetings = Zoom::getMeeting($meetingId);

        return $meetings;

    }


    public function creatingMeet(Request $request){
        $bookSession = BookSession::orderBy('id', 'desc')->get();
        $random = Str::random(40);
        foreach($bookSession as $book){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' .self::generateToken(),
                'Content-Type' => 'application/json',
            ])->post("https://api.zoom.us/v2/users/me/meetings", [
                'topic' => $book->book_session,
                'type' => 8, 
                'start_time' => Carbon::parse($book->book_session_date.' '.$book->book_session_time)->toIso8601String(),
                'duration' => $book->minutes,
                "timezone" => $book->book_session_time_zone,
                "pre_schedule" => false, 
                "schedule_for" => $book->user->email,
                "settings" => [
                    'join_before_host' => false,
                    'host_video' => false,
                    'participant_video' => false,
                    'mute_upon_entry' => true,
                    'waiting_room' => false,
                    'audio' => 'both',
                    'auto_recording' => 'none',
                    'approval_type' => 0,
                ],
            ]);
            
            $data = $response->json();
            dd($data);
        }
    }





    function generateToken(): string
    {
        try {
            $base64String = base64_encode(config('services.zoom.ZOOM_CLIENT_ID') . ':' . config('services.zoom.ZOOM_CLIENT_SECRET'));
            $accountId = config('services.zoom.ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type"=> "application/x-www-form-urlencoded",
                "Authorization"=> "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            return $responseToken->json()['access_token'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
