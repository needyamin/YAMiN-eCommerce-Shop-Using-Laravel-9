<?php

namespace Shipu\Bkash\Facades;

use Illuminate\Support\Facades\Facade;

class Checkout extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bkash.checkout';
    }
}
