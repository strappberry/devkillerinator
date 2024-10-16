<?php

namespace Strappberry\Devkillerinator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Strappberry\Devkillerinator\Devkillerinator
 */
class Devkillerinator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Strappberry\Devkillerinator\Devkillerinator::class;
    }
}
