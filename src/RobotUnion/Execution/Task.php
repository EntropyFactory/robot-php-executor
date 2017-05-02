<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/1/16
 * Time: 4:16 AM
 */

namespace RobotUnion\Execution;


abstract class Task implements Runnable, Cancelable, Launcher {

    public $device;

    private $execution_id;

    /** @var  Notifier */
    private $notifier;

    /** @var  Logger */
    public $logger;

    public $input;

    /** @var  Robot */
    public $robot;

    private $url;

    /**
     * @param $url
     */
    public function initialize($url, $id) {
        $this->url = $url;
        $this->execution_id = $id;
        $this->logger = new JsonLogger(new HttpNotifier($url . "/" . $id));
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
            'http' => [
                'method' => 'PATCH',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($content)
            ]
        ];

        file_get_contents(
            $this->getUrl() . "/" . $this->getExecutionId(),
            false,
            stream_context_create($opts)
        );
    }

    function delegate($task_id, $input)
    {
        $content = [
            'caller_id' => $this->getExecutionId(),
            'task_id' => $task_id,
            'input' => $input,
            'sync' => true
        ];
        $opts = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($content)
            ]
        ];

        $jsonResp = file_get_contents(
            "https://api-staging.robotunion.net/system/v1/executions",
            false,
            stream_context_create($opts)
        );
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
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}