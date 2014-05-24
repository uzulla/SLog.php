<?php
require_once "../lib/Uzulla/SLog.php";
require_once "../vendor/autoload.php";

class SLogTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if(file_exists(__DIR__.'app.log'))
            unlink(__DIR__.'app.log');
    }

    public static function tearDownAfterClass()
    {
        if(file_exists(__DIR__.'app.log'))
            unlink(__DIR__.'app.log');
    }

    public function testSetLogger()
    {
        $app_log = new \Monolog\Logger('APP');
        $app_log->pushHandler(
            new \Monolog\Handler\StreamHandler(__DIR__.'app.log', \Monolog\Logger::DEBUG)
        );
        \Uzulla\SLog::setLogger('APP', $app_log);
    }

    public function testGetLogger()
    {
        $app_log = new \Monolog\Logger('APP');
        $app_log->pushHandler(
            new \Monolog\Handler\StreamHandler(__DIR__.'app.log', \Monolog\Logger::DEBUG)
        );
        \Uzulla\SLog::setLogger('APP', $app_log);

        $_app_log = \Uzulla\SLog::getLogger('APP', $app_log);

        $this->assertEquals("Monolog\\Logger", get_class($_app_log));
    }

    public function testUseLogger()
    {
        $app_log = new \Monolog\Logger('APP');
        $app_log->pushHandler(
            new \Monolog\Handler\StreamHandler(__DIR__.'app.log', \Monolog\Logger::DEBUG)
        );
        \Uzulla\SLog::setLogger('APP', $app_log);

        $_app_log = \Uzulla\SLog::getLogger('APP', $app_log);

        $this->assertFileNotExists(__DIR__.'app.log');
        $_app_log->alert('hogehoge');
        $this->assertFileExists(__DIR__.'app.log');
    }

    public function testKantanLogger()
    {
        \Uzulla\SLog::alert('alert! alert!');
    }
}
