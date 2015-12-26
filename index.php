<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Introdução ao MinPDO</title>
        <link rel="stylesheet" href="css/estilo.css"/>
    </head>
    <body>
        <header class="topo">
            <h3>Obrigado por baixar o MinPDO</h3>
        </header>
        <section class="corpo">
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Introdução</h5>
                </nav>
                <article>
                    <p>Você baixou o repositório <span>MinPDO</span>, nele encontramos uma série de funções destinadas
                    a ajudar iniciantes na linguagem PHP na integração de suas aplicações mais rapidamente e
                    de maneira segura, sem ter grande conhecimento de SQL.</p>
                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Introduction</h5>
                    
                </nav>
                <article>
                    <p>You downloaded the <span>MinPDO</span> repository, it found a number of functions designed to help beginners
                    in PHP language to integrate their applications more rapidly and securely, without having great
                    knowledge of SQL.</p>
                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Configuração</h5>
                </nav>
                <article>
                    <p>A configuração inicial é simples, basta abrir o arquivo <span>minpdo.php</span> e na 
                        função <span>conectar()</span>, alterar as variáveis <span>$sgbd</span>, 
                        <span>$dbhost</span>, <span>$dbname</span>, <span>$dbuser</span>, <span>$dbpass</span>
                         para suas credenciais do banco de dados.
                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Configuration</h5>
                </nav>
                <article>
                   <p>The initial setup is simple, just open the main file <span>minpdo.php</span> and function 
                   <span>conectar()</span>, change the variables 
                   <span>$sgbd</span>, 
                        <span>$dbhost</span>, <span>$dbname</span>, <span>$dbuser</span>, <span>$dbpass</span> for your database credentials.
                </p>
                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Funções</h5>
                </nav>
                <article>
                    <p>No arquivo <span>php/minpdo.php</span> temos as funções <span>conectar()</span>,
                    <span>atualizar()</span>, <span>consultar()</span>, <span>deletar()</span> e 
                    <span>minwhere()</span>. Segue suas definições:</p>
                    <p><span><b>conectar()</b></span>: Não recebe nenhum parâmetro, serve para conectar ao banco de dados;</p>
                    <p><span><b>atualizar()</b></span>: Tem a definição <span>function atualizar($tabela, $colunas, $valores, $where)</span>,
                        onde <span>$colunas</span> e <span>$valores</span> podem ser arrays ou não, e <span>$where</span> tem a possibilidade
                        de receber ou nao ' '(aspas). O objetivo da função é atualizar dados de uma tabela;</p>
                    <p><span><b>consultar()</b></span>: Tem a definição <span>function consultar($tabela, $coluna = "*", $where = NULL, $ordem = NULL, $limite = NULL, $like = NULL)</span>,
                        onde o valor <span>$coluna</span> pode receber NULL, '*' ou uma coluna do banco,
                        <span>$where</span>  tem a possibilidade de receber ou nao ' '(aspas),
                        <span>$ordem</span> deve receber o nome da coluna e um sinal de + ou - (ASC e DESC, respectivamente),
                        exemplo: 'id-',<span>$limite</span> recebe um valor numérico para adotar um limite da consulta e
                        <span>$like</span> recebe a expreção 'busca', '%busca' ou '%busca%' . O objetivo da função é consultar dados
                        de uma tabela e retornar um array com o resultado;</p>
                    
                    <p><span><b>inserir()</b></span>: Tem a definição <span>function inserir($tabela, $colunas, $valores)</span>,
                        onde <span>$colunas</span> e <span>$valores</span> podem ser arrays ou não, 
                        serve para inserir dados em uma tabela do banco de dados;</p>
                    <p><span><b>deletar()</b></span>:  Tem a definição <span>function deletar($tabela, $where = NULL)</span>,
                        onde <span>$where</span> tem a possibilidade de receber ou não ' '(aspas), e caso seja NULL apagará a tabela intera,
                        serve para deletar dados ou uma tabela do banco de dados;</p>
                    <p><span><b>minwhere()</b></span>: Tem a definição <span>function minwhere($where)</span>,
                        é uma função interna as anteriores, não deve ser usada diretamente;</p>

                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Functions</h5>
                </nav>
                <article>
                    <p>
                    In <span>php/minpdo.php</span> file functions we
                    <span>conectar()</span>,
                    <span>atualizar()</span>, <span>consultar()</span>, <span>deletar()</span> e 
                    <span>minwhere()</span>. Follows your settings:
                    </p>
                    <p>
                        <span><b>conectar()</b></span>:
                        You do not receive any parameters, serves to connect to the database;
                    </p>
                    
                    <p><span><b>atualizar()</b></span>:
                        Has the definition <span>function atualizar($tabela, $colunas, $valores, $where)</span>, 
                        where <span>$colunas</span> and  <span>$valores</span> may be arrays or not,
                        and <span>$where</span> has the ability to receive or not '' (quote).
                        The purpose of the function is to update data in a table;
                        
                    <p><span><b>consultar()</b></span>: 
                        Has the definition <span>function consultar($tabela, $coluna = "*", $where = NULL, $ordem = NULL, $limite = NULL, $like = NULL)</span>
                        where the value <span>$coluna</span> can receive NULL,
                        '*' or a column of the bank, <span>$where</span> have the ability to receive or not '' (quote),
                        <span>$ordem</span> to receive the column name and a + or - sign (ASC and DESC, respectively),
                        ie 'id-' <span>$limite</span> receives a numerical value to adopt a query limit and
                        <span>$like</span> expression like 'search', '% search' or '% search%'. The purpose of the function is to query data from a table and returns an array with the result;
                    
                    <p><span><b>inserir()</b></span>: 
                        Has the definition <span>function inserir($tabela, $colunas, $valores)</span>
                        of <span>$colunas</span> and <span>$valores</span> may be arrays or not,
                        serves to insert data into a table from the database;
                    <p><span><b>deletar()</b></span>: 
                        Has the definition <span>function deletar($tabela, $where = NULL)</span>,
                        where <span>$where</span> have the possibility of receiving a '' (quotes),
                        and if NULL delete the interaction table serves to delete data or a database table data;
                    <p><span><b>minwhere()</b></span>: 
                        
                        Has the definition <span>function minwhere($where)</span>
                        is an internal function of the above should not be used directly;
                </article>
            </section>
            
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Exemplo</h5>
                </nav>
                <article>
                    <p>
                        Para exemplificar o funcionamento execute o script <span>minpdo.sql</span> no seu banco
                        de dados, em seguida <a href="exemplo.php">clique aqui</a>.
                    </p>
                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Example</h5>
                </nav>
                <article>
                    <p>
                        To illustrate the operation run the script min pdo.sql in your database, then
                        <a href="exemplo.php">click here</a>.
                    </p>
                </article>
            </section>
        </section>
    </body>
</html>
