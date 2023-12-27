<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data=[
            'email'=>'chichek.abdullayeva@gmail.com',
            'phone'=>"+65 11.188.888",
            'en' => [
                'address'=>fake()->text(7)
            ],
            'tr' => [
                'address'=>fake()->text(7)
            ]
        ];

            
        
        return $data;
    }
}
