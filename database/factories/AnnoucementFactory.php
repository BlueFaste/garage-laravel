<?php

namespace Database\Factories;

use App\Models\Annoucement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnoucementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Annoucement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text($this->faker->numberBetween(5, 15)),
            'content'=> $this->faker->text($this->faker->numberBetween(10, 100)),
            'price'=> $this->faker->randomFloat(2,150,2000),
            'enabled' => true,
        ];
    }
}
