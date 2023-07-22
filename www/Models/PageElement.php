<?php

namespace App\Models;

use App\Core\Sql;

class PageElement extends Sql
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
    protected Int $id_page;
    protected Int $id_element;
    protected String $content;

    /*
    **  Id Getter & Setter
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = \htmlspecialchars($id);
    }

    /**
     * Get the value of id_page
     */
    public function getIdPage()
    {
        return $this->id_page;
    }

    /**
     * Set the value of id_page
     *
     * @return  self
     */
    public function setIdPage($id_page)
    {
        $this->id_page = \htmlspecialchars($id_page);

        return $this;
    }

    /**
     * Get the value of id_element
     */
    public function getIdElement()
    {
        return $this->id_element;
    }

    /**
     * Set the value of id_element
     *
     * @return  self
     */
    public function setIdElement($id_element)
    {
        $this->id_element = \htmlspecialchars($id_element);

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = htmlspecialchars($content);

        return $this;
    }
}
