<?php
  /*
    Idea here is to have a static class with a shared set of movie classifications
  */
  class Movie_Classifications
  {
    /* Includes classifications already given
      Key is the classification, value is the price code*/
    private static $classifications = array(
        "CHILDRENS" => array("priceCode"=>2, "initialCharge"=>1.5, "daysUntilOverdue"=>3, "overdueChargePerDay"=>1.5, "extraPoints"=>false),
        "REGULAR" => array("priceCode"=>0, "initialCharge"=>2, "daysUntilOverdue"=>2, "overdueChargePerDay"=>1.5, "extraPoints"=>false),
        "NEW_RELEASE" => array("priceCode"=>1, "initialCharge"=>0, "daysUntilOverdue"=>0, "overdueChargePerDay"=>3, "extraPoints"=>true)
      );

    /*
      Returns True on success, false on failure
    */
    public static function addClassification($classification, $priceCode, $initialCharge=2, $daysUntilOverdue=3, $overdueChargePerDay=1.5, $extraPoints=false) {
      // Check if it already exists
      if(self::classificationExists($classification)) {
        return false;
      }
      // If not, then add it
      self::$classifications[$classification]["priceCode"] = $priceCode;
      self::$classifications[$classification]["initialCharge"] = $initialCharge;
      self::$classifications[$classification]["daysUntilOverdue"] = $daysUntilOverdue;
      self::$classifications[$classification]["overdueChargePerDay"] = $overdueChargePerDay;
      self::$classifications[$classification]["extraPoints"] = $extraPoints;
      return true;
    }

    /*
      Returns True on success, false on failure
    */
    public static function removeClassification($classification) {
      // Check if it exists
      if(self::classificationExists($classification)) {
        // If so, then remove it
        unset(self::$classifications[$classification]);
        return true;
      }
      return false;
    }

    /*
      Returns True on success, false on failure
    */
    public static function setPriceCode($classification, $priceCode) {
      // Check to see if classification exists
      if(self::classificationExists($classification)) {
        // Change price Code
        self::$classifications[$classification]["priceCode"] = $priceCode;
        return true;
      }
      return false;
    }

    /*
      Returns True on success, false on failure
    */
    public static function setInitialCharge($classification, $initialCharge) {
      // Check to see if classification exists
      if(self::classificationExists($classification)) {
        // Change initialCharge
        self::$classifications[$classification]["initialCharge"] = $initialCharge;
        return true;
      }
      return false;
    }

    /*
      Returns True on success, false on failure
    */
    public static function setDaysUntilOverdue($classification, $daysUntilOverdue) {
      // Check to see if classification exists
      if(self::classificationExists($classification)) {
        // Change daysUntilOverdue
        self::$classifications[$classification]["daysUntilOverdue"] = $daysUntilOverdue;
        return true;
      }
      return false;
    }

    /*
      Returns True on success, false on failure
    */
    public static function setOverdueChargePerDay($classification, $overdueChargePerDay) {
      // Check to see if classification exists
      if(self::classificationExists($classification)) {
        // Change overdueChargePerDay
        self::$classifications[$classification]["overdueChargePerDay"] = $overdueChargePerDay;
        return true;
      }
      return false;
    }

    /*
      Returns True on success, false on failure
    */
    public static function setExtraPoints($classification, $bool) {
      // Check to see if classification exists
      if(self::classificationExists($classification)) {
        // Change overdueChargePerDay
        self::$classifications[$classification]["extraPoints"] = $bool;
        return true;
      }
      return false;
    }

    /* Primarily used to test functionality
      Displays every classification w Price code in the classifications arrray*/
    public static function printClassifications() {
      foreach(array_keys(self::$classifications) as $classification)
        echo "Classification: ".$classification.", Price Code: ".self::getPriceCode($classification).
        " Initial Charge: ".self::getInitialCharge($classification)." Days Until Overdue: ".self::getDaysUntilOverdue($classification)
        ." Overdue Charge Per Day: ".self::getOverdueChargePerDay($classification)." Extra Points: ".((bool)self::getextraPoints($classification) ? "true" : "false")."<br>";
    }

    /*
    returns true if the classification exists
    else returns false
    */
    public static function classificationExists($classification) {
      if(isset(self::$classifications[$classification])) return true;
      return false;
    }

    /*
    returns the array of the classification if found, null if not
    */
    public static function getClassification($classification) {
      if(self::classificationExists($classification)) {
        return self::$classifications[$classification];
      }
      echo $classification;
      //return null;
    }

    /*
    Returns the requested classification price code if classification exists
    else returns -1
    */
    public static function getPriceCode($classification) {
      if(self::classificationExists($classification)) return self::$classifications[$classification]["priceCode"];
      return -1;
    }

    /*
    Returns the requested classification initialCharge if classification exists
    else returns -1
    */
    public static function getInitialCharge($classification) {
      if(self::classificationExists($classification)) return self::$classifications[$classification]["initialCharge"];
      return -1;
    }

    /*
    Returns the requested classification daysUntilOverdue if classification exists
    else returns -1
    */
    public static function getDaysUntilOverdue($classification) {
      if(self::classificationExists($classification)) return self::$classifications[$classification]["daysUntilOverdue"];
      return -1;
    }

    /*
    Returns the requested classification overdueChargePerDay if classification exists
    else returns -1
    */
    public static function getOverdueChargePerDay($classification) {
      if(self::classificationExists($classification)) return self::$classifications[$classification]["overdueChargePerDay"];
      return -1;
    }

    /*
    Returns the requested classification extraPoints boolean if classification exists
    else returns -1
    */
    public static function getextraPoints($classification) {
      if(self::classificationExists($classification)) return self::$classifications[$classification]["extraPoints"];
      return -1;
    }
  }
?>
