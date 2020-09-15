<?php
 // 变量|variety
 // 定义变量：在PHP中不需要任何关键字定义变量{赋值}
 $var1; //定义变量
 $var2 = 1; //定义同时赋值

 //如何看到变量的值，访问变量
 echo $var2; //通过var2变量名字找到存储的内容1，然后输出/echo

 //修改变量
 $var2=2;
 echo '<hr />',$var2;

 //删除变量；使用unset(变量名称),删除变量是为了解放内存
 unset($var2);
 echo $var2;

 //可变变量

 //定义两个变量
 $a='b';
 $b='bb';
 echo $a;
 echo '<hr />',$$a,'<hr/>';

 //值传递
 $a=1;
 $b=$a;
 $b=2;

 echo $a,$b,'<br/>';

 //引用传递
 $a=1;
 $b=&$a;
 $a=2;

 echo $a,$b,'<hr/>';