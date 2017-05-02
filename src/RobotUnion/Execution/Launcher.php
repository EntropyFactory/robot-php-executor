<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/10/16
 * Time: 8:42 PM
 */

namespace RobotUnion\Execution;


interface Launcher {
    function delegate($task_id, $input);
}