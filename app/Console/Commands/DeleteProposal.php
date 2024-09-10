<?php

namespace App\Console\Commands;

use App\Models\Proposal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteProposal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-proposal';

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
        $proposals = Proposal::orderBy('id', 'desc')->where('status' ,  2)->get();
        foreach($proposals as $proposal){
            $proposal->delete();
        }
        info("Deleted Proposal");
    }
}
