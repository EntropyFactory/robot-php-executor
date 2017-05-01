<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/3/16
 * Time: 8:34 PM
 */

namespace RobotUnion\Example;

use RobotUnion\Execution\Task;

class MyFirstTask extends Task {

    function run()
    {
        $this->logger->debug("START");
        $this->logger->debug([
            "capture" => base64_encode($this->device->currentScreenshot())
        ]);
        $this->logger->debug("getting device time");
        $time = $this->device->getDeviceTime();
        $this->logger->debug(['device_time' => $time]);
        $this->logger->debug("centering to Apps");

        $el = $this->device->byAndroidUIAutomator('new UiSelector().textContains("Apps")');
        $el->click();
        $this->logger->debug([
            "capture" => base64_encode($this->device->currentScreenshot())
        ]);
        sleep(5);
        $this->logger->debug([
            "capture" => base64_encode($this->device->currentScreenshot())
        ]);
        $this->logger->debug("END");
    }
}