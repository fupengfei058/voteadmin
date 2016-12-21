<?php

namespace app\controllers;

use Yii;
use app\models\Contestant;
use yii\data\Pagination;

class ContestantController extends SiteController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model = new Contestant();
        $where = Yii::$app->request->get();
        $data = $model->getDataObject($where);
        //分页
        $pagination = new Pagination(['totalCount' =>$data->count(), 'defaultPageSize' => '7']);
        $contestants = $data->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', ['contestants' => $contestants,'pagination' => $pagination,'where'=>$where]);
    }

    //报名审核
    public function actionReviewState()
    {
        if(Yii::$app->request->isGet && !empty($_GET['contestantId']) && !empty($_GET['state'])){
            $model = Contestant::find()
                ->where('contestantId = :contestantId',[':contestantId' => $_GET['contestantId']])
                ->one();
            $model->reviewState = $_GET['state'];
            if($model->save()){
                $this->redirect("./index.php?r=contestant/index");
            }
        }
    }
}