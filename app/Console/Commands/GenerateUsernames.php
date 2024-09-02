<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class GenerateUsernames extends Command
{
    protected $signature = 'generate:usernames';
    protected $description = 'Generate unique usernames for users without a username';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::whereNull('username')->get();

        foreach ($users as $user) {
            $username = $this->generateUniqueUsername($user->name);
            $user->username = $username;
            $user->save();
            $this->info("Generated username for user {$user->id}: {$username}");
        }

        $this->info('Usernames generated successfully.');
    }

    private function generateUniqueUsername($name)
    {
        $username = Str::slug($name);
        $originalUsername = $username;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . '-' . $counter;
            $counter++;
        }

        return $username;
    }
}
