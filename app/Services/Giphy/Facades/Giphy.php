<?php

namespace App\Services\Giphy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static search($query, $limit, $offset)
 */
class Giphy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'giphy';
    }
}
