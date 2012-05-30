<?php

class MySQLDatabase {

  private $host = "localhost";
  private $username = "root";
  private $password = "root";
  private $db_name = "guestbook";
  private $connection = false;
  public $last_query;

  function __construct(){
    if(!$this->connection) {
      $connection = mysql_connect($this->host, $this->username, $this->password);
      if($connection) {
        $this->connection = $connection;
        $select_db = mysql_select_db($this->db_name, $connection);
        if($select_db) {
          $this->con = true;
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return true;
    }
  }

  public function disconnect(){
    if($this->connection) {
      if(mysql_close()) {
        $this->connection = false;
        return true;
      } else {
        return false;
      }
    }
  }

  public function query($sql){
    $this->last_query = $sql;
    $result = mysql_query($sql, $this->connection);
    $this->confirm_query($result);
    return $result;
  }

  public function escape_value($value){
    // escape $value for safe use in SQL
  }

  public function fetch_array($result_set){
    return mysql_fetch_array($result_set);
  }

  public function num_rows($result_set){
    return mysql_num_rows($result_set);
  }

  public function insert_id(){
    // get the last id inserted over the current db connection
    return mysql_insert_id($this->connection);
  }

  public function affected_rows(){
    return mysql_affected_rows($this->connection);
  }

  private function confirm_query($result){
    if(!$result){
      $output = "Database query failed: " . mysql_error() . "<br>";
      $output .= "Last SQL query: " . $this->last_query;
      die($output);
    }
  }

}

$database = new MySQLDatabase();
$db =& $database;

?>
