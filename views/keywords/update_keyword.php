
<div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">           
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:33PX;">
                    <h3>优化设置</h3>
                </div>                    
                 <div class="ibox-content col-sm-12" style="padding-top:0;">
                    <form class="form-horizontal m-t" id="addKeyOptimization" method="post" action="">
                         <div class="col-sm-12 col-md-8 col-lg-6">
                         <fieldset disabled>  
                          <div class="form-group">
                                 <label class="col-sm-2 control-label">关键词名称</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="" name="keyword"  class="form-control" type="text" required=""required="true" value="<?php echo $keyword[0]['keyword'] ?>" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div> 
                         </fieldset>
                             <!-- 隐藏id -->
                             <input type="hidden" name="keyword_id" value="<?=$keyword[0]['kid']?>">
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">类别</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <select name="industry" id="" class="form-control">
                                         <?php foreach ($keyword_category as $key => $value): ?>
                                             <option <?php if ($value['id']==$keyword[0]['category_id']): ?>
                                                 selected="selected"
                                             <?php endif ?> value="<?php echo $value['id'] ?>"><?php echo $value['category_name'] ?></option>
                                         <?php endforeach ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">行业</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="" name="industry_name" class="form-control mb8" type="text" >
                                     <div class="vocationShow mt5">
                                     </div>
                                 </div>
                             </div> 
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">第一页</label>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                     <input id="" name="one_chance" class="form-control mb8" type="text" value="<?php echo $keyword[0]['one_chance'] ?>" placeholder="概率">
                                 </div>
                                 <div class="col-lg-1 mt7">%</div>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                     <input id="" name="one_time" class="form-control mb8" type="text" value="<?php echo $keyword[0]['one_time'] ?>" placeholder="时间">
                                 </div>
                                 <div class="col-lg-1 mt7">天</div>
                             </div>

                             <div class="form-group">
                                 <label class="col-sm-2 control-label">第二页</label>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                     <input id="" name="two_chance" class="form-control mb8" type="text" value="<?php echo $keyword[0]['two_chance'] ?>" placeholder="概率">
                                 </div>
                                 <div class="col-lg-1 mt7">%</div>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                     <input id="" name="two_time" class="form-control mb8" type="text" value="<?php echo $keyword[0]['two_time'] ?>" placeholder="时间">
                                 </div>
                                 <div class="col-lg-1 mt7">天</div>
                             </div> 

                             <div class="form-group">
                                 <label class="col-sm-2 control-label">第三页</label>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                     <input id="" name="three_chance" class="form-control mb8" type="text" value="<?php echo $keyword[0]['three_chance'] ?>" placeholder="概率">
                                 </div>
                                 <div class="col-lg-1 mt7">%</div>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                     <input id="" name="three_time" class="form-control mb8" type="text" value="<?php echo $keyword[0]['three_time'] ?>" placeholder="时间">
                                 </div>
                                 <div class="col-lg-1 mt7">天</div>
                             </div>  
                              <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn btn-primary" id="save_addkey" type="button">保存</button>
                                    <!-- <button class="btn btn-default" id="remove_addkey">重置</button> -->
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

        var hangye="<?php echo $keyword['category'];?>";
        var strs= new Array(); //定义一数组
        strs=hangye.split(","); //字符分割
        for (var i=0; i<strs.length ;i++ )
        {
            if(strs[i]){
                $('.vocationShow').append('<button type="button" value='+strs[i]+' class="btn btn-primary btn-xs mr1">'+strs[i]+'<i class="fa fa-remove"></i></button>')
            }
        }

         // 验证
            var e = "<i class='fa fa-times-circle'></i>";
            var verify = $("#addKeyOptimization").validate({
                rules: {
                    keyword: {
                        required: !0
                    }
                },
                messages: {
                    keyword: {
                        keyword_id: e + "必填"
                    }
                }
            })
             // 失去焦点验证关键字
            $('input[name="industry_name"]').blur(function(event) {
                var val = $(this).val();
                     if (val) {
                        $('.vocationShow').append('<button type="button" value='+val+' class="btn btn-primary btn-xs mr1">'+val+'<i class="fa fa-remove"></i></button>');
                     };        
               
                $(this).val('');
            });
            // 提交
            $("#save_addkey").click(function(){
                if(verify.form()) {                
                    var val = $('input[name="keyword_id"]').val();
                    var vocationValue = $(".vocationShow .btn-primary");
                    var temp = "";
                    if(!vocationValue){
                        temp=-1;
                    }
                    for(var i = 0; i < vocationValue.size(); i++) {
                        temp += vocationValue[i].value + ",";
                    }
                    var industry = $('select[name="industry"]').val();
                    var one_chance = $('input[name="one_chance"]').val();
                    var one_time = $('input[name="one_time"]').val();
                     var two_chance = $('input[name="two_chance"]').val();
                    var two_time = $('input[name="two_time"]').val();
                     var three_chance = $('input[name="three_chance"]').val();
                    var three_time = $('input[name="three_time"]').val();
                    $.post('<?=base_url(); ?>index.php/keywords_category/optimize_set', {'keyword_id': val,'industry_name':temp,'category_id':industry,"one_chance":one_chance,"one_time":one_time,"two_chance":two_chance,"two_time":two_time,"three_chance":three_chance,"three_time":three_time}, function(data) {
                        if (data) {
                            var _url = "<?=base_url(); ?>index.php/keywords_category/keywords_list";
                            $.loadPage(_url);
                            showInfo('操作成功',"success");
                        };
                    });
                }
            });
             // 删除 行业
            $('.vocationShow').on('click', '.btn-primary', function(event) {
                $(this).remove();

                event.preventDefault();
                /* Act on the event */
            });

    })
</script>