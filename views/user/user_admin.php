<div class="mb10 mt10 row form-inline" id="exampleTableEventsToolbar" role="group">                                
                                <div class="col-sm-4 col-md-4 col-lg-3">
                                      <div class="form-group">
                                        <label for="username">用户姓名</label>
                                        <input type="text" class="form-control" id="username" value="<?=$name;?>">
                                      </div>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                    <label for="sousuo_type" >部门</label>
                                    <select name="" id="sousuo_type" class="form-control">
                                        <option value="">请选择</option>
                                        <?php foreach ($department_list as $key => $value): ?>
                                            <option <?php if($department_id==$value['id']){?> selected="selected" <?php } ?> value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                    <label for="sousuo_type" >在职离职</label>
                                    <select name="" id="sousuo_type2" class="form-control">
                                        <option value="">请选择</option>
                                        
                                            <option value="1">在职</option>
											<option value="0">离职</option>
                                    </select>
                                </div>                                
                                <div class="col-lg-3">
                                    <button class="btn btn-primary" id="quit_search">搜索</button>
                                </div>
                            </div>
<script type="text/javascript">
    // 搜索
    $('#quit_search').click(function(event) {
        var name = $('#username').val();
        var department_id = $('#sousuo_type').val();
		var zhi	= $('#sousuo_type2').val();
        var _url="<?php echo base_url();?>index.php/users/menulist/user_admin?&name="+name+"&department_id="+department_id+"&zhi="+zhi;
        $.loadPage(_url);

    });
     // 下一页跳转
        $('.pagination').on('click', 'a', function(event) {
            var href = $(this).attr('data-href');
            $.ajax({
                type: "POST",
                url: href,
                success: function(data){
                    $("#show").html(data);
                }
            });

            /* Act on the event */
        });
</script>
    <div class="wrapper wrapper-content animated fadeInRight">
   

        
        <!-- End Panel Style -->



        <!-- Panel Other -->
        <div class="ibox float-e-margins">
           
            <div class="ibox-content">
                <div class="row row-lg">
            
                    <div class="col-sm-12">
                        <!-- Example Events -->
                        <div class="example-wrap">
                            
                            <div class="example">
                                <div class="alert alert-success hide" id="examplebtTableEventsResult" role="alert">
                                    事件结果
                                </div>
                                <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                    <h4 class="example-title">用户管理<span style="font-size:16px;color:green">
					（说明 :此系统没有编辑用户功能，若要更改员工所属部门，请联系技术手动更改）</span></h4>
													
                                </div>
                                <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>用户名</th>
                                            <th>员工姓名</th>
                                            <th>添加时间</th>
                                            <th>所属部门</th>
                                            <th>所属公司</th>
                                            <th>用户类型</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                        <?php foreach($users as $k=>$v){ ?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?php echo $v->username; ?></td>
                                            <td><?php echo $v->name; ?></td>
                                            <td><?php echo date('y-m-d H:i:s', $v->time); ?></td>
                                            <td><?php echo $v->dname; ?></td>
                                            <td><?php echo $v->cname; ?></td>
                                            <td><?php if($v->user_type==1){
                                                    echo "系统管理员";
                                                }else if($v->user_type==2){
                                                    echo "公司";
                                                }else if($v->user_type==3){
                                                    echo "部门";
                                                }
                                                else if($v->user_type==4){
                                                    echo "员工";
                                                }else if($v->user_type==5){
                                                    echo "售前客服";
                                                }?></td>
                                            <td>
                                    <!--            <?php /*if($v->status==1){ */?>
                                                    <button type="button" class="btn btn-primary btn-xs myJob">在职</button><input type="hidden"  value="<?/*=$v->uid*/?>"><input type="hidden"  value="<?/*=$v->name*/?>">
                                                <?php /*} else if($v->status==0){ */?>
                                                    <button type="button" class="btn btn-default btn-xs">离职</button>
                                                --><?php /*} */?>
                                                <?php if($v->status==1){ ?>
                                                    <a type="button" class="btn btn-success btn-xs ml5 set_power"  >设置权限</a>
                                                <?php }else{ ?>
                                                    <a type="button" class="btn btn-success btn-xs ml5 set_power hide"  >设置权限</a>
                                                <?php } ?>
                                                <input type="hidden"  value="<?=$v->uid?>">
                                                <?php if($v->status==1){ ?>
                                                    <a type="button" class="btn btn-success btn-xs ml5 reset_pwd"  >重置密码</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </table>
                                <div class="page">
                                    <?php echo $pages;?>
                                </div>
                            </div>
                        </div>
                        <!-- End Example Events -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Other -->
    </div>

    <script src="<?php echo base_url(); ?>/static/js/tableCheckbox.js"></script>



<script>
  $("#myTable").tableCheck("success");
</script> 

<!-- 动态授权 弹出框 -->
 <div class="modal inmodal fade" id="authorization" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title ">授权</h4>
                <small class="font-bold hide">这里可以显示副标题。</small>
            </div>
            <div class="modal-body" style="padding-left:20px;">
                <table class="table" id="power_list">
                    <?php foreach($power as $k=>$v){ ?>
                        <thead><th><label><input type='checkbox' value="<?=$v['id']?>"><?=$v['name']?></label></th></thead>
                    <?php } ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"  id="grant">确认</button>
            </div>
        </div>
    </div>
</div>
<!-- 离职 弹出框 -->
 <div class="modal inmodal fade" id="leave" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title ">员工离职</h4>
                <small class="font-bold hide">这里可以显示副标题。</small>
            </div>
            <div class="modal-body clearfix" style="padding-left:20px;">
                <form class="form-horizontal m-t" id="add" method="post"  action="">
                     <div class="col-sm-12 col-md-8 col-lg-12">                               
                         <div class="form-group group">
                             <label class="col-sm-2 control-label">离职人</label>
                             <div class="col-sm-9">
                                 <input id="name" name="name" class="form-control leave" type="text" required="" aria-required="true">
                             </div>
                             <div class="col-sm-1 errorStar">*</div>
                         </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">联系人</label>
                            <div class="col-sm-9">
                                <input id="" name="linkman" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机</label>
                            <div class="col-sm-9">
                                <input id="" name="mobile" id="mobile" class="form-control mobile" type="text" >
                            </div>
                            <div class="col-sm-1 errorStar">*</div>
                        </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">职位</label>
                             <div class="col-sm-9">
                                 <select name="position_id" id="" class="form-control">
                                     <?php foreach($position as $k=>$v){?>
                                     <option <?php if($v->is_default==1){?> selected="selected" <?php }?> value="<?php echo $v->id; ?>" ><?php echo $v->name; ?></option>
                                     <?php }?>
                                 </select>
                             </div>
                         </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">法人</label>
                            <div class="col-sm-9">
                                <input id="" name="corporate_name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注</label>
                            <div class="col-sm-9">
                                <textarea name="content" id=""  class="form-control" row="3"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"  id="grant">确认</button>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" id="user_id"/>
<script type="text/javascript">
    $(function(){
        // $('.myJob').click(function(event) {
        //     var user_id=$(this).next().val();
        //     var ename=$(this).next().next().val();
        //     var user_status= confirm('您确定要把员工'+ename+'修改为离职状态吗？');
        //     if(user_status){
        //         $.post('<?=base_url();?>index.php/users/ajax_user_status',{"user_id":user_id},function(data){
        //             if(data){
        //                 $('input[value="'+ user_id+'"]').prev().removeClass("btn-primary");
        //                 $('input[value="'+ user_id+'"]').prev().addClass("btn-default");
        //                 $('input[value="'+ user_id+'"]').prev().html('离职');
        //                 $('input[value="'+ user_id+'"]').next().next().addClass("hide");
        //             }
        //         });
        //     }
        // });
        $('#grant').click(function(event) {
            var checkedInputs = $("#power_list input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            var user_id=$("#user_id").val();
            $.post("<?=base_url();?>index.php/power/add_user_power",{"power_id":temp,"user_id":user_id},function(data){
            })
        });
        // 设置权限
        $(".set_power").click(function(){
            var user_id=$(this).next().val();
            $("#user_id").val(user_id);
            $.post("<?=base_url();?>index.php/power",{"id":user_id},function(data){
                $("#power_list input[type='checkbox']").removeAttr("checked");
                $.each(data,function(i,item){
                    if (item.pid != "") {
                        $("#power_list").find('input[value="' + item.pid + '"]').prop("checked", "checked");
                    }
                });
                $('#authorization').modal('show');
            },"json");
        })
        // 重置密码
         $(".reset_pwd").click(function(){
            var user_id=$(this).prev().val();
            // $("#user_id").val(user_id);
            // alert(user_id);
            if(!confirm('是否重置该用户密码为 123456 ?')){
                return;
            }
            $.post("<?=base_url();?>index.php/power/resetpwd",{"user_id":user_id},function(data){
                var info = eval(data);
                if(info.s == 'ok'){
                    alert(info.msg);
                }else{
                    alert(info.msg);
                }
                // $("#power_list input[type='checkbox']").removeAttr("checked");
                // $.each(data,function(i,item){
                //     if (item.pid != "") {
                //         $("#power_list").find('input[value="' + item.pid + '"]').prop("checked", "checked");
                //     }
                // });
                // $('#authorization').modal('show');
            },"json");
        });
        // 下一页跳转
        $('.pagination').on('click', 'a', function(event) {
            var href = $(this).attr('data-href');
            $.ajax({
                type: "POST",
                url: href,
                success: function(data){
                    $("#show").html(data);
                }
            });

            /* Act on the event */
        });
        $('.leave').click(function(event) {
            $('#authorization').modal('show');
        });
    })

</script>