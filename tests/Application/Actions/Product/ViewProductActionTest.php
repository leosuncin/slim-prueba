<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Product;

use App\Application\Handlers\HttpErrorHandler;
use EnricoStahn\JsonAssert\Assert as JsonAssert;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ViewProductActionTest extends TestCase
{
    use JsonAssert;

    /**
     * @var App
     */
    private $app;

    public function testAction()
    {
        $request = $this->createRequest('GET', '/products/1');
        $response = $this->app->handle($request);

        $payload = (string)$response->getBody();
        $json = json_decode($payload);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonMatchesSchema($json, 'tests/Common/product-schema.json');
        $this->assertSame($response->getStatusCode(), $json->statusCode);
    }

    public function testActionThrowsProductNotFoundException()
    {
        $request = $this->createRequest('GET', '/products/21');
        $response = $this->app->handle($request);

        $payload = (string)$response->getBody();
        $json = json_decode($payload);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertJsonMatchesSchema($json, 'tests/Common/error-schema.json');
        $this->assertSame($response->getStatusCode(), $json->statusCode);
    }

    protected function setUp(): void
    {
        $this->app = $this->getAppInstance();

        $callableResolver = $this->app->getCallableResolver();
        $responseFactory = $this->app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $this->app->add($errorMiddleware);
    }
}
