<?php
function conectar()
{
    $sgbd = "mysql";
    $dbhost = "localhost";
    $dbname = "minpdo";
    $dbuser = "root";
    $dbpass = "";
    try
    {
        $conn = new PDO("{$sgbd}:host={$dbhost};dbname={$dbname};charset=utf8;", $dbuser, $dbpass);
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    }
    catch (PDOException $ex)
    {
        echo "<br>Erro de conexão: " . $ex->getMessage();
        return false;
    }
}

function atualizar($tabela, $colunas, $valores, $where)
{
    $sucesso = false;
    $sql = null;
    if(!function_exists("conectar"))
    {   //falta include de conexao.php
        echo "Não há uma conexão ativa com o seu banco de dados!\n<br><i>Inclua a página ../conexao.php<br>";
        return false;
    }
    else
    {
        if(is_array($colunas) and is_array($valores))
        {
            if((count($colunas)) == (count($valores)))
            {
                //montar SQL
                $totalValores = count($colunas); //conta quantos valores
                $expressao = null;
                for($i = 0; $i < $totalValores; $i++)
                {
                    $expressao = $expressao."{$colunas[$i]}=:valor{$i},";     
                }
                
                $expressao = substr($expressao, 0, -1); // remove a última virgula
                
                $tabela = "UPDATE ".$tabela." "; // vai montando minha sql
                $expressao = " SET ".$expressao." ";// vai montando minha sql
                $where = minwhere($where);
                echo $sql = $tabela.$expressao.$where; // monta sql (ate aqui tudo bem)
                $sucesso = true;
            }
            else
            {
                echo "<br>Presicamos ter o mesmo número de colunas e valores</br>";
                return false;
            } 
        }
        else if(is_array($colunas) and !is_array($valores))
        {
            echo "<br>'valores' precisa ser um array.</br>";
        }
        else if(!is_array($colunas) and is_array($valores))
        {
            echo "<br>'colunas' precisa ser um array.</br>";
        }
        else
        {
            $tabela = "UPDATE {$tabela} ";
            $coluna = "SET {$colunas}";
            $valor = "  = :valor0 ";
            $where = minwhere($where);
            echo $sql = $tabela.$coluna.$valor.$where;
            
            if($conn = conectar()) // se conectar
            {
                $stmt = $conn->prepare($sql); //prepara
                $stmt->bindParam(":valor0", $valores);
                
                if($result = $stmt->execute())
                    echo "<br>Atualizado!<br>";
                if(!$result)
                {
                    var_dump($stmt->errorInfo());
                    exit;
                }
                $conn = null;
                return true;
            }
            else
            {
                echo "<br>Não foi possível conectar-se ao banco de dados!<br>\n<i>Verifique as variáveis do arquivo ../conexao.php</i>";
                return false;
            }
        }

        if($sucesso == true)
        {
            if($conn = conectar()) // se conectar
            {
                $stmt = $conn->prepare($sql); //prepara
                for($i = 0; $i < $totalValores; $i ++)
                { //substitui o bind criado
                    if(is_string($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_STR);
                    else if(is_numeric($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_INT);
                    else if(is_bool($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i]);
                    else if(is_null($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_NULL);
                    else if(is_long($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_LOB);
                }
                if($result = $stmt->execute())
                    echo "<br>Atualizado!<br>";
                if(!$result)
                {
                    var_dump($stmt->errorInfo());
                    exit;
                }
                
                $conn = null;
                return true;
            }
            else
            {
                echo "<br>Não foi possível conectar-se ao banco de dados!<br>\n<i>Verifique as variáveis do arquivo ../conexao.php</i>";
                return false;
            }
        }
    }
};

function consultar($tabela, $coluna = "*", $where = NULL, $ordem = NULL, $limite = NULL, $like = NULL)
{
    if(!function_exists("conectar"))
    {   //falta include de conexao.php
        echo "Não há uma conexão ativa com o seu banco de dados!\n<br><i>Inclua a página ../conexao.php<br>";
        return false;
    }
    else
    {
        //conexao feita
        if($tabela)
            $tabela = "FROM ".$tabela." ";
        else
        {
            echo "<br>Não foi indicada nenhum tabela.<br>";
            return false;
        }
        
        if($coluna)
            $coluna = "SELECT ".$coluna." ";
        else
            $coluna = "SELECT * ";
        
        $where = minwhere($where);
        
        if($ordem)
        {
            $c = substr($ordem, -1);
            $ordem = substr($ordem, 0, -1);
            if($c == "+")
                $ordem = "ORDER BY ".$ordem." ASC ";
            else if($c == "-")
                $ordem = "ORDER BY ".$ordem." DESC ";
            else
            {
                echo "<br>Informe +/- no final da variável ordem!<br>";
                return false;
            }
        }
        else
            $ordem = NULL;
        
        if($limite)
        {
            if(is_numeric($limite))
                $limite = "LIMIT ".$limite." ";
            else
            {
                echo "<br>Informe um limite númerico!<br>";
                return false;
            }
        }
        else
            $limite = NULL;
        
        if($like)
        {
            $like = " LIKE '".$like."' ";
        }  
        else
            $like = NULL;
        
        $sql = $coluna.$tabela.$where.$like.$ordem.$limite;
            
        if($conn = conectar())
        {
            if($result = $conn->query($sql))
            {
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                if(empty($rows))
                    echo "<br>Sem resultados!<br>";
                $conn = null;
                var_dump($rows);                
                return $rows;
            }
            else
            {
                echo "<br>Sem resultados!<br>";
                return false;
            }  
        }
        else
        {
            echo "<br>Não foi possível conectar-se ao banco de dados!<br>\n<i>Verifique as variáveis do arquivo ../conexao.php</i>";
            return false;
        }
    }
};


function inserir($tabela, $colunas, $valores)
{
    $sucesso = false;
    if(!function_exists("conectar"))
    {   //falta include de conexao.php
        echo "Não há uma conexão ativa com o seu banco de dados!\n<br><i>Inclua a página ../conexao.php<br>";
        return false;
    }
    else
    {
        if(is_array($colunas) and is_array($valores))
        {
            if((count($colunas)) == (count($valores)))
            {
                // montar SQL
                $totalValores = count($valores);
                $valor = null;
                for($i = 0; $i < $totalValores; $i++)
                {
                    $valor = $valor.":valor{$i},";
                }
                $valor = substr($valor, 0, -1); // remove a última virgula
                
                    $tabela = "INSERT INTO ".$tabela." ";
                    $coluna = "(".implode(", ", $colunas).")";
                    $valor = " VALUES(".$valor.")";
                    echo $sql = $tabela.$coluna.$valor;
                    $sucesso = true;
            }
            else
            {
                echo "<br>Presicamos ter o mesmo número de colunas e valores</br>";
                return false;
            } 
        }
        else if(is_array($colunas) and !is_array($valores))
        {
            echo "<br>'valores' precisa ser um array.</br>";
        }
        else if(!is_array($colunas) and is_array($valores))
        {
            echo "<br>'colunas' precisa ser um array.</br>";
        }
        else
        {
            $tabela = "INSERT INTO {$tabela} ";
            $coluna = "({$colunas})";
            $valor = " VALUES(:valor0)";
            echo $sql = $tabela.$coluna.$valor;
            
            if($conn = conectar()) // se conectar
            {
                $stmt = $conn->prepare($sql); //prepara
                $stmt->bindParam(":valor0", $valores);
                
                if($result = $stmt->execute())
                    echo "<br>Inserido!<br>";
                if(!$result)
                {
                    var_dump($stmt->errorInfo());
                    exit;
                }
                $conn = null;
                return true;
            }
            else
            {
                echo "<br>Não foi possível conectar-se ao banco de dados!<br>\n<i>Verifique as variáveis do arquivo ../conexao.php</i>";
                return false;
            }
        }

        if($sucesso == true)
        {
            echo $sql = $tabela.$coluna.$valor;
            if($conn = conectar())
            {
                $stmt = $conn->prepare( $sql );
                for($i = 0; $i < $totalValores; $i ++)
                {
                    if(is_string($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_STR);
                    else if(is_numeric($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_INT);
                    else if(is_bool($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i]);
                    else if(is_null($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_NULL);
                    else if(is_long($valores[$i]))
                        $stmt->bindParam(":valor{$i}", $valores[$i], PDO::PARAM_LOB);
                }
                if($result = $stmt->execute())
                    echo "<br>Inserido!<br>";
                if(!$result)
                {
                    var_dump($stmt->errorInfo());
                    exit;
                }
                $conn = null;
                return true;
            }
            else
            {
                echo "<br>Não foi possível conectar-se ao banco de dados!<br>\n<i>Verifique as variáveis do arquivo ../conexao.php</i>";
                return false;
            }
        }
        
    }
};


function deletar($tabela, $where = NULL)
{
    if(!function_exists("conectar"))
    {   //falta include de conexao.php
        echo "Não há uma conexão ativa com o seu banco de dados!\n<br><i>Inclua a página ../conexao.php<br>";
        return false;
    }
    else
    {
        //conexao feita
        if($tabela)
            $tabela = "DELETE FROM ".$tabela." ";
        else
        {
            echo "<br>Não foi indicada nenhum tabela.<br>";
            return false;
        }
        
        $where = minwhere($where);

        echo $sql = $tabela.$where;
            
        if($conn = conectar())
        {
            if($result = $conn->query($sql))
            {
                $stmt = $conn->prepare( $sql );
                if($result = $stmt->execute())
                        echo "<br>Deletado!<br>";
                else
                    echo "<br>Query inválida!<br>";
                
                $conn = null;
                return true;
            }
            else
            {
                echo "<br>Query inválida!<br>";
                return false;
            }  
        }
        else
        {
            echo "<br>Não foi possível conectar-se ao banco de dados!<br>\n<i>Verifique as variáveis do arquivo ../conexao.php</i>";
            return false;
        }
    }
};

function minwhere($where)
{
    if($where)
    {
        $newwhere = "";
        if(stripos($where, "where") !== false)
        {
            if(!strstr($where, "'"))
            {
                $arr1 = preg_split("/([^\w]+\s*)/", $where, -1, PREG_SPLIT_DELIM_CAPTURE);
                for($j = 0; $j < count($arr1); $j++)
                {
                    if(stripos($arr1[$j], "=") !== false || stripos($arr1[$j], "!") !== false ||
                       stripos($arr1[$j], "<") !== false || stripos($arr1[$j], ">") !== false)
                    {
                        $arr1[$j+1] = "'".$arr1[$j+1]."'";
                    }
                    $newwhere .= " ".$arr1[$j]." ";
                }
            }
            else
                $newwhere = $where;
        }
        else
        {
            $newwhere = "WHERE ";
            if(!strstr($where, "'"))
            {
                $arr1 = preg_split("/([^\w]+\s*)/", $where, -1, PREG_SPLIT_DELIM_CAPTURE);
                for($j = 0; $j < count($arr1); $j++)
                {
                    if(stripos($arr1[$j], "=") !== false || stripos($arr1[$j], "!") !== false ||
                       stripos($arr1[$j], "<") !== false || stripos($arr1[$j], ">") !== false)
                    {
                        $arr1[$j+1] = "'".$arr1[$j+1]."'";
                    }
                    $newwhere .= " ".$arr1[$j]." ";
                }
            }
            else
                $newwhere = "WHERE ".$where;

        }
       
    }   
    else
        $newwhere = NULL;  

return $newwhere;
};

?>

