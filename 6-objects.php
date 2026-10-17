<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
class Car {
  public $color;
  public $model;
  public function __construct($color, $model) {
    $this->color = $color;
    $this->model = $model;
  }
  public function message() {
    return "My car is a " . $this->color . " " . $this->model . "!";
  }
}

$myCar = new Car("red", "Volvo");
// var_dump($myCar);
echo '<br/>';
echo $myCar->color . ' ' . $myCar->model . '<br/>';
echo $myCar->message();

?>

</body>
</html>