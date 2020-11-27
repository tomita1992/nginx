<?php
/**
 *
 * @desc Created by PhpStorm
 * @author: Administrator
 * @since: 2020/11/26 23:42
 */


namespace app\controller;

use app\BaseController;
use think\facade\{Db, Request};

class Data extends BaseController
{
  public function index()
  {
    /**
     *  第一种操作数据库的方法
     *  通过门面模式访问Db的基础类库
     */
    $result = Db::table('users')->where('id', 2)->find();

    /**
     *  排序的方法
     *  直接获取最后一条数据
     */
    $result = Db::table('users')
      ->order('id', 'desc')
      ->find();

    /**
     *  分页
     */
    $result = Db::table('users')
        ->order('id', 'desc')
        //分页 从第二条开始取 取四条
        //->limit(2,4)

        //还可以使用page方法 可以省去计算
        //第一个参数为页数 就是从第一页取两条
        ->page(1, 2)
        ->select();

    /**
     *  where
     */
    $result = Db::table('users')
      //通过where方法中的三个参数来指定条件
      //->where('id', '=', 2)
      //多个条件时可以再次调用where方法
//      ->where(['id' => 2])
//      ->where('gender', '=', 1)
        //还可以通过二维数组来定义where条件
        //使用这种方式的一维数组里必须有三个值
        ->where([
          ['id', 'in', '5, 6, 7, 10'],
          ['gender', '=', 1]
      ])
      ->select();
    dump($result);

    /**
     *  第二种操作数据库的方法
     *  通过容器实现Db实例
     */
    $result = app('db')->table('users')->where('id', 2)->find();
  }

  public function abc(Request $request)
  {
    /**
     *  排查数据库操作 发生问题时的排查方法
     *  1.通过页面右下角的调试中的SQL语句
     */
//    $result = Db::table('users')->where('id', 200)->find();

    /**
     *   2.通过fetchSql()方法
     *    查询语句发生错误时 可以直接在页面上显示出来
     */
    $result = Db::table('users')->where('id', 200)->fetchSql()->find();

    /**
     *   3.通过Db::getLastSql()方法
     *    可以直接返回上一条SQL语句
     */
    $result = Db::table('users')->where('id', 200)->find();
    echo Db::getLastSql();exit();
    dump($result);
  }

  /**
   * 新增数据
   * @param Request $request
   */
  public function insert(Request $request)
  {
    /**
     *  插入数据直接使用instrt()方法
     *  可以直接插入关联数组
     */
    $data = [
      'name'   => '张大哥',
      'age'    => 37,
      'gender' => '1'
    ];
    $request = Db::table('users')->insert($data);
    echo app('db')->getLastSql();
    dump($request);
  }

  /**
   *  删除
   */
  public function delete()
  {
    /**
     *  使用delete()方法
     *  参数为id
     *  还可以使用where()方法来指定条件
     */
  //$result = app('db')->table('users')->delete(21);
    $result = app('db')->table('users')->where('id', 22)->delete();
    echo app('db')->getLastSql();
    dump($result);
  }

  /**
   * 更新
   * @throws \think\db\exception\DbException
   */
  public function update()
  {
    /**
     * 使用update()方法来更新
     */
    $result = Db::table('users')->where('id', 20)->update(['name' => '王二傻']);
    echo app('db')->getLastSql();
    dump($result);
  }
}