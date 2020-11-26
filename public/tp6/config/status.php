<?php
/**
 * 该文件主要存放业务状态码相关的配置
 * @desc Created by PhpStorm
 * @author: Administrator
 * @since: 2020/11/26 23:02
 */

//  +-------------------------------------------+
//  |           业务层状态码相关配置               |
//  +-------------------------------------------+

return [
  //访问成功
  'success'             => 1,
  //访问失败
  'error'               => 0,
  //已登录
  'not_login'           => -1,
  //已注册
  'user_is_register'    => -2,
  //方法不存在
  'action_not_find'     => -3,
  //控制器不存在
  'controller_not_find' => -4
];