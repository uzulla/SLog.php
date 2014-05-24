<?php
/*
 * Singleton and Simple, PSR-3 Logger Container
 */
namespace Uzulla;

use Monolog\Logger;
use Monolog\Handler;

// TODO Monolog依存ではなく、PSR-3のロガーに対応と書き直す
// TODO stderr出力のロガーを自前でPSR-3対応の簡単な奴を書く
class SLog
{
    static $logger = [];
    static $default_name = '_';
    static $strict = false;

    /**
     * @param String $logger_name
     * @param \Monolog\Logger $logger
     */
    static public function setLogger($logger_name = null, \Monolog\Logger $logger = null)
    {
        if (is_null($logger_name))
            $logger_name = static::$default_name;
        static::$logger[$logger_name] = $logger;
    }

    /**
     * @param null $logger_name
     * @return \Monolog\Logger
     * @throws \Exception
     */
    static public function getLogger($logger_name = null)
    {
        if (is_null($logger_name))
            $logger_name = static::$default_name;

        if (!isset(static::$logger[$logger_name])) {
            if (static::$strict) // 未定義ログを怒るモード
                throw new \Exception('Request not exists logger');

            // とりあえずstderrに出力するmonologを返す簡単便利機能
            $log = new Logger($logger_name);
            $log->pushHandler(
                new Handler\StreamHandler("php://stderr", Logger::DEBUG)
            );
            static::$logger[$logger_name] = $log;
        }
        return static::$logger[$logger_name];
    }

    // とりあえず一発で投げられる簡単便利機能
    static public function debug($message, $context = array())
    {
        static::getLogger(static::$default_name)->debug($message, $context);
    }

    static public function info($message, $context = array())
    {
        static::getLogger(static::$default_name)->info($message, $context);
    }

    static public function notice($message, $context = array())
    {
        static::getLogger(static::$default_name)->notice($message, $context);
    }

    static public function warning($message, $context = array())
    {
        static::getLogger(static::$default_name)->warning($message, $context);
    }

    static public function error($message, $context = array())
    {
        static::getLogger(static::$default_name)->error($message, $context);
    }

    static public function critical($message, $context = array())
    {
        static::getLogger(static::$default_name)->critical($message, $context);
    }

    static public function alert($message, $context = array())
    {
        static::getLogger(static::$default_name)->alert($message, $context);
    }

    static public function emergency($message, $context = array())
    {
        static::getLogger(static::$default_name)->emergency($message, $context);
    }
}