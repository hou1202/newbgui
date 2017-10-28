<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25
 * Time: 9:53
 */
namespace app\admin\controller;
use app\admin\model\Retail;
use think\Controller;


class Homepage extends Controller
{
    //展示新零售信息
    public function homePageList()
    {
        $retail = new Retail();
        $retailCount = $retail -> count('id');
        $retailList = $retail -> order('id DESC') -> paginate(5 , false , ['path' => '/admin/main#/homepage/homePageList']);
        return $retailList -> items() ? view('homepage_list',['List' => $retailList , 'Count' => $retailCount]) : ReturnJson::ReturnA('未查询到相关数据信息...');
    }

    //添加新零售信息
    public function homePageAdd()
    {
        if($this -> request -> isPost()){
            $data = $this -> request -> post();
            $homepageValidate = new HomepageValidate();
            if($homepageValidate ->check($data)){
                $retail = new Retail();
                return $retail->allowField(true)->save($data) ? ReturnJson::ReturnJ('新数据创建成功...','success','/homepage/homePageList') : ReturnJson::ReturnJ('创建失败，请重新提交...','false');
            }else{
                return ReturnJson::ReturnJ($homepageValidate->getError(),'false');
            }
        }
        return view('homepage_add');
    }

    //修改新零售信息
    public function homePageUpdate(){
        //处理修改数据
        if($this -> request -> isPost()){
            $data = $this -> request -> post();
            $homepageValidate =new HomepageValidate();
            if($homepageValidate -> check($data)){
                $retail =new Retail();
                return $retail -> save($data,['id' => $data['id']]) ? ReturnJson::ReturnJ('数据更新成功...','success','/homepage/homePageList') : ReturnJson::ReturnJ('数据更新失败，请重新操作...','false');
            }else{
                return ReturnJson::ReturnJ($homepageValidate->getError(),'false');
            }
        }

        //展示修改数据
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $this -> request -> get('id');
            $retail = new Retail();
            $getOne = $retail -> where('id',$id) -> limit(1) -> find();
            return $getOne ? view('homepage_update' , ['getOne' => $getOne]) : ReturnJson::ReturnA('未找到相关修改信息，请重新操作...');
        }else{
            return ReturnJson::ReturnA('无效的修改操作...');
        }

    }

    //删除新零售信息
    public function homePageDel()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $this -> request -> get('id');
            $retail = new Retail();
            return $retail -> where('id',$id) -> delete() ? ReturnJson::ReturnJ('已成功删除此条数据...' , 'success') : ReturnJson::ReturnJ('删除失败，请重新操作...' , 'false');
        }else{
            return ReturnJson::ReturnJ('无效的删除操作...','false');
        }
    }
}