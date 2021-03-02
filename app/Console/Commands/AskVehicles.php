<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class AskVehicles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mds:vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demande si l\'utilsateur veut voir la liste des vehicules';

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
        if ($this->confirm('Voulez-vous voir la liste des véhicules ?')){
            $this->table(
                ['Nom des véhicules'],
            Vehicle::all(['name'])->toArray()
        );
       };
    }
}
