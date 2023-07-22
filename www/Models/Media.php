<?php

class Media
{

    protected Int $id;
    protected String $url;
    protected Int $type;

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
    **  Url Getter & Setter
    */
    public function getUrl(): String
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = htmlspecialchars($url);
    }

    /*
    **  Type Getter & Setter
    */
    public function getType(): Int
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = \htmlspecialchars($type);
    }
}
