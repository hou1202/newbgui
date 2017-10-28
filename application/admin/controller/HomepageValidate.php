<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25
 * Time: 11:57
 */
namespace app\admin\controller;
use think\Validate;

class HomepageValidate extends Validate
{
    protected $rule = [
        'title' => 'require|max:20',
        'subtitle' => 'require|max:20',
        'sort' => 'require|number|integer',
        'thumbnail' => 'require',
        'info' => 'require|max:1000'
    ];
    protected $message= [
        'title.require' => '标题不得为空...',
        'title.max' => '标题最大不得超过20位...',
        'subtitle.require' => '标题不得为空...',
        'subtitle.max' => '副标题最大不得超过20位...',
        'sort.require' => '排序不得为空...',
        'sort.number' => '排序必须是数字...',
        'sort.integer' => '排序必须是整数...',
        'thumbnail.require' => '说明图不得为空...',
        'info.require' => '简介说明不得为空...',
        'info.max' => '简介说明最大不得超过255位...'
        ];
}