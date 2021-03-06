<?php

require_once('Movie.php');
require_once('Rental.php');
require_once('Customer.php');
// New
require_once('Movie_Classifications.php');
require_once('Points.php');
require_once('Price.php');

$rental1 = new Rental(
    new Movie(
        'Back to the Future',
        Movie::CHILDRENS,
        "CHILDRENS"
    ), 4
);

$rental2 = new Rental(
    new Movie(
        'Office Space',
        Movie::REGULAR,
        "REGULAR"
    ), 3
);

$rental3 = new Rental(
    new Movie(
        'The Big Lebowski',
        Movie::NEW_RELEASE,
        "NEW_RELEASE"
    ), 5
);

/*$rental4 = new Rental(
  new Movie(
    'Indiana Jones and the Crystal Skull',
    0,
    "ADVENTURE"
  ), 3
);*/

$customer = new Customer('Joe Schmoe');

$customer->addRental($rental1);
$customer->addRental($rental2);
$customer->addRental($rental3);
//$customer->addRental($rental4);

//echo $customer->statement();
echo $customer->htmlStatement();
//var_dump($customer->rentals());
echo "<br>";
/*
Movie_Classifications::printClassifications();
echo "<br>";
echo(price::calculatePrice($rental1));
echo "<br>";
echo(price::calculatePrice($rental2));
echo "<br>";
echo(price::calculatePrice($rental3));
*/
