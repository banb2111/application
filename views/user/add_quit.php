<div class="wrapper wrapper-content animated fadeInRight">     
        <div class="row">           
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="min-height:45PX;">
                        <h5>添加离职</h5>
                    </div>                    
                     <div class="ibox-content col-sm-12" style="padding-top:0;">
                        <form class="form-horizontal m-t" id="addQuit" method="post" action="">
                             <div class="col-sm-12 col-md-8 col-lg-6">  
                              <div class="form-group">
                                     <label class="col-sm-2 control-label">离职人</label>
                                     <div class="col-sm-9 col-lg-9 col-md-9">
                                        <input class="form-control" name="uname" id="inputSuccess4"required=""required="true" data-toggle="modal" data-target="#quitMan" aria-describedby="inputSuccess4Status" type="text">
                                        <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                        <span id="inputSuccess4Status" class="sr-only">(success)</span>
                                     </div>
                                     <input type="hidden" id="user_id">
                                     <div class="col-sm-1 errorStar">*</div>
                                 </div>                                
                                 <div class="form-group group hide quitInfo">
                                     <label class="col-sm-2 control-label">离职人信息</label>
                                     <div class="col-sm-9">
                                         <p>姓名:<span class="fb uname"></span></p>
                                         <p>账号:<span class="fb ename"></span></p>
                                         <p>部门:<span class="fb dname"></span></p>
                                     </div>
                                 </div>      

                               <div class="form-group">
                                     <label class="col-sm-2 control-label">交接人</label>
                                     <div class="col-sm-9 col-lg-9 col-md-9">
                                        <input class="form-control" name="fname" required=""required="true" id="inputSuccess" data-toggle="modal" data-target="#transferMan" aria-describedby="inputSuccessStatus" type="text">
                                        <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                        <span id="inputSuccessStatus" class="sr-only">(success)</span>
                                     </div>
                                     <div class="col-sm-1 errorStar">*</div>
                                 </div> 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">账号处理方式</label>
                                    <div class="col-sm-9">
                                        <div class="radio">
                                          <label>
                                            <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
                                            禁用账号
                                          </label>
                                        </div>
                                    </div>
                                </div>                                
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">离职时间</label>
                                    <div class="col-sm-9">
                                      <input id="next_time" name="next_time" class="layer-date form-control w" required=""required="true">
                                      <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true" style="left:222px;"></span>
                                      <span id="inputSuccessStatus" class="sr-only">(success)</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">备注</label>
                                    <div class="col-sm-9">
                                        <textarea name="content" id="content" class="form-control" row="3"></textarea>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-2">
                                        <button class="btn btn-primary" id="next_quitMan" type="button">下一步</button>
                                        <button class="btn btn-default">取消</button>
                                    </div>
                                </div>

                                <input type="hidden" id="inputcontent">
                                <!-- 离职人 -->
                                <input type="hidden" id="user_id">
                                <!-- 交接人 -->
                                <input type="hidden" id="transfer_id">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 弹出框显示 查询离职人 -->
    <div class="modal inmodal fade" id="quitMan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-weight: normal;">离职人</h4>
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
                      <button type='button' class="btn btn-primary" id="quitManQuery">查询</button>
                    </form>
                    <table class="table mt10" id="quitManTable">
                    </table>
                     <span class="mes_pR pull-left">
                         <a onclick="up('#quitMan')" >上一页</a>
                         <a onclick="down('#quitMan')">下一页</a>
                     </span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="save_quitMan">确认</button>
                    <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 弹出框显示 查询交接人 -->
    <div class="modal inmodal fade" id="transferMan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-weight: normal;">交接人</h4>
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
                      <button type='button' class="btn btn-primary" id="transferManQuery">查询</button>
                    </form>
                    <table class="table mt10" id="transferManTable">
                    </table>
                     <span class="mes_pR pull-left">
                         <a onclick="up('#transferMan')" >上一页</a>
                         <a onclick="down('#transferMan')">下一页</a>
                     </span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="save_transferMan">确认</button>
                    <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
        <!-- 弹出框显示 查询交接人 -->
    
    <?php include "tan_user.php";?>
    <?php include "next_tan.php";?>
    <!-- 初始化时间 -->
    <script type="text/javascript">
        $(function(){
            // 获取当前时间
            function getNowFormatDate() {
                var date = new Date();
                var seperator1 = "-";
                var seperator2 = ":";
                var month = date.getMonth() + 1;
                var strDate = date.getDate();
                if (month >= 1 && month <= 9) {
                    month = "0" + month;
                }
                if (strDate >= 0 && strDate <= 9) {
                    strDate = "0" + strDate;
                }
                var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                    + " " + date.getHours() + seperator2 + date.getMinutes();
                return currentdate;
            }
            $('#next_time').click(function(event) {
                laydate({
                    elem: "#next_time",
                    event: "",
                    format: "YYYY/MM/DD",                    
                    festival: true,
                    min: laydate.now(),
                    max: "2099-06-16 23:59:59",
                    start: getNowFormatDate()
                });
            });
        })
    </script>
    <!-- 逻辑调用 -->
    <script type="text/javascript">
        $(function(){
            // 验证
            var e = "<i class='fa fa-times-circle'></i>";
            var verify = $("#addQuit").validate({
                rules: {
                    uname: {
                        required: !0
                    },
                    fname: {
                        required: !0
                    },
                    next_time: {
                        required: !0
                    }
                },
                messages: {
                    ename: {
                        required: e + "必填"
                    },
                    fname: {
                        required: e + "必填"
                    },
                    next_time: {
                        required: e + "必填"
                    }
                }
            })
            $("#next_quitMan").click(function(){
                 if(verify.form()) {                
                    var inputSuccess4 = $('#inputSuccess4').val();
                    var inputSuccess = $('#inputSuccess').val();
                    var next_time = $('#next_time').val();
                    var content = $('#content').val();
                    $('.content').html(content);
                    $('.next').html(next_time);
                    $('.inputSuccess').html(inputSuccess);
                    $('.inputSuccess4').html(inputSuccess4);
                    $('.inputcontent').html($('#inputcontent').val());
                    $('#next_quitMan_info').modal('show');
                }
            })
            // 查询离职人
            $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1}, function(data) {
                var str;
                str='<tr>'+
                    '<th></th>'+
                    '<th>用户名</th>'+
                    '<th>用户姓名</th>'+
                    '<th>部门</th>'+
                    ' </tr>';
                $.each(data,function(i,item){
                    str+='<tr>'+
                        '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                        '<td>'+item.usname+'</td>'+
                        '<td>'+item.ename+'</td>'+
                        '<td>'+item.dname+'</td>'+
                        '</tr>';
                });
                $("#quitManTable").html(str);
            },"json");
            // 查询部门联系人
            $('#quitManQuery').click(function() {
                var department_id = $('#quitMan').find('select').val();
                $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1,"department_id":department_id} ,function(data){
                    var str;
                    str='<tr>'+
                        '<th></th>'+
                        '<th>用户名</th>'+
                        '<th>用户姓名</th>'+
                        '<th>部门</th>'+
                        ' </tr>';
                    $.each(data,function(i,item){
                        str+='<tr>'+
                            '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                            '<td>'+item.usname+'</td>'+
                            '<td>'+item.ename+'</td>'+
                            '<td>'+item.dname+'</td>'+
                            '</tr>';
                    });
                    $("#quitManTable").html(str);
                },"json");
            });
            // 选中离职人
            $('#save_quitMan').click(function(event) {
                var user_id=$('input[name="user_id"]:checked').val();
                var uname = $('input[name="user_id"]:checked').parent().next().html();
                var ename = $('input[name="user_id"]:checked').parent().next().next().html();
                var dname = $('input[name="user_id"]:checked').parent().next().next().next().html();
                $('#user_id').val(user_id);
                $('.uname').html(uname);    
                $('.ename').html(ename);
                $('.dname').html(dname);    
                $('#inputSuccess4').val(ename);    
                $('.quitInfo').removeClass('hide');                
                if (user_id) {
                    $.post('<?=base_url(); ?>index.php/quit/quit_user_info', {"id": user_id}, function(data) {
                        $('#inputcontent').val(data);
                        $('#quitMan').modal('hide');
                    });
                }else{
                    showInfo('请勾选离职人',"error");
                }
            });
             // 查询交接人
            $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1}, function(data) {
                var str;
                str='<tr>'+
                    '<th></th>'+
                    '<th>用户名</th>'+
                    '<th>用户姓名</th>'+
                    '<th>部门</th>'+
                    ' </tr>';
                $.each(data,function(i,item){
                    str+='<tr>'+
                        '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                        '<td>'+item.usname+'</td>'+
                        '<td>'+item.ename+'</td>'+
                        '<td>'+item.dname+'</td>'+
                        '</tr>';
                });
                $("#transferManTable").html(str);
            },"json");
            // 交接人回填
            $('#save_transferMan').click(function(event) {
                var transfer_id = $('input[name="user_id"]:checked').val();
                $('#transfer_id').val(transfer_id);
                var ename = $('input[name="user_id"]:checked').parent().next().next().html();
                $('#inputSuccess').val(ename);
                $('#transferMan').modal('hide');
            });
            // 下一步获取确认
            /*$('#next_quitMan').click(function(event) {
                var inputSuccess4 = $('#inputSuccess4').val();
                var inputSuccess = $('#inputSuccess').val();
                var next_time = $('#next_time').val();
                var content = $('#content').val();
                $('.content').html(content);
                $('.next').html(next_time);
                $('.inputSuccess').html(inputSuccess);
                $('.inputSuccess4').html(inputSuccess4);
                $('.inputcontent').html($('#inputcontent').val());
            });*/
            // 确认离职
            $('#confirm_leave').click(function(event) {
                /*
                    $quit_user= $_POST["quit_user"];//离职人
                    $quit_time=$_POST["quit_time"];//离职时间
                    $transfer_user=$_POST["transfer_user"];//交接人
                    $content= $_POST["content"];//备注
                */
                var quit_user = $('#user_id').val();
                var quit_time = $('#next_time').val();
                var transfer_user = $('#transfer_id').val();
                var content = $('#content').val();
                $.post('<?= base_url(); ?>index.php/quit/add_quit', {'quit_user': quit_user,'quit_time':quit_time,'transfer_user':transfer_user,'content':content}, function(data) {
                    if (data) {
                        $('#next_quitMan_info').modal('hide');
                        showInfo("操作成功","success");
                    }else{
                        $('#next_quitMan_info').modal('hide');
                        showInfo("推广客户和签约客户必须手动处理","error");                        
                    }   
                });
            });
        })

    </script>