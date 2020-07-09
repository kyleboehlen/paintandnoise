<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

// Models
use App\Models\Faqs;

class FaqPageTest extends TestCase
{
    /**
     * Test FAQs page
     *
     * @return void
     * @test
     */
    public function faqTest()
    {
        // Call FAQ page and verify ok
        $faq_response = Http::get(route('faq'));
        $this->assertTrue($faq_response->ok());

        // Verify body has 4 FAQs (4 question marks, 4 divs?)
        $this->assertTrue(substr_count($faq_response->body(), 'faq-item') >= 4);
    }
}
