<?php

namespace App\Framework;

use App\Framework\Utilities\Str;

class Repository
{
    /** @var \PDO */
    private $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function create(array $data)
    {
        $keys = implode(',', array_keys($data));
        $placeholders = array_fill(0, sizeof($data), '?');
        $placeholders = implode(',', $placeholders);

        $stmt = $this->dbh->prepare("INSERT INTO {$this->getTable()} ($keys) VALUES ($placeholders)");

        $stmt->execute(array_values($data));

        $model = $this->getModelName();

        return $model::create(array_merge($data, ['id' => $this->dbh->lastInsertId()]));
    }

    public function findBy($key, $value)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM {$this->getTable()} WHERE $key=?");

        $stmt->execute([$value]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        $model = $this->getModelName();

        return $model::create($result);
    }

    public function getTable()
    {
        return Str::shortName($this)
            ->replace('Repository', 's')
            ->toLower()
            ->toString();
    }

    public function getModelName()
    {
        return Str::shortName($this)
            ->replace('Repository', '')
            ->prepend('\\App\\Models\\')
            ->toString();
    }
}