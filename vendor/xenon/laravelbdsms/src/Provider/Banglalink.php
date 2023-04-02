<?php
/*
 *  Last Modified: 6/29/21, 12:06 AM
 *  Copyright (c) 2021
 *  -created by Ariful Islam
 *  -All Rights Preserved By
 *  -If you have any query then knock me at
 *  arif98741@gmail.com
 *  See my profile @ https://github.com/arif98741
 */

namespace Xenon\LaravelBDSms\Provider;

use GuzzleHttp\Exception\GuzzleException;
use Xenon\LaravelBDSms\Handler\ParameterException;
use Xenon\LaravelBDSms\Request;
use Xenon\LaravelBDSms\Sender;

class Banglalink extends AbstractProvider
{
    /**
     * Banglalink constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->senderObject = $sender;
    }

    /**
     * Send Request To Api and Send Message
     * @throws GuzzleException
     */
    public function sendRequest()
    {
        $number = $this->senderObject->getMobile();
        $text = $this->senderObject->getMessage();
        $config = $this->senderObject->getConfig();
        $queue = $this->senderObject->getQueue();

        $formParams = [
            'userID' => $config['userID'],
            'passwd' => $config['passwd'],
            'sender' => $config['sender'],
            'msisdn' => $number,
            'message' => $text,
        ];

        $requestObject = new Request('https://vas.banglalink.net/sendSMS/sendSMS', [], $queue);
        $requestObject->setFormParams($formParams);
        $response = $requestObject->post();
        if ($queue) {
            return true;
        }

        $body = $response->getBody();
        $smsResult = $body->getContents();

        $data['number'] = $number;
        $data['message'] = $text;
        return $this->generateReport($smsResult, $data)->getContent();
    }

    /**
     * @throws ParameterException
     */
    public function errorException()
    {
        if (!array_key_exists('userID', $this->senderObject->getConfig())) {
            throw new ParameterException('userID key is absent in configuration');
        }

        if (!array_key_exists('passwd', $this->senderObject->getConfig())) {
            throw new ParameterException('passwd key is absent in configuration');
        }
        if (!array_key_exists('sender', $this->senderObject->getConfig())) {
            throw new ParameterException('sender key is absent in configuration');
        }

    }
}
