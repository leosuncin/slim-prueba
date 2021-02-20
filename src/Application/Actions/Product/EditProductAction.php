<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class EditProductAction extends ProductAction
{
    /**
     * @inheritDoc
     */
    protected function action(): Response
    {
        $productId = (int) $this->resolveArg('id');
        $product = $this->productRepository->findOne($productId);
        $data = $this->getFormData();
        $product->updateUsingFormData($data);
        $product = $this->productRepository->saveOne($product);

        $this->logger->info("Product edited with id `${productId}`.");

        return $this->respondWithData($product);
    }
}
