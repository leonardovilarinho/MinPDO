<?php

require '../php/minpdo.php';
try {
    MinPDO::update("intro", "param2", "param2", "where id<7 and param1=ele01");
    $array = MinPDO::consult("intro");
    var_dump($array);
} catch (MinPDOException $ex) {
    echo "Error:".$ex->getMessage();
}

echo "<br><a href=\"../exemplo.php\"><<<<<<<<<<<<</a>";
?>
