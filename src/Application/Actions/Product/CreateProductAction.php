<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use App\Domain\Product\Product;
use Psr\Http\Message\ResponseInterface as Response;

class CreateProductAction extends ProductAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $data = $this->getFormData();
        $product = Product::fromFormData($data);
        $product = $this->productRepository->saveOne($product);

        $this->logger->info("Product created with id `{$product->getId()}`.");

        return $this->respondWithData($product, 201)
            ->withHeader('Location', "/products/{$product->getId()}");
    }
}
