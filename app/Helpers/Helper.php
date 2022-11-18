<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

if (!function_exists("custom_pagination")){
    /******************************************************
     * create a customized pagination for laravel
     *
     * @param mixed $models
     * your selected collection or model
     *
     * @param int $perPage
     * count of per page items
     *
     * @param int $page [optional]
     * you can set your page index with this
     * if it hasn't values, show first page
     * @param int $options [optional]
     * you can set others options in this item
     *
     * @return LengthAwarePaginator
     * it's send our pagination
     */
    function custom($models, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ? $page : (Paginator::resolveCurrentPage() ? Paginator::resolveCurrentPage() : 1);
        $models = $models instanceof Collection ? $models : Collection::make($models);
        return new LengthAwarePaginator($models->forPage($page, $perPage), $models->count(), $perPage, $page, $options);
    }
}

