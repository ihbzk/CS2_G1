<?php

namespace App\Models;

use App\Core\Sql;

class Product extends Sql
{
    private static $instance;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    protected Int $id = 0;
    protected String $id_seller;
    protected String $id_category;
    protected String $name;
    protected String $description;
    protected Float $price;
    protected String $stock;
    protected String $thumbnail;

    /*
    **  Id Getter & Setter
    */
    public function getId(): Int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = \htmlspecialchars($id);
    }

    /*
    **  Id_Seller Getter & Setter
    */
    public function getIdSeller(): int
    {
        return $this->id_seller;
    }

    public function setIdSeller(string $id_seller): void
    {
        $this->id_seller = \htmlspecialchars($id_seller);
    }

    /*
    **  Id_Category Getter & Setter
    */
    public function getIdCategory(): int
    {
        return $this->id_category;
    }

    public function setIdCategory(string $id_category): void
    {
        $this->id_category = \htmlspecialchars($id_category);
    }

    /*
    **  Name Getter & Setter
    */
    public function getName(): String
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = \htmlspecialchars($name);
    }

    /*
    **  Description Getter & Setter
    */
    public function getDescription(): String
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = \htmlspecialchars($description);
    }

    /*
    **  Price Getter & Setter
    */
    public function getPrice(): Float
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = \htmlspecialchars($price);
    }

    /*
    **  Stock Getter & Setter
    */
    public function getStock(): Int
    {
        return $this->stock;
    }

    public function setStock($stock): void
    {
        $this->stock = \htmlspecialchars($stock);
    }

    /*
    **  Thumbnail Getter & Setter
    */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = \htmlspecialchars($thumbnail);
    }
}
