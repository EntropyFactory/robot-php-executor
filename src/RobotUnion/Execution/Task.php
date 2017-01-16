<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/1/16
 * Time: 4:16 AM
 */

namespace RobotUnion\Execution;


abstract class Task implements Runnable, Cancelable, HttpDebuggable, HttpExecutable, Launcher {


    private $exceptionNotifier;
    private $urlOk;
    private $urlKo;
    private $urlDebug;
    private $urlException;

    public $device;
    public $logger;
    public $input;
    public $robot;
    public $okNotifier;
    public $koNotifier;

    public function initialize($urlOk, $urlKo, $urlDebug, $urlException)
    {
        $this->urlOk = $urlOk;
        $this->urlKo = $urlKo;
        $this->urlDebug = $urlDebug;
        $this->urlException = $urlException;

        $this->okNotifier = new HttpNotifier($urlOk);
        $this->koNotifier = new HttpNotifier($urlKo);
        $this->logger = new JsonLogger(new HttpNotifier($urlDebug));
        $this->exceptionNotifier = new HttpNotifier($urlException);
    }

    function cancel() {
        $this->koNotifier->notify([]);
        die();
    }

    public function testRunRobot(){
        try {
            $this->run();
            $this->okNotifier->notify([]);
        } catch (\Exception $e){
            $this->exceptionNotifier->notify($e);
            $this->koNotifier->notify([]);
        }
    }

    function launch($taskId, $data)
    {
        $content = [
            'task_id' => $taskId
        ];
        $opts = [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($content)
        ];

        $ctx = stream_context_create($opts);

        file_get_contents("https://api-staging.robotunion.net/system/v1/executions", false, $ctx);
    }

    /**
     * @return mixed
     */
    public function getUrlOk()
    {
        return $this->urlOk;
    }

    /**
     * @return mixed
     */
    public function getUrlKo()
    {
        return $this->urlKo;
    }

    /**
     * @return mixed
     */
    public function getUrlDebug()
    {
        return $this->urlDebug;
    }

    /**
     * @return mixed
     */
    public function getUrlException()
    {
        return $this->urlException;
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

}