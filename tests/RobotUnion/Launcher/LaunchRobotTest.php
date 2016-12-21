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
            'host' => '5.189.191.163',
            'port' => 4723,
            'browserName' => '',
            'desiredCapabilities' => [
                'platformName' => 'Android',
                'deviceName' => 'Google Nexus S',
                'appPackage' => 'com.android.settings',
                "appActivity" => ".Settings"
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
        $task->run();
    }
}