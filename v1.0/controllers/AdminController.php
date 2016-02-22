<?php
/**
 * Class AdminController
 * @author Edvard
 * @time 2015.12.14 12:13
 */

use Phalcon\Mvc\Model\Query;
use Phalcon\Http\Response;

class AdminController extends BaseController
{
    public function getUser($id)
    {
        if(empty($id)){

        }
    }

    public function deleteUser($id)
    {
        if(empty($id)){
            return parent::required('id');
        }

        $where = 'id='.$id.' and isdeleted=0';

        $user = User::findFirst($where);
        if(empty($user)){
            return parent::invalid('id',$id);
        }
        if (false == $user->delete())
            return parent::response($user->getMessages(), 406);

        return parent::success();
    }
}
