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
    /**
     * @api {get} /admin/user 获得全部用户信息
     * @apiHeader {String} Accept=api-version=1.0 api版本
     * @apiHeaderExample {String} Header-Example:
     *     {
     *       "Accept": "api-version=1.0"
     *       "token": xxx
     *     }
     * @apiName getUser
     * @apiGroup Admin
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Array} users 该用户的信息
     *     HTTP/1.1 200 OK
     *       {
     *           "users": [
     *                       {
     *                           "id": "1",
     *                           "username": "Admin",
     *                           "name": "Edvard",
     *                           "organization": null,
     *                           "title": "Software Enginner",
     *                           "email": "edvard_hua@live.com"
     *                       },
     *                       {
     *                           "id": "2",
     *                           "username": "MCAA2015",
     *                           "name": "Lucky",
     *                           "organization": "WTF",
     *                           "title": null,
     *                           "email": null
     *                       }
     *           ],
     *           "total_pages": 1,
     *           "total_items": 2,
     *           "current": 1,
     *           "prev": "/admin/user?p=1",
     *           "next": "/admin/user?p=2",
     *           "perpage": 10
     *       }
     *
     * @apiUse errorExample
     */
    public function getUsers()
    {
        $userModel = new User();

        $p = $this->request->get('p');
        if (!empty($p) && !is_numeric($p)) {
            return parent::invalid('p', $p);
        }

        $perpage = $this->request->get('perpage');
        if (!empty($p) && !is_numeric($perpage))
            return parent::invalid('perpage', $perpage);

        $page = $userModel->page(
            'User',
            'id,username, name, organization, title, email',
            'isdeleted=0',
            'created_time desc'
        );
        $items['users'] = $page->items->toArray();

        return parent::success($userModel->commonPageField($items, $page, $p, $this->request->get('_url')));
    }

    /**
     * @api {get} /admin/user/{id} 获得指定用户信息
     * @apiUse header
     *
     * @apiName getUser
     * @apiGroup Admin
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Array} user 该用户的信息
     *     HTTP/1.1 200 OK
     *       {
     *           "users": [
     *                       {
     *                           "id": "1",
     *                           "username": "Admin",
     *                           "name": "Edvard",
     *                           "organization": null,
     *                           "title": "Software Enginner",
     *                           "email": "edvard_hua@live.com"
     *                       },
     *                       {
     *                           "id": "2",
     *                           "username": "MCAA2015",
     *                           "name": "Lucky",
     *                           "organization": "WTF",
     *                           "title": null,
     *                           "email": null
     *                       }
     *           ],
     *           "total_pages": 1,
     *           "total_items": 2,
     *           "current": 1,
     *           "prev": "/admin/user?p=1",
     *           "next": "/admin/user?p=2",
     *           "perpage": 10
     *       }
     *
     * @apiUse errorExample
     */
    public function getUser($id)
    {
        $user = User::find(array(
                'id=' . $id . ' and isdeleted=0',
                'columns' => 'id,username, name, organization, title, email'
            )
        );
        if(0 == count($user))
            return parent::invalid('id',$id);
        return parent::success(array('user' => $user->toArray()));
    }

    /**
     * @api {delete} /admin/user/{id} 删除某个用户
     * @apiUse header
     *
     * @apiName deleteUser
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
    public function deleteUser($id)
    {
        if (empty($id)) {
            return parent::required('id');
        }

        $where = 'id=' . $id . ' and isdeleted=0';

        $user = User::findFirst($where);
        if (empty($user)) {
            return parent::invalid('id', $id);
        }
        if (false == $user->delete())
            return parent::resWithErrMsg($user->getMessages(), 406);

        $roleUser = new RoleUser();
        $roleUser->user_id = $id;
        if(false == $roleUser->delete())
            return parent::resWithErrMsg($roleUser->getMessages());

        return parent::success();
    }
}
