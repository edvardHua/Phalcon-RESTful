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

    public function validate($data = null, $entity = null)
    {
        $message = parent::validate($data, $entity);

        if (0 != count($message))
            return $message;

        if (!empty($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->appendMessage(new Message('The e-mail is not valid', 'email', 'Inclusion'));
                return false;
            }
        }

        return $this->getMessages();
    }
}