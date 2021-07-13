<?php

require_once('Movie.php');
require_once('Rental.php');
require_once('Customer.php');
// New
require_once('Movie_Classifications.php');

$rental1 = new Rental(
    new Movie(
        'Back to the Future',
        Movie::CHILDRENS
    ), 4
);

$rental2 = new Rental(
    new Movie(
        'Office Space',
        Movie::REGULAR
    ), 3
);

$rental3 = new Rental(
    new Movie(
        'The Big Lebowski',
        Movie::NEW_RELEASE
    ), 5
);

$customer = new Customer('Joe Schmoe');

$customer->addRental($rental1);
$customer->addRental($rental2);
$customer->addRental($rental3);

echo $customer->statement();
echo $customer->htmlStatement();


Movie_Classifications::addClassification("HORROR", 4);
Movie_Classifications::printClassifications();
echo "<br>";
Movie_Classifications::removeClassification("REGULAR");
Movie_Classifications::addClassification("ADVENTURE", 5);
Movie_Classifications::printClassifications();
echo "<br>";
Movie_Classifications::setPriceCode("ADVENTURE", 6);
Movie_Classifications::printClassifications();
echo "<br>";
