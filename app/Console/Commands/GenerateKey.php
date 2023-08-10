<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Broadcasting\GenerateKeyChannel;

class GenerateKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        broadcast(new GenerateKeyChannel("user is followed"))->toOthers();
        $this->info('Generate Key Successfully');
    }
}
