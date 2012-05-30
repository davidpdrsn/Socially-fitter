<?php

require_once("controller.php");

class User {

  protected static $table_name="users";
  public $id;
  public $username;
  public $email;
  public $password;

  static public function find_all(){
    return self::find_by_sql("SELECT * FROM users");
  }

  static public function find_by_id($id=0){
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  static public function find_by_sql($sql=""){
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)){
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  static public function authenticate($username="", $password=""){
    global $database;
    // escape username and password
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";

    $result_array = self::find_by_sql($sql);
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  static private function instantiate($record){
    $object = new self();

    /* Simple, long from approach
    $object->id       = $record["id"];
    $object->username     = $record["username"];
    $object->email    = $record["email"];
    $object->password = $record["password"];
     */

    foreach($record as $attribute=>$value){
      if($object->has_attribute($attribute)){
        $object->$attribute = $value;
      }
    }
    return $object;
  }

  static public function username_is_free($username){
    global $database;
    $sql = "SELECT * FROM " . self::$table_name . " ";
    $sql .= "WHERE username='{$username}'";
    $result_set = $database->query($sql);
    if($database->num_rows($result_set) != 0){
      return false;
    } else {
      return true;
    }
  }

  private function has_attribute($attribute){
    $object_vars = $this->attributes();
    return array_key_exists($attribute, $object_vars);
  }

  protected function attributes(){
    // return an array of attribute keys and their values
    return get_object_vars($this);
  }

  public function input_validates($username, $email, $password, $password_repeat){
    $message = "";
    if(!self::username_is_free($username)){
      $message .= "Username already taken. ";
    }
    if($password != $password_repeat){
      $message .= "Passwords did not match. ";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $message .= "Email is not real.";
    }
    $_SESSION["message"] = $message;
    if(strlen($message) > 0){
      $_SESSION["message"] .= " negative";
      return false;
    } else {
      return true;
    }
  }

  public function save(){
    // a new record wont have an id yet
    return isset($this->id) ? $this->update() : $this->create();
  }

  public function create(){
    global $database;
    $attributes = $this->attributes();
    $sql = "INSERT INTO " . self::$table_name . " (";
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    if ($database->query($sql)){
      $this->id = $database->insert_id();
      return true;
    } else {
      return false;
    }
  }

  public function update(){
    global $database;
    $attributes = $this->attributes();
    $attribute_pairs = array();
    foreach($attributes as $key => $value){
      $attribute_pairs[] = "{$key}={$value}";
    }
    $sql = "UPDATE " . self::$table_name . " SET ";
    $sql .= join(", ", $attribute_pairs);
    $sql .= " WHERE id=" . $this->id;
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  public function delete(){
    global $database;
    $sql = "DELETE FROM " . self::$table_name . " ";
    $sql .= "WHERE id=" . $this->id;
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

}

?>
