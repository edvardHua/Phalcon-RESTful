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
    /**
     * @api {get} /user 获得当前登录用户信息
     * @apiUse header
     *
     * @apiName getUser
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Array} user 该用户的信息
     *     HTTP/1.1 200 OK
     *       {
     *           "user": {
     *               "username": "Admin",
     *               "name": "Edvard",
     *               "organization": null,
     *               "title": "Software Enginner",
     *               "email": "edvard_hua@live.com"
     *           }
     *       }
     *
     * @apiUse errorExample
     */
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

    /**
     * @api {put} /user 更新当前登录用户信息
     * @apiUse header
     *
     * @apiName updateUser
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiParam {String} username 该子会议的ID
     * @apiParam {String} name 该子会议名称 必选
     * @apiParam {String} organization 子会议的开始时间
     * @apiParam {Integer} title 子会议的结束时间
     * @apiParam {String} email 子会议举行场地
     * @apiParam {String} password 该子会议可接纳的人数
     *
     * @apiSuccess {Array} empty_array 空数组
     */
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
