<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = $this->getData();
        // $department = Department::inRandomOrder()->first();

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'middle_name' => fake()->lastName(),
            'country_id' => $location['country']->id,
            'state_id' => $location['state']->id,
            'city_id' => $location['city']->id,
            'address' => fake()->address,
            // 'department_id' => $department->id,
            'zip_code' => fake()->postcode,
            'date_of_birth' => fake()->date('Y-m-d'),
            'date_hired' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }

    /**
     * Recursively get location data (country, state, city)
     *
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        $country = Country::inRandomOrder()->first();
        $state = $country->states()->inRandomOrder()->first();
        $city = $state->cities()->inRandomOrder()->first();

        // If city is null, recursively call getData until a valid city is found
        if ($city === null) {
            return $this->getData();
        }

        return ['country' => $country, 'state' => $state, 'city' => $city];
    }
}
