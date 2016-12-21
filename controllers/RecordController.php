<?php

namespace app\controllers;

use app\models\Record;

class RecordController extends SiteController
{
    
    public function actionIndex()
    {
        $model = new Record();
        $record = $model->getRecord();
        return $this->render('index',['record'=>$record]);
    }
}