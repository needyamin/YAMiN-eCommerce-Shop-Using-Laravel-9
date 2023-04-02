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

use Xenon\LaravelBDSms\Handler\ParameterException;
use Xenon\LaravelBDSms\Handler\RenderException;
use Xenon\LaravelBDSms\Request;
use Xenon\LaravelBDSms\Sender;

class Esms extends AbstractProvider
{
    /**
     * DianaHost constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->senderObject = $sender;
    }

    /**
     * Send Request To Api and Send Message
     * @throws RenderException
     */
    public function sendRequest()
    {
        $number = $this->senderObject->getMobile();
        $text = $this->senderObject->getMessage();
        $config = $this->senderObject->getConfig();
        $queue = $this->senderObject->getQueue();

        $query = [
            'sender_id' => $config['sender_id'],
            'recipient' => $number,
            'message' => $text,
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $config['api_token'],
            'Content-Type' => 'application/json'
        ];

        $requestObject = new Request('https://login.esms.com.bd/api/v3/sms/send', $query, $queue);
        $requestObject->setHeaders($headers)->setContentTypeJson(true);
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
        if (!array_key_exists('api_token', $this->senderObject->getConfig())) {
            throw new ParameterException('api_token is absent in configuration');
        }

        if (!array_key_exists('sender_id', $this->senderObject->getConfig())) {
            throw new ParameterException('sender_id key is absent in configuration');
        }
    }

}
