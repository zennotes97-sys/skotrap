<?php

namespace Tests\Feature;

use App\Http\Middleware\TrustProxies;
use Illuminate\Http\Request;
use Tests\TestCase;

class AssetUrlProductionTest extends TestCase
{
    public function test_asset_urls_use_https_when_running_behind_proxy(): void
    {
        $request = Request::create('http://skotrap-production.up.railway.app/', 'GET', [], [], [], [
            'HTTP_X_FORWARDED_PROTO' => 'https',
            'HTTP_X_FORWARDED_HOST' => 'skotrap-production.up.railway.app',
        ]);

        $middleware = new TrustProxies(['*']);

        $middleware->handle($request, fn ($request) => response()->noContent());

        $this->assertTrue($request->isSecure());
        $this->assertSame(
            'https://skotrap-production.up.railway.app',
            $request->getSchemeAndHttpHost()
        );
    }
}
