<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Item extends ActiveRecord
{

    public static function tableName() {
        return 'vote_item';
    }

    public function attributeLabels()
    {
        return [
            'itemId' => 'itemId',
            'name' => '活动名称',
            'startTime' => '活动开始时间',
            'endTime' => '活动结束时间',
            'regEndTime' => '报名截止时间',
            'desc' => '活动描述',
        ];
    }

    public function rules()
    {
        return [
            [['itemId','totalVote'],'safe'],
            [['name', 'desc'], 'trim'],
            ['name','required','message'=>'活动名称不能为空'],
            ['startTime','required','message'=>'活动开始时间不能为空'],
            ['endTime','required','message'=>'活动开始时间不能为空'],
            ['regEndTime','required','message'=>'报名截止时间不能为空'],
            ['desc','required','message' => '活动描述不能为空'],
            ['desc','string', 'length' => [5,100],'tooLong'=>'{attribute}不能大于100个字符','tooShort'=>'{attribute}不能小于5个字符'],
        ];
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $this->startTime = strtotime($this->startTime);
        $this->endTime = strtotime($this->endTime);
        $this->regEndTime = strtotime($this->regEndTime);
        if($this->isNewRecord){
            $this->createTime = time();
        }
        return true;
    }

    public function afterFind()
    {
        $this->startTime  =	date('Y-m-d',$this->startTime);
        $this->endTime	  =	date('Y-m-d',$this->endTime);
        $this->regEndTime =	date('Y-m-d',$this->regEndTime);
    }
}