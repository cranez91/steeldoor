<?php

namespace Tests\Feature;

use App\Models\JobOpportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobOpportunityTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateJobOpportunity()
    {
        $data = [
            'name' => 'Example Company',
            'location' => 'Example Location',
            'title' => 'Example Job Title',
            'description' => 'Example Job Description',
            'salary_range' => 'Example Salary Range',
            'skills' => ['Skill 1', 'Skill 2'],
        ];

        $response = $this->post(route('admin.job-opportunities.store'), $data);

        $response->assertStatus(302); // Verificar que se redirige después de almacenar

        $this->assertDatabaseHas('opportunities', $data); // Verificar que los datos se almacenan en la base de datos
    }

    public function testUpdateJobOpportunity()
    {
        $jobOpportunity = JobOpportunity::factory()->create();

        $data = [
            'name' => 'Updated Company',
            'location' => 'Updated Location',
            'title' => 'Updated Job Title',
            'description' => 'Updated Job Description',
            'salary_range' => 'Updated Salary Range',
            'skills' => ['Updated Skill 1', 'Updated Skill 2'],
        ];

        $response = $this->put(route('admin.job-opportunities.update', $jobOpportunity), $data);

        $response->assertStatus(302); // Verificar que se redirige después de actualizar

        $this->assertDatabaseHas('job_opportunities', $data); // Verificar que los datos se actualizan en la base de datos
    }
}

