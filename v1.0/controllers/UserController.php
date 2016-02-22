<?php
/**
 * Class UserController
 * @author Edvard
 * @time 2015.12.14 12:13
 */

use Phalcon\Mvc\Model\Query;
use Phalcon\Http\Response;

class UserController extends BaseController
{
    public function getUser()
    {
        $token = $this->session->get('token');

        $user = User::findFirst(array(
            'id='.$token->user_id,
            'columns' => 'username, name, organization, title, email'
        ));

        return parent::success(array(
            'user' => $user
        ));
    }

    public function updateUser()
    {
        $token = $this->session->get('token');

        // username name organization title email password
        $data = $this->request->get();
        $dbUser = User::findFirst('id='.$token->user_id);
        if(!empty($data['password'])){
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $dbUser = $dbUser->toArray();

        $userModel = new User();
        if (false == $userModel->save(array_merge($dbUser,$data)))  // 使用修改的数据覆盖原始的数据来达到部分更新效果
            return parent::resWithErrMsg($userModel->getMessages());

        return parent::success();
    }

}
