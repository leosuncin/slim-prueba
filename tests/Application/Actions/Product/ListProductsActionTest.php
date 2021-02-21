<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Product;

use EnricoStahn\JsonAssert\Assert as JsonAssert;
use Tests\TestCase;

class ListProductsActionTest extends TestCase
{
    use JsonAssert;

    public function testAction()
    {
        $request = $this->createRequest('GET', '/products');
        $response = $this->getAppInstance()->handle($request);

        $payload = (string)$response->getBody();
        $json = json_decode($payload);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonMatchesSchema($json, 'tests/Common/products-schema.json');
        $this->assertSame($response->getStatusCode(), $json->statusCode);
    }
}
