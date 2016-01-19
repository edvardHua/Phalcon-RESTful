<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\Request;

class BaseController extends Controller
{
    /**
     * @apiDefine header
     * @apiHeader {String} Accept=api-version=1.0 api版本
     * @apiHeader {String} token=xxx 授权的token
     * @apiHeaderExample {String} Header-Example:
     *     {
     *       "Accept": "api-version=1.0"
     *     }
     */


    /**
     * @apiDefine errorExample
     * @apiError ParamInvalid 参数不合法或为空
     * @apiError ParamInvalid Token非法
     *
     * @apiErrorExample Error-Required-Response:
     *     HTTP/1.1 406 Not Acceptable
     *     {
     *      "errors": [
     *                  {
     *                    "code": "0001",
     *                    "field": "param_key",
     *                    "message": "The param_key is required"
     *                  }
     *                ]
     *     }
     *
     *
     * @apiErrorExample Error-Invalid-Response:
     *     HTTP/1.1 406 Not Acceptable
     *     {
     *      "errors": [
     *                  {
     *                    "code": "0002",
     *                    "field": "param_key",
     *                    "message": "The param_key is incorrect"
     *                  }
     *                ]
     *     }
     * @apiErrorExample Error-Invalid-Token-Response:
     *     HTTP/1.1 401  Unauthorized
     *     {
     *      "errors": [
     *                  {
     *                     "code": "0003",
     *                     "field": "token",
     *                     "message": "Permission denied."
     *                  }
     *                ]
     *     }
     */

    private static $expire = 7200; // 暂时设定默认过期时间为两小时

    const FIELD_REQUIRED = '0001'; // 该值为空
    const PARAMS_INVALID = '0002'; // 参数不合法
    const PERMISSION_DENIED = '0003'; // 没有权限
    /**
     * 公共的错误码
     * @var array
     */
    private $_errors = array(
        self::FIELD_REQUIRED => array('http_code' => 406, 'field' => null, 'message' => 'Not found or forbidden.'),
        self::PARAMS_INVALID => array('http_code' => 406, 'field' => null, 'message' => 'Parameter invalid.'),
        self::PERMISSION_DENIED => array('http_code' => 401, 'field' => null, 'message' => 'Permission denied.')
    );

    /**
     *
     * 说明:
     * HTTP Status 2xx  (成功)
     * ->表示成功处理了请求的状态代码;
     *
     * 详细代码及说明:
     *
     * HTTP Status 200 (成功)
     * -> 服务器已成功处理了请求。 通常，这表示服务器提供了请求的网页。
     * HTTP Status 201 (已创建)
     * -> 请求成功并且服务器创建了新的资源。
     * HTTP Status 202 (已接受)
     * -> 服务器已接受请求，但尚未处理。
     * HTTP Status 203 (非授权信息)
     * -> 服务器已成功处理了请求，但返回的信息可能来自另一来源。
     * HTTP Status 204 (无内容)
     * -> 服务器成功处理了请求，但没有返回任何内容。
     * HTTP Status 205 (重置内容)
     * -> 服务器成功处理了请求，但没有返回任何内容。
     * HTTP Status 206 (部分内容)
     * -> 服务器成功处理了部分 GET 请求。
     *
     *
     * HTTP Status 4xx (请求错误)
     * ->这些状态代码表示请求可能出错，妨碍了服务器的处理。
     * 详细代码说明:
     * HTTP Status 400 （错误请求）
     * ->服务器不理解请求的语法。
     * HTTP Status 401 （未授权）
     * ->请求要求身份验证。 对于需要登录的网页，服务器可能返回此响应。
     * HTTP Status 403 （禁止）
     * -> 服务器拒绝请求。
     * HTTP Status 404 （未找到）
     * ->服务器找不到请求的网页。
     * HTTP Status 405 （方法禁用）
     * ->禁用请求中指定的方法。
     * HTTP Status 406 （不接受）
     * ->无法使用请求的内容特性响应请求的网页。
     * HTTP Status 407 （需要代理授权）
     * ->此状态代码与 401（未授权）类似，但指定请求者应当授权使用代理。
     * HTTP Status 408 （请求超时）
     * ->服务器等候请求时发生超时。
     * HTTP Status 409 （冲突）
     * ->服务器在完成请求时发生冲突。 服务器必须在响应中包含有关冲突的信息。
     * HTTP Status 410 （已删除）
     * -> 如果请求的资源已永久删除，服务器就会返回此响应。
     * HTTP Status 411 （需要有效长度）
     * ->服务器不接受不含有效内容长度标头字段的请求。
     * HTTP Status 412 （未满足前提条件）
     * ->服务器未满足请求者在请求中设置的其中一个前提条件。
     * HTTP Status 413 （请求实体过大）
     * ->服务器无法处理请求，因为请求实体过大，超出服务器的处理能力。
     * HTTP Status 414 （请求的 URI 过长） 请求的 URI（通常为网址）过长，服务器无法处理。
     * HTTP Status 415 （不支持的媒体类型）
     * ->请求的格式不受请求页面的支持。
     * HTTP Status 416 （请求范围不符合要求）
     * ->如果页面无法提供请求的范围，则服务器会返回此状态代码。
     * HTTP Status 417 （未满足期望值）
     * ->服务器未满足”期望”请求标头字段的要求。
     *
     *
     *
     * 说明
     * HTTP Status 5xx （服务器错误）
     * ->这些状态代码表示服务器在尝试处理请求时发生内部错误。 这些错误可能是服务器本身的错误，而不是请求出错。
     *
     * 代码详细及说明:
     * HTTP Status 500 （服务器内部错误）
     * ->服务器遇到错误，无法完成请求。
     * HTTP Status 501 （尚未实施）
     * ->服务器不具备完成请求的功能。 例如，服务器无法识别请求方法时可能会返回此代码。
     * HTTP Status 502 （错误网关）
     * ->服务器作为网关或代理，从上游服务器收到无效响应。
     * HTTP Status 503 （服务不可用）
     * -> 服务器目前无法使用（由于超载或停机维护）。 通常，这只是暂时状态。
     * HTTP Status 504 （网关超时）
     * ->服务器作为网关或代理，但是没有及时从上游服务器收到请求。
     * HTTP Status 505 （HTTP 版本不受支持）
     * -> 服务器不支持请求中所用的 HTTP 协议版本。
     */
    private $_statuses = array(
        200 => 'OK',
        201 => 'CREATED',
        202 => 'ACCEPTED',
        204 => 'NO CONTENT',
        400 => 'INVALID REQUEST',
        401 => 'UNAUTHORIZED',
        403 => 'FORBIDDEN',
        404 => 'NOT FOUND',
        406 => 'NOT ACCEPTABLE',
        410 => 'GONE',
        422 => 'UNPROCESABLE ENTITY',
        500 => 'INTERNAL SERVER ERROR',
    );

    /**
     * @param array $data
     * @param int $status
     * @return Response
     */
    public function response($data = array(), $status = 200)
    {
        $response = new Response();

        $response->setStatusCode($status);
        $response->setContent(!empty($this->_statuses[$status]) ? $this->_statuses[$status] : null);
        $response->setHeader('Content-type', 'application/json');
        $response->setHeader('api-version', '1.0');
        $response->setJsonContent($data);

        return $response;
    }

    /**
     * @param array $errors
     * @param int $status
     * @param null $customTips 自定义的消息组
     * @return Response
     */
    public function error($field, $code)
    {
        $data = array(
            'errors' => array()
        );
        $item = array(
            'code' => $code,
            'field' => $field,
            'message' => $this->_errors[$code]['message'],
        );
        $data['errors'][] = $item;

        return $this->response($data, $this->_errors[$code]['http_code']);
    }

    /**
     * 因为频繁用到，所以抽取
     * @return Response
     */
    public function tokenError()
    {
        return self::error('token', self::PERMISSION_DENIED);
    }

    /**
     * @param array $data
     * @param int $status
     * @return Response
     */
    public function success($data = array(), $status = 200)
    {
        return $this->response($data, $status);
    }

    /**
     * 获得token
     * @param $userId
     * @param $orgId
     * @param $eventId
     * @return bool 返回false表示生成失败，否则返回sessionId
     */
    protected function obtainToken($userId, $orgId, $eventId, $role)
    {
        session_start();
        session_regenerate_id();
        $sessionId = session_id();
        $token = new Token();

        $token->expire = time() + self::$expire;
        $token->create_time = time();
        $token->token = $sessionId;
        $token->event_id = $eventId;
        $token->user_id = $userId;
        $token->org_id = $orgId;

        switch($role){
            case 5:
                $token->auth = 'Admin';
                break;
            case 6:
                $token->auth = 'Organizer';
                break;
            case 9:
                $token->auth = 'Scanner';
                break;
        }

        /**
         * 把这玩意保存进session
         */
        $this->session->set('token', json_encode($token));

        if (!$token->save()) {
            return false;
        }

        return $sessionId;
    }


    /**
     * 验证token
     * @return bool false为非法 否则返回储存在数据库的token值
     */
    public function verifyToken()
    {
        $request = new Request();
        $token = $request->getHeader('token');

        if (!empty($token)) {
//            $tokenModel = new Token();
//            $dbToken = $tokenModel->findToken($token);
            session_id($token);
            $cacheToken = json_decode($this->session->get('token')); //从缓存中取得token
            if (null == $cacheToken)
                return false;

            $offset = time() - intval($cacheToken->expire);

            if ($offset > 0) { // 过期
                return false;
            }

            if (!empty($cacheToken->logout_time)) { // 已经退出登录
                return false;
            }
            return $cacheToken;
        }

        // 为空，直接返回false
        return false;
    }

    public function verifyNumeric($p)
    {
        if (!empty($p)) {
            $reg = '/^\+?[1-9][0-9]*$/';
            preg_match($reg, $p, $result);
            if (empty($result))
                return false;
        }
        return true;
    }

    public function verifyJson($param)
    {
        if (!empty($param)) {
            $res = json_decode($param, true);
            if (empty($res))
                return false;
            return $res;
        }
        return true;
    }

    public function pInvalid()
    {
        return self::error('p', self::PARAMS_INVALID);
    }

    public function perPageInvalid()
    {
        return self::error('perpage', self::PARAMS_INVALID);
    }

    public function filterInvalid()
    {
        return self::error('filter', self::PARAMS_INVALID);
    }

    public function index()
    {
        echo 'Singou Encounter Back End API Server';
    }
}
