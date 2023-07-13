<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\JobOpportunity;
use Illuminate\Support\Str;

class JobOpportunityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index action.
     *
     * @return void
     */
    public function testIndex()
    {
        JobOpportunity::factory()->count(10)->create();

        $response = $this->get('/api/seeker/job-opportunities');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    /**
     * Test the show action.
     *
     * @return void
     */
    public function testShow()
    {
        $jobOpportunity = JobOpportunity::factory()->create();

        $response = $this->get('/api/admin/job-opportunities/' . $jobOpportunity->slug);

        $response->assertStatus(200)
            ->assertJson([
                'data' => $jobOpportunity->toArray()
            ]);
    }

    /**
     * Test the store action.
     *
     * @return void
     */
    public function testStore()
    {
        $skills = $this->faker->words(5, true);
        $skillsString = implode(';', explode(' ', $skills));

        $company = $this->faker->company;
        $title = $this->faker->jobTitle;

        $jobOpportunityData = [
            'company_name' => $company,
            'location' => $this->faker->city,
            'title' => $title,
            'slug' => Str::slug("$company $title"),
            'description' => $this->faker->paragraph,
            'salary_range' => $this->faker->numberBetween(20, 50) . 'k - ' . $this->faker->numberBetween(60, 110) . 'k',
            'skills' => $skillsString
        ];

        $response = $this->post('/api/admin/job-opportunity', $jobOpportunityData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Job opportunity created successfully'
            ]);
    }

    /**
     * Test the update action.
     *
     * @return void
     */
    public function testUpdate()
    {
        $jobOpportunity = JobOpportunity::factory()->create();

        $skills = $this->faker->words(5, true);
        $skillsString = implode(';', explode(' ', $skills));

        $company = $this->faker->company;
        $title = $this->faker->jobTitle;

        $updatedData = [
            'company_name' => $company,
            'location' => $this->faker->city,
            'title' => $title,
            'slug' => Str::slug("$company $title"),
            'description' => $this->faker->paragraph,
            'salary_range' => $this->faker->numberBetween(20, 50) . 'k - ' . $this->faker->numberBetween(60, 110) . 'k',
            'skills' => $skillsString
        ];

        $response = $this->put('/api/admin/job-opportunity' . $jobOpportunity->slug, $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Job opportunity updated successfully'
            ]);
    }

    /**
     * Test the destroy action.
     *
     * @return void
     */
    public function testDestroy()
    {
        $jobOpportunity = JobOpportunity::factory()->create();

        $response = $this->delete('/api/admin/job-opportunity' . $jobOpportunity->slug);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Job opportunity deleted successfully'
            ]);
    }
}