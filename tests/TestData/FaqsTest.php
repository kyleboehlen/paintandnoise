<?php

namespace Tests\TestData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Models
use App\Models\Faqs;

class FaqsTest extends TestCase
{
    /**
     * Seed admin users
     *
     * @return void
     * @test
     */
    public function faqsTest()
    {
        // Create random Faqs
        $faqs = Faqs::factory(mt_rand(4, 8))->create();

        // Verify there are more than 4
        $this->assertTrue(count($faqs) >= 4);
    }
}
