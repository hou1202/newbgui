<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23
 * Time: 16:13
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\News;

class Test extends Controller
{
    public function index(){
        $news = new News();
        //$ListNews = $news->select();
        $ListNews = $news->paginate(2);
        //var_dump($ListNews);
        return $this->fetch('test',['ListNews'=>$ListNews]);

        /* $config = [
             'imageH' => 40,
             'imageW' => 100,
             'useNoise' => false,
             'useCurve' => false,
             'length' => 4,
             'fontSize' => 15,

         ];*/

    }
}