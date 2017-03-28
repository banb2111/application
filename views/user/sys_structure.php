
    <div class="row wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-12">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title clearfix">
                        <h5>上下级关系图</h5>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0):;" data-toggle="modal" data-target="#update">修改部门隶属</a>
                        <div class="w200 ibox-tools" id="exampleTableEventsToolbar">
                            
                                
								
                            					
                            <button type="button" class="btn btn-outline btn-primary mr1 "data-toggle="modal" data-target="#myModal5">
                                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>添加部门
                            </button>
                            <button type="button" class="btn btn-outline btn-primary mr1 "data-toggle="modal" data-target="#addPost">
                                 <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>添加公司
                            </button>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="treeview6" class="test"></div>
                    </div>
                </div>
                <div id="event_output"></div>
            </div>
        </div>
    </div>
    <input type="hidden" id="department_id" />

<script src="<?php echo base_url(); ?>/static/js/plugins/treeview/bootstrap-treeview.js"></script>
<script src="<?php echo base_url(); ?>/static/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>/static/js/plugins/validate/messages_zh.min.js"></script>
<script src="<?php echo base_url(); ?>/static/js/demo/add_department-validate-demo.min.js"></script>
<!-- 添加部门弹出框 -->
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class=" ">添加部门</h4>
                <small class="font-bold hide">这里可以显示副标题。</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/users/department_add" method="post" id="department_form">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">部门名</label>
                        <div class="col-sm-8 col-sm-offset-1">
                            <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="" javascript:this.focus() required="" aria-required="true">
                        </div>
                         <div class="col-sm-1 errorStar">*</div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4" class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-8 col-sm-offset-1">
                            <input type="text" class="form-control" id="inputEmail4" name="sort" placeholder="" javascript:this.focus() required="" aria-required="true">
                        </div>
                         <div class="col-sm-1 errorStar">*</div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">上级部门</label>
                        <div class="col-sm-8 col-sm-offset-1">
                            <select class="form-control" name="no">
                                <option value="0" selected="selected">顶级部门</option>
                                <?php foreach ($department as $item) {?>
                                    <option value="<?php echo $item->id?>" selected="selected"><?php echo $item->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">部门描述</label>
                        <div class="col-sm-8 col-sm-offset-1">
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a class="btn btn-primary" type="button" id="department_id2" >确认添加</a>
                            <button class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer hide">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>

<!-- 添加公司弹出框 -->
 <div class="modal inmodal fade" id="addPost" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title ">添加公司</h4>
                <small class="font-bold hide">这里可以显示副标题。</small>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" method="post" id="company_form" action="<?php echo base_url();?>index.php/users/company_add">
                 <div class="form-group">
                   <label for="inputEmail3" class="col-sm-2 control-label">公司名</label>
                   <div class="col-sm-8 col-sm-offset-1">
                     <input type="text" class="form-control" name="companyName" id="inputEmail3" placeholder="" javascript:this.focus()required="" aria-required="true">
                   </div>
                    <div class="col-sm-1 errorStar">*</div>
                 </div>
                 <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">公司介绍</label>
                   <div class="col-sm-8 col-sm-offset-1">
                     <textarea class="form-control" name="introduction" rows="3"></textarea>
                   </div>
                 </div>
                 <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a class="btn btn-primary" type="button"  id="company_id" >确认添加</a>
                            <button class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
               </form>
            </div>
            <div class="modal-footer hide">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary"data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>
    <!-- 设置主管 -->
    <div class="modal inmodal fade" id="charge" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">设置主管</h5>
                    <small class="font-bold hide">这里可以显示副标题。</small>
                </div>
                <div class="modal-body pl30">
                    <table class="table" id="myTable">
                    </table>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal"  >关闭</a>
                    <button type="button" class="btn btn-primary" id="setUp" data-dismiss="modal">确认</button>
                </div>
            </div>
        </div>
    </div>  
	
	
<!-- 修改权限弹出框 -->
<div class="modal inmodal fade" id="forbidden" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!--<h4 class="modal-title ">修改岗位信息</h4>-->
                <small class="font-bold hide">这里可以显示副标题。</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/users/department_forbidden" method="post" id="department_form">
                    <!--<div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">岗位名</label>
                        <div class="col-sm-8 ">
                            <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="" javascript:this.focus() required="" aria-required="true">
                        </div>
                         <div class="col-sm-1 errorStar">*</div>
                    </div>-->
					<span style="font-size:16px;color:green">
					说明：禁用后，添加用户与组织架构将不再展示，仅离职信息中可供查询，
					禁用后不允许重新启用，禁用的部门必须是没有任何成员，
					且没有任何下级部门的部门，否则不会禁用成功</span><br><br>
                   <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">要禁用的部门</label>
                        <div class="col-sm-8 ">
                            <select class="form-control" name="nonow">
                                <option value="0" selected="selected">顶级部门</option>
                                <?php foreach ($department as $item) {?>
                                    <option value="<?php echo $item->id?>" selected="selected"><?php echo $item->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">上级部门</label>
                        <div class="col-sm-8 ">
                            <select class="form-control" name="no">
                                <option value="0" selected="selected">顶级部门</option>
                                <?php foreach ($department as $item) {?>
                                    <option value="<?php echo $item->id?>" selected="selected"><?php echo $item->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>-->
                     <!--<div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">岗位描述</label>
                        <div class="col-sm-8 ">
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </div>-->
                     <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit"  id="department_id" >确认修改</button>
                            <button class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer hide">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>	
	
	
<!-- 修改权限弹出框 -->
<div class="modal inmodal fade" id="update" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!--<h4 class="modal-title ">修改岗位信息</h4>-->
                <small class="font-bold hide">这里可以显示副标题。</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/users/department_edit" method="post" id="department_form">
                    <!--<div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">岗位名</label>
                        <div class="col-sm-8 ">
                            <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="" javascript:this.focus() required="" aria-required="true">
                        </div>
                         <div class="col-sm-1 errorStar">*</div>
                    </div>-->
					<span style="font-size:16px;color:green">
					说明 :此处请手动选择，确认后将会更换所属部门</span><br><br>
					<div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">归属到的上级部门</label>
                        <div class="col-sm-8 ">
                            <select class="form-control" name="no">
                                <option value="0" selected="selected">顶级部门</option>
                                <?php foreach ($department as $item) {?>
                                    <option value="<?php echo $item->id?>" selected="selected"><?php echo $item->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">要调整的部门</label>
                        <div class="col-sm-8 ">
                            <select class="form-control" name="nonow">
                                <option value="0" selected="selected">顶级部门</option>
                                <?php foreach ($department as $item) {?>
                                    <option value="<?php echo $item->id?>" selected="selected"><?php echo $item->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                     <!--<div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">岗位描述</label>
                        <div class="col-sm-8 ">
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </div>-->
                     <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit"  id="department_id" >确认修改</button>
                            <button class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer hide">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#setUp').click(function(event) {
           var checkedInputs = $(".setUp input:checked");
           var temp = "";
           if(!checkedInputs){
               temp=-1;
           }
           for(var i = 0; i < checkedInputs.size(); i++) {
               temp += checkedInputs[i].value + ",";
           }
            var department_id= $("#department_id").val();
             $.post("<?=base_url();?>index.php/users/set_department_boss",{"department_id":department_id,"user_id":temp},function(){

             })

         });
         var e = "<i class='fa fa-times-circle'></i> ";
         
         var veirfyDepartment = $("#department_form").validate({
            rules: {
                name: {
                    required: !0
                },
                sort: {
                    required: !0
                }
            },
            messages: {
                name: {
                    required: e + "必填"
                },
                sort: {
                    required: e + "必填"
                }
            }
        })
        $("#department_id2").click(function(){
          
            if (veirfyDepartment.form()) {
                $.submitForm("#department_form");
                $('.modal-backdrop').remove();                
            };
            // $("#department_form").submit();
        }) ;
        var veirfycompany_form = $("#company_form").validate({
            rules: {
                companyName: {
                    required: !0
                },
                sort: {
                    required: !0
                }
            },
            messages: {
                companyName: {
                    required: e + "必填"
                },
                sort: {
                    required: e + "必填"
                }
            }
        })
         $("#company_id").click(function(){
            if (veirfycompany_form.form()) {
                $('#addPost').modal('hide');
            $.submitForm("#company_form");
             // $('.modal-backdrop').remove();    
            };
            // $("#company_form").submit();
        }) ;
      function funCheck () {
        // alert('message')
        var allCheck = $('table').find("th").find(':checkbox');
            allCheck.click(function(event) {
              var set = $(this).parents('table').find('td').find(':checkbox')
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
            var checks = $('#myTable').find('td').find(':checkbox');
            checks.click(function(event) {
              var leng = $(this).parents('table').find('td').find(':checkbox:checked').length;
              if(leng == checks.length){
                allCheck.prop('checked',true);
              }else{
                allCheck.prop("checked",false);
              }
            });
      }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/department/department_tree",
            success: function (data) {
               var e= eval("(" + data + ")");
                                 $("#treeview6").treeview({
                        color: "#428bca",
                        expandIcon: "glyphicon glyphicon-stop",
                        collapseIcon: "glyphicon glyphicon-unchecked",
                        nodeIcon: "glyphicon glyphicon-user",
                        showTags: !0,
                        data: e,
                        onNodeSelected: function(e, o) {
                            $("#department_id").val(o.id);
                            $.post("<?=base_url();?>index.php/users/users_department",{"de_id": o.id},function(data){
                                data=eval("("+data+")");
                                var str="<thead class='fb'>"+
                                    "<th><input type='checkbox'></th>"+
                                    "<th>员工姓名</th>"+
                                    "<th>员工电话</th>"+
                                    "</thead>";
                                $.each(data,function(i,item){
                                    console.log(item);
                                    var mobile="无";
                                    var name="无";
                                    if(item.mobile){
                                        mobile=item.mobile;
                                    }
                                    if(item.name){
                                        name=item.name;
                                    }
                                    if(item.state==1){
                                        str+="<tr class='setUp'>"+
                                            "<td><input type='checkbox' value='"+item.user_id+"' checked='checked'></td>"+
                                            "<td>"+name+"</td>"+
                                            "<td>"+mobile+"</td>"+
                                            "</tr>";
                                    }else{
                                        str+="<tr class='setUp'>"+
                                            "<td><input type='checkbox' value='"+item.user_id+"'></td>"+
                                            "<td>"+name+"</td>"+
                                            "<td>"+mobile+"</td>"+
                                            "</tr>";
                                    }
                                });
                                $("#myTable").html(str);
                                funCheck ();
                            })
                        }
                    })

            }
        },"json");
    });

</script>