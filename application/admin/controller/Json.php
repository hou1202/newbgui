<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/14
 * Time: 11:10
 */

namespace app\admin\controller;
use think\console\command\make\Controller;

class Json extends Controller
{
    public function nav(){
        echo '
            [
                  {
                    "t": "AOZOM",
                    "url": "admin/desktop"
                  },
                  {
                    "t": "表格",
                    "url": "",
                    "child": [
                      {
                        "t": "基本表格",
                        "url": "table/table1.html"
                      },
                      {
                        "t": "DataTables",
                        "url": "table/table2.html"
                      }
                    ]
                  },
                  {
                    "t": "表单",
                    "url": "",
                    "child": [
                      {
                        "t": "基本表单",
                        "url": "form/form1.html"
                      },
                      {
                        "t": "编辑器",
                        "url": "",
                        "child": [
                          {
                            "t": "summernote",
                            "url": "form/form2.html"
                          },
                          {
                            "t": "kindeditor",
                            "url": "form/form3.html"
                          }
                        ]
                      },
                      {
                        "t": "文件上传",
                        "url": "",
                        "child": [
                          {
                            "t": "WebUploader",
                            "url": "form/form4.html"
                          },
                          {
                            "t": "uploadify",
                            "url": "form/form5.html"
                          },
                          {
                            "t": "kindeditor",
                            "url": "form/form6.html"
                          }
                        ]
                      },
                      {
                        "t": "图像裁剪",
                        "url": "",
                        "child": [
                          {
                            "t": "Jcrop",
                            "url": "form/form7.html"
                          }
                        ]
                      },
                      {
                        "t": "选择日期",
                        "url": "",
                        "child": [
                          {
                            "t": "bootstrap-datepicker",
                            "url": "form/form8.html"
                          }
                        ]
                      }
                    ]
                  },
                  {
                    "t": "UI元素",
                    "url": "",
                    "child": [
                      {
                        "t": "弹出框",
                        "url": "widget/widget1.html"
                      },
                      {
                        "t": "树形视图",
                        "url": "widget/widget2.html"
                      }
                    ]
                  },
                  {
                    "t": "页面",
                    "url": "",
                    "child": [
                      {
                        "t": "站点设置",
                        "url": "page/page1.html"
                      },
                      {
                        "t": "编辑角色",
                        "url": "page/page2.html"
                      }
                    ]
                  }
            ]';
    }
}