<?php
/**
 * User: Edvard
 * Date: 2016/01/07
 * Time: 12:27
 */

use Phalcon\Mvc\Model;

class RoleUser extends BaseModel
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $role_id;

    /**
     *
     * @var integer
     */
    public $user_id;
    
    /**
     *
     * @var string
     */
    public $created_time;
    
    /**
     *
     * @var integer
     */
    public $creator;
    
    /**
     *
     * @var integer
     */
    public $isdeleted;
    
    /**
     *
     * @var string
     */
    public $deleted_time;
    
    /**
     *
     * @var integer
     */
    public $deletor;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'role_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Event[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Event
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
