<?php
declare(strict_types=1);

namespace Tests;

use Faker\Factory;

trait WithFaker
{
    /**
     * Faker instance
     *
     * @var \Faker\Generator
     */
    protected $faker;

    protected function setUpFaker(string $locale = Factory::DEFAULT_LOCALE): void
    {
        $this->faker = Factory::create($locale);
    }
}
