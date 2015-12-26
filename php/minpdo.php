<?php

class MinPDOException extends ErrorException {}

class MinPDO {

    public static $sgbd = "mysql";
    public static $dbhost = "localhost";
    public static $dbname = "minpdo";
    public static $dbuser = "root";
    public static $dbpass = "";

    public static function connect() {
        try {
            $conn = new PDO(self::$sgbd.":host=".self::$dbhost.";dbname=".self::$dbname.";charset=utf8;", self::$dbuser, self::$dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $conn;
        } catch (PDOException $ex) {
            throw new MinPDOException($ex->getMessage());
        }
    }

    public static function update($table, $columns, $values, $where = NULL) {
        $sucess = false;
        $sql = null;
        if (is_array($columns) and is_array($values)) {
            if ((count($columns)) == (count($values))) {
                //montar SQL
                $valuesTotal = count($columns); //conta quantos valores
                $expression = null;
                for ($i = 0; $i < $valuesTotal; $i++) {
                    $expression = $expression . "{$columns[$i]}=:value{$i},";
                }

                $expression = substr($expression, 0, -1); // remove a última virgula

                $table = "UPDATE " . $table . " "; // vai montando minha sql
                $expression = " SET " . $expression . " "; // vai montando minha sql
                $where = self::minwhere($where);
                $sql = $table . $expression . $where; // monta sql (ate aqui tudo bem)
                $sucess = true;
            } else {
                throw new MinPDOException("We must have the same number of columns and values.");
            }
        } else if (is_array($columns) and ! is_array($values)) {
            throw new MinPDOException("'values' must be an array.");
        }
            
        else if (!is_array($columns) and is_array($values)) {
            throw new MinPDOException("'columns' must be an array.");
        }
            
        else {
            $table = "UPDATE {$table} ";
            $coluna = "SET {$columns}";
            $value = "  = :value0 ";
            $where = self::minwhere($where);

            $sql = $table . $coluna . $value . $where;

            if ($conn = self::connect()) { // se conectar
                $stmt = $conn->prepare($sql); //prepara
                $stmt->bindParam(":value0", $values);

                if ($result = $stmt->execute()) {
                    return true;
                }
                    
                if (!$result) {
                    throw new MinPDOException($stmt->errorInfo());
                }
                
                $conn = null;
                return true;
            } else {
                throw new MinPDOException("Unable to connect to database!<br>\n<i>Check the connection variables.");
            }
        }

        if ($sucess == true) {
            if ($conn = self::connect()) { // se conectar
                $stmt = $conn->prepare($sql); //prepara
                self::bind($stmt, $valuesTotal, $values);
                
                if ($result = $stmt->execute()) {
                    return true;
                }
                if (!$result) {
                    throw new MinPDOException($stmt->errorInfo());
                }

                $conn = null;
                return true;
            } else {
                throw new MinPDOException("Unable to connect to database! Check the connection variables.");
            }
        }
    }

    public static function consult($table, $columns = "*", $where = NULL, $order = NULL, $limit = NULL, $like = NULL) {
        //conexao feita
        if ($table) {
            $table = "FROM " . $table . " ";
        }
        else {
            throw new MinPDOException("No table has been indicated.");
        }

        if ($columns) {
            $columns = "SELECT " . $columns . " ";
        }
        else {
            $columns = "SELECT * ";
        }

        $where = self::minwhere($where);

        if ($order) {
            $c = substr($order, -1);
            $order = substr($order, 0, -1);
            if ($c == "+") {
                $order = "ORDER BY " . $order . " ASC ";
            }
            else if ($c == "-") {
                $order = "ORDER BY " . $order . " DESC ";
            }
            else {
                throw new MinPDOException("Tell +/- at the end of variable order!");
            }
        } else {
            $order = NULL;
        }

        if ($limit) {
            if (is_numeric($limit)) {
                $limit = "LIMIT " . $limit . " ";
            }
            else {
                throw new MinPDOException("Enter a numeric limit!");
            }
        } else {
            $limit = NULL;
        }
        
        if ($like) {
            $like = " LIKE '" . $like . "' ";
        } else {
            $like = NULL;
        }

        $sql = $columns . $table . $where . $like . $order . $limit;

        if ($conn = self::connect()) {
            if ($result = $conn->query($sql)) {
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                if (empty($rows)) {
                    throw new MinPDOException("No results!");
                }
                $conn = null;
                return $rows;
            }
            else {
                throw new MinPDOException("No results!");
            }
        } else {
            throw new MinPDOException("Unable to connect to database!<br>\n<i>Check the connection variables.");
        }
    }

    public static function insert($table, $columns, $values) {
        if (is_array($columns) and is_array($values)) {
            if ((count($columns)) == (count($values))) {
                // montar SQL
                $valuesTotal = count($values);
                $value = null;
                for ($i = 0; $i < $valuesTotal; $i++) {
                    $value = $value . ":value{$i},";
                }
                $value = substr($value, 0, -1); // remove a última virgula

                $table = "INSERT INTO " . $table . " ";
                $column = "(" . implode(", ", $columns) . ")";
                $value = " VALUES(" . $value . ")";
                $sql = $table . $column . $value;
                $sucesso = true;
            } else {
                throw new MinPDOException("We must have the same number of columns and values.");
            }
        } else if (is_array($columns) and ! is_array($values)) {
            throw new MinPDOException("'values' must be an array.");
        } else if (!is_array($columns) and is_array($values)) {
            throw new MinPDOException("'columns' must be an array.");
        } else {
            $table = "INSERT INTO {$table} ";
            $column = "({$columns})";
            $value = " VALUES(:value0)";
            $sql = $table . $column . $value;

            if ($conn = self::connect()) { // se conectar
                $stmt = $conn->prepare($sql); //prepara
                $stmt->bindParam(":value0", $values);

                if ($result = $stmt->execute()) {
                    return true;
                }
                if (!$result) {
                    throw new MinPDOException($stmt->errorInfo());
                }
                $conn = null;
                return true;
            } else {
                throw new MinPDOException("Unable to connect to database!<br>\n<i>Check the connection variables.");
            }
        }

        if ($sucesso == true) {
            $sql = $table . $column . $value;
            if ($conn = self::connect()) {
                $stmt = $conn->prepare($sql);
                self::bind($stmt, $valuesTotal, $values);
                if ($result = $stmt->execute()) {
                    return true;
                }
                if (!$result) {
                    throw new MinPDOException($stmt->errorInfo());
                }
                $conn = null;
                return true;
            } else {
                throw new MinPDOException("Unable to connect to database!<br>\n<i>Check the connection variables.");
            }
        }
    }

    public static function delete($table, $where = NULL) {
        if ($table) {
            $table = "DELETE FROM " . $table . " ";
        }
        else {
            throw new MinPDOException("No table has been indicated.");
        }

        $where = self::minwhere($where);

        $sql = $table . $where;

        if ($conn = self::connect()) {
            if ($result = $conn->query($sql)) {
                $stmt = $conn->prepare($sql);
                if ($result = $stmt->execute()) {
                    return true;
                }
                else {
                    throw new MinPDOException("Invalid query!");
                }

                $conn = null;
                return true;
            }
            else {
                throw new MinPDOException("Invalid query!");
            }
        } else {
            throw new MinPDOException("Unable to connect to database!<br>\n<i>Check the connection variables.");
        }
    }

    private static function minwhere($where) {
        if ($where) {
            $newwhere = "";
            if (stripos($where, "where") !== false) {
                if (!strstr($where, "'")) {
                    $arr1 = preg_split("/([^\w]+\s*)/", $where, -1, PREG_SPLIT_DELIM_CAPTURE);
                    for ($j = 0; $j < count($arr1); $j++) {
                        if (stripos($arr1[$j], "=") !== false || stripos($arr1[$j], "!") !== false ||
                            stripos($arr1[$j], "<") !== false || stripos($arr1[$j], ">") !== false) {
                            $arr1[$j + 1] = "'" . $arr1[$j + 1] . "'";
                        }
                        $newwhere .= " " . $arr1[$j] . " ";
                    }
                } else
                    $newwhere = $where;
            }
            else {
                $newwhere = "WHERE ";
                if (!strstr($where, "'")) {
                    $arr1 = preg_split("/([^\w\.\,]+\s*)/", $where, -1, PREG_SPLIT_DELIM_CAPTURE);
                    for ($j = 0; $j < count($arr1); $j++) {
                        if (stripos($arr1[$j], "=") !== false || stripos($arr1[$j], "!") !== false ||
                            stripos($arr1[$j], "<") !== false || stripos($arr1[$j], ">") !== false) {
                            $arr1[$j + 1] = "'" . $arr1[$j + 1] . "'";
                        }
                        $newwhere .= " " . $arr1[$j] . " ";
                    }
                } else
                    $newwhere = "WHERE " . $where;
            }
        } else
            $newwhere = NULL;

        return $newwhere;
    }
    
    private static function bind($stmt, $quantity, $values)
    {
        for ($i = 0; $i < $quantity; $i ++) { //substitui o bind criado
            if (is_string($values[$i]))
                $stmt->bindParam(":value{$i}", $values[$i], PDO::PARAM_STR);
            else if (is_numeric($values[$i]))
                $stmt->bindParam(":value{$i}", $values[$i], PDO::PARAM_INT);
            else if (is_bool($values[$i]))
                $stmt->bindParam(":value{$i}", $values[$i]);
            else if (is_null($values[$i]))
                $stmt->bindParam(":value{$i}", $values[$i], PDO::PARAM_NULL);
            else if (is_long($values[$i]))
                $stmt->bindParam(":value{$i}", $values[$i], PDO::PARAM_LOB);
        }
    }
}

?>
