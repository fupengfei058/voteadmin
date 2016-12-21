<?php
use yii\widgets\LinkPager;
?>
<link href="/css/main.css" rel="stylesheet" type="text/css" />
<form class="form-inline" role="form" method="get">
    <input type="hidden" name="r" value="contestant/index">
    <div class="form-group">
        <span>选手名称：</span>
        <input type="text" class="form-control" name="contestantName" placeholder="按选手名称搜索" value="<?=isset($where['contestantName']) ? $where['contestantName'] : ''?>">
    </div>
    <div class="form-group">
        <span>活动名称：</span>
        <input type="text" class="form-control" name="name" placeholder="按活动名称搜索" value="<?=isset($where['name']) ? $where['name'] : ''?>">
    </div>
    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search">搜索</span></button>
</form>
<div class="col-md-12 main_content_div">
<div class="table">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>序号</th>
            <th>活动名称</th>
            <th>选手名称</th>
            <th>选手编号</th>
            <th>选手照片</th>
            <th>选手票数</th>
            <th>报名时间</th>
            <th>状态</th>
            <th>审核</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($contestants)):?>
            <tr>
                <th colspan='9' style="text-align: center;color: red; font-size: 15px;">没有相关信息！</th>
            </tr>
        <?php else:?>
            <?php foreach($contestants as $k=>$contestant):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $contestant['name']?></td>
                    <td><?php echo $contestant['contestantName']?></td>
                    <td><?php echo $contestant['sortNum']?></td>
                    <td><img style="height: 80px;width: 80px;" src="<?=$contestant['pic']?>"></td>
                    <td><?php echo $contestant['voteCount']?></td>
                    <td><?php echo date('Y-m-d',$contestant['contestantCreateTime'])?></td>
                    <td><?php echo $contestant['reviewState'] == 0 ? '待审核' : '已审核'?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a type="button" class="btn btn-success <?=$contestant['reviewState'] == 1 ? 'disabled' : ''?>" href="./index.php?r=contestant/review-state&state=1&contestantId=<?=$contestant['contestantId']?>">
                                <span class="glyphicon glyphicon-ok btn-icon"></span> 通过
                            </a>
                            <a type="button" class="btn btn-danger <?=$contestant['reviewState'] == -1 ? 'disabled' : ''?>" href="./index.php?r=contestant/review-state&state=-1&contestantId=<?=$contestant['contestantId']?>">
                                <span class="glyphicon glyphicon-remove btn-icon"></span>不通过
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
</div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>

