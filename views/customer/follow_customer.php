<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE <html>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/timeline.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:47 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 时间轴</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="<?php echo base_url(); ?>/static/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/font-awesome-4.5.0/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/static/css/base.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>跟进客户</h5>
                        <div class="ibox-tools hide">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="timeline.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="timeline.html#">选项1</a>
                                </li>
                                <li><a href="timeline.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                   
                    <div class="ibox-content timeline">
                         <div class="col-lg-12">
                                <div class="modal-body">
                                   <form class="form-horizontal mb20" method="post" action="<?php echo base_url(); ?>index.php/follow/add_follow_customer" id="feed_form">
                                    <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"/>
                                     <div class="form-group">
                                       <label for="username" class="col-sm-2 control-label">跟进方式</label>
                                       <div class="col-sm-10 ">
                                            <select name="type" id="" class="form-control">
                                                <option value="" selected="selected">请选择</option>
                                                <option value="1">电话</option>
                                                <option value="2">邮件</option>
                                                <option value="3">QQ</option>
                                                <option value="4">微信</option>
                                                <option value="5">上门拜访</option>
                                            </select>
                                       </div>
                                     </div>
                                    <div class="form-group">
                                       <label for="password" class="col-sm-2 control-label">跟进内容</label>
                                       <div class="col-sm-10 ">
                                          <textarea class="form-control" name="content" rows="3"required="" aria-required="true"></textarea>
                                       </div>

                                     </div>
                                     <div class="form-group">
                                       <label for="password" class="col-sm-2 control-label">下次跟进时间</label>
                                       <div class="col-sm-10 ">
                                           <input id="hello" name="next_time" class="laydate-icon form-control layer-date">
                                       </div>

                                     </div>
                                     <div class="form-group">
                                          <div class="col-sm-4 col-sm-offset-2">
                                              <button class="btn btn-primary" type="submit" id="adduser_id">提交</button>
                                          </div>
                                      </div>
                                   </form>
                                </div>
                        </div>
                        <?php foreach($follow as $key=>$value){ ?>
                         <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-file-text"></i><?php echo date('y-m-d H:i:s',$value->time); ?>
                                </div>
                                <div class="col-xs-7 content">
                                    <p>客户名称:<?php echo $value->name;?></p>
                                    <p>下次跟进时间:<?php echo date('y-m-d',$value->next_time);?></p>
                                    <P>跟进方式:<?php if($value->type==1){
                                            echo "电话";
                                        }else if($value->type==2){
                                            echo "邮件";
                                        }else if($value->type==3){
                                            echo "QQ";
                                        }else if($value->type==4){
                                            echo "微信";
                                        }else if($value->type==5){
                                            echo "上门拜访";
                                        }?></P>
                                    <p class="m-b-xs"><strong><?php echo $value->content;?></strong></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo base_url(); ?>/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/content.min.js?v=1.0.0"></script>
    <script src="<?php echo base_url(); ?>/static/js/demo/peity-demo.min.js"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/validate/messages_zh.min.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/demo/feedback-validate.js"></script>
    <script src="<?php echo base_url(); ?>/static/js/plugins/layer/laydate/laydate.js"></script>
    <script type="text/javascript">
        laydate({
            elem: "#hello",
            event: "focus",
            format: "YYYY/MM/DD",
            min: laydate.now(),
            max: "2099-06-16 23:59:59"
        });
    </script>
</body>
<script>
    $(function(){
        $("#adduser_id").click(function(){
           $("#feed_form").submit();
        });
    })
</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/timeline.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:47 GMT -->
</html>
