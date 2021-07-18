<?php
class Price {
  // Returns the price of a rental based on the classification that the rental has.
  public static function calculatePrice(Rental $rental) {
    $price = 0;
    if(Movie_Classifications::classificationExists($rental->movie()->classification())) {
      $classificationInfo = Movie_Classifications::getClassification($rental->movie()->classification());
      $price += $classificationInfo["initialCharge"];
      if($rental->daysRented() > $classificationInfo["daysUntilOverdue"]) {
        $price += ($rental->daysRented() - $classificationInfo["daysUntilOverdue"]) * $classificationInfo["overdueChargePerDay"];
      }
    }
    return $price;
  }
}
?>
