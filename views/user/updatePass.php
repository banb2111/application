
    <div class="wrapper wrapper-content animated fadeInRight">
     
        <div class="row">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="modify_password_from" method="post" action="<?php echo base_url();?>index.php/users/modify_password">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">旧密码</label>
                                <div class="col-sm-8">
                                    <input id="username" name="orig_password" class="form-control" type="password" aria-required="true" aria-invalid="true" class="error">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">密码</label>
                                <div class="col-sm-8">
                                    <input id="password" name="new_password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">确认密码</label>
                                <div class="col-sm-8">
                                    <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" id="modify_password_id" >提交</button>
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
    <script src="<?php echo base_url(); ?>/static/js/demo/updatePassword-validate-demo.min.js"></script>
</html>
<script>
    $(function(){
       $("#modify_password_id").click(function(){
           $("#modify_password_from").submit();
       }) ;
    });
</script>