<?php

require '../php/minpdo.php';
try {
    for($i = 0; $i < 7; $i ++)
    {
        MinPDO::insert("intro",
            array("param1", "param2"),
            array("ele01", "ele02"));
    }
} catch (MinPDOException $ex) {
    echo "Error:".$ex->getMessage();
}



echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
