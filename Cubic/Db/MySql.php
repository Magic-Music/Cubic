<?php

namespace Cubic\Db;

use \mysqli;

class MySql
{
    private mysqli $connection;

    public function connect(
        string $host,
        string $username,
        string $password,
        string $database = null,
        $port = 3306
    ): void
    {
        $this->connection = new mysqli($host, $username, $password, $database, $port);
    }

    public function query(string $query)
    {
        return $this->connection->query($query);
    }
}