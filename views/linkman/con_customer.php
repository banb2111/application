
    <div class="wrapper wrapper-content animated fadeInRight">
     
        <div class="row">
           
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加客户联系人&nbsp;&nbsp;&nbsp;&nbsp;客户名称：【<?=$cus_name?>】</h5>
                    </div>
                     <div class="ibox-content">
                         <form class="form-horizontal" method="post" action="<?php echo base_url() ;?>index.php/customer/linkman" id="adduser_form">
                                <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"/>
                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">姓名</label>
                                     <div class="col-sm-9">
                                         <input id="" name="name" class="form-control" type="text" required="" aria-required="true">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">电话</label>
                                     <div class="col-sm-9">
                                         <input id="" name="mobile" class="form-control" type="text"required="" aria-required="true">
                                         <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">QQ</label>
                                     <div class="col-sm-9">
                                         <input id="" name="qq" class="form-control" type="text" >
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">微信</label>
                                     <div class="col-sm-9">
                                         <input id="" name="wechat" class="form-control" type="text" >
                                     </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-9">
                                        <input id="" name="email" class="form-control" type="email">
                                        <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span> -->
                                    </div>
                                </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">职位</label>
                                 <div class="col-sm-9">
                                     <select name="position_id" id="" class="form-control">
                                         <?php foreach($position as $k=>$v){?>
                                             <option <?php if($v->if_default==1){?> selected="selected" <?php }?> value="<?php echo $v->id; ?>" ><?php echo $v->name; ?></option>
                                         <?php }?>
                                     </select>
                                 </div>
                             </div>
                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">备注</label>
                                     <div class="col-sm-9">
                                        <textarea class="form-control" name="remark" rows="3"></textarea>
                                     </div>
                                 </div>
                             
                            <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-2">
                                        <button type="button" class="btn btn-primary" id="customer_add_id">确认添加</button>
                                        <a class="btn btn-default quxiao" >取消</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>/static/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/validate/messages_zh.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/demo/customer-validate-demo.min.js"></script>

<script type="text/javascript">
    $(function(){
        var e = "<i class='fa fa-times-circle'></i>";
        var verify = $("#adduser_form").validate({
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
                    digits:true
                }
            },
            messages: {
                keyword_id: e + "关键词",
                name: {
                    required: e + "请输入客户名称"
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
        $("#customer_add_id").click(function(){
            if(verify.form()) {
                $.submitForm("#adduser_form");
            }
            // $("#customer_add_from").submit();
        })
        $(".quxiao").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer";
             $.loadPage(_url);
        });
    });

</script>
