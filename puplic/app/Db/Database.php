<?php

namespace App\Db;

use PDO;
use PDOException;

class Database {

    /**
     * Host de conexão com o banco de dados
     */
    const HOST = 'crud-mysql'; // Nome do serviço do contêiner MySQL no Docker Compose

    /**
     * Nome do banco de dados
     */
    const NAME = 'crud';

    /**
     * Usuário do banco de dados
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco
     */
    const PASS = 'asdf000';

    /**
     * Nome da tabela a ser manipulada
     */
    private $table;

    /**
     * Instância de conexão com o banco de dados
     */
    private $connection;

    /**
     * Define a tabela e define a conexão
     */
    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Define a tabela e a instância e a conexão
     */
    public function setConnection() {
        try {
            // Cria a conexão PDO
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR' . $e->getMessage());
        }
    }

    /**
     * Método responsável por executar query dentro do banco de dados
     * @param string  $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($sql, $params = []) {
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco
     * @param array  $values [ field => value ]
     * @return interge
     */
    public function insert($values) {
        // DADOS DA QUERY
        $fields = array_keys($values);
        $bindings = array_pad([], count($fields), '?');

        // MONTA A QUERY
        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUES (" . implode(',', $bindings) . ")";

        // EXECUTA O INSERT
        $this->execute($sql, array_values($values));

        // RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    public function select($where = null, $order = 'id DESC', $limit = null, $fields = "*") {
        $whereClause = ($where !== null && strlen($where) > 0) ? 'WHERE ' . $where : '';
        // $orderByClause = ($order !== null && strlen($order) > 0) ? 'ORDER BY ' . $order : '';
        $limitClause = ($limit !== null && strlen($limit) > 0) ? 'LIMIT ' . $limit : '';

        // $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $whereClause . ' ' . $orderByClause . ' ' . $limitClause;
         $sql = "SELECT {$fields} FROM {$this->table} {$whereClause}  ORDER BY id DESC {$limitClause}";
    
        //$sql = "SELECT {$fields} FROM {$this->table} {$whereClause} ORDER BY {$order} {$limitClause}";
        return $this->execute($sql);
    }

    public function update($where, $values) {
        // Separa os campos e valores a serem atualizados
        $fields = array_keys($values);
        $setFields = implode('=?, ', $fields) . '=?';

        // Monta a query de atualização
        $sql = 'UPDATE ' . $this->table . ' SET ' . $setFields . ' WHERE ' . $where;

        // Executa a query
        $this->execute($sql, array_values($values));

        return true;
    }

    public function delete($where) {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $this->execute($sql);
        return true;
    }

    public function selectAll($order = 'id DESC', $limit = null, $fields = "*") {
        $orderByClause = ($order !== null && strlen($order) > 0) ? 'ORDER BY ' . $order : '';
        $limitClause = ($limit !== null && strlen($limit) > 0) ? 'LIMIT ' . $limit : '';

        // Modificado para ordem decrescente em relação ao campo especificado na ordem
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $orderByClause . ' ' . $limitClause;

        return $this->execute($sql);
    }
}
