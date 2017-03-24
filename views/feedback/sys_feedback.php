
	<!-- 添加用户 -->
	<div class="modal-body col-lg-6 col-md-8 animated fadeInRight">
     <form class="form-horizontal" method="post" id="feed_form" action="<?php echo base_url(); ?>index.php/feedback/add_feedback" >
       <div class="form-group">
         <label for="feed_name" class="col-sm-2 control-label">反馈标题</label>
         <div class="col-sm-8 ">
           <input type="text" class="form-control" id="feed_name" name="feed_name" placeholder="" required="" aria-required="true">
         </div>
          <div class="col-sm-1 errorStar">*</div>
       </div>
      <div class="form-group">
         <label for="description" class="col-sm-2 control-label">反馈内容</label>
         <div class="col-sm-8 ">
            <textarea class="form-control" name="description" rows="3"required="" aria-required="true"></textarea>
         </div>
           <div class="col-sm-1 errorStar">*</div>
       </div>
       <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary" type="button" id="feedback_id" >提交</button>
            </div>
        </div>
     </form>
  </div>
                

                <script src="<?php echo base_url(); ?>/static/js/plugins/validate/jquery.validate.min.js"></script>
                <script src="<?php echo base_url(); ?>/static/js/plugins/validate/messages_zh.min.js"></script>
                <script src="<?php echo base_url(); ?>/static/js/demo/feedback-validate.js"></script>


<script>
    $(function(){
        $("#feedback_id").click(function(){
         
          var e = "<i class='fa fa-times-circle'></i> ";
          var verify =  $("#feed_form").validate({
            rules: {
              username: {
                required: !0
              },
              description: {
                required: !0,
                minlength: 6
              },
              confirm_password: {
                required: !0,
                minlength: 5,
                equalTo: "#password"
              },
              email: {
                required: !0,
                email: !0
              },
              topic: {
                required: "#newsletter:checked",
                minlength: 2
              },
              agree: "required"
            },
            messages: {
              username: {
                required: e + "请输入标题"
              },
              description: {
                required: e + "必填",
                minlength: e + "必须6个字符以上"
              },
              confirm_password: {
                required: e + "请再次输入密码",
                minlength: e + "密码必须5个字符以上",
                equalTo: e + "两次输入的密码不一致"
              },
              email: e + "请输入您的E-mail",
              agree: {
                required: e + "必须同意协议后才能注册",
                element: "#agree-error"
              }
            }
          })
          if (verify.form()) {
          $.submitForm("#feed_form");            
          };
        });
    });
</script>