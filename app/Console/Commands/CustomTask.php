<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Course;
use App\Models\Proposal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Zoom;

class CustomTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:custom-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Perform your custom task here
        $random = Str::random(10);
        $users = User::orderBy('id', 'desc')->get();
        
        foreach($users as $user){
            $proposals = Proposal::where('user_id', $user->id)->where('prefer', 'group')->get();
            foreach($proposals as $proposal){
                foreach ($proposal->day as $day) {  // Loop through each day in the day array
                    // Calculate the next occurrence of the specified day
                    $startTime = Carbon::now()->next(Carbon::parse($day)->dayOfWeek)
                        ->setTimeFromTimeString($proposal->time)
                        ->setTimezone($proposal->timezone ?? 'UTC')
                        ->format('Y-m-d\TH:i:s\Z');
                    
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' .self::generateToken(),
                        'Content-Type' => 'application/json',
                    ])->post("https://api.zoom.us/v2/users/me/meetings", [
                        'topic' => $proposal->title,
                        'type'=> 2,
                        'duration'   => 60,
                        "timezone" => 'UTC',
                        'start_time' => $startTime,
                        "password" => $random, 
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
                    
                    $data = $response->json();
                    dd($data);

                    // Save or process the response as needed
                }
            }
        }
        info('Working');
    }
    /**
     * Generate a Zoom API access token.
     *
     * @return string
     */
    function generateToken(): string
    {
        try {
            $base64String = base64_encode(config('services.zoom.ZOOM_CLIENT_ID') . ':' . config('services.zoom.ZOOM_CLIENT_SECRET'));
            $accountId = config('services.zoom.ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type" => "application/x-www-form-urlencoded",
                "Authorization" => "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            return $responseToken->json()['access_token'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}