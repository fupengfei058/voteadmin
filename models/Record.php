<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Record extends ActiveRecord
{

    public static function className($className = __CLASS__)
    {
        return $className;
    }

    public static function tableName()
    {
        return 'vote_record';
    }

    public function getRecord()
    {
        $record = Record::find()->select('record.voteTime,record.IP,item.name,contestant.contestantName')
            ->from('vote_record record')
            ->leftJoin('vote_item item', 'record.itemId = item.ItemId')
            ->leftJoin('vote_contestant contestant','record.contestantId = contestant.contestantId')
            ->asArray()
            ->all();
        return $record;
    }
}