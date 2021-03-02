<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class PrintHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mds:hello {name} {id?} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Affiche hello en ASCII';

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
//        dd($this->arguments('id'));
//        dd($this->arguments());
        dd($this->options());
//       $this->line('Hello les gens');
//       $this->alert('Hello');
//       if ($this->confirm('Ca va ?')){
//           dd('yes');
//       };

//       $name = $this->choice('nom',['test','demo'], 1);
//       dd($name);
//
//        $this->table(
//        ['Id', 'name'],
//            Vehicle::all(['id','name'])->toArray()
//        );


    }
}
