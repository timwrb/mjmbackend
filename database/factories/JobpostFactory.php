<?php

namespace Database\Factories;

use App\Models\address;
use App\Models\jobpost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Database\Factories\UserFactory;
use Database\Factories\AddressFactory;

class JobpostFactory extends Factory
{
    protected $model = jobpost::class;

    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->word(),
            'content' => $this->faker->text(),
            'address_id' => Address::all()->random()->id,
            'visible' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
