<?php

// this is just an example php class

class NameOfClass // note how the name is capitalized
{
  public $_publicProperty = "Default value";
  private $_privateProperty;

  public function __construct(/* inputs */)
  {
    // run this function when the class is initiated
  }

  public function nameOfMethod() // note how the name is capitalized and differs from the name of the class
  {
    // a class method
  }

  public function anotherFunction()
  {
    // accessing a class property
    ++$this->_publicProperty;
  }
}

// Creating a new object
$object = new NameOfClass(/* inputs */);

// Accessing the object methods
$object->nameOfMethod(/* inputs */);
$object->nameOfMethod();

?>
