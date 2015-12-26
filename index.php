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
                        função <span>connect()</span>, alterar as variáveis <span>$sgbd</span>, 
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
                        <span>connectr()</span>, change the variables 
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
                    <p>No arquivo <span>php/minpdo.php</span> temos as funções <span>connect()</span>,
                        <span>update()</span>, <span>consult()</span> e <span>delete()</span>. Segue suas definições:</p>
                    <p><span><b>connect()</b></span>: Não recebe nenhum parâmetro, serve para conectar ao banco de dados;</p>
                    <p><span><b>update()</b></span>: Tem a definição <span>function update($table, $columns, $values, $where)</span>,
                        onde <span>$columns</span> e <span>$values</span> podem ser arrays ou não, e <span>$where</span> tem a possibilidade
                        de receber ou nao ' '(aspas). O objetivo da função é atualizar dados de uma tabela;</p>
                    <p><span><b>consult()</b></span>: Tem a definição <span>function consultar($table, $column = "*", $where = NULL, $order = NULL, $limit = NULL, $like = NULL)</span>,
                        onde o valor <span>$column</span> pode receber NULL, '*' ou uma coluna do banco,
                        <span>$where</span>  tem a possibilidade de receber ou nao ' '(aspas),
                        <span>$order</span> deve receber o nome da coluna e um sinal de + ou - (ASC e DESC, respectivamente),
                        exemplo: 'id-',<span>$limit</span> recebe um valor numérico para adotar um limite da consulta e
                        <span>$like</span> recebe a expreção 'busca', '%busca' ou '%busca%' . O objetivo da função é consultar dados
                        de uma tabela e retornar um array com o resultado;</p>

                    <p><span><b>insert()</b></span>: Tem a definição <span>function inserir($table, $column, $values)</span>,
                        onde <span>$column</span> e <span>$values</span> podem ser arrays ou não, 
                        serve para inserir dados em uma tabela do banco de dados;</p>
                    <p><span><b>delete()</b></span>:  Tem a definição <span>function deletar($table, $where = NULL)</span>,
                        onde <span>$where</span> tem a possibilidade de receber ou não ' '(aspas), e caso seja NULL apagará a tabela intera,
                        serve para deletar dados ou uma tabela do banco de dados;</p>

                </article>
            </section>
            <section class="conteudo">
                <nav class="titulo">
                    <h5>Functions</h5>
                </nav>
                <article>
                    <p>
                        In <span>php/minpdo.php</span> file functions we
                        <span>connect()</span>,
                        <span>update()</span>, <span>consult()</span> and <span>delete()</span>. 
                        Follows your settings:
                    </p>
                    <p>
                        <span><b>connect()</b></span>:
                        You do not receive any parameters, serves to connect to the database;
                    </p>

                    <p><span><b>update()</b></span>:
                        Has the definition <span>function update($table, $columns, $values, $where)</span>, 
                        where <span>$column</span> and  <span>$values</span> may be arrays or not,
                        and <span>$where</span> has the ability to receive or not '' (quote).
                        The purpose of the function is to update data in a table;

                    <p><span><b>consult()</b></span>: 
                        Has the definition <span>function consult($table, $column = "*", $where = NULL, $order = NULL, $limit = NULL, $like = NULL)</span>
                        where the value <span>$column</span> can receive NULL,
                        '*' or a column of the bank, <span>$where</span> have the ability to receive or not '' (quote),
                        <span>$order</span> to receive the column name and a + or - sign (ASC and DESC, respectively),
                        ie 'id-' <span>$limit</span> receives a numerical value to adopt a query limit and
                        <span>$like</span> expression like 'search', '% search' or '% search%'. The purpose of the function is to query data from a table and returns an array with the result;

                    <p><span><b>insert()</b></span>: 
                        Has the definition <span>function insert($table, $columns, $values)</span>
                        of <span>$columns</span> and <span>$values</span> may be arrays or not,
                        serves to insert data into a table from the database;
                    <p><span><b>delete()</b></span>: 
                        Has the definition <span>function delete($table, $where = NULL)</span>,
                        where <span>$where</span> have the possibility of receiving a '' (quotes),
                        and if NULL delete the interaction table serves to delete data or a database table data;
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
                        To illustrate the operation run the script minpdo.sql in your database, then
                        <a href="exemplo.php">click here</a>.
                    </p>
                </article>
            </section>
        </section>
    </body>
</html>
