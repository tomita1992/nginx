<?php
/**
 *
 * @desc Created by PhpStorm
 * @author: Administrator
 * @since: 2020/11/26 22:38
 */


namespace app\controller;

/**
 * TP框架规定的Error类 内容自定义
 * 找不到控制器时会自动调用
 * Class Error
 * @package app\controller
 */
class Error
{
  /**
   * @param $name                     ->    访问的方法名
   * @param $arguments                ->    URL中的参数数组
   * @return \think\response\Json     ->    通过API模式 返回给前端的错误数据
   */
  public function __call($name, $arguments)
  {
    /**
     *  逻辑：如果是提供给前端APP的时候会通过API的模式  所以需要输出API的数据格式
     *       如果是模板引擎的方式 就只会输出一个通用的错误页面
     */
    $result = [
      'status'  => config('status.controller_not_find'),
      'message' => '找不到该控制器',
      'result'  => null
    ];

    return json($result, 400);
  }
}