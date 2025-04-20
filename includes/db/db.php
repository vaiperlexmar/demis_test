<?php

namespace DB\db;

use PDO;
use PDOException;

class DB
{
    private $connection = null;

    public function __construct(
        string $host = 'localhost',
        string $dbname = 'demis_test',
        string $username = 'root',
        string $password = ''
    ) {
        try {
            $this->connection = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    public function insert(string $statement, array $params = []): int
    {
        try {
            $this->executeStatement($statement, $params);
            return $this->connection->lastInsertId();
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    public function select(string $statement, array $params = [])
    {
        try {
            $stmt = $this->executeStatement($statement, $params);
            return $stmt->fetchAll();
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    public function update(string $statement, array $params = [])
    {
        try {
            $stmt = $this->executeStatement($statement, $params);
            return $stmt->rowCount();
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    public function delete(string $statement, array $params = [])
    {
        try {
            $stmt = $this->executeStatement($statement, $params);
            return $stmt->rowCount();
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    private function executeStatement(string $statement, array $params = [])
    {
        try {
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    private function __clone()
    {
        throw new PDOException("Clone is not allowed.");
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}