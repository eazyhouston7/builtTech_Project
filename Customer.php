<?php

class Customer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Rental[]
     */
    private $rentals;

    // new
    private $frequentRenterPoints;  // Amount of loyalty points the customer has accumulated
    private $totalDue;  // Amount in Dollars the Customer Owes

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->rentals = [];
        $this->frequentRenterPoints = 0;
        $this->totalDue = 0;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    public function rentals() {
      return $this->rentals;
    }

    /**
     * @param Rental $rental
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    //new
    public function frequentRenterPoints() {
      return $this->frequentRenterPoints;
    }

    public function setFrequentRenterPoints($amount) {
      $this->frequentRenterPoints = $amount;
    }

    public function addFrequentRenterPoints($amount) {
      $this->frequentRenterPoints += $amount;
    }

    public function removeFrequentRenterPoints($amount) {
      $this->frequentRenterPoints -= $amount;
    }

    //new
    public function totalDue() {
      return $this->totalDue;
    }

    public function setTotalDue($amount) {
      $this->totalDue = $amount;
    }

    public function addToTotalDue($amount) {
      $this->totalDue += $amount;
    }

    public function removeFromTotalDue($amount) {
      $this->totalDue -= $amount;
    }

    /**
     * @return string
     */
     public function statement()
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;

        $result = 'Rental Record for ' . $this->name() . PHP_EOL;

        foreach ($this->rentals as $rental) {
            $thisAmount = 0;

            switch($rental->movie()->priceCode()) {
                case Movie::REGULAR:
                    $thisAmount += 2;
                    if ($rental->daysRented() > 2) {
                        $thisAmount += ($rental->daysRented() - 2) * 1.5;
                    }
                    break;
                case Movie::NEW_RELEASE:
                    $thisAmount += $rental->daysRented() * 3;
                    break;
                case Movie::CHILDRENS:
                    $thisAmount += 1.5;
                    if ($rental->daysRented() > 3) {
                        $thisAmount += ($rental->daysRented() - 3) * 1.5;
                    }
                    break;
            }

            $totalAmount += $thisAmount;

            $frequentRenterPoints++;
            if ($rental->movie()->priceCode() === Movie::NEW_RELEASE && $rental->daysRented() > 1) {
                $frequentRenterPoints++;
            }

            $result .= "\t" . str_pad($rental->movie()->name(), 30, ' ', STR_PAD_RIGHT) . "\t" . $thisAmount . PHP_EOL;
        }

        $result .= 'Amount owed is ' . $totalAmount . PHP_EOL;
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points' . PHP_EOL;

        return $result;
    }



    /*
      Start of the htmlStatement() func
      No params, returns html
    */
    public function htmlStatement() {
      $toReturn = "<h1>Rental Record for <em>".$this->name()."</em></h1><ul>";
      foreach($this->rentals as $rental) {
        $toReturn.="<li>".$rental->movie()->name()." - ";
        $thisAmount = Price::calculatePrice($rental);
        $this->addToTotalDue($thisAmount);
        $this->addFrequentRenterPoints(Points::calculatePoints($rental));

        $toReturn .= $thisAmount."</li>";
      }
      $toReturn.="</ul>";
      $toReturn.="<p>Amount owed is <em>".$this->totalDue()."</em><p>You earned <em>".$this->frequentRenterPoints()." </em> frequent renter points</p>";
      return $toReturn;
    }
    /* End of the htmlStatement() func */
}
