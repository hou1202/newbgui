<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:24
 */

namespace app\index\controller;
use app\admin\controller\ReturnJson;
use app\admin\model\Retail;
use think\Controller;

class Index extends Controller
{
    public function index(){
        $retail =  new Retail();
        $retailList = $retail -> where('state' , 1) -> order('sort DESC') -> find();
        //var_dump($retailList);
        return $this -> fetch('',['List'=>$retailList]);
    }


    public function about(){
        return view('');
    }

    public function edition(){
        return view('');
    }

    public function join(){
        return view('');
    }

  /*  public function news(){
        return view('');
    }*/

    public function product(){
        return view('');
    }


}