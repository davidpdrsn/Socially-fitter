<?php

require_once("controller.php");

class Log {

  protected static $table_name="logs";
  public $log_id;
  public $title;
  public $body;
  public $notes;
  public $time;
  public $user_id;
  public $username;
  public $profile_picture;

  // find all
  static public function find_all(){
    return self::find_by_sql("SELECT * FROM " . self::$table_name);
  }

  // find by id
  static public function find_by_id($log_id=0){
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE log_id={$log_id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  // find by sql statement
  static public function find_by_sql($sql=""){
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)){
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  // build a log object from an SQL record and return the object
  static private function instantiate($record){
    $object = new self();
    // loop through each part of the record array and assign the value to a object property
    foreach($record as $attribute=>$value){
      if($object->has_attribute($attribute)){
        $object->$attribute = $value;
      }
    }
    return $object;
  }

  // check if attribute is part of object
  private function has_attribute($attribute){
    $object_vars = $this->attributes();
    return array_key_exists($attribute, $object_vars);
  }

  // return an array of attribute keys and their values
  protected function attributes(){
    return get_object_vars($this);
  }

  // check if input validates and build error message
  public function input_validates(/* INPUT */){
    $message = "";
    if(false){
      $message .= "Error message. ";
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
    // a new record wont have an user_id yet
    return isset($this->user_id) ? $this->update() : $this->create();
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
      $this->user_id = $database->insert_id();
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
    $sql .= " WHERE user_id=" . $this->user_id;
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  public function delete(){
    global $database;
    $sql = "DELETE FROM " . self::$table_name . " ";
    $sql .= "WHERE user_id=" . $this->user_id;
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  public function is_faved(){
    global $database;
    global $session;
    $result = $this->find_by_sql("SELECT user_id, log_id FROM fav WHERE user_id = {$session->user_id} AND log_id = {$this->log_id}");
    return $result;
  }

}

?>
