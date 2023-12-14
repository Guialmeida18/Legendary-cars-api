<?php
                     // conexao com banco de dados

namespace App\Infra\Database; //Define o namespace onde a classe

use \PDO; //Importa a classe PDO para usar no código.
use \PDOException; //Importa a classe PDOException para capturar exceções relacionadas ao PDO.

class Connector // Inicia a definição da classe Connector.
{
    private $username; //Declara uma propriedade privada chamada $username
    private $password; //Declara uma propriedade privada chamada $password
    private $dbname; // Declara uma propriedade privada chamada $dbname
    private $host; // Declara uma propriedade privada chamada $host

    public PDO $pdo; // Declara uma propriedade pública chamada $pdo

    public function __construct($username, $password, $dbname, $host) //Método construtor da classe. É chamado automaticamente quando um objeto da classe é instanciado.
    {
        $this->username = $username; //Atribui o valor do parâmetro $username à propriedade
        $this->password = $password; //Atribui o valor do parâmetro $password
        $this->dbname = $dbname; // Atribui o valor do parâmetro $dbname
        $this->host = $host; //atribui o valor do parametro $host

        $this->connect(); //Chama o método connect() para estabelecer a conexão com o banco de dados imediatamente após a instância ser criada.
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password); //Cria uma nova instância de PDO para estabelecer a conexão com o banco de dados MySQL usando as credenciais fornecidas.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Configura o modo de erro para lançar exceções em caso de erros no PDO.
        } catch (PDOException $e) {
            die($e->getMessage()); //Captura exceções do tipo PDOException que podem ocorrer durante a conexão e encerra a execução do script, exibindo a mensagem de erro.
        }

    }

    public function execute($query, $params = []) //Método que prepara e executa uma consulta SQL.
    {
        try {
            $statement = $this->pdo->prepare($query); //: Prepara a consulta SQL usando a instância PDO.
            $statement->execute($params); // Executa a consulta SQL com os parâmetros fornecidos.

            return $statement; // Retorna o objeto PDOStatement resultante.
        } catch (PDOException $e) {
            die($e->getMessage()); //Captura exceções do tipo PDOException que podem ocorrer durante a execução da consulta e encerra a execução do script, exibindo a mensagem de erro.
        }
    }

    public function create($values) //Método que insere um novo registro na tabela "cars"
    {
        $fields = array_keys($values); //Obtém as chaves do array associativo $values (nomes dos campos).
        $binds = array_pad([], count($fields), "?"); // Cria um array de placeholders ? para serem usados na consulta.

        $query = "INSERT INTO cars " . "(" . implode(",", $fields) . ") VALUES (" . implode(",", $binds) . ")"; // Monta a consulta SQL de inserção com base nos nomes dos campos e nos placeholders.

        $this->execute($query, array_values($values)); //Executa a consulta SQL, substituindo os placeholders pelos valores correspondentes.

        return $this->pdo->lastInsertId(); //: Retorna o ID do último registro inserido.
    }

    public function find($id) ///Método que busca um registro na tabela "cars" com base no ID.
    {
        $query = "SELECT * FROM cars WHERE id = ?"; //Consulta SQL para selecionar um registro com um ID específico.

        return $this->execute($query, [$id]); // Chama o método execute para executar a consulta SQL, passando o ID como parâmetro.
    }

    public function list() //Método que lista todos os registros na tabela "cars".
    {
        $query = "SELECT * FROM cars "; //Consulta SQL para selecionar todos os registros da tabela "cars".

        return $this->execute($query); // Chama o método execute para executar a consulta SQL.
    }

    public function edit($id, $values) // Método que atualiza um registro na tabela "cars" com base no ID.
    {
        $values = array_filter($values, function ($item){ //Remove os valores nulos do array $values.
            return $item !== null;
        });

        $fields = array_keys($values); //Obtém as chaves do array associativo $values (nomes dos campos a serem atualizados).

        $query = "UPDATE cars SET " . implode("=?, ", $fields) . "=? WHERE id = ?"; // Monta a consulta SQL de atualização com base nos nomes dos campos.

        $values[] = $id; //Adiciona o ID como último valor no array $values.

         $this->execute($query, array_values($values)); // Executa a consulta SQL, substituindo os placeholders pelos valores correspondentes.

         return true; //Retorna true para indicar que a operação de edição foi bem-sucedida.
    }

    public function delete($id) //  Método que exclui um registro na tabela "cars" com base no ID.
    {
        $query = "DELETE FROM cars WHERE `id` = ?"; // Consulta SQL para excluir um registro com um ID específico.

        $this->execute($query, [$id]); //Executa a consulta SQL, passando o ID como parâmetro.

        return true; //Retorna true para indicar que a operação de exclusão foi bem-sucedida.
    }
}