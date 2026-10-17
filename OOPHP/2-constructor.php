<?php
class Fruit {
  public $make;
  public $model;
  public $wheels;
  private $chasisNumber;

  function __construct($make, $model, $wheels, $chasisNumber) {
    $this->make = $make;
    $this->model = $model;
    $this->wheels = $wheels;
    $this->chasisNumber = $chasisNumber;
  }

  function get_details() {
    echo "Make: " . $this->make . ". Model: " . $this->model . ". Wheels: " . $this->wheels . ". Chasis Number: " . $this->chasisNumber . ".<br>";
  }
}

$car = new Fruit('Honda', 'Civic', 4, 'ABC123');
$car->get_details();

// $banana = new Fruit('Banana', 'Yellow');
// $banana->get_details();
?>