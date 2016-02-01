<?php
/**
 * Created by PhpStorm.
 * User: Edvard
 * Date: 2015/12/21
 * Time: 14:57
 */

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class BaseModel extends Model
{
    const DELETED = 1;
    const NOT_DELETED = 0;
    const LIMIT_ITEM = 10;

    public function initialize()
    {
        $this->addBehavior(new SoftDelete(
            array(
                'field' => 'isdeleted',
                'value' => BaseModel::DELETED
            )
        ));

        $operation = new Operation();
        $cacheToken = json_decode($this->getDI()->getSession()->get('token'));
        $operation->setUserId($cacheToken->user_id);
        $this->addBehavior($operation);
    }

    /**
     * 把信息格式化成我们需要的
     *
     * @param null $filter
     * @return array|\Phalcon\Mvc\MessageInterface[]
     */
    public function getMessages($filter = null)
    {
        $messages = parent::getMessages($filter);
        if (empty($messages))
            return parent::getMessages($filter);

        $arrayMessages['errors'] = array();
        foreach ($messages as $message) {
            switch ($message->getType()) {
                case 'PresenceOf':
                    $arrayMessages['errors'][] = array(
                        'code' => BaseController::FIELD_REQUIRED, // 错误码取自BaseController
                        'field' => $message->getField(),
                        'message' => $message->getMessage()
                    );
                    break;
                case 'Inclusion':
                    $arrayMessages['errors'][] = array(
                        'code' => BaseController::PARAMS_INVALID, // 错误码取自BaseController
                        'field' => $message->getField(),
                        'message' => $message->getMessage()
                    );
                    break;
            }
        }

        return $arrayMessages;
    }

    public function page($table, $field, $where, $orderBy, $currentPage = 1, $limit = self::LIMIT_ITEM)
    {
        if (empty($limit)) {
            $limit = self::LIMIT_ITEM;
        }

        $builder = $this->modelsManager->createBuilder()
            ->columns($field)
            ->from($table)
            ->where($where)
            ->orderBy($orderBy);

        $paginator = new PaginatorQueryBuilder(
            array(
                "builder" => $builder,
                "limit" => $limit,
                "page" => $currentPage
            )
        );
        return $paginator->getPaginate();
    }

    public function pageByData($data, $currentPage = 1, $limit = self::LIMIT_ITEM)
    {
        if (empty($limit)) {
            $limit = self::LIMIT_ITEM;
        }
        $paginator = new PaginatorArray(
            array(
                "data" => $data,
                "limit" => $limit,
                "page" => $currentPage
            )
        );
        return $paginator->getPaginate();
    }

    public function commonPageField($data, $page, $p = 1)
    {
        if (empty($limit))
            $limit = self::LIMIT_ITEM;

        $data['total_pages'] = $page->total_pages;
        $data['total_items'] = $page->total_items;

        if (null == $p)
            $p = 1;
        $data['current'] = $p;

        if (!empty($p) && $p != 1)
            $data['prev'] = '/session?p=' . ($p - 1);
        else
            $data['prev'] = '/session?p=' . $page->total_pages; // 循环吧，到最后一页

        $data['next'] = '/session?p=' . ($p + 1);
        $data['perpage'] = $page->limit;
        return $data;
    }
}
