
<div class="wrapper wrapper-content animated fadeInRight">


</div>
 <div class="ml3" style="width:800px;">
            <div class="row">
                <div class="col-sm-12">
                       <div class="col-sm-1">
                           <img src="<?php echo $base_url; ?>/static/img/avatar_company.png" alt="" class="cusTop">
                       </div>
                    <!--签约状态-->
                    <input type="hidden" id="sign_status" value="<?=$customer[0]['sign_status']?>">
                       <div class="col-sm-9">
                           <h1 class="title hide">
                               <span class="callIPone cp hide">打电话</span>
                               <span class="callMail cp hide">发邮件</span>
                           </h1>
                           <h1 class="title">
                               <span id="state"></span>
                               <span id="cus_name"><?=$customer[0]['name'];  ?></span>
                               <span class="callMail cp" id="in_customer_text" data-toggle="modal" data-target="#gonghai">转入公海</span>
                               <span class="callIPone cp sign" title="将客户设置为签约客户" data-toggle="modal" data-target="#sign" >设置签约</span>
                           </h1>
                           <div class="tagShow">
                               <div id="cus_tag" style="float: left;"></div>
                                <a href="#" class="editTag" style="float: left;"><i class="fa fa-pencil"></i> 修改标签</a>
                           </div>
                           <div class="updateTagAll hide">
                                <div class="tagUpdate">
                                    <?php foreach($label as $k=>$v){?>
                                   <span>
                                       <i class="fa fa-fw fa-square-o tag_up"></i><?php echo $v->tag; ?>
                                       <input type="hidden" class="tag_up"  value="<?=$v->id;?>"/>
                                   </span>
                                    <?php }?>
                               </div>
                               <div>
                                   <button class="btn btn-primary btn-xs" id="up_custag">确定</button>
                                   <button class="btn btn-default btn-xs">取消</button>

                               </div>
                           </div>
                       </div>
                       <div class="col-sm-2">
                         <div class="back">
                                <a  title="返回页面" class="pull-right" id="back_view"><i class="fa fa-reply f12"></i></a>
                            </div>
                           <div class="edit mb">
                                <a  title="编辑客户资料" class="pull-right cus_up"><i class="fa fa-pencil f12"></i></a>
                            </div>
                           
                       </div>
                   </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                
                <div class="mt30">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">跟进记录</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">联系人</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="">
                                        <div class="">
                                            <div class="form-horizontal m-t">
                                                <input type="hidden" id="custo_id" value="<?=$customer[0]['id']?>"/>
                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 hide control-label">跟进方式</label>
                                                    <div class="col-sm-12 ">
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="1" selected="selected">电话</option>
                                                            <option value="2">邮件</option>
                                                            <option value="3">QQ</option>
                                                            <option value="4">微信</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="content" class="col-sm-3 control-label hide">跟进内容</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="content" id="content" rows="3"required="" aria-required="true" placeholder="跟进内容"></textarea>
                                                    </div>

                                                </div>
                                               <div class="form-group" style="">
                                                    <div class="col-lg-2">
                                                        <span class="bell cp">
                                                            <i class="fa fa-bell-o f14"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2 col-sm-offset-8">
                                                        <button class="btn btn-primary add_follow"  id="">提交</button>
                                                    </div> 
                                                 </div>  
                                                 <div class="form-group nextFollow pr hide" style="margin-left:0;margin-right:0;">
                                                    <div class="icon"><div class="iconbg"></div></div>
                                                        <label for="next_time" class="col-sm-4 control-label" style="padding-top:2px;">下次跟进时间</label>
                                                        <div class="col-sm-8">
                                                            <input id="next_time" name="next_time" class="layer-date">
                                                        </div>
                                                    </div> 
                                                     
                                                <div class="form-group hide">                                             
                                                    <div class="col-sm-2 col-sm-offset-10">
                                                        <button class="btn btn-primary add_follow"  id="">提交</button>
                                                    </div>
                                                </div>
                                               
                                                
                                            </div>
                                        </div>
                                        <div id="follow" class="pb40">
                                            <!--跟进记录-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2"class="tab-pane" >
                                <button class="btn btn-primary mt10 add_linkman">添加客户联系人</button>
                                <table class="table mt10 table-hover" id="tab-2_linkman">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-sm-4" id="customer_info">

            </div>
            </div>
           
        </div>
<!-- 签约客户确定 -->
<div class="modal inmodal fade" id="sign" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title sign_text" style="font-size:18px;font-weight: normal;"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-9">
                        <button class="btn btn-primary" id="determine_sign"  data-dismiss="modal" >确认</button>
                        <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--公海-->
<div class="modal inmodal fade" id="gonghai" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title in_text " style="font-size:18px;font-weight: normal;"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-6">
                        <button class="btn btn-primary" id="in_public_customer"  data-dismiss="modal">确认</button>
                        <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#myTable").tableCheck("success");
</script>


<!-- 关闭侧边栏时 取消表格的 active -->
<script type="text/javascript">
    $('#doc-oc-demo3').on('open.offcanvas.amui', function() {
        // console.log(id + ' 打开了。');
    }).on('close.offcanvas.amui', function() {
        $('table').find('.success').find('input[type="checkbox"]').removeAttr('checked');
        // alert(val);
        $('table').find('.success').removeClass('success');
    });
</script>

<script type="text/javascript">
    $(function (){
        $("#excel_in_id").click(function(){
            $("#excel_in_form").submit();
        }) ;
        $("#back_view").click(function(){
           var _url="<?=base_url();?>index.php/customer/index";
           $.loadPage(_url);
        });
    });
</script>

<script type="text/javascript">
    $(function (){
        $("#excel_out_id").click(function(){
            $("#excel_out_form").submit();
        }) ;
    });
</script>
<script type="text/javascript">
    $(function(){
        $('#inputEmail3').focus();
        $(".add_linkman").click(function(){
            var customer_id=$("#custo_id").val();
            var _url="<?php echo  base_url();?>index.php/customer/linkman/"+customer_id;
            $.loadPage(_url);
        });
        $(".add_follow").click(function(){
            var type=$("#type").val();
            var content=$("#content").val();
            var next_time=$("#next_time").val();
            var custo_id=$("#custo_id").val();
            if(content){
                $.post("<?php echo base_url(); ?>index.php/follow/add_follow_customer",
                    {"customer_id": custo_id, "type": type, "content": content, "next_time": next_time},
                    function (data) {
                        if (data == 'succ') {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/follow/follow_customer",
                                data: "customer_id=" + custo_id,
                                success: function (data) {
                                    $("#follow").html(data);
                                    $("#content").val("");
                                    $("#next_time").val("");
                                    $("#type").val("1");
                                }
                            });
                        } else {
                            alert('跟进添加存在错误！');
                        }
                    });
            }else{
                alert("请填写内容!");
            }
        });
        $(".cus_up").click(function(){
            var customer_id=$("#custo_id").val();
            var _url="<?php echo  base_url();?>index.php/customer/customer_update/"+customer_id;
            $.loadPage(_url)
        });
        //签约状态
      var  sign_status=$("#sign_status").val();
        if(sign_status==1){
            $("#in_customer_text").addClass("hide");
            $(".sign").addClass("hide");
        }else{
            $("#in_customer_text").removeClass("hide");
            $(".sign").removeClass("hide");
        }
            var cous=$("#custo_id").val();
                cus_status(cous);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/follow/follow_customer",
                    data: "customer_id="+cous,
                    success: function(data){
                         $("#follow").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/ajax_linkman",
                    data: "customer_id="+cous,
                    success: function(data){
                        $("#tab-2_linkman").html(data);
                        //跳转修改联系人页面
                        $('#tab-2 .link').on('click', function(){
                            var href = $(this).attr('data-href');
                            $.ajax({
                                type: "POST",
                                url: href,
                                success: function(data){
                                    $("#show").html(data);
                                }});
                        });
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/customer_info",
                    data: "customer_id="+cous,
                    success: function(data){
                        $("#customer_info").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/cus_tag",
                    data: "customer_id="+cous,
                    success: function(data){
                        $("#cus_tag").html(data);
                    }
                });
        // 点击跟进按钮显示  下次跟进时间
        $('.bell').click(function(event) {
            $('.nextFollow').removeClass('hide');
            $('.col-sm-offset-8').addClass('hide');
            $('.col-sm-offset-8').find('button').removeClass('add_follow');
            $('.col-sm-offset-10').parent().removeClass('hide');
        });
    });
</script>

<script type="text/javascript">
    $(function(){
        $('.follow_add').click(function(event) {
            $('.page-tabs-content').appendChild('<a href="javascript:;" class="J_menuTab" data-id="users/menulist/user_admin">用户管理 <i class="fa fa-times-circle"></i></a>')
        });
        function initStatus() {
            var status = "<?=$status; ?>";
            var statusArrays = status.split(",");
            for(var i = 0; i < statusArrays.length; i++) {
                if(statusArrays[i] == "") {
                    continue;
                }
                $('.cusMt input[value="' +statusArrays[i] + '"]').attr("checked", "checked");
            }
            var tags="<?=$tag?>";
            var tagsArrays = tags.split(",");
            for(var i = 0; i < tagsArrays.length; i++) {
                if(tagsArrays[i] == "") {
                    continue;
                }
                $('input[value="'+ tagsArrays[i] +'"]').prev().attr("class","fa fa-fw fa-check-square-o");
            }
        }
        initStatus();
        // 客户表右侧查询条件
//        var arr = [];
        $('.cusMt input').click(function(event) {
            var checkedInputs = $(".cusMt input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            location.href="<?php echo base_url(); ?>index.php/customer/menulist/cusMan?&status="+temp+"&tag=<?php echo $_GET['tag']; ?>";
        });
        // 标签分类的查询

        $('.bags li').click(function(event) {
            var i = $(this).find('i');
             if (i.hasClass('fa-square-o')) {
                var tag_id = $(this).find('.tag_id').val();
                i.addClass('fa-check-square-o').removeClass('fa-square-o');
            }else{
                i.addClass('fa-square-o').removeClass('fa-check-square-o');
            }
            var temp = "";
            var checkI = $(".bags").find('.fa-check-square-o');
            for(var i = 0; i < checkI.size(); i++) {
                temp += $(checkI[i]).next().val() + ",";
            }
            noCustomer ()
            location.href="<?php echo base_url(); ?>index.php/customer/menulist/cusMan?&tag="+temp+"&status=<?php echo $_GET['status']; ?>";
        });
        var  tag_val=$("#tag_val").val();
        $('.bags ul li').each(function(index, el) {
            var tag_id = $(this).find('.tag_id').val();
            if (tag_val == tag_id) {
                $(this).find('.tag_id').prev().find('i').removeClass('fa-square-o').addClass('fa-check-square-o');
            };
        });
        //修改客户标签
        $("#up_custag").click(function(){
            var cous=$("#custo_id").val();
            var temp = "";
            var checkI = $(".tagUpdate").find('.fa-check-square-o');
            for(var i = 0; i < checkI.size(); i++) {
                temp += $(checkI[i]).next().val() + ",";
            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/customer/insert_cusTags",
                data: "tags="+temp+"&id="+cous,
                success: function(data){
                  if(data){
                      $.ajax({
                          type: "POST",
                          url: "<?php echo base_url(); ?>index.php/customer/cus_tag",
                          data: "customer_id="+cous,
                          success: function(data){
                              $("#cus_tag").html(data);
                          }
                      });
                  }
                }
            });
        });
        // 提示没有客户的的位置

        // 修改标签的状态
        $('.tagUpdate span').click(function(event) {

            if ($(this).find('i').hasClass('fa-square-o')) {
                $(this).find('i').removeClass('fa-square-o').addClass('fa-check-square-o');
            }else{
                $(this).find('i').removeClass('fa-check-square-o').addClass('fa-square-o');
            }
        });
        // 点击修改
        $('.editTag').click(function(event) {
             var cous=$("#custo_id").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/customer/cus_tag_id",
                data: "id="+cous,
                success: function(data){
                    console.log(data);
                    var data=eval('('+data+')');
                    for(var x in data) {
                        if(data[x].tag_id == "") {
                            continue;
                        }
                        $('.tagUpdate').find('input[value="'+ data[x].tag_id +'"]').prev().attr("class","fa fa-fw fa-check-square-o ");
                    }
                }
            },'json');
            $(this).parent().addClass('hide');
            $('.updateTagAll').removeClass('hide');
        });
         $('.updateTagAll button.btn-primary').click(function(event) {
            $('.tagShow').removeClass('hide');
            $('.updateTagAll').addClass('hide');
        });
          $('.updateTagAll button.btn-default').click(function(event) {
            $('.tagShow').removeClass('hide');
            $('.updateTagAll').addClass('hide');
        });
        //我的客户放入公海
        function noCustomer () {
            var w = $('.noCustomer').width();
            var pw = $(document).width();
            var pwb = pw/2;
            var wb = w/2;
            var weizhi = pwb - w;
            $('.noCustomer').css('left', weizhi+'px');
        }
        noCustomer ()
        $(window).resize(function(event) {
            noCustomer ();
        });
    })
    
    function status_change(obj){
        var id=$("#custo_id").val();
        var status=obj.value;
        $.ajax({
            type: "POST",
            url: "<?=base_url();  ?>index.php/customer/update_status?",
            data: "id="+id+"&status1="+status,
            success: function(data){
                if(data){
                    cus_status(id);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/customer/customer_info",
                        data: "customer_id="+id,
                        success: function(data){
                            $("#customer_info").html(data);
                        }
                    });
                }
            }
        });
    }
    function cus_status(id){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/customer/status_cus",
            data: "customer_id="+id,
            success: function(data){
                if(data==1){
                    $("#state").html(' <span class="category f12" style="background-color: #00a651;">A类客户</span>');
                }else if(data==2){
                    $("#state").html(' <span class="category f12" style="background-color: #00B2E2;">B类客户</span>');
                }else if(data==3){
                    $("#state").html(' <span class="category f12" style="background-color: fuchsia;">C类客户</span>');
                }else if(data==4){
                    $("#state").html(' <span class="category f12" style="background-color: #c1d7e9;">D类客户</span>');
                }else if(data==-1){
                    $("#state").html('');
                }

            }
        });
    }
</script>
<!-- 时间插件 -->
<script type="text/javascript">

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
        format: "YYYY/MM/DD hh:mm",
        istime: true,
        festival: true,
        min: laydate.now(),
        max: "2099-06-16 23:59:59",
        start: getNowFormatDate()
    });
 });

    
</script>
<script>
    $(function(){
        $("#public_class").click(function(){
            var checkedInputs = $(".tdClass input:checked");
            var temp="";
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            if(temp){
                location.href="<?php echo base_url(); ?>index.php/customer/in_public_customer?&cus_id="+temp;
            }
        });
        //转入公海
        $("#in_public_customer").click(function(){
            var id=$("#custo_id").val();
            location.href="<?php echo base_url(); ?>index.php/customer/in_public_customer?&cus_id="+id;
        });
        $("#in_customer_text").click(function(){
            var cname=$("#cus_name").text();
            $(".in_text").html('您确定将'+cname+'客户转入到公海中吗？');
        });
        // 点击签约
        $('.sign').click(function(event) {
            var id=$("#custo_id").val();
            var cname=$("#cus_name").text();
            $(".sign_text").text("您确定要把"+cname+"客户设置成签约客户吗？");
            $("#determine_sign").click(function(){
                $.post('<?php echo base_url();?>index.php/customer/set_sign',{"cus_id":id},function(data){

                });
            });
        });
    });
</script>

