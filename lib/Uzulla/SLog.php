<?php
/*
 * Singleton and Simple, PSR-3 Logger Container
 * Author: uzulla <uzulla@himitsukichi.com>
 * Site: https://github.com/uzulla/SLog.php
 * License: MIT
 */
namespace Uzulla;

use \Uzulla\SLog\SimpleLogger as Logger;
use \Psr\Log\LoggerInterface;
class SLog
{
    static $logger = [];
    static $default_name = '_';
    static $strict = false;

    /**
     * @param string $logger_name
     * @param \Psr\Log\LoggerInterface $logger
     */
    static public function setLogger($logger_name = null, LoggerInterface $logger = null)
    {
        if (is_null($logger_name))
            $logger_name = static::$default_name;
        static::$logger[$logger_name] = $logger;
    }

    /**
     * @param string $logger_name
     * @return \Psr\Log\LoggerInterface
     * @throws \Exception
     */
    static public function getLogger($logger_name = null)
    {
        if (is_null($logger_name))
            $logger_name = static::$default_name;

        if (!isset(static::$logger[$logger_name])) {
            if (static::$strict) // 未定義ログを怒るモード
                throw new \Exception('Request not exists logger');

            // とりあえずstderrに出力するシンプルロガーをアタッチする
            static::$logger[$logger_name] = new Logger();
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