<?php

namespace Tests\Unit;

use App\Models\Error;
use Tests\TestCase;

class ErrorTest extends TestCase
{
    /* @test*/
    public function demo()
    {

        $errorMake = Error::factory()->make(); // retourne une instance
        $errorCreate = Error::factory()->create(); // retourne une instance et l'ajoute dans la bdd
    }
}
