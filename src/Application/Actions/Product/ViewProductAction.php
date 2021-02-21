<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use Psr\Http\Message\ResponseInterface as Response;

class ViewProductAction extends ProductAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $productId = (int) $this->resolveArg('id');
        $product = $this->productRepository->findOne($productId);

        $this->logger->info("Product of id `${productId}` was viewed.");

        return $this->respondWithData($product);
    }
}
