<?php

namespace app\controllers;

use Yii;
use app\models\Contestant;
use app\models\Item;

class ItemController extends SiteController
{


    public function actionIndex()
    {
        $item = Item::find()
        ->where(1)
        ->orderBy('itemId')
        ->asArray()
        ->all();
        foreach ($item as $k => $v){
            $item[$k]['contestantCount'] = Contestant::contestantCount($v['itemId']);
        }
        return $this->render('index',['item' => $item]);
    }
    
    public function actionItemform()
    {
        $model = new Item();
        if(Yii::$app->request->get('itemId')){
            $model = $model->findOne(Yii::$app->request->get('itemId'));
            if(empty($model)){
                throw new CHttpException();
            }
        }
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            $model->save();
            $this->redirect('./index.php?r=item/index');
        }
        return $this->render('itemform',['model' => $model]);
    }

}