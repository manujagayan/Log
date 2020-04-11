<?php


namespace Adl\Logger;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;

class LoggerUtils
{
    private static $threadId;
    private static $hostName;
    private static $appName;
    private static $msName;
    private static $uuid;
    private static $logName;
    private static $massageType;
    private static $logger;
    private static $loggingUtils;

    public function __construct($name)
    {
        self::initialize();
        self::$logger = self::createLogger($name);
    }

    public static function createLogger($name):Logger{
        $pattern = "%datetime%|%context.threadId%|%context.hostName%|%level_name%|%context.appender%|%context.appName%|%context.msName%|%context.UUID%|%context.msgType%|%message%\n";
        $dateFormat = "Y-m-d H:i:s:u";
        $formatter = new LineFormatter($pattern, $dateFormat);

        $consoleHandler = new StreamHandler('php://stdout', config('LogConfig.consoleLogLevel', 'INFO'));
        $consoleHandler->setFormatter($formatter);

        $fileName = config('LogConfig.logFilePath', "../storage/logs/") . self::$msName;
        $file_handler = new RotatingFileHandler($fileName, 0, config('LogConfig.fileLogLevel', 'INFO'));
        $file_handler->setFormatter($formatter);

        $logger = new Logger($name);
        $logger->pushHandler($consoleHandler);
        $logger->pushHandler($file_handler);
        $logger->pushProcessor(new WebProcessor());
        return $logger;

    }

    public static function initialize(){

        self::$hostName = gethostname();
        self::$appName = config('AppConfig.appName', "LoggerUtils");
        self::$msName = config('AppConfig.msName', "offer");
        self::$threadId = config('LogConfig.threadId', "1000");
        self::$uuid = config('LogConfig.UUID', "1a2ad889b");
        self::$massageType = config('LogConfig.massageType', "API_CALL");
    }

    public static function getLogger($logName){

        self::$loggingUtils = new LoggerUtils($logName);
        self::$logName = $logName;
        return self::$loggingUtils;
    }


    public function emergency($message)
    {

        // TODO: Implement emergency() method.
        self::$logger->emergency($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $message
     */
    public function alert($message)
    {
        // TODO: Implement alert() method.
        self::$logger->alert($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $message
     */
    public function critical($message)
    {
        // TODO: Implement critical() method.
        self::$logger->critical($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $message
     */
    public function error($message)
    {
        // TODO: Implement error() method.
        self::$logger->error($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $message
     */
    public function warning($message)
    {
        // TODO: Implement warning() method.
        self::$logger->warning($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $message
     */
    public function notice($message)
    {
        // TODO: Implement notice() method.
        self::$logger->notice($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $message
     */
    public function info($message)
    {
        // TODO: Implement info() method.
        self::$logger->info($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));

    }

    /**
     * @param $message
     */
    public function debug($message)
    {
        // TODO: Implement debug() method.
        self::$logger->debug($message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }

    /**
     * @param $level
     * @param $message
     */
    public function log($level, $message)
    {
        // TODO: Implement log() method.
        self::$logger->log($level, $message, array('threadId' => self::$threadId, 'hostName' => self::$hostName,'appender' => self::$logName, 'appName' => self::$appName, 'msName' => self::$msName, 'UUID' => self::$uuid, 'msgType' => self::$massageType));
    }
}
