<?php use yii\helpers\Url;?>
<link href="/css/main.css" rel="stylesheet" type="text/css" />
<a type="button" class="btn btn-primary" href="./index.php?r=item/itemform">
    <span class="glyphicon"></span>创建活动
</a>
<div class="col-md-12 main_content_div">
    <div class="table">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>活动名称</th>
                    <th>活动开始时间</th>
                    <th>活动结束时间</th>
                    <th>报名截止时间</th>
                    <th>活动投票量</th>
                    <th>报名人数</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody>
                <?php if(empty($item)):?>
                    <tr>
                        <th colspan='9' style="text-align: center;color: red; font-size: 15px;">没有相关信息！</th>
                    </tr>
                <?php else:?>
                <?php foreach($item as $k=>$v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo date('Y-m-d',$v['startTime'])?></td>
                    <td><?php echo date('Y-m-d',$v['endTime'])?></td>
                    <td><?php echo date('Y-m-d',$v['regEndTime'])?></td>
                    <td><?php echo $v['totalVote']?></td>
                    <td><?php echo $v['contestantCount']?></td>
                    <td>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-default itemModal" data-toggle="modal" data-target="#myModal" itemId="<?=$v['itemId']?>"><span class="glyphicon glyphicon-search">查看链接</span></button>
                         <a type="button" class="btn btn-primary" href="./index.php?r=item/itemform&itemId=<?=$v['itemId']?>">
                            <span class="glyphicon glyphicon-list btn-icon"></span>&nbsp;编辑
                        </a>
                        <a type="button" class="btn btn-danger" onclick="return confirm('是否确认删除？');" href="./index.php?r=item/delete-item&itemId=<?=$v['itemId']?>">
                            <span class="glyphicon glyphicon-remove btn-icon"></span>&nbsp;删除
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">查看链接</h4>
            </div>
            <div class="modal-body">
                <p>
                    链接地址：<span id="link"></span><?=\Yii::$app->params['hostSuffix']?>
                </p>
                <p>
                    二维码：<img id="qrcode">
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('item') ?>
    $(".itemModal").click(function(){
        var itemId = $(this).attr("itemId");
        $("#link").text(itemId);
        var wholeLink = "./index.php?r=item/qrcode&itemId="+itemId;
        $("#qrcode").attr("src", wholeLink);
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['item']); ?>