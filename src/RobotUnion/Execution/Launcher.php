<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/10/16
 * Time: 8:42 PM
 */

namespace RobotUnion\Execution;


interface Launcher {
    function launchTask($task_id, $input);
}