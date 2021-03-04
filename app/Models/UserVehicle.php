<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVehicle extends Pivot
{
    public $incrementing = true;
    public $timestamps = false;

    protected $dates = [
        'started_at',
        'ended_at',
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
