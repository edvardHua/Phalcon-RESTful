<?php
/**
 * User: Edvard
 * Date: 2015/12/15
 * Time: 12:27
 */

use Phalcon\Mvc\Model;

class Event extends Model
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
    public $org_id;

    /**
     *
     * @var string
     */
    public $code;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $start_date;

    /**
     *
     * @var string
     */
    public $end_date;

    /**
     *
     * @var string
     */
    public $venue;

    /**
     *
     * @var string
     */
    public $remark;

    /**
     *
     * @var string
     */
    public $app_title;

    /**
     *
     * @var string
     */
    public $app_bak_image;

    /**
     *
     * @var string
     */
    public $app_home_image;

    /**
     *
     * @var string
     */
    public $time_zone_area;

    /**
     *
     * @var double
     */
    public $time_zone;

    /**
     *
     * @var integer
     */
    public $auto_create_qrcode;

    /**
     *
     * @var string
     */
    public $qrcode_prefix;

    /**
     *
     * @var string
     */
    public $qrcode_suffix;

    /**
     *
     * @var integer
     */
    public $organization_in_pad;

    /**
     *
     * @var integer
     */
    public $salute_in_pad;

    /**
     *
     * @var integer
     */
    public $photo_in_pad;

    /**
     *
     * @var integer
     */
    public $meeting_info_in_pad;

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
     * @var string
     */
    public $modified_time;

    /**
     *
     * @var integer
     */
    public $modifier;

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
        $this->hasMany('id', 'Session', 'event_id', array('alias' => 'Session'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'event';
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
