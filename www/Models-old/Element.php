<?php

namespace App\Models;

use App\Core\Sql;

class Element extends Sql
{

    protected Int $id;
    protected String $name;

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
}
