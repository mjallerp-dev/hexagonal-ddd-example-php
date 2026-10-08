<?php

declare(strict_types=1);

final class CreateArticleCommand
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

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getStore(): string
    {
        return $this->store;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPurchasePrice(): float
    {
        return $this->purchasePrice;
    }

    public function getSalePrice(): float
    {
        return $this->salePrice;
    }

    public function getIva(): float
    {
        return $this->iva;
    }

}