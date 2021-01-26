<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVehicle extends Pivot
{
    protected $table = 'user_vehicle';
    protected $primaryKey = 'id';

    public function vehicle()
    {
        return $this -> belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
}
