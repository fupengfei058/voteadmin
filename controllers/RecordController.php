<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Record;

class RecordController extends SiteController
{
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}