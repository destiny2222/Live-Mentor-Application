<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;
use App\Models\User;
use App\Models\BookSession;
use Illuminate\Support\Str;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Notifications\MeetingDetailsMail;

  

Schedule::command('custom:meeting')->everyMinute();
Schedule::command('custom:custom-task')->everyMinute();
Schedule::command('app:custom')->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

