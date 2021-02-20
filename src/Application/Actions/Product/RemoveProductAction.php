<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use Psr\Http\Message\ResponseInterface as Response;

class RemoveProductAction extends ProductAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $productId = (int)$this->resolveArg('id');
        $this->productRepository->removeOne($productId);

        $this->logger->info("Product removed with id `${productId}`.");

        return $this->response->withStatus(204);
    }
}
