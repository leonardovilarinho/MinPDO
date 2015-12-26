<?php

require '../php/minpdo.php';

try {
        MinPDO::delete("intro", "id > 3");
} catch (MinPDOException $ex) {
    echo "Error:".$ex->getMessage();
}


echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
