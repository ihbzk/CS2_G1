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
    protected String $max_quantity;
    protected String $thumbnail;
    protected String $slug;
    protected String $meta_title;
    protected String $meta_description;
    protected String $meta_keywords;

    /*
    **  Id Getter & Setter
    */
    public function getId(): Int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
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
        $this->id_seller = $id_seller;
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
        $this->id_category = $id_category;
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
        $this->name = $name;
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
        $this->description = $description;
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
        $this->price = $price;
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
        $this->stock = $stock;
    }

    /*
    **  Max Quantity Getter & Setter
    */
    public function getMaxQuantity(): Int
    {
        return $this->max_quantity;
    }

    public function setMaxQuantity($max_quantity): void
    {
        $this->max_quantity = $max_quantity;
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
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /*
    **  Meta Title Getter & Setter
    */
    public function getMetaTitle(): String
    {
        return $this->meta_title;
    }

    public function setMetaTitle($meta_title): void
    {
        $this->meta_title = $meta_title;
    }

    /*
    **  Meta Description Getter & Setter
    */
    public function getMetaDescription(): String
    {
        return $this->meta_description;
    }

    public function setMetaDescription($meta_description): void
    {
        $this->meta_description = $meta_description;
    }

    /*
    **  Meta Keywords Getter & Setter
    */
    public function getMetaKeywords(): String
    {
        return $this->meta_keywords;
    }

    public function setMetaKeywords($meta_keywords): void
    {
        $this->meta_keywords = $meta_keywords;
    }
}
