<?php

declare(strict_types=1);

namespace Tests\Integration\Cors;

use App\Classes\Env\Env;
use Illuminate\Foundation\Testing\TestCase;

class CorsTest extends TestCase
{
    public function test_admin_cors_should_pass()
    {
        $origin = Env::get()->adminFrontEndURI;

        $response = $this->withHeaders([
            'Origin' => $origin,
        ])->postJson('/api/admin/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'secret',
        ]);

        $response->assertHeader('Access-Control-Allow-Origin', $origin);
        $response->assertHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->assertHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->assertHeader('Access-Control-Allow-Credentials', 'true');
    }

    public function test_admin_cors_should_fail()
    {
        $response = $this->withHeaders([
            'Origin' => 'https://sample.com',
        ])->postJson('/api/admin/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'secret',
        ]);

        $response->assertHeaderMissing('Access-Control-Allow-Origin');
        $response->assertHeaderMissing('Access-Control-Allow-Methods');
        $response->assertHeaderMissing('Access-Control-Allow-Headers');
        $response->assertHeaderMissing('Access-Control-Allow-Credentials');
    }

    public function test_supplier_cors_should_pass()
    {
        $origin = Env::get()->supplierFrontEndURI;

        $response = $this->withHeaders([
            'Origin' => $origin,
        ])->postJson('/api/supplier/auth/login', [
            'email' => 'supplier@example.com',
            'password' => 'secret',
        ]);

        $response->assertHeader('Access-Control-Allow-Origin', $origin);
        $response->assertHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->assertHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->assertHeader('Access-Control-Allow-Credentials', 'true');
    }

    public function test_supplier_cors_should_fail()
    {
        $response = $this->withHeaders([
            'Origin' => 'https://sample.com',
        ])->postJson('/api/supplier/auth/login', [
            'email' => 'supplier@example.com',
            'password' => 'secret',
        ]);

        $response->assertHeaderMissing('Access-Control-Allow-Origin');
        $response->assertHeaderMissing('Access-Control-Allow-Methods');
        $response->assertHeaderMissing('Access-Control-Allow-Headers');
        $response->assertHeaderMissing('Access-Control-Allow-Credentials');
    }

    public function test_client_cors_should_pass()
    {
        $origin = Env::get()->clientFrontEndURI;

        $response = $this->withHeaders([
            'Origin' => $origin,
        ])->postJson('/api/client/auth/login', [
            'email' => 'client@example.com',
            'password' => 'secret',
        ]);

        $response->assertHeader('Access-Control-Allow-Origin', $origin);
        $response->assertHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->assertHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->assertHeader('Access-Control-Allow-Credentials', 'true');
    }

    public function test_client_cors_should_fail()
    {
        $response = $this->withHeaders([
            'Origin' => 'https://sample.com',
        ])->postJson('/api/client/auth/login', [
            'email' => 'client@example.com',
            'password' => 'secret',
        ]);

        $response->assertHeaderMissing('Access-Control-Allow-Origin');
        $response->assertHeaderMissing('Access-Control-Allow-Methods');
        $response->assertHeaderMissing('Access-Control-Allow-Headers');
        $response->assertHeaderMissing('Access-Control-Allow-Credentials');
    }
}
