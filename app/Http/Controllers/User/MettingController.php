<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;

class MettingController extends Controller
{
    public function createMeeting(Request $request){
        $meeting = Zoom::createMeeting([
            "agenda" => 'Mentor',
            "topic" => 'web development',
            "type" => 2, 
            "duration" => 60, 
            "timezone" => 'Asia/Dhaka', 
            "password" => '123456',
            "start_time" => '2022-08-25T10:00:00', 
            "template_id" => 'Dv4YdINdTk+Z5RToadh5ug==', 
            "pre_schedule" => false,  
            // "schedule_for" => 'text@gmail.com', 
            "settings" => [
                'join_before_host' => false, 
                'host_video' => false, 
                'participant_video' => false, 
                'mute_upon_entry' => false, 
                'waiting_room' => false, 
                'audio' => 'both', 
                'auto_recording' => 'none', 
                'approval_type' => 0, 
            ],

        ]);
       // Access meeting details
        // $meetingId = Zoom::getMeeting($meeting);
        // $joinUrl = $meeting['join_url'];
        dd($meeting);
    }

    public function getMeeting($meetingId)
    {
        $meetings = Zoom::getMeeting($meetingId);

        return $meetings;

    }
}
