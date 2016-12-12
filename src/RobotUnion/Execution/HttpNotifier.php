<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/3/16
 * Time: 6:56 PM
 */

namespace RobotUnion\Execution;


class HttpNotifier implements Notifier {

    private $url;

    /**
     * HttpNotifier constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    function notify($data) {
        $opts = [
            'http' => [
                'method' => 'POST',
                'content' => $data
            ]
        ];
        json_decode($data);
        if(json_last_error() == JSON_ERROR_NONE)
            $opts['http']['header'] = 'Content-Type: application/json';

        $ctx = stream_context_create($opts);
        file_get_contents($this->url, false, $ctx);
    }
}