<?php

abstract class VehicleBase
{
    // Shared properties for all vehicles
    protected $name;
    protected $type;
    protected $price;
    protected $image;

    // Constructor to set vehicle properties
    public function __construct($name = '', $type = '', $price = 0, $image = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->image = $image;
    }

    // Abstract method that must be implemented by child classes
    abstract public function getDetails();

    // Getter methods to access properties
    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }
}
