<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:24
 */

namespace app\index\controller;
use app\admin\controller\ReturnJson;
use think\Controller;
use app\admin\model\News;
use think\model;

class Index extends Controller
{
    public function index(){
        $news = new News();
        $list = $news -> getFrontListNews();
        foreach($list as $value){
            $value['c_date'] = date('Y-m-d' , $value['c_date']);
        }
        return view('',['List' => $list]);
    }

    public function destail(){
        if($this->request->isGET() && isset($_GET['id'])){
            $get_data = $this -> request -> GET();
            $news = new News();
            $OneNew = $news::get(['id' => $get_data['id']]);
            if($OneNew){
                return $this -> fetch('destail',['OneNew' => $OneNew]);
            }else{
                return ReturnJson::ReturnH('未找到相关文章，新重新浏览！','/index/index');
            }
        }else{
            return ReturnJson::ReturnH('未找到相关文章，新重新浏览！','/index/index');
        }
    }
}