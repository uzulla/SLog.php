<?php
require_once "../vendor/autoload.php";

use \Uzulla\SLog;

class SLogTest extends PHPUnit_Framework_TestCase
{
    protected $log_file = null;

    protected function setUp()
    {
        $this->log_file = __DIR__.'/app.log';

        if(file_exists($this->log_file))
            unlink($this->log_file);
    }

    public static function tearDownAfterClass()
    {
        if(file_exists(__DIR__.'/app.log'))
            unlink(__DIR__.'/app.log');
    }

    public function testSetLogger()
    {
        $app_log = new SLog\SimpleLogger();
        SLog::setLogger('APP', $app_log);
    }

    public function testGetLogger()
    {
        $app_log = new SLog\SimpleLogger();
        SLog::setLogger('APP', $app_log);

        $_app_log = SLog::getLogger('APP', $app_log);
        $this->assertEquals("Uzulla\\SLog\\SimpleLogger", get_class($_app_log));
    }

    public function testUseLogger()
    {
        $app_log = new SLog\SimpleLogger(SLog\SimpleLogger::DEBUG, $this->log_file);
        SLog::setLogger('APP', $app_log);

        $_app_log = SLog::getLogger('APP', $app_log);

        $this->assertFileNotExists($this->log_file);
        $_app_log->alert('hogehoge');
        $this->assertFileExists($this->log_file);
    }

    public function testKantanLogger()
    {
        SLog::alert('alert! alert!');
    }
}
