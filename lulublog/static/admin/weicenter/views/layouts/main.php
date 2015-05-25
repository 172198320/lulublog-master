<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use source\models\Takonomy;
use source\libs\Resource;
use source\LuLu;

/* @var $this \yii\web\View */
/* @var $content string */

/* 
Resource::registerCommon('/libs/bootstrap/3.0.2/css/bootstrap.css');
Resource::registerCommon('/js/common.js');
Resource::registerAdmin('/css/site.css');
 */
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="blank" />
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo $this->title?> —— LuLu Blog</title>
    

    
    <base href="<?php echo LuLu::getAlias('@web');?>" />
    <?php Resource::registerAdmin('/css/bootstrap.css?v=20150409');?>
    <?php Resource::registerAdmin('/css/icon.css?v=20150409');?>

    <script type="text/javascript">
        var G_INDEX_SCRIPT = "?/";
        var G_BASE_URL = "http://localhost/WeCenter/?";
        var G_STATIC_URL = "http://localhost/WeCenter/static";
        var G_UPLOAD_URL = "http://localhost/WeCenter/uploads";
        var G_USER_ID = "1";
        var G_POST_HASH = "";
    </script>
    
    <?php Resource::registerAdmin('/css/common.css?v=20150409');?>
    
    <?php Resource::registerAdmin('/js/jquery.2.js?v=20150409');?>
    <?php Resource::registerAdmin('/js/aws_admin.js?v=20150409');?>
    <?php Resource::registerAdmin('/js/aws_admin_template.js?v=20150409');?>
    <?php Resource::registerAdmin('/js/jquery.form.js?v=20150409');?>
    <?php Resource::registerAdmin('/js/framework.js?v=20150409');?>
    <?php Resource::registerAdmin('/js/global.js?v=20150409');?>
    
   
    <!--[if lte IE 8]>
    <?php Resource::registerAdmin('/js/respond.js');?>
    <![endif]-->
</head>

<body>
    <div class="aw-header">
        <button class="btn btn-sm mod-head-btn pull-left">
            <i class="icon icon-bar"></i>
        </button>

        <div class="mod-header-user">
            <ul class="pull-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle mod-bell" data-toggle="dropdown">
                        <i class="icon icon-bell"></i>
                    </a>
                    <ul class="dropdown-menu mod-chat">
                        <p>没有通知</p>
                    </ul>
                </li>

                <li class="dropdown username">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo Resource::getAdminUrl('/images/avatar-mid-img.png')?>" class="img-circle" width="30">
                        admin888                    <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu pull-right mod-user">
                        <li>
                            <a href="<?php echo LuLu::getAlias('@web');?>" target="_blank"><i class="icon icon-home"></i>首页</a>
                        </li>

                        <li>
                            <a href="<?php echo LuLu::getAlias('@web');?>"><i class="icon icon-ul"></i>概述</a>
                        </li>

                        <li>
                            <a href="<?php echo LuLu::getAlias('@web');?>"><i class="icon icon-logout"></i>退出</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="aw-side" id="aw-side">
        <div class="mod">
            <div class="mod-logo">
                
                <h1>LuLu Blog</h1>
            </div>

            <div class="mod-message">
                <div class="message">
                    <a class="btn btn-sm" href="<?php echo LuLu::getAlias('@web');?>" target="_blank" title="首页">
                        <i class="icon icon-home"></i>
                    </a>

                    <a class="btn btn-sm" href="<?php echo LuLu::getAlias('@web');?>" title="概述">
                        <i class="icon icon-ul"></i>
                    </a>

                    <a class="btn btn-sm" href="<?php echo LuLu::getAlias('@web');?>" title="退出">
                        <i class="icon icon-logout"></i>
                    </a>
                </div>
            </div>

            <ul class="mod-bar">
                <input type="hidden" id="hide_values" value="0" />
                <li>
                    <a href="<?php echo LuLu::getAlias('@web');?>" class=" icon icon-home">
                        <span>概述</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-setting active" data="icon">
                        <span>全局设置</span>
                    </a>

                    <ul>
                        <li>
                            <?php echo Html::a('<span>站点信息</span>',['/system/config/basic'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>注册与访问控制置</span>',['/system/config/access'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>时间设置</span>',['/system/config/datetime'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>邮件设置</span>',['/system/config/email'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>评论设置</span>',['/#'])?>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-reply" data="icon">
                        <span>类目管理</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <?php echo Html::a('<span>菜单管理</span>',['/menu'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>分类管理</span>',['/takonomy'])?>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-user" data="icon">
                        <span>文章管理</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <?php echo Html::a('<span>新建</span>',['/post/default/create'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>所有文章</span>',['/post'])?>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-report" data="icon">
                        <span>页面管理</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <?php echo Html::a('<span>新建</span>',['/page/default/create'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>所有页面</span>',['/page'])?>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-signup" data="icon">
                        <span>模块管理</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <?php echo Html::a('<span>模块管理</span>',['/modularity'])?>
                        </li>
                       
                    </ul>
                </li>
                <!-- 
                <li>
                    <a href="javascript:;" class=" icon icon-signup" data="icon">
                        <span>界面</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <?php echo Html::a('<span>主题</span>',['/page/default/create'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>菜单</span>',['/page/default/create'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>小工具</span>',['/page/default/create'])?>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-share" data="icon">
                        <span>用户管理</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <?php echo Html::a('<span>用户列表</span>',['/page/default/create'])?>
                        </li>
                        <li>
                            <?php echo Html::a('<span>用户组</span>',['/page/default/create'])?>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-inbox" data="icon">
                        <span>邮件群发</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <a href="http://localhost/WeCenter/?/admin/edm/tasks/">
                                <span>任务管理</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost/WeCenter/?/admin/edm/groups/">
                                <span>用户群管理</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class=" icon icon-job" data="icon">
                        <span>工具</span>
                    </a>

                    <ul class="hide">
                        <li>
                            <a href="http://localhost/WeCenter/?/admin/tools/">
                                <span>系统维护</span>
                            </a>
                        </li>
                    </ul>
                </li>
                 -->
            </ul>
        </div>
    </div>

    <div class="aw-content-wrap">
        <div class="main-content" style="margin: 20px;">
            <?php echo $content?>
        </div>
        
    </div>

    <div class="aw-footer">
        <p>Copyright &copy; 2015 - Powered By <a href="http://www.yiifans.com/" target="blank">LuLu Blog 3.1.2</a></p>
    </div>

    <!-- DO NOT REMOVE -->
    <div id="aw-ajax-box" class="aw-ajax-box"></div>


    <div style="display: none;" id="__crond">
        
    </div>

    <!-- Escape time: 0.099004983901978 -->
    <!-- / DO NOT REMOVE -->

</body>
</html>
