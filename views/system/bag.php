
    <div class="wrapper wrapper-content animated fadeInRight">     
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="modify_password_from"  method="post" action="<?= base_url(); ?>index.php/my_tags/add_tag">
                            <div class="form-group">
                                <div class="col-sm-8 fb">
                                    添加新的标签
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <input id="tag" name="tag" class="form-control" type="text" >
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary" type="button" id="add_tag" >添加</button>
                                </div>
                            </div>
                        </form>
                        <div class="bag row">
                            <ul>
                                <?php foreach($label as $k=>$v){ ?>
                                <li class="row mt5">
                                    <div class="conshow">
                                        <div class="col-sm-10 f16 fb"><?=$v->tag; ?></div>
                                        <div class="col-sm-2">
                                            <span><a href="javascript:void(0);">编辑</a></span>
                                        </div>
                                    </div>
                                    <div class="conedit hide mt5 clearfix">
                                        <div class="col-sm-10 pl">
                                            <div class="col-sm-6">
                                                <input id="" name="" class="form-control" type="text" value="<?=$v->tag;?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-primary updateTag">修改</button><input type="hidden" value="<?=$v->id;?>">
                                                <button class="btn btn-default" id="" >取消</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<script>
    $(function(){
        // 提交
        $("#add_tag").click(function(){
            // $("#add_tag_from").submit();
            $.submitForm('#modify_password_from');
        });
        $('.updateTag').click(function(event) {
             var tag = $(this);
             var name = tag.parent().siblings().find('input').val();
             var id = tag.next().val();
            $.post('<?= base_url(); ?>index.php/my_tags/update_tag', {'id': id,'name':name}, function(data) {
                if (data) {
                     tag.parent().parent().parent().siblings().find('.fb').html(name);
                     tag.parent().parent().parent().addClass('hide').siblings().removeClass('hide');
                     tag.parents('li').removeClass('on').css('padding-bottom', '5px');
                };
            });
        });
        $('.bag a').click(function(event) {
            $(this).parent().parent().parent().addClass('hide').siblings().removeClass('hide');
            $(this).parents('li').addClass('on').css('padding-bottom', '0');
        });
        // 点击取消
        $('.btn-default').click(function(event) {
            $(this).parent().parent().parent().addClass('hide').siblings().removeClass('hide');
            $(this).parents('li').removeClass('on').css('padding-bottom', '5px');
        });
    });
</script>