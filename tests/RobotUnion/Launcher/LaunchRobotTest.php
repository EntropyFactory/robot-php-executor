<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/1/16
 * Time: 4:26 AM
 */

namespace Tests\RobotUnion\Launcher;

use PHPUnit_Extensions_AppiumTestCase;


class LaunchRobotTest extends PHPUnit_Extensions_AppiumTestCase {

    public static $browsers = [
        [
            'local' => false,
            'host' => '__host__',
            'port' => __port__,
            'browserName' => '__browser_name__',
            'desiredCapabilities' => [
                'platformName' => '__platform_name__',
                'deviceName' => '__device_name__',
                'appPackage' => '__app_package__',
                "appActivity" => "__app_activity__",
                "nodeIdentifier" => "__node_identifier__"
            ]
        ]
    ];

    public function testExecuteRobot(){
        $executionId = "__exec_id__";
        //$executionId = "4a6ae24d-bfeb-11e6-9ba2-0050563c3ed9";
        $baseURL = "https://api-staging.robotunion.net";
        $task = new __task_class__();
        $task->initialize(
            $baseURL . "/system/v1/__extype__/" . $executionId,
            $baseURL . "/system/v1/__extype__/" . $executionId,
            $baseURL . "/system/v1/__extype__/" . $executionId,
            $baseURL . "/system/v1/__extype__/" . $executionId
        );
        $task->setDevice($this);
        $task->setRobot(json_decode(base64_decode(getenv('ROBOT'))));
        $task->setInput(json_decode(base64_decode(getenv('INPUT'))));
        $task->run();
    }
}