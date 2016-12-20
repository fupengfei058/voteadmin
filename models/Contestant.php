<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Contestant extends ActiveRecord
{
    public static function tableName() {
        return 'vote_contestant';
    }

    public static function contestantCount($itemId){
        return Yii::$app->db->createCommand("SELECT COUNT(*) FROM vote_contestant where itemId=$itemId")->queryScalar();
    }

}