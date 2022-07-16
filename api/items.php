<?php
$query = "SELECT * FROM items";
$items = $sql->getItems($query);
exit(json_encode($items));
