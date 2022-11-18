<?php

namespace App\Repositories\MongoDB;

interface IBaseRepository
{
    public function getAll();

    public function getAllWithPaginate($perPage,$page);

    public function findById($id);

    public function insertData($data);

    public function updateData($identity, $data);

    public function deleteData($identity);
}
