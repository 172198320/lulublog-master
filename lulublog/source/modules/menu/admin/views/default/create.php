<?php

use yii\helpers\Html;
use source\LuLu;
use source\models\MenuCategory;


/* @var $this yii\web\View */
/* @var $model source\models\Menu */

$category=LuLu::getGetValue('category');
$categoryModel = MenuCategory::findOne(['id'=>$category]);

$this->title = '新建菜单';
$this->addBreadcrumbs([
		['菜单管理',['/menu']],
		[$categoryModel['name'],['/menu/default/index','category'=>$category]],
		$this->title,
		]);
?>
<div class="menu-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
