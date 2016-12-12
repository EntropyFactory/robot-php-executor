<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/3/16
 * Time: 6:42 PM
 */

namespace RobotUnion\Execution;

interface Logger {

    /**
     * @param string $message
     * @param mixed $data
     * @param int $severity , standard RFC3164 code (https://tools.ietf.org/html/rfc3164)
     * @param string $channel
     */
    function log($message, $data = null, $severity = 7, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function debug($message, $data = null, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function warning($message, $data = null, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function alert($message, $data = null, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function emergency($message, $data = null, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function critical($message, $data = null, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function error($message, $data = null, $channel = "");

    /**
     * @param $message
     * @param null $data
     * @param string $channel
     */
    function info($message, $data = null, $channel = "");
}