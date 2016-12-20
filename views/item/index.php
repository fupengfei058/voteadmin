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
                         <a type="button" class="btn btn-primary" href="./index.php?r=item/itemform&itemId=<?=$v['itemId']?>">
                            <span class="glyphicon glyphicon-list btn-icon"></span>&nbsp;编辑
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
