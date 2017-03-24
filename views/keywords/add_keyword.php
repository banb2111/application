<div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">           
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:45PX;">
                    <h5>添加关键词</h5>
                </div>                    
                 <div class="ibox-content col-sm-12" style="padding-top:0;">
                    <form class="form-horizontal m-t" id="addKey" method="post" action="">
                         <div class="col-sm-12 col-md-8 col-lg-6">  
                          <div class="form-group">
                                 <label class="col-sm-2 control-label">关键字</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                     <input id="" name="keyword" class="form-control" type="text" required=""required="true" value="" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div> 
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">行业</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                     <input id="" name="vocation" class="form-control mb10" type="text" value="" >
                                    <div class="vocationShow">
                                        <!-- 显示关键词 -->
                                    </div>
                                 </div>
                             </div> 
                              <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-2">
                                    <button class="btn btn-primary" id="save_addkey" type="button">保存</button>
                                    <button class="btn btn-default" id="remove_addkey">重置</button>
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
         // 验证
            var e = "<i class='fa fa-times-circle'></i>";
            var verify = $("#addKey").validate({
                rules: {
                    keyword_id: {
                        required: !0
                    }
                },
                messages: {
                    keyword_id: {
                        keyword_id: e + "必填"
                    }
                }
            })
            $("#save_addkey").click(function(){
                if(verify.form()) {                
                    var val = $('input[name="keyword"]').val();
                    var vocationValue = $(".vocationShow .btn-primary");
                    var temp = "";
                    if(!vocationValue){
                        temp=-1;
                    }
                    for(var i = 0; i < vocationValue.size(); i++) {
                        temp += vocationValue[i].value + ",";
                    }
                    $.post('<?=base_url(); ?>index.php/keywords_category/add_keywords', {'industry': temp,'keyword':val}, function(data) {
                        if (data) {
                            showInfo('操作成功',"success");
                            $.loadPage('<?=base_url(); ?>index.php/keywords_category/add_keywords');
                        };
                    });
                }
            })
    })
</script>
<script type="text/javascript">
    $(function(){
        // 失去焦点验证关键字重复
         $('input[name="keyword"]').blur(function(event) {
            var val = $(this).val();
            $.post('<?=base_url(); ?>index.php/keywords_category/keyword_only', {'keyword': val}, function(data) {
                if (!data) {
                    showInfo('关键字重复','error');
                    $('input[name="keyword"]').val('');
                    $('input[name="keyword"]').focus();
                };
            });
        });
         // 失去焦点验证关键字
        $('input[name="vocation"]').blur(function(event) {
            var val = $(this).val();
                 if (val) {

                $('.vocationShow').append('<button type="button" value='+val+' class="btn btn-primary btn-xs mr1">'+val+'<i class="fa fa-remove"></i></button>');
                 };        
           
            $(this).val('');
        });
        // 删除 行业
       $('.vocationShow').on('click', '.btn-primary', function(event) {
            $(this).remove();
           event.preventDefault();
           /* Act on the event */
       });
       // 重置
       $('#remove_addkey').click(function(event) {
           $('input[name="keyword"]').val('');
           $('input[name="vocation"]').val('');
           $('.vocationShow').html('');

       });
    })
</script>                        