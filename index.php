<?php
  session_start();
  require_once "lib/Sql.php";
  require_once "lib/Helper.php";
  
  get("api/items","items");
?>