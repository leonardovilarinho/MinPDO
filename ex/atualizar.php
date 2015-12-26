<?php

include '../php/minpdo.php';

atualizar("intro", "param2", "param2", "where id<7 and param1=ele01");

consultar("intro");

echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
