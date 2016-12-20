<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Record extends ActiveRecord
{

    public static function tableName() {
        return 'vote_record';
    }

}