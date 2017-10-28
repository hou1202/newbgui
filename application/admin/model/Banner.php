<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 11:36
 */
namespace app\admin\model;
use think\Model;

class Banner extends Model
{
    //自动写入创建及修改的时间戳
    protected $autoWriteTimestamp = true;

    ///获取器自动处理attribute字段
    protected function getAttributeAttr($value){
        $attribute = [
                        1 => '首页Banner',
                        2 => '关于我们Banner',
                        3 => '产品介绍Banner',
                        4 => '功能版本Banner',
                        5 => '新闻动态Banner',
                        6 => '加入我们Banner',
                        7 => '新闻详情Banner'
                     ];
        return $attribute[$value];
    }

    protected function getCreateTimeAttr($value){
        return date('Y-m-d' , $value);
    }




}