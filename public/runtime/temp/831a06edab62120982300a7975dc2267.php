<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\newbgui\public/../application/admin\view\main\test.html";i:1505447297;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
这是一个测试页面
<p>{{<?php if(is_array($tests) || $tests instanceof \think\Collection || $tests instanceof \think\Paginator): if( count($tests)==0 ) : echo "" ;else: foreach($tests as $key=>$i): ?>}} <?php echo $i; ?> {{<?php endforeach; endif; else: echo "" ;endif; ?>}}</p>
<p><?php echo $content; ?></p>
</body>
</html>