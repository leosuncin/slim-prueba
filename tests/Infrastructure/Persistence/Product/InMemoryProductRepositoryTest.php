<?php

namespace Tests\Infrastructure\Persistence\Product;

use App\Domain\Product\Product;
use App\Domain\Product\ProductNotFoundException;
use App\Infrastructure\Persistence\Product\InMemoryProductRepository;
use Tests\TestCase;
use Tests\WithFaker;

class InMemoryProductRepositoryTest extends TestCase
{
    use WithFaker;

    public function testSaveOneProduct()
    {
        $productRepository = new InMemoryProductRepository([]);

        $product = $productRepository->saveOne(new Product(null, $this->faker->word(), $this->faker->paragraph(), $this->faker->imageUrl(), $this->faker->randomFloat(2, 1, 100)));

        $this->assertIsInt($product->getId());
    }

    public function testSaveOneExistingProduct()
    {
        $productRepository = new InMemoryProductRepository([1 => new Product(1, $this->faker->word(), $this->faker->paragraph(), $this->faker->imageUrl(), $this->faker->randomFloat(2, 1, 100))]);

        $product = $productRepository->saveOne(new Product(1, $this->faker->word(), $this->faker->paragraph(), $this->faker->imageUrl(), $this->faker->randomFloat(2, 1, 100)));

        $this->assertEquals($productRepository->findOne(1), $product);
    }

    public function testFindOneProduct()
    {
        $product = new Product(1, $this->faker->word(), $this->faker->paragraph(), $this->faker->imageUrl(), $this->faker->randomFloat(2, 1, 100));
        $productRepository = new InMemoryProductRepository([1 => $product]);

        $this->assertEquals($product, $productRepository->findOne(1));
    }

    public function testFindOneProductThrowsNotFoundException()
    {
        $productRepository = new InMemoryProductRepository([]);

        $this->expectException(ProductNotFoundException::class);

        $productRepository->findOne(1);
    }

    public function testFindAllProducts()
    {
        $product = new Product(1, $this->faker->word(), $this->faker->paragraph(), $this->faker->imageUrl(), $this->faker->randomFloat(2, 1, 100));
        $productRepository = new InMemoryProductRepository([1 => $product]);

        $this->assertEquals([$product], $productRepository->findAll());
    }

    public function testRemoveOneProduct()
    {
        $productRepository = new InMemoryProductRepository();
        $productCount = count($productRepository->findAll());

        $productRepository->removeOne(1);

        $this->assertCount($productCount - 1, $productRepository->findAll());
    }

    public function testRemoveOneProductThrowsNotFoundException()
    {
        $productRepository = new InMemoryProductRepository([]);

        $this->expectException(ProductNotFoundException::class);

        $productRepository->removeOne(1);
    }

    protected function setUp(): void
    {
        $this->setUpFaker();
    }
}
