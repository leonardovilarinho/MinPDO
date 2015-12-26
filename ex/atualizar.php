<?php

include '../php/minpdo.php';

MinPDO::update("intro", "param2", "param2", "where id<7 and param1=ele01");

MinPDO::consult("intro");

echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
