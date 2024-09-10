<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BookSession extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:book-session';

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
        $booksession = BookSession::where('status',  )->get();
        
    }
}
