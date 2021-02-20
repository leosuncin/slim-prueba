<?php
declare(strict_types=1);

namespace App\Domain\Product;

use JsonSerializable;

/**
 * Product Entity
 * @package App\Domain\Product
 */
class Product implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var float
     */
    private $price;

    /**
     * Product constructor.
     * @param int|null $id
     * @param string $name
     * @param string $description
     * @param string $image
     * @param float $price
     */
    public function __construct(?int $id, string $name, string $description, string $image, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    /**
     * Create a new product from form data
     * @param object $data
     * @return Product
     */
    public static function fromFormData(object $data): Product
    {
        return new self(null, $data->name, $data->description, $data->image, (float)$data->price);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Replace property values with form data
     * @param object $data
     */
    public function updateUsingFormData(object $data)
    {
        if (isset($data->name)) {
            $this->name = $data->name;
        }

        if (isset($data->description)) {
            $this->description = $data->description;
        }

        if (isset($data->image)) {
            $this->image = $data->image;
        }

        if (isset($data->price)) {
            $this->price = (float)$data->price;
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
        ];
    }
}
