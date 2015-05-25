<?php
namespace source\modules\modularity\admin;

use yii\web\Controller;
use Yii;
use source\models\Content;
use source\models\search\ContentSearch;
use source\core\back\BaseBackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\ContentController;
use source\modules\post\models\ContentPost;
use source\modules\post\models\source\modules\post\models;
use source\LuLu;
use source\modules\modularity\models\Modularity;

class DefaultController extends BaseBackController
{

    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $moduleManager = LuLu::$app->moduleManager;
        $modules = $moduleManager->loadModules();
        return $this->render('index', [
            'modules' => $modules
        ]);
    }

    public function actionInstall($id)
    {
        $model = new Modularity();
        $model->id = $id;
        $model->enable_admin = 0;
        $model->enable_home = 0;
        $model->save();
        
        $moduleManager = LuLu::$app->moduleManager;
        $modules = $moduleManager->loadModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            $modules[$id]['instance']->install();
        }
        return $this->redirect([
            'index'
        ]);
    }

    public function actionUninstall($id)
    {
        Modularity::deleteAll(['id' => $id ]);
        
        $moduleManager = LuLu::$app->moduleManager;
        $modules = $moduleManager->loadModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            $modules[$id]['instance']->uninstall();
        }
        
        return $this->redirect([
            'index'
        ]);
    }

    public function actionActive($id, $is_admin = null)
    {
        $field = $is_admin === null ? 'enable_home' : 'enable_admin';
        Modularity::updateAll([$field => 1], ['id' => $id ]);
        
        $moduleManager = LuLu::$app->moduleManager;
        $modules = $moduleManager->loadModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            if ($is_admin === null)
            {
                $modules[$id]['instance']->activeHome();
            }
            else
            {
                $modules[$id]['instance']->activeAdmin();
            }
        }
        
        return $this->redirect([
            'index'
        ]);
    }

    public function actionDeactive($id, $is_admin = null)
    {
        $field = $is_admin === null ? 'enable_home' : 'enable_admin';
        Modularity::updateAll([$field => 0], ['id' => $id ]);
        
        $moduleManager = LuLu::$app->moduleManager;
        $modules = $moduleManager->loadModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            if ($is_admin === null)
            {
                $modules[$id]['instance']->deactiveHome();
            }
            else
            {
                $modules[$id]['instance']->deactiveAdmin();
            }
        }
        
        return $this->redirect([
            'index'
        ]);
    }
}
