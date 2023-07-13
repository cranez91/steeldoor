<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobOpportunity;
use Illuminate\Support\Str;

class JobOpportunityFactory extends Factory
{
    protected $model = JobOpportunity::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $skills = $this->faker->words(5, true);
        $skillsString = implode(';', explode(' ', $skills));

        $company = $this->faker->company;
        $title = $this->faker->jobTitle;
        return [
            'company_name' => $company,
            'location' => $this->faker->city,
            'title' => $title,
            'slug' => Str::slug("$company $title"),
            'description' => $this->faker->paragraph,
            'salary_range' => $this->faker->numberBetween(20, 50) . 'k - ' . $this->faker->numberBetween(60, 110) . 'k',
            'skills' => $skillsString,
        ];
    }
}
