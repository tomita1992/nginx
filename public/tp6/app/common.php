<?php
// 应用公共文件

/**
 * 前后端都会用到的通用化的方法
 * 通用化API数据格式输出
 * @param int $status             ->   业务层的状态码
 * @param string $message         ->   消息提示
 * @param array $data             ->   数据
 * @param int $httpStatus         ->   http状态码
 * @return \think\response\Json   ->   返回给前端的API数据
 */
function show(int $status, string $message = 'error', $data = [], int $httpStatus = 200)
{
  /**
   *  返回的数据内容就是API的数据规范
   */
  $result = [
    'status'  => $status,
    'message' => $message,
    'result'  => $data
  ];

  return json($result, $httpStatus);
}