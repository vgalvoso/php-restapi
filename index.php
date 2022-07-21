<?php
  session_start();
  require_once "lib/sql.php";
  require_once "lib/helper.php";
  
  route("/","api/items");
?>