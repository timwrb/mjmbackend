<?php

namespace Database\Factories;

use App\Models\address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


class AddressFactory extends Factory
{
    protected $model = address::class;
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new()->create()->id, // Create a user and get its ID
            'state' => $this->faker->word(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->randomNumber(5, true),
            'street' => $this->faker->streetName(),
            'house_nr' => $this->faker->word(),
            'address_addition' => $this->faker->address(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
