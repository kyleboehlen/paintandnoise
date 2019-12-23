<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

// Models
use App\Models\Users;
class AuthTest extends TestCase
{
    /**
     * Test the user auth gaurd is working properly
     *
     * @return void
     * @test
     */
    public function testUserGaurd()
    {
        // Call home
        $response = $this->get('/home');

        // Assert redirect to about
        $response->assertStatus(302);

        // Create user
        $user = $user = factory(Users::class)->create();

        // Unverify user email
        $user->email_verified_at = null;
        $this->assertTrue($user->save());

        // Call home
        $response = $this->actingAs($user)->get('/home');

        // Assert redirect
        $response->assertStatus(302);

        // Verify user email
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $this->assertTrue($user->save());

        // Call home
        $response = $this->actingAs($user)->get('/home');

        // Assert ok
        $response->assertStatus(200);
    }
}