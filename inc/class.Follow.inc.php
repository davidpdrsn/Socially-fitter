<?php

require_once("controller.php");

class Follow {

  protected static $table_name="follow";
  public $follower_id;
  public $following_id;

  // find all and return object
  static public function find_all(){
    return self::find_by_sql("SELECT * FROM " . self::$table_name);
  }

  // find by id and return as object
  static public function find_by_id($follower_id=0){
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE follower_id={$follower_id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  // find by sql statement and return as object
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

  public function unfollow(){
    global $database;
    $sql = "DELETE FROM " . self::$table_name . " ";
    $sql .= "WHERE follower_id=" . $this->follower_id . " AND following_id=" . $this->following_id;
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

}

?>
