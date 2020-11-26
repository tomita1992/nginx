<?php
/**
 *
 * @desc Created by PhpStorm
 * @author: Administrator
 * @since: 2020/11/26 21:41
 */


namespace app\controller;


use app\Request;
use think\facade\Request as facadeRequest;

class Learn
{
  /**
   * 第二种获取url参数的方法
   * 通过依赖注入的方式获取框架内的Request对象
   * @param Request $request
   */
  public function index(Request $request)
  {
    if(!$request->isPost() && !$request->isAjax() && $request->isGet()){
      dump($request->get('abc', 1111, 'intval'));

      /**
       * 第三种获取url参数的方法
       * 通过Request对象中的input方法
       */
      dump(input('name'));

      /**
       *  第四种获取url参数的方法
       *  通过框架提供的request方法来获取
       */
      dump(request()->request('age'));

      /**
       *  第五种获取url参数的方法
       *  使用框架的门面模式
       */
      dump(facadeRequest::param('gender'));

      /**
       *  无论是哪一种最后都是通过调用app类中的request属性来完成
       */
    }
  }
}