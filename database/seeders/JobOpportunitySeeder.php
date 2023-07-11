<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobOpportunity;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class JobOpportunitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // Seeding with 10 random jobs
        for ($i = 0; $i < 10; $i++) {
            $skills = $faker->words(5, true);
            $skillsString = implode(';', explode(' ', $skills));

            $company = $faker->company;
            $title = $faker->jobTitle;
            JobOpportunity::create([
                'company_name' => $company,
                'location' => $faker->city,
                'title' => $title,
                'slug' => Str::slug("$company $title"),
                'description' => $faker->paragraph,
                'salary_range' => $faker->numberBetween(20, 50) . 'k - ' . $faker->numberBetween(60, 110) . 'k',
                'skills' => $skillsString,
            ]);
        }
    }
}
