<?php

namespace Database\Factories;

//use App\Models\Model;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array= ['loué', 'accidenté', 'disponible'];
        return [
           'name' => $this->faker->company,
            'price' => $this->faker-> numberBetween(1000, 15000),
            'status' => array_rand($array, 1),
            'odometer' => $this->faker->numberBetween(100, 150000),
            'type' => $this->faker->word,
        ];
    }
}
