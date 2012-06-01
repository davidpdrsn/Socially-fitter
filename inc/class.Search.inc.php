<?php

require_once("controller.php");

class Search extends Log {

  public $query;

  public function search(){
    global $database;
    $search_results = $this->find_by_sql("SELECT username, title, body, notes, time FROM logs, users WHERE logs.user_id = users.user_id AND users.username='{$this->query}' ORDER BY time ASC LIMIT 1 ");
    return $search_results;
  }

}

?>
