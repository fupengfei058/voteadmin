<link href="/css/main.css" rel="stylesheet" type="text/css" />
<div class="col-md-12 main_content_div">
    <div class="table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>序号</th>
                <th>选手名称</th>
                <th>活动名称</th>
                <th style="width:25%">投票时间</th>
                <th>投票者IP</th>
            </tr>
            </thead>
            <tbody>
            <?php if(empty($record)):?>
                <tr>
                    <th colspan='9' style="text-align: center;color: red; font-size: 15px;">没有相关信息！</th>
                </tr>
            <?php else:?>
                <?php foreach($record as $k=>$v):?>
                    <tr>
                        <td><?php echo $k+1?></td>
                        <td><?php echo $v['contestantName']?></td>
                        <td><?php echo $v['name']?></td>
                        <td><?php echo date('Y-m-d H:i:s',$v['voteTime'])?></td>
                        <td><?php echo long2ip($v['IP'])?></td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
