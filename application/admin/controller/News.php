<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15
 * Time: 15:57
 */

namespace app\admin\controller;


use think\Controller;
use app\admin\model\News as NewsModel;
use think\Validate;


class News extends Controller
{
    public function list_news(){
        $news = new NewsModel();
        $count = $news -> getCountNews();
        $list = $news->paginate(5,false,['path' => '/admin/main#/news/list_news' ]);
        foreach($list as $value){
            $value['title'] = mb_substr($value['title'],0,10,'utf-8');
            $value['info'] = mb_substr($value['info'],0,30,'utf-8').'...';
            $value['state'] = $value['state'] ? '通过' : '未通过';
            $value['c_date'] = date('Y-m-d' , $value['c_date']);
        }
        return view('list_news',['List' => $list,'Count' => $count]);
    }

    public function add_news(){
        if($this->request->isPost()){
            $post_data = array();
            $post_data = $this -> request -> post();
            $post_data['author'] = empty($post_data['author']) ? '平台作者' : $post_data['author'];
            $post_data['c_date'] = time();
            $post_data['u_date'] = time();
            $post_data['state'] = 1;
            //var_dump($post_data);
            $validate = new NewsValidate();
            if($validate -> check($post_data)){
                $news = new NewsModel();
                return $news -> allowField(true) -> save($post_data) ? ReturnJson::ReturnJ("恭喜你啊，搞定了！","success","/news/list_news") : ReturnJson::ReturnJ("出现了一些纰漏，没有创建成功，请重新提交！","false");
            }else{
                return ReturnJson::ReturnJ($validate -> getError(),"false");
            }
        }else{
            return view('add_news');
        }
    }

    public function update_news(){
        //修改提交信息
        if($this -> request -> isPost()){
            $post_data = array();
            $post_data = $this -> request -> Post();
            if(isset($post_data['id']) && empty($post_data['id'])){
                return ReturnJson::ReturnJ('非法数据操作！','false','/news/list_news');
            }
            $post_data['author'] = empty($post_data['author']) ? '平台作者' : $post_data['author'];
            $post_data['u_date'] = time();
            $validate = new NewsValidate();
            if($validate -> check($post_data)){
                $news = new NewsModel();
                 return $news -> save($post_data,['id' => $post_data['id']]) ? ReturnJson::ReturnJ('恭喜你啊，更新成功了！','success','/news/list_news') : ReturnJson::ReturnJ('出现了一些纰漏，没有更新成功，请重新提交！','false');
            }
            return ReturnJson::ReturnJ($validate -> getError(),'false');
        }

        //获取、展示修改信息
        if(isset($_GET['id'])){
            $news = new NewsModel();
            $getOne = $news -> field('id,title,author,thumbnail,info,content,state') -> where('id',$_GET['id']) -> limit(1) -> find();
            return $getOne ?  view('update_news',['getOne' => $getOne]) : ReturnJson::ReturnH("未获取到相应的新闻数据信息！","#/news/list_news");
        }else{
            ReturnJson::ReturnH("非法数据操作!！","#/news/list_news");
        }

    }

    public function del_news(){
        if(isset($_GET['id'])){
            $news = new NewsModel();
            return $news -> where('id','eq',$_GET['id']) -> delete() ? ReturnJson::ReturnJ("已成功删除此信息!") : ReturnJson::ReturnJ($news -> getError(),"false");
        }
        return ReturnJson::ReturnJ("非法的数据提交信息!","false");
    }

    //新闻搜索
    public function serach_news()
    {

        if ($this->request->isGet()  && isset($_GET['keyword'])){
            $post_data = $this->request->get('keyword');
            if (empty($post_data)) {
                return ReturnJson::ReturnA('关键字不能为空，请重新搜索！');
            } else {
                $news = new NewsModel();
                $serachList = $news->getSerachNews($post_data);
                if (empty($serachList->items())) {
                    return ReturnJson::ReturnA('未查询到相关数据，请重新搜索！');
                } else {
                    foreach($serachList as $value){
                        $value['title'] = mb_substr($value['title'],0,10,'utf-8');
                        $value['info'] = mb_substr($value['info'],0,30,'utf-8').'...';
                        $value['state'] = $value['state'] ? '通过' : '未通过';
                        $value['c_date'] = date('Y-m-d' , $value['c_date']);
                    }
                    return view('serach_news' , ['serachList' => $serachList , 'Count' => $news->getCountSerachNews($post_data)]);
                }
            }
        }else{
            return ReturnJson::ReturnA('非法数据操作!');
        }

    }


}