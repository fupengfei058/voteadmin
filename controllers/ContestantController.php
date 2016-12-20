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
        //联表查询
        $data = (new \yii\db\Query())
            ->select(['*','vote_contestant.createTime as contestantCreateTime'])
            ->from('vote_contestant')
            ->join('LEFT JOIN','vote_item','vote_item.itemId=vote_contestant.itemId')
            ->orderBy('vote_item.itemId,sortNum');
        $contestantName = '';
        $name = '';
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            //拼接搜索条件
            $contestantName = trim($_POST['Contestant']['contestantName']) ? trim($_POST['Contestant']['contestantName']) : '';
            $name = trim($_POST['Contestant']['name']) ? trim($_POST['Contestant']['name']) : '';
            $data->filterWhere(['like','contestantName',$contestantName])
                ->andFilterWhere(['like','name',$name]);
        }
        //分页
        $pagination = new Pagination(['totalCount' =>$data->count(), 'defaultPageSize' => '7']);
        $contestants = $data->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', ['contestants' => $contestants,'pagination' => $pagination,'contestantName'=>$contestantName,'name'=>$name]);
    }
    //报名审核
    public function actionReviewState(){
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