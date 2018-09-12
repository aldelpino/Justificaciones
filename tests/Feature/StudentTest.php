<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanListStudents()
    {
        $user = User::find(2);
        $response = $this->actingAs($user)->get('/alumno/index');
        $response->assertStatus(200);
    }
}
