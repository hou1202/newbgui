<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 9:32
 */
namespace app\admin\controller;
use think\Controller;
use think\Validate;
use app\admin\model\Banner as BannerMdoel;

class Banner extends Controller
{
    //数据验证规则
    protected $rule = [
        'title' => 'require|max:20',
        'thumbnail' => 'require',
        'attribute' => 'require'
        ];
    //数据验证返回信息
    protected $message = [
        'title.require' => '标题不得为空...',
        'title.max' => '标题最大不得超过20位...',
        'thumbnail.require' => 'Banner图不得为空...',
        'attribute.require' => 'Banner类型不得为空...'
    ];

    //banner列表
    public function bannerList()
    {
        $bannerM = new BannerMdoel();
        $gitBannerList = $bannerM -> select();
        return $gitBannerList ? view('banner_list' , ['List' => $gitBannerList]) : ReturnJson::ReturnA('未找到相关Banner图数据信息...');
    }

    //添加banner图
    public function bannerAdd()
    {
        if($this -> request -> isPost()){
            $data = $this -> request -> post();
            $bannerValidate = new Validate($this->rule,$this->message);
            if($bannerValidate -> check($data)){
                $bannerM = new BannerMdoel();
                return $bannerM -> save($data) ? ReturnJson::ReturnJ('Banner图创建成功...','success','/banner/bannerList') : ReturnJson::ReturnJ('Banner图创建失败，请重新提交...','false');
            }else{
                return ReturnJson::ReturnJ($bannerValidate -> getError() , 'false');
            }
        }
        return view('banner_add');
    }

    //修改banner图
    public function bannerUpdate()
    {
        if($this -> request -> isPost()){
            $data = $this -> request -> post();
            $bannerValidate = new Validate($this->rule , $this->message);
            if($bannerValidate -> check($data)){
                $bannerM = new BannerMdoel();
                return $bannerM -> save($data,['id'=>$data['id']]) ? ReturnJson::ReturnJ('Banner图修改成功...','success','/banner/bannerList') : ReturnJson::ReturnJ('Banner图修改失败，请重新提交...','false');
            }else{
                return ReturnJson::ReturnJ($bannerValidate -> getError() , 'false');
            }
        }

        if(isset($_GET['id']) && !empty($_GET['id'])){
            $bannerM = new BannerMdoel();
            $id = $this ->request ->get('id');
            $getOneBanner = $bannerM -> where('id',$id) -> limit(1) -> find();
            //var_dump($getOneBanner);die;
            return $getOneBanner ? view('banner_update' , ['getOne' => $getOneBanner]) : ReturnJson::ReturnA('未找到相关需修改Banner信息...');
        }else{
            return ReturnJson::ReturnA('无效的修改操作...');
        }
    }

    //删除banner图
    public function bannerDel()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $bannerM = new BannerMdoel();
            $id = $this ->request ->get('id');
            return $bannerM -> where('id',$id)  -> delete() ? ReturnJson::ReturnJ('Banner图删除成功...' , 'success') : ReturnJson::ReturnJ('删除失败，请重新操作...' , 'false');
        }else{
            return ReturnJson::ReturnA('无效的删除操作...');
        }
    }

}