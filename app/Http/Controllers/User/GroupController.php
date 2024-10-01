<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\InviteRequest;
use App\Models\GroupSession;
use App\Models\Invitation;
use App\Notifications\GroupInvitation;
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
        $groups = GroupSession::where('user_id', Auth::user()->id)->paginate(9);
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
    
            // If the session is not paid, ensure price is null
            if (!$request['is_paid']) {
                $request['price'] = null;
            }
    
            // Create a temporary GroupSession object
            $tempGroup = new GroupSession([
                'title' => $request->title,
                'description' => $request->description,
                'end_time' => $request->end_time,
                'start_time' => $request->start_time,
                'price' => $request->price,
                'is_paid' => $request->is_paid,
                'image' => $imageUrl,
                'interest_areas' => $request->input('interest_areas'),
                'topic_expertise' => $request->topic_expertise,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
                'invitation_token' => Str::slug($request->title),
            ]);
    
            // Generate zoom meeting link
            $meetingLink = $this->generateMeetingLink($tempGroup);
            
            // Now create and save the actual GroupSession with the Zoom link
            $group = new GroupSession($tempGroup->toArray());
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


public function inviteStore(InviteRequest $request){
    try{


        // check if the user as already registered for the event
        $isUserRegistered = Invitation::where('user_id', Auth::user()->id)
                                    ->where('group_session_id', $request->group_session_id)
                                    ->exists();

        if($isUserRegistered){
            return redirect()->back()->with('error', 'You have already registered for this RSVP.');
        }

        $invite = Invitation::updateOrCreate([
            'user_id' => Auth::user()->id,
            'group_session_id'=> $request->group_session_id,
            'email'=>$request->email,
            'invitation_code'=>$request->zoom_meeting_link,
            'is_invited'=>true,
            'invitation_count'=> $request->invitation_count,
        ]);
        // send message to user who has registered for the group
        $invite->user->notify(new GroupInvitation($invite));
        return redirect()->back()->with('success', 'You have successfully join RSVP.');
    }catch(\Exception $e){
        Log::error('Error sending invitation: '. $e->getMessage());
         return redirect()->back()->with('error', 'Failed to send RSVP. Please try again later.');
    }
}

public function cancelInvite($id){
    try{
        $invite = Invitation::where('user_id', Auth::user()->id)
                            ->where('id', $id)
                            ->where('is_invited', true)
                            ->first();
                            
        if($invite){ 
            $invite->delete();
            return redirect()->back()->with('success', 'RSVP has been cancelled.');
        }
        return redirect()->back()->with('error', 'RSVP not found.');
    }catch(\Exception $e){
        Log::error('Error cancelling invitation: '. $e->getMessage());
    }
}

}
