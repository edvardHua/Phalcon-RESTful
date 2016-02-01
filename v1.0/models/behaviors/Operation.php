<?php
/**
 * Created by PhpStorm.
 * User: Edvard
 * Date: 2015/12/21
 * Time: 14:57
 */

use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;

class Operation extends Behavior implements BehaviorInterface
{

    private $userId = null;

    public function notify($type, \Phalcon\Mvc\ModelInterface $model)
    {
        switch ($type) {
            case 'beforeUpdate':
                $model->modified_time = time();
                $model->modifier = $this->userId;
                break;
            case 'beforeCreate':
                $model->created_time = time();
                $model->creator = $this->userId;
                break;
            case 'beforeSave':
                $model->modified_time = time();
                $model->modifier = $this->userId;
                break;
            case 'beforeDelete':
                $model->deleted_time = time();
                $model->deletor = $this->userId;
                break;
            default:
        }
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }
}