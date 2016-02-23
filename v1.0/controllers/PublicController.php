<?php
/**
 * Class PublicController
 * @author Edvard
 * @time 2015.12.14 12:13
 */

use Phalcon\Mvc\Model\Query;
use Phalcon\Http\Response;

class PublicController extends BaseController
{
    /**
     * @api {post} /token 登录获得token
     * @apiHeader {String} Accept=api-version=1.0 api版本
     * @apiHeaderExample {String} Header-Example:
     *     {
     *       "Accept": "api-version=1.0"
     *     }
     * @apiName login
     * @apiGroup Token
     * @apiVersion 1.0.0
     *
     * @apiParam {String} username 用户名
     * @apiParam {String} password 密码
     *
     * @apiSuccess {String} token 该用户的token，两小时后失效
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "token": "xxx"
     *     }
     *
     * @apiUse errorExample
     */
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $modelUser = new User();

        $userValidator = new UserValidator();
        $messages = $userValidator->validate($this->request->getPost());

        if (0 != count($messages)) {
            return parent::resWithErrMsg($messages, 406);
        }

        $result = $modelUser->login($username, $password);
        if (false === $result) {
            return parent::resWithErrMsg($modelUser->getMessages(), 406);
        }

        $roleUser = RoleUser::findFirst("user_id=" . $result->id);

        $token = parent::obtainToken($result->id, $roleUser->role_id);

        if (false === $token) {
            return parent::serverError();
        }

        return parent::success(array(
            'token' => $token
        ));
    }

    /**
     * @api {post} /token 登录获得token
     * @apiUse header
     *
     * @apiName logout
     * @apiGroup Token
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Array} empty_array 空数组，无实际意义
     *
     * @apiUse errorExample
     */
    public function logout()
    {
        $token = $this->session->get('token');

        if (false == $token)
            return parent::tokenError();

        if (!empty($token->logout_time))
            return parent::tokenError();

        $dbToken = Token::findFirst("token='" . $token->token . "'");
        $dbToken->logout_time = time();
        if (false == $dbToken->delete())
            return parent::serverError();

        $this->session->set('token',null); // 设置token为null
        return parent::success();
    }

    /**
     * @api {post} /user 注册接口
     * @apiHeader {String} Accept=api-version=1.0 api版本
     * @apiHeaderExample {String} Header-Example:
     *     {
     *       "Accept": "api-version=1.0"
     *     }
     * @apiName register
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Array} empty_array 空数组
     *
     * @apiUse errorExample
     */
    public function register()
    {
        $this->db->begin();

        $data = $this->request->getPost();

        $userValidator = new UserValidator();
        $messages = $userValidator->validate($data);
        if(0 != count($messages)){
            return parent::resWithErrMsg($messages, 406);
        }

        $modelUser = new User();
        $duplicate = $modelUser->findFirst("lower(username)='".strtolower($data['username'])."'");
        if(!empty($duplicate)){
            return parent::valueDuplicate('username');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $res = $modelUser->create($data);
        if (false == $res) {
            $this->db->rollback();
            return parent::resWithErrMsg($modelUser->getMessages());
        }

        $config = $this->di->get('config');
        $userRole['role_id'] = $config->role->User;
        $userRole['user_id'] = $modelUser->id;

        $roleUserModel = new RoleUser();
        $res = $roleUserModel->create($userRole);
        if (false == $res) {
            $this->db->rollback();
            return parent::resWithErrMsg($roleUserModel->getMessages());
        }

        $this->db->commit();
        return parent::success();
    }
}
