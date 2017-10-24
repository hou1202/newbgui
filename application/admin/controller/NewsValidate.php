<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 10:50
 */

namespace app\admin\controller;

use think\Validate;

class NewsValidate extends Validate
{
    protected $rule = [
        'title' => 'require|max:60',
        'author' => 'max:20',
        'thumbnail' => 'require',
        'info' => 'require|max:250',
        'content' => 'require',
    ];

    protected $message = [
        'title.require' => '新闻标题内容不得为空！',
        'title.max' => '新闻标题最大为得超过25位！',
        'author.max' => '作者名称长度最大不得超过10位！',
        'thumbnail.require' => '新闻缩略图不得为空！',
        'info.require' => '新闻简介不得为空！',
        'info.max' => '新闻简介长度最大不得超过250位！',
        'content.require' => '新闻内容不得为空！',
    ];

}