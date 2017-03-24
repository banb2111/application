<!-- 添加用户 -->
	<div class="modal-body col-lg-6 col-sm-12 col-md-8 animated fadeInRight">
               <form class="form-horizontal" method="post" action="<?php echo base_url() ;?>index.php/users/user_add" id="adduser_form">
                 <div class="form-group">
                   <label for="username" class="col-sm-2 control-label">用户名</label>
                   <div class="col-sm-8 ">
                     <input type="text" class="form-control" id="username" name="username" placeholder="" required="" aria-required="true">
                   </div>
                    <div class="col-sm-1 errorStar">*</div>
                 </div>
                <div class="form-group">
                   <label for="password" class="col-sm-2 control-label">密码</label>
                   <div class="col-sm-8 ">
                     <input type="text" class="form-control" id="password" name="password" placeholder="" required="" aria-required="true">
                   </div>
                    <div class="col-sm-1 errorStar">*</div>
                 </div>
                   <div class="form-group">
                       <label for="username" class="col-sm-2 control-label">员工姓名</label>
                       <div class="col-sm-8 ">
                           <input type="text" class="form-control" id="name" name="name" placeholder="" required="" aria-required="true">
                       </div>
                         <div class="col-sm-1 errorStar">*</div>
                   </div>
                    <div class="form-group">
                       <label for="username" class="col-sm-2 control-label">默认推广词</label>
                       <div class="col-sm-8 ">
                           <input type="text" class="form-control" id="keyword_id" name="keyword_id" placeholder="">
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="username" class="col-sm-2 control-label">手机号码</label>
                       <div class="col-sm-8 ">
                           <input type="text" class="form-control" id="mobile" name="mobile" placeholder="" required="" aria-required="true">
                       </div>
                        <div class="col-sm-1 errorStar">*</div>
                   </div>
                 <div class="form-group">
                   <label for="inputPassword3" class="col-sm-2 control-label">用户类别</label>
                   <div class="col-sm-8">
                     <select class="form-control" name="type">
                         <option value="0" selected="selected">--请选择--</option>
                         <option value="1">系统管理员</option>
                         <!-- <option value="2">公司</option> -->
                         <!-- <option value="3">部门</option> -->
                         <option value="4">商务人员</option>
                         <option value="5">售前客服</option>
                         <option value="6">人力资源</option>
                        </select>
                   </div>
                   
                 </div>
                 <div class="form-group">
                   <label for="inputPassword3" class="col-sm-2 control-label">部门</label>
                   <div class="col-sm-8 ">
                     <select class="form-control" name="department_id">
                         <!-- <option value="0" selected="selected">顶级部门</option> -->
                         <?php foreach ($department as $item) {?>
                             <option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
                         <?php }?>
                      </select>
                   </div>
                 </div>
                 <div class="form-group">
                   <label for="inputPassword3" class="col-sm-2 control-label" >公司</label>
                   <div class="col-sm-8 ">
                     <select class="form-control" name="company_id">
                         <option value="0" selected="selected">请选择</option>
                         <?php foreach ($company as $item) {?>
                             <option value="<?php echo $item->id?>"><?php echo $item->name?></option>
                         <?php }?>
                        </select>
                   </div>
                 </div>
                 <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                          <button class="btn btn-primary" type="button" id="adduser_id">提交</button>
                      </div>
                  </div>
               </form>
            </div>
                
           

<script type="text/javascript">
  $(function(){
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
    var verify = $("#adduser_form").validate({
      
      rules: {
        username: {
          required: !0,
          minlength: 6
        },
        name:{
          required:!0
        },
        password: {
          required: !0,
          minlength: 6
        },
        mobile: {
          required:!0,
          ismobile: true
        }
      },
      messages: {
        username: {
          required: e + "请输入用户名",
          minlength: e + "用户名必须6个字符以上"
        },
        name:{
          required:e+"请输入员工姓名"
        },
        password: {
          required: e + "请输入您的密码",
          minlength: e + "密码必须6个字符以上"
        },
         mobile: {
            required: e + "请输入手机号",
            ismobile: e + "请输入正确的手机号码"
        }  
        
      }
    })
    $('#adduser_id').click(function(event) {
      if(verify.form()) {
          $.submitForm("#adduser_form");
      }
    });
  })
</script>