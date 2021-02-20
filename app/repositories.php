<?php
declare(strict_types=1);

use App\Domain\Product\ProductRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Product\InMemoryProductRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        // Here we map our UserRepository interface to its in memory implementation
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        ProductRepository::class => \DI\autowire(InMemoryProductRepository::class),
    ]);
};
