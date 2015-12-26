<?php

include '../php/minpdo.php';

$array = MinPDO::consult("intro", NULL, "id > 1", "id-", "3", "%e%");


echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
