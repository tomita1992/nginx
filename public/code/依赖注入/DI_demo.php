<?php
/**
 *
 * @desc Created by PhpStorm
 * @author: Administrator
 * @since: 2020/11/25 19:53
 */

interface Interface1
{
  public function foo();
}

class Class_1 implements Interface1
{
  public function foo()
  {
    $className = __CLASS__;
    echo "我是{$className} 我实现了接口Interface1\n";
  }
}

class Class_2 implements Interface1
{
  public function foo()
  {
    $className = __CLASS__;
    echo "我是{$className} 我实现了接口Interface1\n";
  }
}

class Class_DI
{
  public Interface1 $interface1;

  public function __construct(Interface1 $interface1)
  {
    $this->interface1 = $interface1;
  }
}

$class1 = new Class_1();
$class2 = new Class_2();

$class_DI = new Class_DI($class1);
$class_DI->interface1->foo();

$class_DI = new Class_DI($class2);
$class_DI->interface1->foo();