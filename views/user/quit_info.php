<div class="wrapper wrapper-content">

    <!-- End Panel Style -->



    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12 col-lg-12 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">离职日志</h4>
                        <div class="example">
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
                                <div class="col-sm-6 col-md-5 col-lg-3">
                                    <form class="form-inline">
                                      <div class="form-group">
                                        <label for="reservation">录入时间</label>
                                         <input type="text" readonly="readonly" name="reservation" id="reservation" style="width:230px;" class="f14 form-control" value="" />
                                        <span style="right:70px;"  class="glyphicon glyphicon-calendar calendar fa fa-calendar form-control-feedback" aria-hidden="true"></span>
                                      </div>
                                    </form>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-primary" id="quit_search">搜索</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="fb">
                                        <td>离职人姓名</td>
                                        <td>部门</td>
                                        <td>离职日期</td>
                                        <td>交接人编号</td>
                                        <td>交接内容</td>
                                        <td>备注</td>
                                        <td>创建人</td>
                                    </tr>
                                    <?php if (!empty($quit_info)){ ?>
                                        <?php foreach ($quit_info as $key => $value): ?>
                                            <tr>
                                                <td><?php echo $value['quit_name']; ?></td>
                                                <td><?php echo $value['dname']; ?></td>
                                                <td><?php echo date("Y-m-d",$value['quit_time']); ?></td>
                                                <td><?php echo $value['transfer_name']; ?></td>
                                                <td><?php echo $value['transfer_content']; ?></td>
                                                <td><?php echo $value['content']; ?></td>
                                                <td><?php echo $value['creator_name']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php }else{ ?>
                                        <div class="noCustomer ">
                                            <h3>没有符合条件的客户信息</h3>
                                        </div>
                                    <?php } ?>
                                </table>
                            </div>
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
<!-- 时间插件 -->
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
        strDate = strDate + 6;
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate;
        return currentdate;
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".daterangepicker").remove();
          $('#reservation').daterangepicker(null, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
          });
    });
</script>
<script type="text/javascript">
    // 搜索
    $('#quit_search').click(function(event) {
        var name = $('#username').val();
        var department_id = $('#sousuo_type').val();
        var daterangepicker_start= $('input[name="daterangepicker_start"]').val();
        var daterangepicker_end= $('input[name="daterangepicker_end"]').val();
        var _url="<?php echo base_url();?>index.php/quit?&start_time="+daterangepicker_start+"&end_time="+daterangepicker_end+"&name="+name+"&department_id="+department_id;
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