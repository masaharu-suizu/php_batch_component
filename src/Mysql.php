<?php

namespace App;

use Exception;
use PDO;
use PDOException;
use Symfony\Component\Yaml\Yaml;

class Mysql
{
    const TYPE_MASTER = 'master';
    /**
     * @param string $dbtype
     * @return PDO
     * @throws Exception
     */
    public function ConnectDatabase(string $dbtype): PDO
    {
        list($host, $port, $dbname, $charset, $user, $password) = $this->readDatabaseConfiguration($dbtype);

        try {
            $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s', $host, $port, $dbname, $charset);
            return new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            $errorCode = 500;
            throw new Exception($e->getMessage(), $errorCode);
        }
    }

    /**
     * @param string $dbtype
     * @return array
     */
    private function readDatabaseConfiguration(string $dbtype): array
    {
        $configuration = Yaml::parseFile(__DIR__.'/../config/app.yaml');
        $detail = $configuration['databases'][$dbtype];

        return [
            $detail['host'],
            $detail['port'],
            $detail['dbname'],
            $detail['charset'],
            $detail['user'],
            $detail['password'],
        ];
    }
}