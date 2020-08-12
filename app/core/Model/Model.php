<?php

namespace App\Core\Model;

use App\Core\Database\Database;

class Model
{
    public function dbConnection()
    {
        return Database::getInstance()->getConnection();
    }

    public function selectAllFromTable($table)
    {
        $stmt = $this->dbConnection()->prepare('SELECT * FROM ' . $table);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function insert($colsValues, $table)
    {
        $this->escapeArray($colsValues);

        $sql = $this->resolveInsertQuery($colsValues, $table);

        $stmt = $this->dbConnection()->prepare($sql);

        foreach ($colsValues as $col => $value) {
            $stmt->bindValue($col, $value);
        }

        $stmt->execute();
    }

    private function resolveInsertQuery($colsValues, $table)
    {
        $cols = array_keys($colsValues);

        $query = 'INSERT INTO ' . $table . ' (';
        $query .= implode(', ', $cols);
        $query .= ') VALUES (';
        array_walk($cols, function (&$col) {
            $col = ':' . $col;
        });
        $query .= implode(', ', $cols) . ' )';

        return $query;
    }

    public function paginationInfo(int $limit, int $currentPage, string $table)
    {
        $total = $this->dbConnection()->query('SELECT COUNT(*) FROM ' . $table)->fetchColumn();
        $countPages = ceil($total / $limit);

        return [
            'total' => $total,
            'count' => $countPages,
            'current' => $currentPage,
        ];
    }

    public function pagination(int $limit, int $currentPage, string $table, $orderColumn, $orderType = 'desc')
    {
        $offset = ($currentPage - 1) * $limit;

        $stmt = $this->dbConnection()->prepare("SELECT * FROM {$table} ORDER BY {$orderColumn} {$orderType} LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    private function escapeArray(array &$values)
    {
        array_walk($values, function (&$value) {
            $value = htmlspecialchars($value);
        });
    }

    public function findByIdInTable(int $id, string $table)
    {
        $stmt = $this->dbConnection()->prepare('SELECT * FROM ' . $table .' WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function update(int $id, string $table, array $colsValues)
    {
        $this->escapeArray($colsValues);

        $sql = $this->resolveUpdateQuery($table, $colsValues);

        $stmt = $this->dbConnection()->prepare($sql);

        foreach ($colsValues as $col => $value) {
            $stmt->bindValue($col, $value);
        }

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();
    }

    public function resolveUpdateQuery(string $table, array $values)
    {
        $sql = "UPDATE {$table} SET ";
        foreach ($values as $column => $value) {
            $sql .= $column.' = :'.$column.', ';
        }
        $sql = substr($sql, 0, -2);
        $sql .= ' WHERE id = :id';

        return $sql;
    }
}