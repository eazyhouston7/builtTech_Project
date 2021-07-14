<?php

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $priceCode;

    // New
    private $classification;

    /**
     * @param string $name
     * @param int $priceCode
     */
    public function __construct($name, $priceCode, $classification)
    {
        $this->name = $name;
        $this->priceCode = $priceCode;
        $this->classification = $classification;
        if(!Movie_Classifications::classificationExists($classification)) {
          Movie_Classifications::addClassification($classification, $priceCode);
        }
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function priceCode()
    {
        return $this->priceCode;
    }

    public function classification() {
      return $this->classification;
    }

}
