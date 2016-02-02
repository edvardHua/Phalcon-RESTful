<?php
/**
 * Created by PhpStorm.
 * User: Edvard
 * Date: 2015/12/21
 * Time: 14:57
 */

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class BaseModel extends Model
{
    const DELETED = 1;
    const LIMIT_ITEM = 10;

    public function initialize()
    {
        $this->setConnectionService('db'); // 可修改连接的数据库

        $this->addBehavior(new SoftDelete(
            array(
                'field' => 'isdeleted',
                'value' => BaseModel::DELETED
            )
        ));

        $operationLog = new OperationLog();
        $cacheToken = json_decode($this->getDI()->getSession()->get('token'));
        if (null !== $cacheToken) {  // 一些公共的接口是没有登录信息的
            $operationLog->setUserId($cacheToken->user_id);
        }
        $this->addBehavior($operationLog);
    }

    /**
     * @param $table
     * @param $field
     * @param $where
     * @param $orderBy
     * @param int $currentPage
     * @param int $limit
     * @return stdClass
     */
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

    /**
     * @param $data
     * @param int $currentPage
     * @param int $limit
     * @return stdClass
     */
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

    /**
     * @param $data
     * @param $page
     * @param int $p
     * @param string $path
     * @return mixed
     */
    public function commonPageField($data, $page, $p = 1, $path = '')
    {

        $data['total_pages'] = $page->total_pages;
        $data['total_items'] = $page->total_items;

        if (null == $p)
            $p = 1;
        $data['current'] = $p;

        if (!empty($p) && $p != 1)
            $data['prev'] = $path . '?p=' . ($p - 1);
        else
            $data['prev'] = $path . '?p=' . $page->total_pages; // 循环吧，到最后一页

        $data['next'] = $path . '?p=' . ($p + 1);
        $data['perpage'] = $page->limit;
        return $data;
    }

}
