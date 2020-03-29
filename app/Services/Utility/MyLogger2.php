<?php

namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MyLogger2 implements ILogger
{
    private static $logger = null;

    static function getLogger()
    {
        if (self::$logger == null)
        {
            self::$logger = new Logger('MyApp');
            //$stream = new StreamHandler('storage/logs/myapp.log', Logger::DEBUG);
            $stream = new StreamHandler('b79d48aa-0105-4d8b-a5ee-4b9069eed8d3/tag/cst323_logfile_heroku_upload_php', Logger::INFO);
            $stream->setFormatter(new LineFormatter("%datetime% : %level_name% : %message% %context%\n", "g:iA n/j/Y"));
            self::$logger->pushHandler($stream);
        }
        return self::$logger;
    }

    public static function debug($message, $data=array())
    {
        self::getLogger()->debug($message, $data);
    }

    public static function info($message, $data=array())
    {
        self::getLogger()->info($message, $data);
    }

    public static function warning($message, $data=array())
    {
        self::getLogger()->warning($message, $data);
    }

    public static function error($message, $data=array())
    {
        self::getLogger()->error($message, $data);
    }
}
