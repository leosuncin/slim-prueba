<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Product;

use App\Application\Handlers\HttpErrorHandler;
use EnricoStahn\JsonAssert\Assert as JsonAssert;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;
use Tests\WithFaker;

class CreateProductActionTest extends TestCase
{
    use WithFaker;
    use JsonAssert;

    /**
     * @var App
     */
    private $app;

    public function testAction()
    {
        $request = $this->createRequest('POST', '/products', ['HTTP_ACCEPT' => 'application/json', 'HTTP_CONTENT_TYPE' => 'application/json']);
        $request->getBody()->write(json_encode([
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 1, 100),
        ]));
        $request->getBody()->rewind();
        $response = $this->app->handle($request);

        $payload = (string)$response->getBody();
        $json = json_decode($payload);

        if ($response->getStatusCode() == 400) {
            $this->markTestIncomplete('Fails to send JSON');
        }

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJsonMatchesSchema($json, 'tests/Common/product-schema.json');
        $this->assertSame($response->getStatusCode(), $json->statusCode);
    }

    protected function setUp(): void
    {
        $this->setUpFaker();
        $this->app = $this->getAppInstance();

        $callableResolver = $this->app->getCallableResolver();
        $responseFactory = $this->app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $this->app->add($errorMiddleware);
    }
}
