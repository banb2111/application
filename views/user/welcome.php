<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title clearfix">
                     <div class="control-group pull-right " style="width:240px;">
                      <div class="controls welcome">
                       <div class="input-prepend input-group">
                         <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" readonly="readonly" style="width: 200px" name="reservation" id="reservation" class="form-control" value="2016-7-14 - 2016-7-15" />
                       </div>
                      </div>
                    </div>
                    <div class="pull-right changeDate mt10">
                        <a id="yaday">昨日</a>
                        <a id="day">今天</a>
                        <a id="weekdays">最近七日</a>
                        <a id="ben_month">本月</a>
                    </div>
                     
                    <h5 class="pull-left">客户统计</h5>
                </div>
                    <div class="ibox-content" style="background: #edf2f6;">
                        <div class="auto clearfix" style="width:720px;">
                            <div class="statistics">
                                <a href="">
                                  <i class="fa fa-user fa-2x f30"></i>
                                  <div id="notContactedNum"><?=$not_contact_count; ?></div>
                                  <p>未联系客户数量</p>
                                </a>
                            </div>
                            <div class="statistics">
                                <a href="">
                                  <i class="fa fa-bell fa-2x f30"></i>
                                  <div id="notContactedNum"><?=$contact_count; ?></div>
                                  <p>已联系客户数量</p>
                                </a>
                            </div>
                            <div class="statistics">
                                <a href="">
                                  <i class="fa fa-yen fa-2x f30"></i>
                                  <div id="notContactedNum"><?=$to_becontact_count; ?></div>
                                  <p>需要联系客户数量</p>
                                </a>
                            </div>
                            <div class="statistics">
                                <a href="">
                                  <i class="fa fa-check fa-2x f30"></i>
                                  <div id="notContactedNum"><?=$sign_customer_count; ?></div>
                                  <p>签约客户数量</p>
                                </a>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div> 
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <div class="control-group pull-right hide">
                    <div class="controls">
                     <div class="input-prepend input-group">
                       <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" readonly="readonly" style="width: 200px" name="reservation" id="reservation" class="form-control" value="2016-7-14 - 2016-7-15" /> 
                     </div>
                    </div>
                  </div>
                    <h5>最近七日新增客户数</h5>
                </div>
                <div class="ibox-content clearfix">
                   <div id="container" style="min-width:400px;height:400px"></div>
                </div>
            </div>
        </div> 
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <div class="control-group pull-right hide">
                    <div class="controls">
                     <div class="input-prepend input-group">
                       <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" readonly="readonly" style="width: 200px" name="reservation" id="reservation" class="form-control" value="2016-7-14 - 2016-7-15" /> 
                     </div>
                    </div>
                  </div>
                    <h5>最近七日跟进客户数</h5>
                </div>
                <div class="ibox-content clearfix">
                   <div id="container1" style="min-width:400px;height:400px"></div>
                </div>
            </div>
        </div>     
         <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <div class="control-group pull-right hide">
                    <div class="controls">
                     <div class="input-prepend input-group">
                       <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" readonly="readonly" style="width: 200px" name="reservation" id="reservation" class="form-control" value="2016-7-14 - 2016-7-15" /> 
                     </div>
                    </div>
                  </div>
                    <h5>我的客户组成</h5>
                </div>
                <div class="ibox-content clearfix">
                   <div id="container3" style="min-width:400px;height:400px"></div>
                </div>
            </div>
        </div>           
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"></span>
                    <h5>新增客户数统计</h5>
                </div>
                <div class="ibox-content" >
                     <div class="tabs-container">
                         <ul class="nav nav-tabs">
                             <li class="active"><a data-toggle="tab" id="yday" href="#tab-1" aria-expanded="true">昨日</a>
                             </li>
                             <li class=""><a data-toggle="tab" href="#tab-2" id="weeks" aria-expanded="false">最近七日</a>
                             </li>
                              <li class=""><a data-toggle="tab" href="#tab-3" id="month" aria-expanded="false">本月</a>
                             </li>
                         </ul>
                         <div class="tab-content"style="height:400px;overflow-y:auto;">
                             <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                     <table class="table mt10" id="cus_add">
                                     </table>
                                 </div>
                             </div>
                     </div>
                     </div>
                </div>
            </div>
        </div>

        <!-- 来源渠道部分统计 -->
        <div class="col-sm-12" style="<?php if($_SESSION['user_id']->type != 5) echo 'display:none;' ?>">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"></span>
                    <h5 style="float:left">渠道推广客户数据统计</h5>
                    <input type="hidden" value="0" name="queryuid" id="queryuid">
                    <input type="hidden" value="0" name="querydepid" id="querydepid">
                    <div style="margin-left:20px;float:left">
                      <span>查询类型：以个人&nbsp;/&nbsp;部门&nbsp;&nbsp;&nbsp;</span> 
                      <select name="" id="channel_department">
                      <option value="-1">--请选择--</option>
                      <option value="0" data-toggle="modal" data-target="#appointSale" id="onlyuser">个人</option>
                      <?php foreach($department_list as $dval){ ?>
                        <option value="<?=$dval['id']?>"><?=$dval['name']?></option>
                      <?php } ?>
                      </select>

                    </div>

                </div>
                <div class="ibox-content" >
                     <div class="tabs-container">
                         <ul class="nav nav-tabs">
                             <li class="active"><a data-toggle="tab" id="yday_channel" href="#tab-1" aria-expanded="true">昨日</a>
                             </li>
                             <li class=""><a data-toggle="tab" href="#tab-2" id="weeks_channel" aria-expanded="false">最近七日</a>
                             </li>
                              <li class=""><a data-toggle="tab" href="#tab-3" id="month_channel" aria-expanded="false">本月</a>
                             </li>
                         </ul>
                         <div class="tab-content"style="height:1000px;overflow-y:auto;">
                             <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                     <table class="table mt10" id="chanel_data">
                                     </table>
                                 </div>
                             </div>
                     </div>
                     </div>
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
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">查询个人推广渠道客户数据</h4>
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




				             <script type="text/javascript">
 function getNowFormat1() {
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
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate;
    return currentdate;
}
var getNow1 = getNowFormat1();
var getNow2 = getNowFormat2();
var get = getNow1 +" - "+getNow2;
$('#reservation').val(get);
function getNowFormat2() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    strDate = strDate +6 ;
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate;
    return currentdate;
}
               $(document).ready(function() {
                   $(".daterangepicker").remove();
                  $('#reservation').daterangepicker(null,function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                  });

                   // 获取时间段
                   $('.applyBtn').on('click', function(event) {
                       var daterangepicker_start= $('input[name="daterangepicker_start"]').val();
                       var daterangepicker_end= $('input[name="daterangepicker_end"]').val();
                       var _url="<?php echo base_url(); ?>index.php/users/menulist/index_v1?&start_time="+daterangepicker_start+"&end_time="+daterangepicker_end+"";
                       $.loadPage(_url);
                   });

                   $("#yaday").click(function(){
                      var _url="<?php echo base_url(); ?>index.php/users/menulist/index_v1?&type=1";
                      $.loadPage(_url);
                   });
                   $("#day").click(function(){
                      var _url="<?php echo base_url(); ?>index.php/users/menulist/index_v1?&type=4";
                      $.loadPage(_url);
                   });
                   $("#weekdays").click(function(){
                       var _url="<?php echo base_url(); ?>index.php/users/menulist/index_v1?&type=2";
                       $.loadPage(_url);
                   });
                   $("#ben_month").click(function(){
                       var _url="<?php echo base_url(); ?>index.php/users/menulist/index_v1?&type=3";
                       $.loadPage(_url);
                   });
               });
               </script>   
<script type="text/javascript">

    $(function () {

        window.weeks;


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


        $.post('<?=base_url();?>index.php/users/weeks_add_cus',function(data){
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '最近七日新增客户数'
                },
                subtitle: {
                    // text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '客户数'
                    }
                },
                credits: {
                    enabled:false
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '新增客户数<b>{point.y}</b>位'
                },
                series: [{
                    name: 'Population',
                    data: data,
                    dataLabels: {
                        enabled: false,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }]
            });
        },"json");
//客户七天跟进记录统计
        $.post('<?=base_url();?>index.php/follow/ajax_follow_weeks',function(follow) {
            $('#container1').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '跟进数统计'
                },
                subtitle: {
                    // text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                credits: {
                    enabled:false
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '客户数'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '跟进客户数<b>{point.y}</b>位'
                },
                series: [{
                    name: 'Population',
                    data:follow,
                    dataLabels: {
                        enabled: false,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }]
            });
        },"json");
        $.post('<?=base_url();?>index.php/users/customer_status',function(status) {
            $('#container3').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                credits: {
                    enabled:false
                },
                title: {
                    text: '我的客户'
                },
                tooltip: {
                    // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            format: '<b>{point.name}</b>: {point.percentage:.1f}%'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: ' ',
                    data:status,
                }]
            });
        },"json");
        add_customer();
        $("#yday").click(function(){
           add_customer();
        });
        $("#weeks").click(function(){
            weeks_customer();
        });
        $("#month").click(function(){
            montch();
        });


        // 推广渠道的昨天的
        $('#yday_channel').click(function(){
          get_yday_chinfo($('#queryuid').val() , $('#querydepid').val());  
        });
        $('#weeks_channel').click(function(){
          get_weeks_chinfo($('#queryuid').val() , $('#querydepid').val());  
        });
        $('#month_channel').click(function(){
          get_month_chinfo($('#queryuid').val() , $('#querydepid').val());  
        });


        // 加载来源渠道客户
        get_yday_chinfo();



        //指定销售查询部门
        $('#query').click(function() {
            var department_id = $('#appointSale').find('select').val();
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
                $('#onlyuser').text(user_name);
                $('#queryuid').val(user_id);
                $('#querydepid').val(0);

                // 获取昨天的
                get_yday_chinfo(user_id);



                $("#appointSale").modal('hide');
            }else{
                showInfo('请勾选您要指定的用户',"error");
            }
        });

        // 按部门查询推广渠道
        $('#channel_department').change(function(){
          var department_id = $(this).val();
          if(department_id > 0){
              $('#queryuid').val(0);
              $('#querydepid').val(department_id);
              get_yday_chinfo(0,department_id);
          }
        });



    });
function add_customer(){
    $.post("<?=base_url();?>index.php/customer/ajax_add_customer",function (data){
        var str=' <thead><tr class="fb">'+
            '<td>排名</td>'+
            '<td>销售员</td>'+
            '<td>新增企业数</td>'+
            '</tr></thead>';
        $.each(data,function(i,item){
            str+='<tr>'+
                '<td>'+(i+1)+'</td>'+
                '<td>'+item.ename+'</td>'+
                '<td>'+item.num+'</td>'+
                '</tr>';
        });
        $("#cus_add").html(str);
    },"json");
}

// 获取昨天来源渠道客户数据
function get_yday_chinfo(user_id=0 , department_id=0){
    $.post("<?=base_url();?>index.php/customer/get_yday_chinfo",{'user_id':user_id,'department_id':department_id},function (data){
        var str=' <thead><tr class="fb">'+
            '<td>来源渠道</td>'+
            '<td>录入数量</td>'+
            '<td>跟进数量</td>'+
            '<td>签单客户数量</td>'+
            '<td>签单金额总计</td>'+
            '</tr></thead>';
        $.each(data,function(i,item){
                if(item.level == 1){
                  str+='<tr>'+
                    '<td><b>'+item.channel_name+'</b></td>';
                        str+='<td><b>'+item.newadd_num+'</b></td>'+
                    '<td><b>'+item.followcount+'</b></td>'+
                    '<td><b>'+item.signcount+'</b></td>'+
                    '<td><b>'+item.signval+'</b></td>'+
                    '</tr>';
                }else{
                  str+='<tr>'+
                    '<td>'+item.channel_name+'</td>';
                        str+='<td>'+item.newadd_num+'</td>'+
                    '<td>'+item.followcount+'</td>'+
                    '<td>'+item.signcount+'</td>'+
                    '<td>'+item.signval+'</td>'+
                    '</tr>';
                }
        });
        $("#chanel_data").html(str);
    },"json");
}  

// 获取近七天来源渠道客户数据
function get_weeks_chinfo(){
    $.post("<?=base_url();?>index.php/customer/get_weeks_chinfo",function (data){
        var str=' <thead><tr class="fb">'+
            '<td>来源渠道</td>'+
            '<td>录入数量</td>'+
            '<td>跟进数量</td>'+
            '<td>签单客户数量</td>'+
            '<td>签单金额总计</td>'+
            '</tr></thead>';
        $.each(data,function(i,item){
                if(item.level == 1){
                  str+='<tr>'+
                    '<td><b>'+item.channel_name+'</b></td>';
                        str+='<td><b>'+item.newadd_num+'</b></td>'+
                    '<td><b>'+item.followcount+'</b></td>'+
                    '<td><b>'+item.signcount+'</b></td>'+
                    '<td><b>'+item.signval+'</b></td>'+
                    '</tr>';
                }else{
                  str+='<tr>'+
                    '<td>'+item.channel_name+'</td>';
                        str+='<td>'+item.newadd_num+'</td>'+
                    '<td>'+item.followcount+'</td>'+
                    '<td>'+item.signcount+'</td>'+
                    '<td>'+item.signval+'</td>'+
                    '</tr>';
                }
        });
        $("#chanel_data").html(str);
    },"json");
} 

// 获取近30天来源渠道客户数据
function get_month_chinfo(){
    $.post("<?=base_url();?>index.php/customer/get_month_chinfo",function (data){
        var str=' <thead><tr class="fb">'+
            '<td>来源渠道</td>'+
            '<td>录入数量</td>'+
            '<td>跟进数量</td>'+
            '<td>签单客户数量</td>'+
            '<td>签单金额总计</td>'+
            '</tr></thead>';
        $.each(data,function(i,item){
                if(item.level == 1){
                  str+='<tr>'+
                    '<td><b>'+item.channel_name+'</b></td>';
                        str+='<td><b>'+item.newadd_num+'</b></td>'+
                    '<td><b>'+item.followcount+'</b></td>'+
                    '<td><b>'+item.signcount+'</b></td>'+
                    '<td><b>'+item.signval+'</b></td>'+
                    '</tr>';
                }else{
                  str+='<tr>'+
                    '<td>'+item.channel_name+'</td>';
                        str+='<td>'+item.newadd_num+'</td>'+
                    '<td>'+item.followcount+'</td>'+
                    '<td>'+item.signcount+'</td>'+
                    '<td>'+item.signval+'</td>'+
                    '</tr>';
                }

                
        });
        $("#chanel_data").html(str);
    },"json");
}

function weeks_customer(){
    $.post("<?=base_url();?>index.php/customer/ajax_week_add",function (data){
        $("#cus_add").html("")
        var str=' <thead><tr class="fb">'+
            '<td>排名</td>'+
            '<td>销售员</td>'+
            '<td>新增企业数</td>'+
            '</tr></thead>';
        $.each(data,function(i,item){
            str+='<tr>'+
                '<td>'+(i+1)+'</td>'+
                '<td>'+item.ename+'</td>'+
                '<td>'+item.num+'</td>'+
                '</tr>';
        });
        $("#cus_add").html(str);
    },"json");
}
function montch(){
    $.post("<?=base_url();?>index.php/customer/ajax_month_add",function (data){
        $("#cus_add").html("")
        var str=' <thead><tr class="fb">'+
            '<td>排名</td>'+
            '<td>销售员</td>'+
            '<td>新增企业数</td>'+
            '</tr></thead>';
        $.each(data,function(i,item){
            str+='<tr>'+
                '<td>'+(i+1)+'</td>'+
                '<td>'+item.ename+'</td>'+
                '<td>'+item.num+'</td>'+
                '</tr>';
        });
        $("#cus_add").html(str);
    },"json");
}
</script>


<?php include "tan_user.php";?>
<?php include "share_user.php";?>
