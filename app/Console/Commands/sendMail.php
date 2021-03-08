<?php

namespace App\Console\Commands;

use App\Mail\TestSending;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class sendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mds:mail';

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
     * @return int
     */
    public function handle()
    {
        try {
            echo ('command:mail');
           return Mail::to('caroline@overflo.tech')->send(new TestSending());
        } catch (Exception $e){
            echo($e);
        }
    }
}
