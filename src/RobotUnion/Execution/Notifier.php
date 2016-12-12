<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/3/16
 * Time: 6:57 PM
 */

namespace RobotUnion\Execution;


interface Notifier {
    /**
     * @param string $data
     */
    function notify($data);
}