<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">


<!-- Mirrored from www.zi-han.net/theme/hplus/table_bootstrap.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:03 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="<?php echo base_url(); ?>/static/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/base.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/cusMan.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/tabcss/reset-min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/tabcss/progression.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/tabcss/style.css" rel="stylesheet">


</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content  ">
   

        
        <!-- End Panel Style -->



        <!-- Panel Other -->
        <div class="ibox float-e-margins">
           
            <div class="ibox-content">
                <div class="row row-lg">
                    <form class="form-horizontal m-t" id="batch_from" method="post"  action="<?php echo base_url(); ?>index.php/customer/batch_add_customer">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Example Events -->
                        <div class="example-wrap">
                            <h4 class="example-title">批量添加客户</h4>
                            <div class="example">
                                <div class="alert alert-success hide" id="examplebtTableEventsResult" role="alert">
                                    事件结果
                                </div>
                                <div class="" id="exampleTableEventsToolbar" role="group">
                                    <a type="button" class="btn btn-outline btn-default cp">
                                           <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                    </a>


                                </div>

                                <table class="table table-bordered table-hover borderNone">
                                    <thead>
                                        <tr style="width:20px;">
                                            <th>客户名称</th>
                                            <th>公司名称</th>
                                            <th>手机</th>
                                            <th>法人</th>
                                            <th>公司规模</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td >                                                                                 
                                            <input type="text" name="name[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="company_name[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="mobile[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="corporate_name[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="company_size[]" class="form-control">
                                        </td>
                                        <td>
                                            <button class="btn btn-white btn-sm del"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                </table>
                               <div class="pull-right">
                                   <button type="button" class="btn btn-primary" id="batch_id" >保存</button>
                                   <button type="button" class="btn btn-white" >取消</button>
                               </div>
                            </div>
                        </div>
                        <!-- End Example Events -->
                    </div>
                    <div class="col-sm-3">
                        <input type="hidden" id="custo_id"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Panel Other -->
    </div>
  
    <script src="<?php echo base_url(); ?>/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo base_url(); ?>/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="<?php echo base_url(); ?>/static/js/content.min.js?v=1.0.0"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/demo/bootstrap-table-demo.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/tableCheckbox.js"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
                                  <script>
  $("#myTable").tableCheck("success");
</script> 
</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/table_bootstrap.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:06 GMT -->
</html>
<script type="text/javascript">
    $(function(){
        var _tr = '<tr><td><input type="text" name="name[]" class="form-control"></td><td><input type="text" class="form-control" name="company_name[]"></td><td><input type="text" class="form-control" name="mobile[]"></td><td><input type="text" class="form-control" name="corporate_name[]"></td><td><input type="text" class="form-control" name="company_size[]"></td><td><button class="btn btn-white btn-sm del"><i class="fa fa-trash-o"></i></button></td></tr>';
        $('.btn-outline').click(function(event) {
            $('.borderNone').append(_tr);
        });
        $('table').on('click', '.del', function(event) {
            
            $(this).parent().parent().remove();
        });
        $("#batch_id").click(function(){
            $("#batch_from").submit();
        });
    })
</script>
