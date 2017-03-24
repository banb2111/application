<div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">           
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:45PX;">
                    <h5>添加关键词类别</h5>
                </div>
                <input type="hidden" id="type" value="<?=$type;?>">;
                 <div class="ibox-content col-sm-12" style="padding-top:0;">
                    <form class="form-horizontal m-t" id="addKeyCa" method="post" action="">
                         <div class="col-sm-12 col-md-8 col-lg-6">  
                          <div class="form-group">
                                 <label class="col-sm-2 control-label">类别名称</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                     <input id="" name="name" class="form-control" type="text" required=""required="true" value="<?php echo $keywords[0]['category_name'] ?>" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div> 
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">类别价格</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                     <input id="" name="price" class="form-control mb10" type="text" value="<?php echo $keywords[0]['category_price'] ?>" required=""required="true">
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div> 
                              <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-2">
                                    <button class="btn btn-primary" id="save_addkey_ca" type="button">保存</button>
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
            var verify = $("#addKeyCa").validate({
                rules: {
                    name: {
                        required: !0
                    },
                    price: {
                        required: !0,
                        digits:true
                    }
                },
                messages: {
                    name: {
                        keyword_id: e + "必填"
                    },
                    price: {
                        keyword_id: e + "必填",
                        digits:e+'填写整数'
                    }
                }
            })
            $("#save_addkey_ca").click(function(){
                if(verify.form()) {
                    var name = $('input[name="name"]').val();
                    var price = $('input[name="price"]').val();
                    var type=$("#type").val();
                    if(type==2){
                        //修改关键词类别
                        $.post('<?=base_url(); ?>index.php/keywords_category/update_keyword_category', {'category_name': name,'category_price':price,"keywords_id":"<?php echo $keywords[0]['id']  ?>"}, function(data) {
                            if (data) {
                                showInfo('操作成功',"success");
                                $.loadPage('<?=base_url(); ?>index.php/keywords_category/category_list');
                            };
                        });
                    }else if(type==1){
                        //添加关键词类别
                        $.post('<?=base_url(); ?>index.php/keywords_category/add_keyword_category', {'category_name': name,'category_price':price}, function(data) {
                            if (data) {
                                showInfo('操作成功',"success");
                                $.loadPage('<?=base_url(); ?>index.php/keywords_category/add_keyword_category');
                            };
                        });
                    }
                }
            });
    })
</script>
                   