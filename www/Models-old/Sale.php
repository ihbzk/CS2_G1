<?php
class Sale
{

    protected Int $id;
    protected String $date;
    protected Float $amount;

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
    **  Date Getter & Setter
    */
    public function getDate(): String
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    /*
    **  Amount Getter & Setter
    */
    public function getAmount(): Float
    {
        return $this->amount;
    }

    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }
}
