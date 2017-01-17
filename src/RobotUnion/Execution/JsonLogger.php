<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/3/16
 * Time: 7:55 PM
 */


namespace RobotUnion\Execution;


class JsonLogger implements Logger {

    const LOG_SEVERITY_EMERGENCY = 0;
    const LOG_SEVERITY_ALERT = 1;
    const LOG_SEVERITY_CRITICAL = 2;
    const LOG_SEVERITY_ERROR = 3;
    const LOG_SEVERITY_WARNING = 4;
    const LOG_SEVERITY_NOTICE = 5;
    const LOG_SEVERITY_INFO = 6;
    const LOG_SEVERITY_DEBUG = 7;

    private $notifier;

    public function __construct(Notifier $notifier){
        $this->notifier = $notifier;
    }

    /**
     * @param string $message
     * @param mixed $data
     * @param int $severity , standard RFC3164 code (https://tools.ietf.org/html/rfc3164)
     * @param string $channel
     */
    function log($message, $data = null, $severity = 7, $channel = "")
    {
        $log = json_encode(
            ['debug_add' =>
                [
                    'time' => new \DateTime('now'),
                    'severity' => $severity,
                    'channel' => $channel,
                    'message' => $message,
                    'data' => $data
                ]
            ]
        );
        $this->notifier->notify($log);
    }


    function capture($device, $severity = 7, $channel = ""){
        $this->debug([
            "capture" => base64_encode($device->currentScreenshot())
        ], null, $severity, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function debug($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_DEBUG, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function warning($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_WARNING, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function alert($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_ALERT, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function emergency($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_EMERGENCY, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function critical($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_CRITICAL, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function error($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_ERROR, $channel);
    }

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function info($message, $data = null, $channel = "")
    {
        $this->log($message, $data, JsonLogger::LOG_SEVERITY_INFO, $channel);
    }
}