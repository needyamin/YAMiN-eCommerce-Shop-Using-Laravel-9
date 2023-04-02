<?php namespace Xenon\LaravelBDSms\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static Xenon\LaravelBDSms\Log\Log createLog(array $data)
 * @method static Xenon\LaravelBDSms\Log\Log viewLastLog()
 * @method static Xenon\LaravelBDSms\Log\Log viewAllLog()
 * @method static Xenon\LaravelBDSms\Log\Log logByProvider()
 * @method static Xenon\LaravelBDSms\Log\Log logByDefaultProvider()
 * @method static Xenon\LaravelBDSms\Log\Log total()
 * @method static Xenon\LaravelBDSms\Log\Log toArray()
 * @method static Xenon\LaravelBDSms\Log\Log toJson()
 *
 * @see \Xenon\LaravelBDSms\Log\Log
 */
class Logger extends Facade
{
    /**
     * @return string
     * @version v1.0.35
     * @since v1.0.35
     */
    protected static function getFacadeAccessor(): string
    {
        return 'LaravelBDSmsLogger';
    }
}
