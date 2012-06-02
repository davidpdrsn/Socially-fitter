<?php

require_once("controller.php");

class User {

  protected static $table_name="users";
  public $user_id;
  public $username;
  public $email;
  public $password;
  public $profile_picture;

  // find all users and return as object
  static public function find_all(){
    return self::find_by_sql("SELECT * FROM " . self::$table_name);
  }

  // find user by user_id and return as object
  static public function find_by_id($user_id=0){
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE user_id={$user_id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }

  // find users by sql statement and return as object
  static public function find_by_sql($sql=""){
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)){
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  // check if username and password matches
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

  // build a user object from an SQL record and return the object
  static private function instantiate($record){
    $object = new self();

    /* Simple, long from approach
    $object->user_id       = $record["user_id"];
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

  // check if username is free
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

  // check if attribute is part of object
  private function has_attribute($attribute){
    $object_vars = $this->attributes();
    return array_key_exists($attribute, $object_vars);
  }

  // return an array of attribute keys and their values
  protected function attributes(){
    return get_object_vars($this);
  }

  // check if signup input validates and build error message
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

  // create the user in the database if it doesn't exist otherwise update it
  public function save(){
    // a new record wont have an user_id yet
    return isset($this->user_id) ? $this->update() : $this->create();
  }

  // create the user in the database
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

  // update the user in the database
  public function update(){
    global $database;
    $attributes = $this->attributes();
    $attribute_pairs = array();
    foreach($attributes as $key => $value){
      $attribute_pairs[] = "{$key}='{$value}'";
    }
    $sql = "UPDATE " . self::$table_name . " SET ";
    $sql .= join(", ", $attribute_pairs);
    $sql .= " WHERE user_id=" . $this->user_id;
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  // delete the user from the database
  public function delete(){
    global $database;
    $sql = "DELETE FROM " . self::$table_name . " ";
    $sql .= "WHERE user_id=" . $this->user_id;
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() == 1) ? true : false;
  }

  public function find_number_of_followers($user_id){
    global $database;
    $result_set = $database->query("SELECT COUNT(follower_id) FROM follow WHERE following_id={$user_id}");
    $result_array = $database->fetch_array($result_set);
    return $result_array["COUNT(follower_id)"];
  }

  public function find_number_of_following($user_id){
    global $database;
    $result_set = $database->query("SELECT COUNT(following_id) FROM follow WHERE follower_id={$user_id}");
    $result_array = $database->fetch_array($result_set);
    return $result_array["COUNT(following_id)"];
  }

  public function has_followers(){
    if($this->find_number_of_followers($this->user_id)){
      return true;
    } else {
      return false;
    }
  }

  public function has_following(){
    if($this->find_number_of_following($this->user_id)){
      return true;
    } else {
      return false;
    }
  }

  public function find_number_of_logs($user_id){
    global $database;
    $result_set = $database->query("SELECT COUNT(user_id) FROM logs WHERE user_id={$user_id}");
    $result_array = $database->fetch_array($result_set);
    return $result_array["COUNT(user_id)"];
  }

  public function is_following($follower_id, $following_id){
    global $database;
    $result_set = $database->query("SELECT user_id FROM users, follow WHERE users.user_id = follow.follower_id AND follow.following_id = {$follower_id} AND follow.follower_id = {$following_id}");
    $result_array = $database->fetch_array($result_set);
    if($result_array){
      return true;
    } else {
      return false;
    }
  }

}

?>
