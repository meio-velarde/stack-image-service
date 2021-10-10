<?php

namespace Database\Factories;

use App\Data\Models\ImageAccessInformation;
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
            's3_key' => $this->faker->url(),
            'index' => intval(0),
        ];
    }
}
