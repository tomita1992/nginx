<?php
/**
 *
 * @desc Created by PhpStorm
 * @author: Administrator
 * @since: 2020/11/24 22:51
 */

namespace  app\controller;

use app\BaseController;

class Demo extends BaseController
{
  /**
   * 可以用用过return的方式直接将数据传回给前端
   * 第一个参数为数据，第二个参数为状态码，第三个参数为设置的header头信息
   * @return \think\response\Json
   */
  public function show()
  {
    $result = [
      'status' => 1,
      'message' => 'ok',
      'result' => ['id' => 1],
    ];
    $header = [
      'Token' => 'tomita'
    ];
    return json($result, 201, $header);
  }

  /**
   *  参数的获取方法
   *  1.通过访问本类的request属性来直接获取
   *  这个request是通过BaseController的构造方式中注入的app对象
   *  去访问容器类的make方法创建 再通过反转赋给继承了BaseController的子类的
   *  request属性 这样就可以用this直接取访问各种方法
   */
  public function request()
  {
    dump($this->request->param('abc', 1111, 'intval'));
  }
}