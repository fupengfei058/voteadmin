
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$form = ActiveForm::begin([
    'id' => 'itemform',
]) ?>
<?= $form->field($model, 'itemId',['options' => ['class'=>'hidden']])->textInput() ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'desc')->textarea() ?>
<?= $form->field($model, 'startTime')->widget(
    DatePicker::className(), [
    'inline' => true,
    'language' => 'zh-CN',
    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);?>
<?= $form->field($model, 'endTime')->widget(
    DatePicker::className(), [
    'inline' => true,
    'language' => 'zh-CN',
    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);?>
<?= $form->field($model, 'regEndTime')->widget(
    DatePicker::className(), [
    'inline' => true,
    'language' => 'zh-CN',
    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ]
]);?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
