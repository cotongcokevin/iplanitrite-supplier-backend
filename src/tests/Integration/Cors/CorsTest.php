<?php

declare(strict_types=1);

namespace Cors;

use App\Classes\Env\Env;
use Illuminate\Foundation\Testing\TestCase;

class CorsTest extends TestCase
{

    public function test_cors_headers_missing_should_fail()
    {
        $response = $this->withHeaders([
            'Origin' => 'http://anything:3000',
        ])->get('/api/admin/auth/login');

        // This assertion will FAIL if the CORS headers are NOT present:
        $response->assertHeader('Access-Control-Allow-Origin', Env::get()->adminFrontEndURI);
    }

}