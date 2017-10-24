<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15
 * Time: 16:10
 */
namespace app\admin\model;

use think\Model;

class News  extends Model
{
    //取值器方法
    /*public function getStateAttr($value){
        $state = [0 => '未通过' , 1 => '通过'];
        return $state[$value];
    }*/


    //获取所有新闻信息
    public function getListNews(){
        return $this -> alias('n')
                     -> field('n.id,n.title,n.info,n.author,n.c_date,n.thumbnail,n.state')
                     //->limit('4')
                     ->order('c_date','DESC')
                     -> select();
    }

    //按id统计新闻数量
    public function getCountNews(){
        return $this -> alias('n')
                     ->field('n.id')
                     ->count();
    }

    //前端新闻列表
    public function getFrontListNews(){
        return $this -> alias('n')
            -> field('n.id,n.title,n.info,n.author,n.c_date,n.thumbnail,n.state')
            ->where(['n.state' => 1])
            ->limit('2')
            ->order('c_date','DESC')
            -> select();
    }

    //搜索新闻
    public function getSerachNews($keyword){
        return $this -> field('id,title,info,thumbnail,author,state,c_date')
                     -> where('id','=',$keyword)
                     -> whereOr('title','like','%'.$keyword.'%')
                     -> order('c_date','DESC')
                     -> paginate(5,false,['path' => '/admin/main#/news/serach_news' ]);
                     //-> select();
    }

    //按id统计搜索新闻数量
    public function getCountSerachNews($keyword){
        return $this -> field('id')
                     -> where('id','=',$keyword)
                     -> whereOr('title','like','%'.$keyword.'%')
                     ->count();
    }


}