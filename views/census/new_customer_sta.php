    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
             <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title clearfix">
                        <h5 class="pull-left mt5">新增客户统计</h5>
                        <div class="form-horizontal">
                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                   <label for="inputEmail3" class="col-sm-3 control-label">时间</label>
                                   <div class="col-sm-9">
                                    <input id="next_time" name="next_time" readonly="" value="<?php echo date('Y/m'); ?>" class="layer-date form-control">
                                    <!-- <select class="form-control year">
                                      <option value="2016">2016</option>
                                      <option value="2015">2015</option>
                                      <option value="2014">2014</option>
                                      <option value="2013">2013</option>
                                      <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                    </select> -->

                                   </div>
                                 </div>
                            </div>
                        	<!--  <div class="col-lg-2 col-md-2">
                    	        <div class="form-group">
                    	           <label for="inputEmail3" class="col-sm-3 control-label">月</label>
                    	           <div class="col-sm-9">
                    	            <select class="form-control month">
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                    	           </div>
                    	         </div>
                        	</div> -->


                         <!-- <select class="form-control year">
                                  <option value="2016">2016</option>
                                  <option value="2015">2015</option>
                                  <option value="2014">2014</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                </select> -->


                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                   <label for="inputEmail3" class="col-sm-3 control-label">部门</label>
                                   <div class="col-sm-9">
                                       <select class="form-control" id="department">
                                           <option value="0">全部</option>
                                          <?php foreach($chis_deparments as $k=>$v){ ?>
                                            <option value="<?=$v['id'];?>"><?=$v['name'];?></option>
                                            <?php } ?>
                                       </select>
                                   </div>
                                 </div>
                            </div>
                        	<div class="col-lg-2 col-md-3">
                    	        <div class="form-group">
                    	           <label for="inputEmail3" class="col-sm-4 control-label">负责人</label>
                    	           <div class="col-sm-8">
                    	            <!-- <select class="form-control" id="fuzeren">
                                        <option value="0">请选择</option>
                                    </select> -->

                                    <input type="text" class="form-control" id="fuzeren" value="<?=$user_chis_name?>" data-toggle="modal" data-target="#chiscus" readonly="readonly" placeholder="查询指定负责人">
                    	            <input type="hidden" value="0" id="fuzerenval">
                                   </div> 
                    	         </div>
                        	</div>
                        </div>


                        <div class="col-lg-2 col-md-2">
                            <select name="channel_id" id="channel_id" style="padding:6px 12px;font-size:14px;margin-bottpm:10px;">
                                <option value="0">--请选择来源渠道分类--</option>
                                <?php foreach($channel as $k=>$v){ ?>
                                    <?php if($v['level'] == 1){ ?>
                                        <option value="<?=$v['id']?>">&nbsp;&nbsp;&nbsp;&nbsp;--<?=$v['channel_name']?></option>
                                    <?php }elseif($v['level'] == 2){ ?>
                                        <option value="<?=$v['id']?>" levelattr="<?=$v['level']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--<?=$v['channel_name']?></option>
                                    <?php }else{?>
                                        <option value="<?=$v['id']?>"><?=$v['channel_name']?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-lg-2 col-md-2">
                            <button class="btn btn-primary" id="chaxun">查询</button>
                        </div>

                    </div>
                    <div class="ibox-content clearfix">
                         <div id="container" style="min-width:400px;height:400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- 查询指定下级的数据 -->
<div class="modal inmodal fade" id="chiscus" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">查询指定人员录入客户数据</h4>
            </div>
            <div class="modal-body p10 clearfix">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="exampleInputName2">部门：</label>
                    <select name="exampleInputName2" id="exampleInputName2" class="form-control">
                        <!-- <option value="">请选择</option> -->
                        <?php foreach($chis_deparments as $k=>$v){ ?>

                        <?php if($v['id'] == 12){ ?>
                            <option value="<?=$deparments_ids;?>"><?=$v['name'];?></option>
                        <?php }else{ ?>
                            <option value="<?=$v['id'];?>"><?=$v['name'];?></option>
                        <?php } ?>

                        
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

                  <button type='button' class="btn btn-primary" id="chis_query">搜索负责人</button>
                  <!-- <button type='button' class="btn btn-primary" id="clear_query">清空</button> -->
                </form>
                <table class="table mt10" id="chisuser_table2">
                </table>
                 <span class="mes_pR pull-left">
                     <a onclick="up('#chiscus')">上一页</a>
                     <a onclick="down('#chiscus')">下一页</a>
                 </span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="chis_get_user" >查询</button>
                <button class="btn btn-default" id="clear_query"  data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>




<?php include "tan_user.php";?>
<?php include "share_user.php";?>

 <script type="text/javascript">
   $(document).ready(function() {
      $('#reservation').daterangepicker(null, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#reservation2').daterangepicker(null, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
   });
   </script>
   <script type="text/javascript">





$(function(){


    $('#clear_query').click(function(){
        $('#fuzeren').val('');
        $('#fuzerenval').val(0);
    });



    var chis_department_ids = "<?=$deparments_ids;?>";
    $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1,'department_id':chis_department_ids}, function(data) {
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
        $("#chisuser_table2").html(str);
    },"json");




    // 查询指定负责人
    $('#chis_query').click(function(){
        var department_id = $('#chiscus').find('select').val();

        var serchusername = $.trim($(this).siblings('.serwhere').find('.serchusername').val());
        var onwork  = $(this).siblings('.serwhere').find('.onwork').val();

        $.post('<?=base_url();?>index.php/users/get_users',{"per_page":1,"department_id":department_id,'onwork':onwork,'serchusername':serchusername} ,function(data){
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
            $("#chisuser_table2").html(str);
        },"json");
    });


    $("#chis_get_user").click(function(){
       // var cus_id= $("#custo_id").val();
       var user_id=$('input[name="user_id"]:checked').val();
       var user_name = $('input[name="user_id"]:checked').parent().next().next().text();
       $('#fuzeren').val(user_name);
       var channel_id = $("#channel_id option:selected").val();
       // alert(user_id);
       // return;
        if (user_id) {
            $('#chiscus').modal('hide');

            $('#fuzerenval').val(user_id);

            var timestr = $('#next_time').val();
            var timestr = timestr.split('/');
            var year=timestr[0];
            var month=timestr[1];

            // 加载该用户的客户数据
            new_customer(0,year,month,user_id,channel_id);

            $('#chiscus').modal('hide');

            if($('.modal-backdrop')){
                $('.modal-backdrop').remove();
            }

        }else{
            showInfo('请勾选您要指定的用户',"error");
        }
    });





    new_customer(0,"<?php echo date('Y');?>","<?php echo date('m');?>");
    $("#chaxun").click(function(){
        var department= $("#department").val();

        var channel_id = $("#channel_id option:selected").val();

        var timestr = $('#next_time').val();
        var timestr = timestr.split('/');
        var year=timestr[0];
        var month=timestr[1];
        // var fuzeren=$('#fuzeren').val();
        var fuzeren = $('#fuzerenval').val();
        new_customer(department,year,month,fuzeren,channel_id);
    });

    $("#department").change(function(){
        var de_no=$(this).val();
        $("#fuzeren").html("");
        $.post("<?=base_url();?>index.php/statistical/employee_department",{"department":de_no},function(data){
            var str="<option value='0'>请选择</option>";
            $.each(data,function(i,item){
                str+="<option value='"+item.eid+"'>"+item.ename+"</option>";
            });
            $("#fuzeren").html(str);
        },"json");
    });
    function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "";
        var seperator2 = ":";
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = date.getFullYear() + '年' + month +'月';
        return currentdate;
    }
    function getYear() {
        var date = new Date();
        var seperator1 = "";
        var seperator2 = ":";
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = date.getFullYear();
        return currentdate;
    }
    var year = getYear();
    $('.year option').each(function(index, el) {
        if ($(this).val()==year) {
            $('.year').children('option').eq(index).attr('selected', 'selected');
        };
    });
    function getMonth() {
        var date = new Date();
        var seperator1 = "";
        var seperator2 = ":";
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        // if (month >= 1 && month <= 9) {
        //     month = "0" + month;
        // }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = month;
        return currentdate;
    }
    var month =  getMonth();
    $('.year option').change(function(event) {
        alert($(this).val());
    });
    // alert(month);
    $('.month option').each(function(index, el) {
        // alert($(this).val());
        if ($(this).val()==month) {
            $('.month').children('option').eq(index).attr('selected', 'selected');
        };
    });



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
            format: "YYYY/MM",
            istime: true,
            festival: true,
            min: "2010-01-01 00:00:00",
            max: "2099-06-16 23:59:59",
            start: getNowFormatDate()
        });
    });







    function  new_customer(department,year,month,fuzeren,channel_id) {
        $.post("<?=base_url();?>index.php/statistical/ajax_add_customer",{"department":department,"year":year,"month":month,"fuzeren":fuzeren,"channel_id":channel_id}, function (data) {
            var Yht =  $(".year option:selected").val();
    var Mht =  $(".month option:selected").val();
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '新增客户统计'
                },
                subtitle: {
                     text: '时间:'+year+'年'+month+'月'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: 0,
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
                    enabled: false
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
        }, "json");
    }
})
   </script>
