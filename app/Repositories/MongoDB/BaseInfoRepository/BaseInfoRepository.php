<?php

namespace App\Repositories\MongoDB\BaseInfoRepository;

use App\Models\BaseInfo;
use App\Repositories\MongoDB\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from IBaseInfoRepository to register the rules
 *********************************************************************************/
class BaseInfoRepository extends BaseRepository implements IBaseInfoRepository
{
    /***********************
     * @var $model BaseInfo
     ***********************/
    private $model;

    /*************************
     * @param BaseInfo $model
     * pass our model to the BaseRepository
     *************************/
    public function __construct(BaseInfo $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /************************************************
     * this method use for update BaseInfo model
     * if it doesn't exist this item
     * it can generate smart with our update items
     * @param $id
     * @param $data
     * @return void
     ************************************************/
    public function createOrUpdateBaseInfo($id = null, $data)
    {
        $this->model->createOrUpdate(['id' => $id], $data);
    }

}
