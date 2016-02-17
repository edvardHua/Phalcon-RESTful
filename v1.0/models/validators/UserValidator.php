<?php

/**
 * Created by PhpStorm.
 * User: Edvard
 * Date: 2016/2/17
 * Time: 21:37
 */

use Phalcon\Validation\Validator\PresenceOf;

class UserValidator extends \Phalcon\Validation
{
    public function initialize()
    {
        $this->add(
            'username',
            new PresenceOf(array(
                'message' => 'The username is required'
            ))
        );
        $this->add(
            'password',
            new PresenceOf(array(
                'message' => 'The password is required'
            ))
        );

    }
}