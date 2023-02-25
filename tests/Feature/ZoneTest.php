<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZoneTest extends TestCase
{
    use RefreshDatabase;

    public function testPublicUserCanGetAllZones()
    {
        $response = $this->getJson('/api/v1/zones');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }
}
