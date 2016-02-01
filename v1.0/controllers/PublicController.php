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

        $userModel = new User();

        $result = $userModel->login($username, $password);
        if (false === $result) {
            return parent::response($userModel->getMessages(), 406);
        }
        $roleUser = RoleUser::findFirst("user_id=" . $result->id);

        $token = parent::obtainToken($result->id, $roleUser->role_id);

        if (false === $token) {
            return parent::response(array(
                'errors' => array(
                    array(
                        'code' => 500,
                        'field' => null,
                        'message' => 'unkown error',
                    )
                )
            ), 500);
        }

        return parent::success(array(
            'token' => $token
        ));
    }

    public function logout(){

    }

    public function register(){

    }
}
