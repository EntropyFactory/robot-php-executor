<?php
/**
 * Created by PhpStorm.
 * User: lluis
 * Date: 12/1/16
 * Time: 4:30 AM
 */

namespace RobotUnion\Execution;


interface HttpExecutable {
    function getUrlOK();
    function getUrlException();
    function getUrlKO();
}