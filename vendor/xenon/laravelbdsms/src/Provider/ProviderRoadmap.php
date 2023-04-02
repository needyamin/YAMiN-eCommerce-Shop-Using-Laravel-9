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

namespace Xenon\LaravelBDSms\Provider;

interface ProviderRoadmap
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return mixed
     */
    public function setData();

    /**
     * @return mixed
     */
    public function sendRequest();

    /**
     * @param $result
     * @param $data
     * @return mixed
     */
    public function generateReport($result, $data);

    /**
     * @return mixed
     */
    public function errorException();
}
