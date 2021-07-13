<?php
  /*
    Idea here is to have a static class with a shared set of movie classifications
  */
  class Movie_Classifications
  {
    /* Includes classifications already given
      Key is the classification, value is the price code*/
    private static $classifications = array("CHILDRENS" => 2, "REGULAR" => 0, "NEW_RELEASE" => 1);

    /*
      Returns True on success, false on failure
    */
    public static function addClassification($classification, $priceCode) {
      // Check if it already exists
      if(self::classificationExists($classification)) {
        return false;
      }
      // If not, then add it
      self::$classifications[$classification] = $priceCode;
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
        self::$classifications[$classification] = $priceCode;
        return true;
      }
      return false;
    }

    /* Primarily used to test functionality
      Displays every classification w Price code in the classifications arrray*/
    public static function printClassifications() {
      foreach(array_keys(self::$classifications) as $classification)
        echo "Classification: ".$classification.", Price Code: ".self::getPriceCode($classification)."<br>";
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
    Returns the requested classification price code if classification exists
    else returns -1
    */
    public static function getPriceCode($classification) {
      if(self::classificationExists($classification)) return self::$classifications[$classification];
      return -1;
    }
  }
?>
