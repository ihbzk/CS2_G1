<?php

namespace App\Models;

use App\Core\Sql;

class Comment extends Sql{

    private static $instance;
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    protected Int $id;
    protected String $content;
    protected String $date;
    protected Int $id_user;
    protected Int $id_product;


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
    **  Content Getter & Setter
    */
    public function getContent(): String
    {
        return $this->content;
    }

    public function setContent($content): void
    {
        $this->content = \htmlspecialchars($content);
    }

    /*
    **  Date Getter & Setter
    */
    public function getDate(): String
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = \htmlspecialchars($date);
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
        $this->id_user = \htmlspecialchars($id_user);
    }

    /*
    **  IdProduct Getter & Setter
    */
    public function getIdProduct(): Int
    {
        return $this->id_product;
    }

    public function setIdProduct($id_product): void
    {
        $this->id_product = \htmlspecialchars($id_product);
    }
}