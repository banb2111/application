<div class="wrapper wrapper-content animated fadeInRight">     
        <div class="row">           
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="min-height:45PX;">
                        <h5>添加会销客户</h5>
                    </div>                    
                     <div class="ibox-content col-sm-12" style="padding-top:0;">
                        <form class="form-horizontal m-t" id="add" method="post"  action="<?php echo base_url(); ?>index.php/customer/hx_customer_add">
                             <div class="col-sm-12 col-md-8 col-lg-6" style="width:50%;float:left">  


                                <div class="form-group group" style="width:100%;float:left">
                                     <label class="col-sm-2 control-label">企业名称</label>
                                     <div class="col-sm-9">
                                         <input id="name" name="name" class="form-control" type="text" required="" aria-required="true">
                                         <span class="help-block m-b-none hide error-help"><i class="fa fa-times-circle"></i> 企业名称重复</span>
                                     </div>
                                     <div class="col-sm-1 errorStar">*</div>
                                </div>
                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">联系人</label>
                                    <div class="col-sm-9">
                                        <input id="" name="linkman" class="form-control" type="text" required="" aria-required="true">
                                    </div>
                                    <div class="col-sm-1 errorStar">*</div>
                                </div>
                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">手机号码</label>
                                    <div class="col-sm-9">
                                        <input id="" name="mobile" id="mobile" class="form-control mobile" type="text" >
                                    </div>
                                    <div class="col-sm-1 errorStar">*</div>
                                </div>
                                
                                 <div class="form-group" style="width:100%;float:left">
                                     <label class="col-sm-2 control-label">职位</label>
                                     <div class="col-sm-9">
                                         <select name="position_id" id="" class="form-control">
                                             <?php foreach($position as $k=>$v){?>
                                             <option <?php if($v->is_default==1){?> selected="selected" <?php }?> value="<?php echo $v->id; ?>" ><?php echo $v->name; ?></option>
                                             <?php }?>
                                         </select>
                                     </div>
                                 </div>

                                <!-- <div class="form-group">
                                   <label class="col-sm-2 control-label">是否推广</label>
                                    <div class="col-sm-9">
                                      <label class="radio-inline">
                                        <input type="radio" name="extend_xml" id="" value="1"  checked="checked">是
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="extend_xml" id="" value="0">否
                                      </label>
                                    </div>
                                </div> -->
                                 <div class="form-group" style="width:100%;float:left">
                                     <label class="col-sm-2 control-label">来源渠道</label>
                                     <div class="col-sm-3">
									<select id="channel_id" class="form-control" name="channel_id" aria-required="true" required="required">
									<option value="20" selected="selected">销售录入</option>
									</select>
                                     </div>
                                     <div class="col-sm-3" style="padding-left:0px;">
									<select id="channel_id_2" class="form-control help-block m-b-none" name="channel_id_2" aria-invalid="false">
									<option value="211">会销客户</option>
									</select>
                                     </div>

                                     <div class="col-sm-3 channel_id_3" style="padding-left:0px;display:none">
                                         <select name="channel_id_3" id="channel_id_3" class="form-control">
                                           
                                         </select>
                                     </div>
                                 </div>
                                 
                                 <div class="form-group hide" style="width:50%;float:left">
                                    <label class="col-sm-2 control-label">公司地址</label>
                                    <div class="col-sm-9">
                                        <input id="address" name="address" class="form-control" type="text">
                                    </div>
                                </div>
                                
                                
                                
                                 <div class="form-group hide" style="width:50%;float:left">
                                    <label class="col-sm-2 control-label">客户分类</label>
                                    <div class="col-sm-9">
                                       <select name="status" id="" class="form-control ">
                                           <option value="0">A</option>
                                           <option value="1">B</option>
                                           <option value="2" selected="selected">C</option>
                                           <option value="3">D</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">备注信息</label>
                                    <div class="col-sm-9">
                                        <textarea name="content" id=""  class="form-control" row="3"></textarea>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-2">
                                        <button class="btn btn-primary" id="customeradd" type="button">保存</button>
                                        <a class="btn btn-default" id="" data-toggle="modal" data-target="#reset">重置</a>
                                        <!-- <button class="btn btn-default" id="">取消</button> -->
                                    </div>
                                </div>
                            </div>

                            <!-- // @zzr edit at 2016-12-20 11:18 -->
                            <div class="col-sm-12 col-md-8 col-lg-6" style="width:50%;float:left">  
                                  <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">企业法人</label>
                                    <div class="col-sm-9">
                                        <input id="" name="corporate_name" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">页数</label>
                                    <div class="col-sm-9">
                                        <input id=""    name="bd_ranking" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">客户Q&nbsp;Q</label>
                                    <div class="col-sm-9">
                                        <input id="" name="qq" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">客户邮箱</label>
                                    <div class="col-sm-9">
                                        <input id="" name="email" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">固定电话</label>
                                    <div class="col-sm-9">
                                        <input id="" name="tel" id="tel" class="form-control tel" type="text" >
                                    </div>
                                    <!-- <div class="col-sm-1 errorStar">*</div> -->
                                </div>

                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">客户预算</label>
                                    <div class="col-sm-9">
                                        <input name="budget" id="budget" class="form-control tel" placeholder="例如：18000 请输入数字" type="text" >
                                    </div>
                                    <div class="col-sm-1 errorStar"></div>
                                </div>

                                 <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">省/市/县</label>
                                    <div class="col-sm-3">
                                         <select name="province_no" id="province_id" class="form-control">
                                             <option value="0" selected="selected">请选择</option>
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

                                <?php if($is_custom_service[0]['type']==5){ ?>
                                <div class="form-group" style="width:100%;float:left">
                                    <label class="col-sm-2 control-label">指派给销售</label>
                                    <div class="col-sm-9">
                                        <input name="new_user_id" value="" readonly="readonly" id="new_user_id" data-toggle="modal" data-target="#appointSale" class="form-control"  type="text" >
                                        <input type="hidden" value="0" id="new_user_id_val" name="new_user_id_val">
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
       <!--用户类型-->
    <input type="hidden" id="is_custom_service" value="<?=$is_custom_service?>">
    </div>
        <!-- 验证 -->
    <script src="<?php echo base_url(); ?>static/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>static/js/plugins/validate/messages_zh.min.js"></script>
    <script src="<?php echo base_url(); ?>static/js/demo/form-validate-demo.min.js"></script>
    
 <script type="text/javascript">
    $(function(){
        var e = "<i class='fa fa-times-circle'></i>";
        var verify = $("#add").validate({
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
                    ismobile:true,
                    required: !0
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
        $("#customeradd").click(function(){
             if(verify.form()) {    
                var user_type =  "<?=$is_custom_service[0]['type']?>";
                if(user_type == 5){
                    if($('#channel_id_2').val() == 0){
                        alert('请选择来源渠道二级小分类');
                        return;
                    }
                }
                // if($('#province_id option:selected').val() == 0){
                //     alert('请选择客户所在省/市/县');
                //     return;
                // }


                $(this).attr("disabled","disabled");
                

                $.submitForm("#add");
            }
        })
        $("#province_id").change(function(){
           var province_no=$(this).val();
            $.post("<?php echo base_url(); ?>index.php/customer/customer_add",{"province_no":province_no},function(data){
                $("#city").html(data);
            });
        });
        var extend_xml = $('input[name="extend_xml"]').val();
        if (extend_xml==1) {
            $('select[name="channel_id"]').attr('required', '',"aria-required","true");
        }else{
            $('select[name="channel_id"]').attr('required', '',"aria-required","");
        }
    });
    function county(obj){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/customer/customer_add",
            data: "city_no="+obj.value,
            success: function(data){
                $("#county").html(data);
            }
        });
    }
</script>
<!-- 重置弹出框 start-->
<div class="modal inmodal fade" id="reset" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
                <small class=" f14">您确定要重置吗？</small>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary reset" onclick="reset()" data-dismiss="modal">确定</a>
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<!-- 重置弹出框 end-->
<!-- 检测 唯一项弹出框 start-->
<div class="modal inmodal fade" id="only" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
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
<!-- 检测 唯一项弹出框 end-->
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
                <a type="button" class="btn btn-danger" id="send_message" data-dismiss="modal" data-toggle="modal" data-target="#sendMessage">发送消息</a>
                <a type="button" class="btn btn-primary onlytrue" data-dismiss="modal">确定</a>
                <!-- <a type="button" class="btn btn-white cancel" data-dismiss="modal">取消</a> -->
            </div>
        </div>
    </div>
</div>
<!-- 发送消息 -->
<div class="modal inmodal fade" id="sendMessage" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header hide">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title "></h4>
            </div>
            <div class="modal-body clearfix">
                <form class="form-horizontal" id="sendForm" method="post">
                     <div class="col-sm-12 col-md-8 col-lg-12">  
                      <div class="form-group">
                             <label class="col-sm-2 control-label">收信人</label>
                             <div class="col-sm-9 col-lg-9 col-md-9">
                                <p class='mt5 f14 fb is_sale'><!--收信人--></p><input type="hidden" id="recipient">
                             </div>
                         </div>
                      
                      <div class="form-group">
                             <label class="col-sm-2 control-label">内 容</label>
                             <div class="col-sm-9 col-lg-9 col-md-9">
                                 <textarea name="content" id="mail_content" class="form-control" required=""required="true"></textarea>
                             </div>
                         </div>
                    </div>
                </form>         
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary onlytrue send">发送</a>
                <!-- <a type="button" class="btn btn-white cancel" data-dismiss="modal">取消</a> -->
            </div>
        </div>
    </div>
</div>

<!-- 指定销售 -->
<div class="modal inmodal fade" id="appointSale" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">指定销售人员</h4>
            </div>
            <div class="modal-body p10 clearfix">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="exampleInputName2">部门：</label>
                    <select name="exampleInputName2" id="exampleInputName2" class="form-control">
                        <option value="">请选择</option>
                        <?php foreach($department_list as $k=>$v){ ?>
                        <option value="<?=$v['id'];?>"><?=$v['name'];?></option>
                        <?php } ?>
                    </select>
                  </div>


                   <div class="form-group serwhere">
                    <input type="text" value="" name="serchusername" placeholder="请输入姓名" class="form-control serchusername" style="width:100px;">
                  </div>

                    <div class="form-group serwhere">
                        <select name="onwork" class="form-control onwork">
                            <option value="on">在职人员</option>
                            <option value="no">离职人员</option>
                        </select>
                  </div>


                  <button type='button' class="btn btn-primary" id="query">查询</button>
                </form>
                <table class="table mt10" id="table2">
                </table>
                 <span class="mes_pR pull-left">
                     <a onclick="up('#appointSale')">上一页</a>
                     <a onclick="down('#appointSale')">下一页</a>
                 </span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="sale_user" >确认</button>
                <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<!-- 推广客户弹出框 start-->
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
                <div class="col-lg-7 pull-right">
                    <?php if($is_custom_service[0]['type']==5){ ?>
                    <a type="button" class="btn btn-danger" id="tuiguang" data-dismiss="modal">捡回客户</a>
                    <?php }else{ ?>
                    <a type="button" class="btn btn-primary" id="out_public_customer" data-dismiss="modal">捡入</a>
                    <?php } ?>
                    <a type="button" class="btn btn-white cancel" data-dismiss="modal">取消</a>
                </div>
                <div class="col-lg-5 pull-right">
                    <?php if($is_custom_service[0]['type']==5){ ?>
                         <select name="tuiguang" id="" class="form-control">
                           <option value="">请选择客户来源渠道</option>
                           <?php foreach ($all_channels as $key => $value) { ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['channel_name'] ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- 推广客户弹出框 end-->
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

<!-- 关键词修改弹出框 end-->
<script type="text/javascript">
    $(function(){
         // 关键词重复
             var key;
            $('input[name="keyword"]').on({
            focus:function(){
                      key = $(this).val(); 
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
        // 手机重复
        $('input[name="mobile"]').on({
            blur:function(){
                var mobile=$(this).val();
                var  str="";
                if(mobile){
                    $.post("<?php echo base_url(); ?>index.php/customer/ajax_mobile",{"mobile":mobile},function(data){
                        for(var cus in data){
                            if(data[cus].public_state==0){
                                $("#mobile_info").html("该手机号与<span style='color: red;'>'"+data[cus].ename+"'</span>客户手机重复，请填写其他手机");
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
                                    "<td>"+data[cus].lmobile+"<td>" +
                                    "<td>"+data[cus].pname+"<td>" +
                                    "</tr>"
                                "</table>";
                                $("#public_name").html("该手机号已在客户公海中"+str);
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
                var str="";
                if(name){
                    $.post("<?php echo base_url(); ?>index.php/customer/ajax_name",{"name":name},function(data){
                        for(var cus in data) {
                            $("#custo_id").val(data[cus].cid);
                            if (data[cus].public_state==0) {
                                $("#cus_name").html("该客户与<span class='fb' style='color:red;'>'"+data[cus].ename+"'</span>的客户重复");
                                $('#companyName').modal('show');
                                $('#companyName').on('hidden.bs.modal', function (e) {
                                    $('#name').val('');
                                    $('#name').focus();
                                });
                            }else{
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
                                    "<td>"+data[cus].lmobile+"<td>" +
                                    "<td>"+data[cus].pname+"<td>" +
                                    "</tr>"
                                "</table>";
                                $("#public_name").html("该客户已在客户公海中"+str);
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
        //销售人员捡入公海客户
        $("#out_public_customer").click(function(){
            var cus_id=$("#custo_id").val();
            $.post("<?php echo base_url(); ?>index.php/customer/ajax_out_public",{"cus_id":cus_id},function(data){
                if(data){
                    showInfo("捡入客户成功","success");
                }
            });
        });
        $("#send_message").click(function(){
            var cus_id=$("#custo_id").val();
            $.post("<?php echo base_url(); ?>index.php/mail/is_send_message",{"cus_id":cus_id},function(data){
                $.each(data,function(i,item){
                    //判断发送人
                    if(item.custom_service!=null&&item.new_user_id!=0){
                        $(".is_sale").html(item.ename);
                        $("#recipient").val(item.new_user_id);
                    }else if(item.custom_service!=null||item.new_user_id!=0){
                        $(".is_sale").html(item.ename);
                        $("#recipient").val(item.new_user_id);
                    }else if(item.custom_service!=null&&item.new_user_id==0){
                        $(".is_sale").html(item.ename);
                        $("#recipient").val(item.custom_service);
                    }
                });
            },"json");
        });
        $(".send").click(function(){
            var mail_content=$("#mail_content").val();
            if (!mail_content) {
                showInfo("发送信息失败","error");    
            }else{
                var recipient=$(".is_sale").next().val();
                $.post("<?=base_url();?>index.php/mail/send",{"user_id":recipient,"mail_content":mail_content},function(data){
                   if(data){
                        $('#sendMessage').modal('hide');
                       showInfo("发送信息成功","success");
                   }else{
                       showInfo("发送信息失败","error");
                   }
                });
            }
           
        });
        $('#tuiguang').click(function(event) {
            var cus_id = $('#custo_id').val();
            var tuiguang = $('select[name="tuiguang"]').val();
            $.post('<?=base_url();?>index.php/customer/set_tuiguang', {'cus_id': cus_id,'channel_id':tuiguang}, function(data) {
                if (data) {
                    showInfo('设置推广成功',"success");
                };
            });
        });
    });
    function reset () {
        // alert('d')
        var val = $('input[name="keyword"]').val();
        // alert(val);
       $('#add')[0].reset();
       $('input[name="keyword"]').val(val);
       $('form').find('.has-success').removeClass('has-success');
       // $('form').find('.has-error').removeClass('has-error');
       $('form').find('input').next('span').addClass('hide')
       $('#reset').on('hidden.bs.modal', function (e) {
              $('#name').focus();
        });
    }

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


    //指定销售分页样式显示
    $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1}, function(data) {
        var str;
        str='<tr>'+
            '<th></th>'+
            '<th>用户名</th>'+
            '<th>用户姓名</th>'+
            '<th>部门</th>'+
            ' </tr>';
        $.each(data,function(i,item){
            str+='<tr><label>'+
                '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                '<td>'+item.usname+'</td>'+
                '<td>'+item.ename+'</td>'+
                '<td>'+item.dname+'</td>'+
                '</label></tr>';
        });
        $("#table2").html(str);
    },"json");


    //指定销售查询部门
    $('#query').click(function() {
        var department_id = $('#appointSale').find('select').val();

        var serchusername = $.trim($(this).siblings('.serwhere').find('.serchusername').val());
        var onwork  = $(this).siblings('.serwhere').find('.onwork').val();

        $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1,"department_id":department_id,'serchusername':serchusername,'onwork':onwork} ,function(data){
            var str;
            str='<tr>'+
                '<th></th>'+
                '<th>用户名</th>'+
                '<th>用户姓名</th>'+
                '<th>部门</th>'+
                ' </tr>';
            $.each(data,function(i,item){
                str+='<tr>'+
                    '<label><td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                    '<td>'+item.usname+'</td>'+
                    '<td>'+item.ename+'</td>'+
                    '<td>'+item.dname+'</td>'+
                    '</label></tr>';
            });
            $("#table2").html(str);
        },"json");
    });

    //指定销售-确认
    $("#sale_user").click(function(){
       var user_id = $('input[name="user_id"]:checked').val();
       var user_name = $('input[name="user_id"]:checked').parent().next().next().text();
        if (user_id) {
            $('#new_user_id').val(user_name);
            $('#new_user_id_val').val(user_id);
            $("#appointSale").modal('hide');
        }else{
            showInfo('请勾选您要指定的用户',"error");
        }
    });




</script>

<?php include "tan_user.php";?>
<?php include "share_user.php";?>
