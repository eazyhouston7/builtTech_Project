<?php

  class Points
  {
    /*
    - Points earned per rental, shared for all
      $classifications
    - Could be changed to per classification
    */
    private static $pointsPerRental = 1;

    /*
    - Amount of points earned if a movie classification
      is eligile for extra points. e.g. NEW_RELEASE
    */
    private static $extraPointAmount = 1;

    /*
    - The amount of days a rental must be rented in order
      to qualify for extra point(s)
    */
    private static $daysNeededForExtraPoints = 1;

    // Returns the points earned per rental
    public static function pointsPerRental() {
      return self::$pointsPerRental;
    }

    /*
      returns the amount of extra points earned if a movie
      classification is eligible for extra points
    */
    public static function extraPointAmount() {
      return self::$extraPointAmount;
    }

    /*
      returns the amount of days needed for a rental to qualify for extra point(s)
    */
    public static function daysNeededForExtraPoints() {
      return self::$daysNeededForExtraPoints;
    }

    // Allows to change the earned points per rental
    public static function setPointsPerRental($newAmount) {
      self::$setPointsPerRental = $newAmount;
    }

    /*
      Allows for the change in amount of extra points earned
      if a movie classification is eligble for extra points
    */
    public static function setExtraPointAmount($newAmount) {
      self::$extraPointAmount = $newAmount;
    }

    /*
      Allows to change the amount of days a movie must be rented to
      qualify for extra rental points.
    */
    public static function setDaysNeededForExtraPoints($newAmount) {
      self::$daysNeededForExtraPoints = $newAmount;
    }

    // Adds given points to a given customer
    public static function addPoints(Customer $customer, $points) {
      $customer->setFrequentRenterPoints($points);
    }

    /*
    - Subtracts given points from a given customer
    */
    public static function removePoints(Customer $customer, $points) {
      $customer->setFrequentRenterPoints(-1 * $points);
    }

    /*
    - calculates points to be credited to a customers account
      based on rental classification
    */
    public static function calculatePoints(Rental $rental) {
      $pointsToAdd = self::pointsPerRental();
      if(Movie_Classifications::getClassification($rental->movie()->classification())["extraPoints"] && $rental->daysRented() > self::daysNeededForExtraPoints()) {
        $pointsToAdd += self::extraPointAmount();
      }
      return $pointsToAdd;
    }
  }
 ?>
