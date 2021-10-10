<?php

namespace Database\Factories;

use App\Models\ImageAccessInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageAccessInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImageAccessInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url(),
            'index' => intval(0),
        ];
    }
}
