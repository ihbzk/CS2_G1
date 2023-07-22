<?php

namespace App\Models;

use App\Core\Sql;

class Page extends Sql
{
    private static $instance;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    protected ?Int $id = null;
    protected Int $id_user;
    protected String $cover_image;
    protected String $cover_image_alt;
    protected String $cover_title;
    protected String $slug;
    protected String $meta_title;
    protected String $meta_description;
    protected String $meta_keywords;

    /*
    **  Id Getter & Setter
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /*
    **  IdUser Getter & Setter
    */
    public function getIdUser(): Int
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /*
    **  Cover Image Getter & Setter
    */
    public function getCoverImage(): String
    {
        return $this->cover_image;
    }

    public function setCoverImage($cover_image): void
    {
        $this->cover_image = $cover_image;
    }

    /*
    **  Cover Image Alt Getter & Setter
    */
    public function getCoverImageAlt(): String
    {
        return $this->cover_image_alt;
    }

    public function setCoverImageAlt($cover_image_alt): void
    {
        $this->cover_image_alt = $cover_image_alt;
    }

    /*
    **  Cover Title Getter & Setter
    */
    public function getCoverTitle(): String
    {
        return $this->cover_title;
    }

    public function setCoverTitle($cover_title): void
    {
        $this->cover_title = $cover_title;
    }

    /*
    **  Slug Getter & Setter
    */
    public function getSlug(): String
    {
        return $this->slug;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
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
