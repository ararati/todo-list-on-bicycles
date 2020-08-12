<?php

namespace App\Models;

class Model extends \App\Core\Model\Model
{
    public function all()
    {
        return $this->selectAllFromTable(static::table);
    }

    public function findById(int $id)
    {
        return parent::findByIdInTable($id, static::table);
    }

    public function paginationDetails($limit, $currentPage)
    {
        return parent::paginationInfo($limit, $currentPage, static::table);
    }

    public function paginate($limit, $currentPage, $orderColumn, $orderType = 'desc')
    {
        $orderType = $orderType === 'desc' ? 'desc' : 'asc';
        $orderColumn = $orderColumn === 'date' ? 'id' : $orderColumn;
        return $this->pagination($limit, $currentPage, static::table, $orderColumn, $orderType);
    }

    protected function updatedById(int $id, string $table, array $values)
    {
        parent::update($id, $table, $values);
    }

}