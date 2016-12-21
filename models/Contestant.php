<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Contestant extends ActiveRecord
{
    public static function tableName()
    {
        return 'vote_contestant';
    }

    public static function contestantCount($itemId)
    {
        return Yii::$app->db->createCommand("SELECT COUNT(*) FROM vote_contestant where itemId=$itemId")->queryScalar();
    }

    public function rules()
    {
        return [
            [['name','contestantName'],'safe'],
        ];
    }

    public function getDataObject($where = [])
    {
        //联表查询
        $data = (new \yii\db\Query())
            ->select(['*','vote_contestant.createTime as contestantCreateTime'])
            ->from('vote_contestant')
            ->join('LEFT JOIN','vote_item','vote_item.itemId=vote_contestant.itemId')
            ->where(1)
            ->orderBy('vote_item.itemId,sortNum');
        if(!empty($where)){
            //拼接搜索条件
            if(isset($where['contestantName'])){
                $data->andFilterWhere(['like','contestantName',$where['contestantName']]);
            }
            if(isset($where['name'])){
                $data->andFilterWhere(['like','name',$where['name']]);
            }
        }
        return $data;
    }

}