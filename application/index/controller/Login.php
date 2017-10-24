<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 14:15
 */

namespace app\index\controller;


use think\console\command\make\Controller;

class Login extends Controller
{
    public function login(){
        return view();
    }

    public function register(){
        return view();
    }
}