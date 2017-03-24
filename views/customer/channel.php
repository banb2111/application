    <div class="wrapper wrapper-content animated fadeInRight">  
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="channel_from" method="post" action="<?= base_url(); ?>index.php/channel/add_channel">
                            <div class="form-group">
                                <div class="col-sm-8 fb">
                                    添加新的来源渠道
                                </div>
                            </div>
                            <!-- // @zzr edit at 2016-12-06 14:23 -->
                            <select name="channel_pid" style="padding:6px 12px;font-size:14px;margin-bottpm:10px;" class="col-sm-3">
                                <option value="0">--请选择来源渠道分类--</option>
                                <?php foreach($channel as $k=>$v){ ?>
                                    <?php if($v['level'] == 1){ ?>
                                        <option value="<?=$v['id']?>">&nbsp;&nbsp;&nbsp;&nbsp;--<?=$v['channel_name']?></option>
                                    <?php }elseif($v['level'] == 2){ ?>
                                        <!-- <option value="<?=$v['id']?>" levelattr="<?=$v['level']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--<?=$v['channel_name']?></option> -->
                                    <?php }else{?>
                                        <option value="<?=$v['id']?>"><?=$v['channel_name']?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>
                            <div class="form-group">

                                <div class="col-sm-4">
                                    <input id="channel_name" name="channel_name" class="form-control" type="text" placeholder="请输入来源渠道名称">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" id="add_channel" >添加</button>
                                </div>
                            </div>
                        </form>
                        <div class="bag row">
                            <ul>
                                <?php if($channel){?>
                                <?php foreach($channel as $k=>$v){ ?>
                                    <li class="row mt5">
                                        <div class="conshow">
                                            <?php if($v['level'] == 1){ ?>
                                                <div class="col-sm-10 f16 fb" style="font-size:14px;" extval="&nbsp;&nbsp;&nbsp;&nbsp;--">&nbsp;&nbsp;&nbsp;&nbsp;--<?=$v['channel_name']?></div>
                                            <?php }elseif($v['level'] == 2){?>
                                                <div class="col-sm-10 f16 fb" style="font-size:12px;font-weight:normal" extval="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--<?=$v['channel_name']?></div>
                                            <?php }else{ ?>
                                                <div class="col-sm-10 f16 fb"><?=$v['channel_name']?></div>
                                            <?php } ?>
                                            <div class="col-sm-2">
                                                <span><a href="javascript:void(0);" class="editch" title="编辑该来源渠道">编辑</a></span>
                                                &nbsp;&nbsp;&nbsp;
                                                <span><a href="javascript:void(0);" class="deletech" valid="<?=$v['id']?>" title="删除该来源渠道">删除</a></span>
                                            </div>
                                        </div>
                                        <div class="conedit hide mt5 clearfix">
                                            <div class="col-sm-10 pl">
                                                <div class="col-sm-6">
                                                    <input id="" name="" class="form-control" type="text" value="<?=$v['channel_name']?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <button class="btn btn-primary updateChannel">修改</button>
                                                    <input type="hidden" value="<?=$v['id']?>">
                                                    <button class="btn btn-default" id="" >取消</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(function(){
        // 提交添加
       $("#add_channel").click(function(){

            if($("select[name=channel_pid] option:selected").val() == 0){
                alert('请选择来源渠道分类');
                return;   
            }

            if($.trim($("#channel_name").val()) == ''){
                alert('请输入来源渠道名称');
                return;
            }
            
           $.submitForm('#channel_from');
       });

       // 提交修改
       $('.updateChannel').click(function(event) {
            var channel = $(this);
            var channel_name = channel.parent().siblings().find('input').val();
            var id = channel.next().val();
           $.post('<?= base_url(); ?>index.php/channel/update_channel', {'id': id,'channel_name':channel_name}, function(data) {
               if (data) {
                    var extval = channel.parent().parent().parent().siblings().find('.fb').attr('extval');
                    channel.parent().parent().parent().siblings().find('.fb').html(extval+channel_name);
                    channel.parent().parent().parent().addClass('hide').siblings().removeClass('hide');
                    channel.parents('li').removeClass('on').css('padding-bottom', '5px');
               };
           });
       });
       // 编辑渠道
        $('.bag a.editch').click(function(event) {
            $(this).parent().parent().parent().addClass('hide').siblings().removeClass('hide');
            $(this).parents('li').addClass('on').css('padding-bottom', '0');
        });
        // 删除渠道
        $('.bag a.deletech').click(function(event) {
            var that = $(this);
            if(confirm('确定要删除该渠道？')){
                $.post('<?= base_url(); ?>index.php/Channel/delete_channel',{'id':$(this).attr('valid')},function(data){
                    var info = eval(data);
                    if(info.s == 'ok'){
                         that.parents('li.mt5').css('display','none');
                    }else{
                        alert(info.errmsg);
                    }
                },'json');
            }
        });
        // 取消修改
        $('.btn-default').click(function(event) {
            $(this).parent().parent().parent().addClass('hide').siblings().removeClass('hide');
            $(this).parents('li').removeClass('on').css('padding-bottom', '5px');
        });

    });
</script>