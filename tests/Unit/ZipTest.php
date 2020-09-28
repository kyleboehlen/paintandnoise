<?php

namespace Tests\Feature\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

// Helpers
use App\Http\Helpers\Functions\ZipHelper;

class ZipTest extends TestCase
{
    /**
     * Test the ZipHelper::search() functionality.
     *
     * @return void
     * @test
     */
    public function zipHelperTest()
    {
        // Validate ZipWise is up
        $response = Http::get('https://www.zipwise.com/');
        $this->assertTrue($response->ok());

        // Check for valid zip
        $zips = ZipHelper::search(84107);
        $this->assertTrue(count($zips) > 1);

        // Check for invalid zips
        $zips = ZipHelper::search(00000);
        $this->assertTrue(count($zips) == 0);
        $zips = ZipHelper::search(99999);
        $this->assertTrue(count($zips) == 0);
    }
}
