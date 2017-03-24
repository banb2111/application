<div class="col-sm-12 animated fadeInRight mt20 mb100">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">全部消息</a>
            </li>
            <li class="hide"><a data-toggle="tab" href="#tab-2" aria-expanded="false">联系人</a>
            </li>
            <span class="pull-right">
                <?php if (isset($mail_status)){ ?>
                    <input name="mes_noread" class="mes_noread" id="mes_noread" type="checkbox" checked="checked" value="0">
                    <label for="mes_noread">只显示未读消息</label>
                <?php }else{ ?>
                    <input name="mes_noread" class="mes_noread" id="mes_noread" type="checkbox" value="0">
                    <label for="mes_noread">只显示未读消息</label>
                <?php } ?>
            </span>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <ul class="mes_con">
                        <?php foreach ($message as $key => $value) { ?>
                        <li>
                            <div class="mes_time">
                                <span class="mes_span1"><?=date("m月d日",$value['send_time'])?></span>
                                <span class="mes_span2"><?=date("H:i",$value['send_time'])?></span>
                            </div>
                            <div class="mes_box">
                                <input class="mes_check" type="checkbox" value="<?php echo $value['id'] ?>">
                                <?php if($value['mail_status']==0){ ?>
                                <span class="mes_icon"></span>
                                 <p><?=$value['mail_content']?></p><input type="hidden" value="<?php echo $value['mail_status'] ?>"><input type="hidden" value="<?php echo $value['id'] ?>">
                                <?php }else if($value['mail_status']==1){ ?>
                                     <span class="mes_icon readed"></span>
                                    <p class="readedP"><?=$value['mail_content'] ?></p>
                               <?php } ?>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <p class="mes_page">
                        <span class="mes_pL">
                            <input class="mes_checkAll" id="mes_checkAll" type="checkbox">
                            <label for="mes_checkAll">全选本页</label>
                            <input class="mes_del" value="删 除" type="button">
                        </span>
                        <div class="page pull-right">
                            <?php echo $pages;?>

                        </div>
                    </p>
                   
                </div>
            </div>
            <div id="tab-2"class="tab-pane" >
               <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- 弹出框 -->
<div class="modal inmodal fade" id="userInfo" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">信息详情</h4>
            </div>
            <div class="modal-body pl10">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-primary" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// 分页
    $('.pagination').on('click', 'a', function(event) {
             var href = $(this).attr('data-href');
            $.ajax({
                type: "POST",
                url: href,
                success: function(data){
                     $("#show").html(data);
                }
            });
        
            /* Act on the event */
        });
</script>
<script type="text/javascript">
    var allCheck = $('.mes_checkAll');
    allCheck.click(function(event) {
      var set = $('.mes_con').find('li').find(':checkbox');
      if($(this).prop("checked")){
        $.each(set,function(i,v){
          $(v).prop("checked",true);
        });
      }else{
        $.each(set,function(i,v){
          $(v).prop("checked",false);
        });
      }
    });
    var checks = $('.mes_con').find('li').find(':checkbox');
    checks.click(function(event) {
      var leng = $(this).parents('.mes_con').find('li').find(':checkbox:checked').length;
      if(leng == checks.length){
        allCheck.prop('checked',true);
      }else{
        allCheck.prop("checked",false);
      }
    });
    // 点击邮件查看详情
    $('.mes_box p').click(function(event) {
         $(this).addClass('readedP');
        $(this).prev().addClass('readed');
        var mail_status = $(this).next().val();
        var id = $(this).next().next().val();
        if (mail_status== 0) {
            $.post('<?=base_url(); ?>index.php/mail/set_readMessage', {"id": id}, function(data) {

            });
        };
        var ht = $(this).html();
        $('.modal-body p').html(ht);
        $('#userInfo').modal('show');
    });
    // 删除
    $('.mes_del').click(function(event) {
        var checkedInputs = $(".mes_con input:checked");
        var temp = "";
        if(!checkedInputs){
            temp=-1;
        }
        for(var i = 0; i < checkedInputs.size(); i++) {
            temp += checkedInputs[i].value + ",";
        }
        $.post('<?=base_url(); ?>index.php/mail/delete_message', {"id": temp}, function(data) {
            if (data) {
                showInfo("删除成功","success");
                $.loadPage('<?=base_url(); ?>index.php/mail');
            }
        });
    });
    $('#mes_noread').click(function(event) {
        var num = $('input[name="mes_noread"]:checked').val();
        if (num) {
            var _url = "<?=base_url(); ?>index.php/mail?&mail_status="+num;
            $.loadPage(_url);
        }else{
             var _url = "<?=base_url(); ?>index.php/mail";
               $.loadPage(_url);
        }
    });

</script>