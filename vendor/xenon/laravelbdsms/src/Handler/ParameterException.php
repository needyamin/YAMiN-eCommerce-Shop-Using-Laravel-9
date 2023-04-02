<?php
/*
 *  Last Modified: 6/28/21, 11:18 PM
 *  Copyright (c) 2021
 *  -created by Ariful Islam
 *  -All Rights Preserved By
 *  -If you have any query then knock me at
 *  arif98741@gmail.com
 *  See my profile @ https://github.com/arif98741
 */

namespace Xenon\LaravelBDSms\Handler;


use Illuminate\Http\Request;

/**
 * Class ParameterException
 * @package Xenon\LaravelBDSmsLog\Handler
 * @version v1.0.20
 * @since v1.0.20
 */
class ParameterException extends \Exception
{
    /**
     * Report the exception.
     *
     * @return void
     * @version v1.0.20
     * @since v1.0.20
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param Request $request
     * @return void
     * @version v1.0.20
     * @since v1.0.20
     */
    public function render($request)
    {

    }
}
