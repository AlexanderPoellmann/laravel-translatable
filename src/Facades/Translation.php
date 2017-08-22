<?php namespace Lecturize\Translatable\Facades;

use Illuminate\Support\Facades\Facade;

class Translation extends Facade
{
    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'translatable';
    }
}