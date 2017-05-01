<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/1/16
 * Time: 4:16 AM
 */

namespace RobotUnion\Execution;


abstract class Task implements Runnable, Cancelable, HttpDebuggable, HttpExecutable, Launcher {

    private $execution_id;

    /** @var  Notifier */
    private $notifier;

    public $device;
    /** @var  Logger */
    public $logger;
    public $input;

    /** @var  Robot */
    public $robot;

    /**
     * @param $url
     */
    public function initialize($url) {
        $this->logger = new JsonLogger(new HttpNotifier($url));
    }

    function cancel() {
        $this->notifier->notify([]);
        die();
    }

    function execute(){
        $output = $this->run();
        $content = [
            'status' => 'ending',
            'output' => $output
        ];
        $opts = [
            'method' => 'PATCH',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($content)
        ];

        return file_get_contents(
            "https://api-staging.robotunion.net/system/v1/executions/" . $this->getExecutionId(),
            false,
            stream_context_create($opts)
        );
    }

    function launchTask($task_id, $input)
    {
        $content = [
            'caller_id' => $this->getExecutionId(),
            'task_id' => $task_id,
            'input' => $input,
            'sync' => true
        ];
        $opts = [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($content)
        ];

        $ctx = stream_context_create($opts);

        $jsonResp = file_get_contents("https://api-staging.robotunion.net/system/v1/executions", false, $ctx);
        $execution = json_decode($jsonResp);
        return $execution->output;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @param mixed $input
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * @param mixed $robot
     */
    public function setRobot($robot)
    {
        $this->robot = $robot;
    }

    public function getExecutionId()
    {
        return $this->execution_id;
    }

    /**
     * @param mixed $execution_id
     */
    public function setExecutionId($execution_id)
    {
        $this->execution_id = $execution_id;
    }

}