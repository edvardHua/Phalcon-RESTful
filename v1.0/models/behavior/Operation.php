<?php
/**
 * Created by PhpStorm.
 * User: Edvard
 * Date: 2015/12/21
 * Time: 14:57
 */

use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;

class Operation extends Behavior implements BehaviorInterface{
    public function notify($type, \Phalcon\Mvc\ModelInterface $model)
    {
        switch ($type) {
            case 'beforeUpdate':
                break;
            default:
        }
    }
}