<?php

declare(strict_types=1);

final class ArticleResponse
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
        $this->id = $id;
        $this->description = $description;
        $this->provider = $provider;
        $this->brand = $brand;
        $this->model = $model;
        $this->category = $category;
        $this->store = $store;
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

    /**
     * @return array<string, string|int|float>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'description' => $this->description,
            'provider' => $this->provider,
            'brand' => $this->brand,
            'model' => $this->model,
            'category' => $this->category,
            'store' => $this->store,
            'quantity' => $this->quantity,
            'purchasePrice' => $this->purchasePrice,
            'salePrice' => $this->salePrice,
            'iva' => $this->iva,
        );
    }
}
