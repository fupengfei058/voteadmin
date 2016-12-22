<?php

namespace app\controllers;

use Yii;
use app\models\Contestant;
use app\models\Item;
use dosamigos\qrcode\QrCode;

class ItemController extends SiteController
{


    public function actionIndex()
    {
        $item = Item::find()
        ->where('itemState=1')
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
            if($model == null){
                return $this->redirect('./index.php?r=item/index');
            }
        }
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            $model->save();
            return $this->redirect('./index.php?r=item/index');
        }
        return $this->render('itemform',['model' => $model]);
    }

    public function actionDeleteItem()
    {
        if(Yii::$app->request->get('itemId')){
            $itemId = Yii::$app->request->get('itemId');
            $item = Item::find()->where('itemId = :itemId',[':itemId' => $itemId])->one();
            $item->itemState = 0;
            if($item->save()){
                return $this->redirect('./index.php?r=item/index');
            }
        }
    }

    public function actionQrcode()
    {
        if($_POST['itemId']){
            $url = $_POST['itemId'].\Yii::$app->params['hostSuffix'];
            return QrCode::png($url,false,0,5);
        }
    }

}