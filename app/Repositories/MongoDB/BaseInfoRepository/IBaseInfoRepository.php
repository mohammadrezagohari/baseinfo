<?php

namespace App\Repositories\MongoDB\BaseInfoRepository;

use App\Repositories\MongoDB\IBaseRepository;

interface IBaseInfoRepository extends IBaseRepository
{
    public function createOrUpdateBaseInfo($id = null,$data);
}
