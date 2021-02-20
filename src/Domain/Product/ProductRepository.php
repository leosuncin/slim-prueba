<?php
declare(strict_types=1);

namespace App\Domain\Product;

/**
 * Product Repository
 * @package App\Domain\Product
 */
interface ProductRepository
{
    /**
     * @param Product $product
     * @return Product
     * @throws ProductNotFoundException
     */
    public function saveOne(Product $product): Product;

    /**
     * @param int $id
     * @return Product
     * @throws ProductNotFoundException
     */
    public function findOne(int $id): Product;

    /**
     * @return Product[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @throws ProductNotFoundException
     */
    public function removeOne(int  $id): void;
}
