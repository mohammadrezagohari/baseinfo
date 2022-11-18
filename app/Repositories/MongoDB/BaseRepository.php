<?php

namespace App\Repositories\MongoDB;

use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model as EloquentMongoModel;
use App\Helpers;
use PHPUnit\Exception;

/******************************************************
 * @class BaseRepository
 *  In this class we create our popular methods
 *  such as get all data , find by id and CRUD actions
 *******************************************************/
class BaseRepository implements IBaseRepository
{
    /***************************************
     * @var EloquentMongoModel $currentModel
     *  define model type with this property
     ****************************************/
    private $currentModel;

    /********************************************************
     * @param EloquentMongoModel $model
     * We use the constructor for repository constructor type
     * So with constructor we can assign your select model
     *********************************************************/
    public function __construct(EloquentMongoModel $model)
    {
        $this->currentModel = $model;
    }

    /************************
     * @method getAll()
     *  get all of your model
     ************************/
    public function getAll()
    {
        return $this->currentModel->get();
    }

    /**************************************************
     * @method getAllWithPaginate()
     *  get all of your model with paginate your model
     ***************************************************/
    public function getAllWithPaginate($perPage, $page)
    {
        $skipItems = ($page == 1) ? 0 : $perPage * $page;
        return Helpers\custom($this->currentModel->skip($skipItems)->take($perPage)->get(), $perPage, $page);
    }


    /*************************
     * @method findById()
     * @param $id
     * find your select method
     *************************/
    public function findById($id)
    {
        return $this->currentModel->findOrFail($id);
    }

    /******************************
     * @method insertData()
     * @param $data
     * new instance of your model
     ******************************/
    public function insertData($data)
    {
        return $this->currentModel->create($data);
    }

    /*******************************
     * @method updateData()
     * @param $data
     * @param $identity
     * update your instance of model
     *******************************/
    public function updateData($identity, $data)
    {
        $model = $this->currentModel->find($identity);
        if (!@$model)
            return false;
        foreach ($model as $index => $field) {
            $model[$index] = $data[$index];
        }
        return $model->save();
    }

    /*******************************
     * @method deleteData()
     * @param $identity
     * drop instance of model
     *******************************/
    public function deleteData($identity)
    {
        $model = $this->currentModel->find($identity);
        if (!@$model)
            return false;
        return $model->delete();
    }

}
