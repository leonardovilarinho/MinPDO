<?php

include '../php/minpdo.php';
for($i = 0; $i < 7; $i ++)
{
    inserir("intro",
        array("param1", "param2"),
        array("ele01", "ele02"));
}


echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
