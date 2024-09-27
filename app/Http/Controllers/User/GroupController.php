<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupStoreRequest;
use App\Models\GroupSession;
// use App\Models\Invitation;
use App\Traits\FirebaseStorageTrait;
use DateTime;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    use FirebaseStorageTrait;
    
    
    public function index()
    {
        $groups = GroupSession::where('user_id', Auth::user()->id)->get();
        return view('user.group.index', compact('groups'));
    }

    public function create(){
        return view('user.group.create');
    }


    public function edit($id){
        $group = GroupSession::find($id);
        if (!$group) {
            return redirect()->route('cohort.index')->with('error', 'Group session not found.');
        }
        $group->start_time = Carbon::parse($group->start_time);
        $group->end_time = Carbon::parse($group->end_time);
        return view('user.group.edit', compact('group'));
    }

    public function update(GroupStoreRequest $request, $id){
        $group = GroupSession::find($id);
        if (!$group) {
            return redirect()->route('cohort.index')->with('error', 'Group session not found.');
        }
        $group->update($request->all());
        return redirect()->route('cohort.index')->with('success', 'Group session updated successfully.');
    }
    
    public function store(GroupStoreRequest $request)
        {
            try {
                $imageUrl = null;
                
                if ($request->has('image')) {
                    $imageUrl = $this->uploadFileToFirebase($request->file('image'), 'images/cohort/');
                }
    
                $group = new GroupSession();
                $group->title = $request->title;
                $group->description = $request->description;
                $group->end_time = $request->end_time;
                $group->start_time = $request->start_time;
                $group->image = $imageUrl;
                $group->interest_areas = $request->input('interest_areas');
                $group->topic_expertise = $request->topic_expertise;
                $group->status = $request->status;
                $group->user_id = Auth::user()->id;
                $group->invitation_token = Str::slug($request->title);
                $group->save();
    
                // Generate zoom meeting link
                $meetingLink = $this->generateMeetingLink($group);
                
                // Save the meeting link to the group
                $group->zoom_meeting_link = $meetingLink;
                $group->save();
    
                return redirect()->route('cohort.index')
                    ->with('success', 'Group created successfully');
                    // ->with('shareableLink', route('join.group', $group->invitation_token));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
    }
    

    private function generateMeetingLink(GroupSession $group)
    {
        $client = new Client(['base_uri' => 'https://api.zoom.us']);
        

        try {
           $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " . $this->getZoomAccessToken(),
                    "Content-Type" => "application/json"
                ],
                'json' => [
                    "topic" => $group->title,
                    "type" => 2, // Scheduled meeting
                    "start_time" => $group->start_time,
                    "duration" => $this->calculateDurationInMinutes($group->start_time, $group->end_time),
                    "timezone" => "UTC",
                    "settings" => [
                        "host_video" => true,
                        "participant_video" => true,
                        "join_before_host" => true,
                        "mute_upon_entry" => true,
                        "watermark" => false,
                        "use_pmi" => false,
                        "approval_type" => 0,
                        "audio" => "both",
                        "auto_recording" => "none"
                    ]
                ],
            ]);

            $data = json_decode($response->getBody());
            return $data->join_url;
        } catch (\Exception $e) {
            Log::error('Zoom API Error: ' . $e->getMessage());
            throw new \Exception('Failed to create Zoom meeting: ' . $e->getMessage());
        }
    }

    private function getZoomAccessToken()
    {
        $clientId = config('services.zoom.ZOOM_CLIENT_ID');
        $clientSecret = config('services.zoom.ZOOM_CLIENT_SECRET');
        $accountId = config('services.zoom.ZOOM_ACCOUNT_ID');
        
        // Make a POST request to get the access token
        $client = new \GuzzleHttp\Client();
        
        try {
            $response = $client->request('POST', 'https://zoom.us/oauth/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode("$clientId:$clientSecret"),
                ],
                'form_params' => [
                    'grant_type' => 'account_credentials',
                    'account_id' => $accountId,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $data['access_token']; // Use this token for Zoom API requests
        } catch (\Exception $e) {
            Log::error('Error obtaining Zoom OAuth token: ' . $e->getMessage());
            throw new \Exception('Failed to retrieve Zoom access token');
        }
    }
    

    private function calculateDurationInMinutes($start_time, $end_time)
    {
        $start = new \DateTime($start_time);
        $end = new \DateTime($end_time);
        $diff = $end->diff($start);
        return ($diff->h * 60) + $diff->i;
    }

}
