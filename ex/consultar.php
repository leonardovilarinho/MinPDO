<?php

require '../php/minpdo.php';
try {
    $array = MinPDO::consult("intro", NULL, "id > 1", "id-", "3", "%e%");
    var_dump($array);
} catch (MinPDOException $ex) {
    echo "Error:".$ex->getMessage();
}
echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
