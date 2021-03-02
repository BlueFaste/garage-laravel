<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class seeVehicleInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mds:infoVehicle {id} {--full}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Affiche les détailles d\'un vehicule';

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
        $id = $this->argument('id');
        $vehicule = Vehicle::find($id);

        if(!$vehicule){
            $this->alert("Le véhicule n'existe pas");
        } else{
            if ($this->option('full') ) {
                $this->table(
                    array_keys($vehicule->toArray()),
                    [$vehicule->toArray()]
                );
            } else {
                $this->table(
                    ['Id', 'name'],
                    [
                        [$vehicule->id, $vehicule->name]
                    ]
                );
            }

        }



    }
}
