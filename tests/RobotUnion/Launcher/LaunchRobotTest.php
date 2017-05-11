<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/1/16
 * Time: 4:26 AM
 */

namespace Tests\RobotUnion\Launcher;

use PHPUnit_Extensions_AppiumTestCase;
use RobotUnion\Execution\Task;


class LaunchRobotTest extends PHPUnit_Extensions_AppiumTestCase {

    public static $browsers = [
        [
            'local' => false,
            'host' => '__host__',
            'port' => __port__,
            'browserName' => '__browser_name__',
            'desiredCapabilities' => __capabilities__
        ]
    ];

    public function testExecuteRobot(){
        $id = "__exec_id__";
        //$executionId = "4a6ae24d-bfeb-11e6-9ba2-0050563c3ed9";
        $baseURL = "https://api.alpha.rallf.com";
        /** @var Task $task */
        $task = new __task_class__();
        $task->initialize($baseURL . "/system/v1", "__extype__", $id);
        $task->setDevice($this);
        $task->setRobot(json_decode(base64_decode(getenv('ROBOT'))));
        $task->setInput(json_decode(base64_decode(getenv('INPUT'))));
        $task->execute();
    }
}