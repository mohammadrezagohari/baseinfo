<?php
namespace Gohari\Pagination;
use Illuminate\Support\ServiceProvider;
class PaginationServiceProvider extends ServiceProvider
{
    /*************
     * @return void
     * first step
     */
    public function boot()
    {
        dd('package is working');
    }

    /**********
     * @return void
     * after than
     */
    public function register()
    {

    }
}
