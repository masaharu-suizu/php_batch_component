<?php

namespace App\Model;

use App\Mysql;
use PDO;

class TableName
{

    private PDO $dbh;

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function select()
    {
    }

    public function insert()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}