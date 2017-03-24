
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑客户</h5>
                </div>
<?php foreach($customer as $k=>$customer){ ?>
                <div class="ibox-content col-sm-12">
                    <?php $str= $_SERVER['HTTP_REFERER'];
                    $page=substr($str, -1);
                    ?>
                    <form class="form-horizontal m-t" id="customer_add_from" method="post"  action="<?php echo base_url(); ?>index.php/customer/customer_update">
                        <input type="hidden" name="cus_id" id="cus_id" value="<?php echo $cus_id;?>">
                        <input type="hidden" name="create_time" value="<?php echo $customer->create_time;?>">
                        <input type="hidden" name="no" value="<?php echo $customer->no;?>">
                        <input type="hidden" name="keyword_id" id='keyword_id' value="<?php echo $customer->keyword_id;?>">
                        <input type="hidden" name="linkman_id" value="<?php echo $customer->linkman_id;?>">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">推广词</label>
                                <div class="col-sm-9">
                                    <input id="" name="keyword" class="form-control" type="text" required=""required="true" value="<?php foreach($keyword as $k=>$keyword){ echo $keyword->keyword; }?>" >
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 输入关键词有助于提高搜索，可以使用多个用 | 隔开</span>
                                </div>
                                <div class="col-sm-1 errorStar">*</div>
                            </div>
                            <div class="form-group group">
                                <label class="col-sm-2 control-label">企业名称</label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" class="form-control" type="text"required="" aria-required="true" value="<?php echo $customer->cname; ?>">
                                    <span class="help-block m-b-none hide error-help"><i class="fa fa-times-circle"></i> 企业名称重复</span>
                                </div>
                                <div class="col-sm-1 errorStar">*</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">法人</label>
                                <div class="col-sm-9">
                                    <input id="" name="corporate_name" class="form-control" type="text" value="<?php echo $customer->corporate_name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">联系人</label>
                                <div class="col-sm-9">
                                    <input id="" name="linkman" class="form-control" type="text" value="<?php echo $customer->linkman_name; ?>">
                                </div>
                                <div class="col-sm-1 errorStar">*</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">职位</label>
                                <div class="col-sm-9">
                                    <select name="position_id" id="" class="form-control">
                                        <?php foreach($position as $k=>$v){?>
                                            <option <?php if($v->is_default==$customer->position_id){?> selected="selected" <?php }?> value="<?php echo $v->id; ?>" ><?php echo $v->name; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机</label>
                                <div class="col-sm-9">
                                    <input id="" name="mobile" id="mobile" class="form-control mobile" type="text" value="<?php echo $customer->linkman_mobile; ?>"  >
                                </div>
                                <div class="col-sm-1 errorStar">*</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">页数</label>
                                <div class="col-sm-9">
                                    <input id=""    name="bd_ranking" class="form-control" type="text"  value="<?php echo $customer->bd_ranking; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">网址</label>
                                <div class="col-sm-9">
                                    <input id=""    name="URL" class="form-control" type="text"  value="<?php echo $customer->linkman_URL; ?>">
                                </div>
                            </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label">来源渠道</label>
                                     <div class="col-sm-3">
                                         <select name="channel_id" <?php echo $sel_disabled; ?> id="channel_id" class="form-control" aria-required="true">
                                             <!-- <option value="0">请选择</option> -->

                                            <?php if($customer->channel_id > 0){?>

                                                <?php foreach ($channel_list as $key => $value) { ?>
                                                    <?php if($customer->channel_id_1 ==  $value['id']){ ?>
                                                        <option value="<?= $value['id']?>" selected="selected"><?= $value['channel_name']?></option>
                                                    <?php }else{ ?>

                                                         <?php if($is_custom_service[0]['type'] != 5){ ?>
                                                            <option value="<?= $value['id']?>"><?= $value['channel_name']?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php }else{ ?>

                                                <?php foreach ($channel_list as $key => $value) { ?>
                                                    <?php if($is_custom_service[0]['type']==5 && $value['channel_name'] == '推广渠道'){ ?>
                                                        <option value="<?= $value['id']?>" selected="selected"><?= $value['channel_name']?></option>
                                                    <?php }elseif($is_custom_service[0]['type'] != 5 && $value['channel_name'] == '销售录入'){ ?>
                                                        <option value="<?= $value['id']?>" selected="selected"><?= $value['channel_name']?></option>
                                                    <?php }elseif($is_custom_service[0]['type'] != 5 && $value['channel_name'] != '销售录入'){ ?>
                                                        <option value="<?= $value['id']?>"><?= $value['channel_name']?></option>
                                                    <?php } ?>
                                                <?php } ?>

                                            <?php } ?>
                                         </select>
                                     </div>

                                     <div class="col-sm-3" style="padding-left:0px;">
                                         <select name="channel_id_2" <?php echo $sel_disabled; ?> id="channel_id_2" class="form-control">
                                            <?php if($is_custom_service[0]['type']==5){ ?>
                                             <option value="0">请选择</option>
                                             <?php }else{ ?>
                                             <option value="0">请选择(可选项)</option>
                                             <?php } ?>
                                            <?php foreach ($channel_list_2 as $key => $value) { ?>

                                                <?php if($customer->channel_id_2 == $value['id']){ ?>
                                                    <option value="<?= $value['id']?>" selected = 'selected'><?= $value['channel_name']?></option>
                                                <?php }else{ ?>
                                                    <option value="<?= $value['id']?>"><?= $value['channel_name']?></option>
                                                <?php } ?>
                                                
                                            <?php } ?>
                                         </select>
                                     </div>

                                     <div class="col-sm-3 channel_id_3" <?php echo $sel_disabled; ?> style="padding-left:0px;display:none">
                                         <select name="channel_id_3" id="channel_id_3" class="form-control">
                                           
                                         </select>
                                     </div>

                                </div>

                                <div class="form-group" style="display:none">
                                    <label class="col-sm-2 control-label">是否推广</label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <?php if($customer->extend_status==1){ ?>
                                            <input type="radio" name="extend_xml"  value="1"  checked="checked">是
                                            <?php }else{ ?>
                                                <input type="radio" name="extend_xml"  value="1"  >是
                                            <?php } ?>
                                        </label>
                                        <label class="radio-inline">
                                            <?php if($customer->extend_status==0){ ?>
                                            <input type="radio" name="extend_xml"  value="0" checked="checked" >否
                                            <?php }else{ ?>
                                                <input type="radio" name="extend_xml"  value="0"  />否
                                            <?php } ?>
                                        </label>
                                    </div>
                                </div>
                      
                            <div class="form-group" id="city_no" style="display: none;">
                                <label class="col-sm-2 control-label">省市县</label>
                                <div class="col-sm-3">
                                    <select name="province_no" id="province_id" class="form-control" >
                                        <option value="" selected="selected">请选择</option>
                                        <?php
                                        $this->db->where('father_id',0);
                                        $query=$this->db->get('region');
                                        $province=$query->result();
                                        foreach($province as $k=>$v){

                                            ?>
                                            <option value="<?php echo $v->region_code; ?>"><?php echo $v->region_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="city">
                                </div>
                                <div class="col-sm-3" id="county">
                                </div>
                            </div>
                            <div class="form-group" id="city_no2">
                                <label class="col-sm-2 control-label">省市县</label>
                                <div class="col-sm-9">
                                    <p id="" name="fax" class="form-control"><?php echo $customer->province_no.$customer->city_no.$customer->county_no; ?></p>
                                    <input type="button" id="bianji" value="编辑">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">公司地址</label>
                                <div class="col-sm-9">
                                    <input id="address" name="address" class="form-control" type="text" value="<?php echo $customer->address;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input id="" name="email" class="form-control" type="text" value="<?php echo $customer->linkman_email;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">QQ</label>
                                <div class="col-sm-9">
                                    <input id="" name="qq" class="form-control" type="text" value="<?php echo $customer->linkman_qq;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客户分类</label>
                                <div class="col-sm-9">
                                    <select name="status" id="" class="form-control">
                                        <option <?php if($customer->sta==-1){ ?> selected="selected"<?php } ?>  value="-1">无分类</option>
                                        <option <?php if($customer->sta==1){ ?> selected="selected" <?php } ?>  value="1">A类客户</option>
                                        <option <?php if($customer->sta==2){ ?> selected="selected" <?php } ?> value="2">B类客户</option>
                                        <option <?php if($customer->sta==3){ ?> selected="selected" <?php } ?> value="3">C类客户</option>
                                        <option <?php if($customer->sta==4){ ?> selected="selected" <?php } ?> value="4">D类客户</option>

                                    </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注</label>
                            <div class="col-sm-9">
                                <textarea name="cus_content" id=""  class="form-control" row="3" value="<?php echo $customer->cus_content;?>" ><?php echo $customer->cus_content;?></textarea>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-2">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#export">确认修改</a>
                                    <a class="btn btn-default cancel_edit" data-herf="<?php echo $_SESSION['cur_url']; ?>">取消</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<!-- 检测 唯一项弹出框 start-->
<div class="modal inmodal fade" id="export" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close hide" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
                <small class=" f14">您确定要修改吗</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="customer_add_id" data-dismiss="modal">确定</button>
                <a type="button" class="btn btn-white" data-dismiss="modal">取消</a>
            </div>
        </div>
    </div>
</div>
<!-- 检测 手机号码重复 start-->
<div class="modal inmodal fade" id="only" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close hide" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
                <small class=" f14" id="mobile_info"></small>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary onlytrue" data-dismiss="modal">确定</a>
                <!-- <a type="button" class="btn btn-white cancel" data-dismiss="modal">取消</a> -->
            </div>
        </div>
    </div>
</div>
<!-- 检测 手机号码重复 end-->
<!-- 检测 唯一项弹出框 start-->
<div class="modal inmodal fade" id="companyName" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close hide" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
                <small class=" f14" id="cus_name"></small>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary onlytrue" data-dismiss="modal">确定</a>
                <!-- <a type="button" class="btn btn-white cancel" data-dismiss="modal">取消</a> -->
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal fade" id="publicName" tabindex="-1" role="dialog"  aria-hidden="true">
    <input type="hidden" id="custo_id" value=""/>
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close hide" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
                <small class=" f14" id="public_name"></small>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" id="out_public_customer" data-dismiss="modal">捡入</a>
                <a type="button" class="btn btn-white cancel" data-dismiss="modal">取消</a>
            </div>
        </div>
    </div>
</div>
<!-- 检测 唯一项弹出框 end-->
<!-- 关键词修改弹出框 start-->
<div class="modal inmodal fade" id="keyWordUpdate" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
                <small class=" f14" id="key_name"></small>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary"data-dismiss="modal" id="keyquery">确定</a>
                <button type="button" class="btn btn-white keyCancel" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){

        // 取消编辑
        $('.cancel_edit').click(function(){
            var herf = $(this).attr('data-herf');
            $.loadPage(herf);
        });



        // 动态加载下级来源分类
        $('#channel_id_2').change(function(){
            var this_ch_id = $(this).val();
            if(this_ch_id != 0){
                $.post('<?=base_url();?>index.php/customer/get_ch_channels',{'pid':this_ch_id},function(data){
                    var info = eval(data);
                    if(info.s == 'ok'){
                        var chstr = '<option value="">请选择</option>';
                        for(val in info.chsdata){
                            chstr = chstr + '<option value="'+info.chsdata[val]['id']+'">'+info.chsdata[val]['channel_name']+'</option>';
                        }
                        if(info.chsdata.length > 0){
                            $('#channel_id_3').html(chstr);
                            $('.channel_id_3').css('display','block');
                        }else{
                            $('#channel_id_3').html('');
                            $('.channel_id_3').css('display','none');
                        }
                    }
                },'json');
            }else{
                $('#channel_id_3').html('');
                $('.channel_id_3').css('display','none');
            }
        });

        //切换来源渠道1级分类
        $('#channel_id').change(function(){

            var this_ch_id = $(this).val();
            var level = 2;
            if(this_ch_id == 20 || this_ch_id == 21){ //此处需手动设置属于哪个分类
                var level = 1;
            }

            $('#channel_id_3').html('');
            $('.channel_id_3').css('display','none');

            if(this_ch_id != 0){
                $.post('<?=base_url();?>index.php/customer/get_ch_channels',{'pid':this_ch_id,'level':level},function(data){
                    var info = eval(data);
                    if(info.s == 'ok'){
                        if(info.level == 1 && this_ch_id == 20){
                            var chstr = '<option value="0">请选择(可选)</option>';
                        }else{
                            var chstr = '<option value="0">请选择</option>';
                        }
                        
                        for(val in info.chsdata){
                            chstr = chstr + '<option value="'+info.chsdata[val]['id']+'">'+info.chsdata[val]['channel_name']+'</option>';
                        }
                        if(info.chsdata.length > 0){
                            $('#channel_id_2').html(chstr);
                            // $('.channel_id_2').css('display','block');
                        }else{
                            alert('获取子分类数据出错！');
                            return
                            // $('#channel_id_3').html('');
                            // $('.channel_id_3').css('display','none');
                        }
                    }
                },'json');
            }else{
                $('#channel_id_3').html('');
                $('.channel_id_3').css('display','none');
            }
        });
    
        
        // 动态加载第二级小来源渠道分类
        var channel_id_1 = "<?php echo $customer->channel_id_1; ?>";
        if(channel_id_1 != 0){
                $.post('<?=base_url();?>index.php/customer/get_ch_channels',{'pid':channel_id_1},function(data){
                    var info = eval(data);
                    if(info.s == 'ok'){
                        var chstr = '<option value="">请选择</option>';
                        var channel_id_2 = "<?php echo $customer->channel_id_2; ?>";
                        for(val in info.chsdata){
                            if(info.chsdata[val]['id'] == channel_id_2){
                                chstr = chstr + '<option value="'+info.chsdata[val]['id']+'" selected="selected">'+info.chsdata[val]['channel_name']+'</option>';
                            }else{
                                chstr = chstr + '<option value="'+info.chsdata[val]['id']+'">'+info.chsdata[val]['channel_name']+'</option>';    
                            }
                        }
                        if(info.chsdata.length > 0){
                            $('#channel_id_2').html(chstr);
                            $('.channel_id_2').css('display','block');
                        }else{
                            $('#channel_id_2').html('');
                            $('.channel_id_2').css('display','none');
                        }
                    }
                },'json');
        }
    



        // 动态加载第三级小来源渠道分类
        var channel_id_2 = "<?php echo $customer->channel_id_2; ?>";
            if(channel_id_2 != 0){
                $.post('<?=base_url();?>index.php/customer/get_ch_channels',{'pid':channel_id_2},function(data){
                    var info = eval(data);
                    if(info.s == 'ok'){
                        var chstr = '<option value="">请选择</option>';
                        var channel_id_3 = "<?php echo $customer->channel_id_3; ?>";
                        for(val in info.chsdata){
                            if(info.chsdata[val]['id'] == channel_id_3){
                                chstr = chstr + '<option value="'+info.chsdata[val]['id']+'" selected="selected">'+info.chsdata[val]['channel_name']+'</option>';
                            }else{
                                chstr = chstr + '<option value="'+info.chsdata[val]['id']+'">'+info.chsdata[val]['channel_name']+'</option>';    
                            }
                        }
                        if(info.chsdata.length > 0){
                            $('#channel_id_3').html(chstr);
                            $('.channel_id_3').css('display','block');
                        }else{
                            $('#channel_id_3').html('');
                            $('.channel_id_3').css('display','none');
                        }
                    }
                },'json');
        }





        // 关键词重复
        var key;
        $('input[name="keyword"]').on({
            focus:function(){
                key = $(this).val();
                alert(key);
            },
            blur:function(){
                if ($(this).val()!=key) {
                    $("#key_name").html("是否将推广词的默认值设置为<span style='color: red;'>'"+$(this).val()+"'?</span>");
                    $('#keyWordUpdate').modal('show');
                    $('input[name="keyword"]').val($(this).val());
                };
            }
        });
        $('.keyCancel').click(function(event) {
            $('#keyWordUpdate').on('hidden.bs.modal', function (e) {
                $('input[name="keyword"]').val(key);
            });
        });
        $("#keyquery").click(function(){
            var keyval=$('input[name="keyword"]').val();
            $.post("<?=base_url(); ?>index.php/customer/keyword_update",{"keyword":keyval},function(data){
                $("#keyword_id").val(data);
            });
        });
        $("#customer_add_id").click(function(){
            $('#export').modal('hide');
            var e = "<i class='fa fa-times-circle'></i>  ";
            $.validator.addMethod('ismobile',function(value,element,params){
              var length = value.length;
              var mobile = /^1[3|4|5|7|8]\d{9}$/;
              return this.optional(element) || (length == 11 && mobile.test(value));
            },e+'请填写正确的手机号码')
            $.validator.setDefaults({
              highlight: function(e) {
                $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
              },
              success: function(e) {
                e.closest(".form-group").removeClass("has-error").addClass("has-success")
              },
              errorElement: "span",
              errorPlacement: function(e, r) {
                e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
              },
              errorClass: "help-block m-b-none",
              validClass: "help-block m-b-none"
            })
            var verify = $("#customer_add_from").validate({
                rules: {
                    keyword_id: "required",
                    name: {
                        required: !0,
                        minlength: 2
                    },
                    linkman_id:{
                        required: !0
                    },
                    email: {
                        email: !0,
                        email:true
                    },
                    mobile: {
                        required: !0,
                        minlength: 11,
                        maxlength:11,
                        digits:true,
                        ismobile:true
                    }
                },
                messages: {
                    keyword_id: e + "关键词",
                    name: {
                        required: e + "请输入企业名称",
                        minlength: e + "企业名称必须两个字符以上"
                    },
                    linkman_id: {
                        required: e + "请输入联系人"
                    },
                    mobile: {
                        required: e + "请输入手机号",
                        minlength: e + "请输入正确的手机号码"
                    },
                    email: e + "请输入您的E-mail",
                    agree: {
                        required: e + "必须同意协议后才能注册",
                        element: "#agree-error"
                    }
                }
            })
            if (verify.form()) {
                $.submitForm("#customer_add_from");
            };
        })
        $("#province_id").change(function(){
            var province_no=$(this).val();
            $.post("<?php echo base_url(); ?>index.php/customer/customer_update",{"province_no":province_no},function(data){
                $("#city").html(data);
            });
        });
        $("#bianji").click(function(){
            $("#city_no").show();
            $("#city_no2").hide();
        });
        // 手机重复
        $('input[name="mobile"]').on({
            blur:function(){
                var mobile=$(this).val();
                var cus_id=$("#cus_id").val();
                var str="";
                if(mobile){
                    $.post("<?php echo base_url(); ?>index.php/customer/ajax_mobile",{"mobile":mobile,"id":cus_id},function(data){
                        for(var cus in data){
                            if(data[cus].public_state==0){
                                $("#mobile_info").html("该手机号与我的<span style='color: red;'>'"+data[cus].lname+"'</span>客户手机重复，请填写其他手机");
                                $('#only').modal('show');
                                $('#only').on('hidden.bs.modal', function (e) {
                                    $('.mobile').val('');
                                    $('.mobile').focus();
                                });
                            }else{
                                $("#custo_id").val(data[cus].cid);
                                str+="<table class='table mt20'>" +
                                    "<tr>" +
                                    "<td>公司名称<td>" +
                                    "<td>联系人<td>" +
                                    "<td>手机号<td>" +
                                    "<td>职位<td>" +
                                    "</tr>" +
                                    "<tr>" +
                                    "<td>"+data[cus].cname+"<td>" +
                                    "<td>"+data[cus].lname+"<td>" +
                                    "<td>"+data[cus].mobile+"<td>" +
                                    "<td>"+data[cus].pname+"<td>" +
                                    "</tr>"
                                "</table>";
                                $("#public_name").html("该手机号与公海客户<span style='color: red;'>'"+data[cus].lname+"'</span>手机重复，请填写其他手机"+str);
                                $('#publicName').modal('show');
                                $('#publicName').on('hidden.bs.modal', function (e) {
                                    $('.mobile').val('');
                                    $('.mobile').focus();
                                });
                            }
                        }
                    },'json');
                }
            }     
    });
        // 企业名称重复
        $('input[name="name"]').on({
            blur:function(){
                var name=$(this).val();
                var cus_id=$("#cus_id").val();
                var str="";
                if(name){
                    $.post("<?php echo base_url(); ?>index.php/customer/ajax_name",{"name":name,"id":cus_id},function(data){
                        for(var cus in data) {
                            if (data[cus].public_state==0) {
                                $("#cus_name").html("该客户与<span style='color:red;'>'"+data[cus].lname+"'</span>的客户重复");
                                $('#companyName').modal('show');
                                $('#companyName').on('hidden.bs.modal', function (e) {
                                    $('#name').val('');
                                    $('#name').focus();
                                });
                            }else{
                                $("#custo_id").val(data[cus].cid);
                                str+="<table class='table mt20'>" +
                                    "<tr>" +
                                    "<td>公司名称<td>" +
                                    "<td>联系人<td>" +
                                    "<td>手机号<td>" +
                                    "<td>职位<td>" +
                                    "</tr>" +
                                    "<tr>" +
                                    "<td>"+data[cus].cname+"<td>" +
                                    "<td>"+data[cus].lname+"<td>" +
                                    "<td>"+data[cus].mobile+"<td>" +
                                    "<td>"+data[cus].pname+"<td>" +
                                    "</tr>"
                                "</table>";
                                $("#public_name").html("该客户与公海客户中的<span style='color:red;'>'"+data[cus].lname+"'</span>重复"+str);
                                $('#publicName').modal('show');
                                $('#publicName').on('hidden.bs.modal', function (e) {
                                    $('#name').val('');
                                    $('#name').focus();
                                });
                            }
                        }
                    },'json');
                }
            }

        });
        $("#out_public_customer").click(function(){
            var id=$("#custo_id").val();
            $.post("<?php echo base_url(); ?>index.php/customer/ajax_out_public_customer",{"cus_id":id},function(){
            });
        });

    });
    function county(obj){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/customer/customer_update",
            data: "city_no="+obj.value,
            success: function(data){
                $("#county").html(data);
            }
        });
    }
</script>
