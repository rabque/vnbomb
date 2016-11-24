<?php

namespace App\Console\Commands;

use App\Events\LiveMatch;
use App\Models\Match;
use Illuminate\Console\Command;

class SendMatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match:live';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $match = Match::liveGame(1);
        broadcast(new LiveMatch($match));
    }
}
