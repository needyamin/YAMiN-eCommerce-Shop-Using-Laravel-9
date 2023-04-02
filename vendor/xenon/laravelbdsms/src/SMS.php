<?php namespace Xenon\LaravelBDSms;

use Exception;

class SMS
{
    /** @var Sender */
    private $sender;

    /**
     * @param Sender $sender
     * @version v1.0.32
     * @since v1.0.31
     */
    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @throws Handler\RenderException
     * @throws Exception
     * @version v1.0.32
     * @since v1.0.31
     */
    public function via($provider): SMS
    {
        $this->sender->setProvider($provider);
        $this->sender->setConfig(config('sms.providers')[$provider]);
        return $this;
    }

    /**
     * @throws Handler\ParameterException
     * @throws Exception
     * @version v1.0.32
     * @since v1.0.31
     */
    public function shoot(string $number, string $text)
    {
        $this->sender->setMobile($number);
        $this->sender->setMessage($text);
        return $this->sender->send();
    }

    /**
     * @throws Handler\ParameterException
     * @throws Exception
     * @version v1.0.46-dev
     * @since v1.0.46-dev
     */
    public function shootWithQueue(string $number, string $text)
    {
        $this->sender->setMobile($number);
        $this->sender->setMessage($text);
        $this->sender->setQueue(true);
        return $this->sender->send();
    }
}
