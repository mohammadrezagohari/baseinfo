<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/** import EloquentMongoModel for using MongoDB database **/
use Jenssegers\Mongodb\Eloquent\Model as EloquentMongoModel;

class BaseInfo extends EloquentMongoModel
{
    /**************************************************************
     * @var $connection string set our connection type name.
     * @var $collection string set our collection name in database
     * @var $primaryKey string set collection identity name
     * @var $fillable   array  set our collection keys
     ***************************************************************/
    protected $connection = 'mongodb';
    protected $collection = 'baseinfo';
//    protected $primaryKey = 'id';
    protected $fillable = [
       'name_title','type', 'value','length','display_title'
    ];
}
