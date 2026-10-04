<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/ArticleId.php';
require_once __DIR__ . '/../ValueObjects/ArticleDescription.php';
require_once __DIR__ . '/../ValueObjects/ArticleProvider.php';
require_once __DIR__ . '/../ValueObjects/ArticleBrand.php';
require_once __DIR__ . '/../ValueObjects/ArticleModelo.php';
require_once __DIR__ . '/../Enums/ArticleCategoryEnum.php';
require_once __DIR__ . '/../ValueObjects/ArticleStore.php';
require_once __DIR__ . '/../ValueObjects/ArticleQuantity.php';
require_once __DIR__ . '/../ValueObjects/ArticlePurchasePrice.php';
require_once __DIR__ . '/../ValueObjects/ArticleSalePrice.php';
require_once __DIR__ . '/../ValueObjects/ArticleIva.php';

final class ArticleModel
{
    private ArticleId $id;
    private ArticleDescription $description;
    private ArticleProvider $provider;
    private ArticleBrand $brand;
    private ArticleModelo $model;
    private string $category;
    private ArticleStore $store;
    private ArticleQuantity $quantity;
    private ArticlePurchasePrice $purchasePrice;
    private ArticleSalePrice $salePrice;
    private ArticleIva $iva;

    public function __construct(
        ArticleId            $id,
        ArticleDescription   $description,
        ArticleProvider      $provider,
        ArticleBrand         $brand,
        ArticleModelo        $model,
        string               $category,
        ArticleStore         $store,
        ArticleQuantity      $quantity,
        ArticlePurchasePrice $purchasePrice,
        ArticleSalePrice     $salePrice,
        ArticleIva           $iva
    ) {
        ArticleCategoryEnum::ensureIsValid($category);

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

    public static function create(
        ArticleId            $id,
        ArticleDescription   $description,
        ArticleProvider      $provider,
        ArticleBrand         $brand,
        ArticleModelo        $model,
        string               $category,
        ArticleStore         $store,
        ArticleQuantity      $quantity,
        ArticlePurchasePrice $purchasePrice,
        ArticleSalePrice     $salePrice,
        ArticleIva           $iva
    ): self {
        return new self(
            $id,
            $description,
            $provider,
            $brand,
            $model,
            $category,
            $store,
            $quantity,
            $purchasePrice,
            $salePrice,
            $iva
        );
    }

    public function id(): ArticleId
    {
        return $this->id;
    }

    public function description(): ArticleDescription
    {
        return $this->description;
    }

    public function provider(): ArticleProvider
    {
        return $this->provider;
    }

    public function brand(): ArticleBrand
    {
        return $this->brand;
    }

    public function model(): ArticleModelo
    {
        return $this->model;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function store(): ArticleStore
    {
        return $this->store;
    }

    public function quantity(): ArticleQuantity
    {
        return $this->quantity;
    }

    public function purchasePrice(): ArticlePurchasePrice
    {
        return $this->purchasePrice;
    }

    public function salePrice(): ArticleSalePrice
    {
        return $this->salePrice;
    }

    public function iva(): ArticleIva
    {
        return $this->iva;
    }

    public function changeDescription(ArticleDescription $description): self
    {
        return new self(
            $this->id,
            $description,
            $this->provider,
            $this->brand,
            $this->model,
            $this->category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeProvider(ArticleProvider $provider): self
    {
        return new self(
            $this->id,
            $this->description,
            $provider,
            $this->brand,
            $this->model,
            $this->category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeBrand(ArticleBrand $brand): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $brand,
            $this->model,
            $this->category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeModel(ArticleModelo $model): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $model,
            $this->category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeStore(ArticleStore $store): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $this->model,
            $this->category,
            $store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeCategory(string $category): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $this->model,
            $category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeQuantity(ArticleQuantity $quantity): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $this->model,
            $this->category,
            $this->store,
            $quantity,
            $this->purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changePurchasePrice(ArticlePurchasePrice $purchasePrice): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $this->model,
            $this->category,
            $this->store,
            $this->quantity,
            $purchasePrice,
            $this->salePrice,
            $this->iva
        );
    }

    public function changeSalePrice(ArticleSalePrice $salePrice): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $this->model,
            $this->category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $salePrice,
            $this->iva
        );
    }

    public function changeIva(ArticleIva $iva): self
    {
        return new self(
            $this->id,
            $this->description,
            $this->provider,
            $this->brand,
            $this->model,
            $this->category,
            $this->store,
            $this->quantity,
            $this->purchasePrice,
            $this->salePrice,
            $iva
        );
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'description' => $this->description->value(),
            'provider' => $this->provider->value(),
            'brand' => $this->brand->value(),
            'model' => $this->model->value(),
            'category' => $this->category,
            'store' => $this->store->value(),
            'quantity' => $this->quantity->value(),
            'purchasePrice' => $this->purchasePrice->value(),
            'salePrice' => $this->salePrice->value(),
            'iva' => $this->iva->value()
        );
    }
}