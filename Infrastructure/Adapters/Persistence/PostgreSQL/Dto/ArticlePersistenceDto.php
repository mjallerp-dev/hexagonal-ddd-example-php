<?php

declare(strict_types=1);

final class ArticlePersistenceDto
{
    private string $id;
    private string $description;
    private string $provider;
    private string $brand;
    private string $model;
    private string $category;
    private string $store;
    private int $quantity;
    private float $purchasePrice;
    private float $salePrice;
    private float $iva;

    public function __construct(
        string $id,
        string $description,
        string $provider,
        string $brand,
        string $model,
        string $category,
        string $store,
        int $quantity,
        float $purchasePrice,
        float $salePrice,
        float $iva
    ) {
        $this->id = trim($id);
        $this->description = trim($description);
        $this->provider = trim($provider);
        $this->brand = trim($brand);
        $this->model = trim($model);
        $this->category = trim($category);
        $this->store = trim($store);
        $this->quantity = $quantity;
        $this->purchasePrice = $purchasePrice;
        $this->salePrice = $salePrice;
        $this->iva = $iva;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function provider(): string
    {
        return $this->provider;
    }

    public function brand(): string
    {
        return $this->brand;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function store(): string
    {
        return $this->store;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function purchasePrice(): float
    {
        return $this->purchasePrice;
    }

    public function salePrice(): float
    {
        return $this->salePrice;
    }

    public function iva(): float
    {
        return $this->iva;
    }
}
