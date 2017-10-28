<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 18:00
 */
namespace app\index\controller;

use app\admin\controller\ReturnJson;
use app\admin\model\Banner;
use think\Controller;
use app\admin\model\News as NewsModel;

class News extends Controller
{
    public function index(){
        $news = new NewsModel();
        $banner = new Banner();
        $newsBanner = $banner -> field('thumbnail') -> where('attribute',5) -> limit(1) -> find();
        if(!$newsBanner){
            $newsBanner['thumbnail'] = '/static/index/images/news.jpg';
        }
        $newsList = $news -> where('state','eq',1) -> order('id' , 'DESC') -> paginate(2,false,['path' => '/index/news/index' ]);
        return $this -> fetch('index/news' , ['newsList' => $newsList  , 'newsBanner' => $newsBanner]);
    }

    public function detail(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $this -> request -> get('id');
            $news = new NewsModel();
            $banner = new Banner();
            $detailBanner = $banner -> field('thumbnail') -> where('attribute',7) -> limit(1) -> find();
            if(!$detailBanner){
                $detailBanner['thumbnail'] = '/static/index/images/news.jpg';
            }
            $getOne = $news -> where('id',$id) -> limit(1) -> find();
            return $getOne ? view('index/detail' , ['getOne' => $getOne  , 'detailBanner' => $detailBanner]) : ReturnJson::ReturnA('未找到相关新闻资讯...');
        }else{
            return  ReturnJson::ReturnA('未找到相关新闻资讯...');
        }

    }
}