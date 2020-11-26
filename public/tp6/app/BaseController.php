<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
  /**
   * Request实例
   * @var \think\Request
   */
  protected $request;

  /**
   * 应用实例
   * @var \think\App
   */
  protected $app;

  /**
   * 是否批量验证
   * @var bool
   */
  protected $batchValidate = false;

  /**
   * 控制器中间件
   * @var array
   */
  protected $middleware = [];

  /**
   * 构造方法
   * @access public
   * @param App $app 应用对象
   */
  public function __construct(App $app)
  {
    $this->app = $app;
    $this->request = $this->app->request;

    // 控制器初始化
    $this->initialize();
  }

  // 初始化
  protected function initialize()
  {
  }

  /**
   * 验证数据
   * @access protected
   * @param array $data 数据
   * @param string|array $validate 验证器名或者验证规则数组
   * @param array $message 提示信息
   * @param bool $batch 是否批量验证
   * @return array|string|true
   * @throws ValidateException
   */
  protected function validate(array $data, $validate, array $message = [], bool $batch = false)
  {
    if (is_array($validate)) {
      $v = new Validate();
      $v->rule($validate);
    } else {
      if (strpos($validate, '.')) {
        // 支持场景
        [$validate, $scene] = explode('.', $validate);
      }
      $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
      $v = new $class();
      if (!empty($scene)) {
        $v->scene($scene);
      }
    }

    $v->message($message);

    // 是否批量验证
    if ($batch || $this->batchValidate) {
      $v->batch(true);
    }

    return $v->failException(true)->check($data);
  }

  /**
   * 访问类中不存在的方法时会自动调用
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
    //由于定义了公共的方法 所以不需要在这个地方定义
//    $result = [
//      'status'  => 0,
//      'message' => '找不到该方法',
//      'result'  => null
//    ];
//    return json($result, 400);
//    在代码中直接写数字的状态码很不容易理解 所以将状态码放到配置文件里 然后直接读取配置文件就好
//    return show(-1, "找不到该{$name}方法", null, 404);

      return show(config('status.action_not_find'), "找不到该{$name}方法", null, 404);
  }
}
