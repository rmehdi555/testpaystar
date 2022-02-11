<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(1200000,259000000),
            'description'  => $this->faker->title(),
            'destinationFirstname' => $this->faker->name(),
            'destinationLastname' => $this->faker->name(),
            'destinationNumber' => 'IR'.$this->faker->numerify('#######################'),
            'inquiryDate' => $this->faker->title(),
            'inquirySequence' => $this->faker->title(),
            'message' => $this->faker->title(),
            'refCode' => $this->faker->numerify('#######################'),
            'sourceFirstname' => $this->faker->name(),
            'sourceLastname' => $this->faker->name(),
            'sourceNumber' => 'IR'.$this->faker->numerify('#######################'),
            'type' => $this->faker->randomElement(['internal', 'paya']),
            'status' => $this->faker->randomElement(['DONE', 'FAILED', 'PENDING']),
        ];
    }
}
