<!DOCTYPE html>
<html lang="en" class="h">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<title>首页</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/assets/css/amazeui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/css/cusMan.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/nav/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/css/animate.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/font-awesome-4.5.0/css/font-awesome.css">
<!-- 转移过来 -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/css/userinfo.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/css/style.min862f.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/static/css/base.css" rel="stylesheet">
<!-- 提示信息 -->
<link href="<?php echo base_url(); ?>/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo base_url(); ?>/static/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/static/js/style.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/static/nav/js/index.js"></script>

<!-- 选择时间段 和 图表的显示 -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>/static/daterangepicker/daterangepicker-bs3.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>/static/daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/static/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/static/highcharts/js/highcharts.js"></script>

<!-- 添加客户验证 -->
<script src="<?php echo base_url(); ?>static/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>static/js/plugins/validate/messages_zh.min.js"></script>
<script src="<?php echo base_url(); ?>static/js/demo/form-validate-demo.min.js"></script>

<!-- 跳转路径方法 -->
<script src="<?php echo base_url(); ?>/static/js/oa.js"></script>
<!-- 选择时间插件 -->
<script src="<?php echo base_url(); ?>/static/js/plugins/layer/laydate/laydate.js"></script>
<!--全选-->
<script src="<?php echo base_url(); ?>/static/js/tableCheckbox.js"></script>
<!-- 提示信息js -->
<script src="<?php echo base_url(); ?>/static/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>/static/js/showToastr.js"></script>
<!-- 用户管理 -->
<link href="<?php echo base_url(); ?>/static/tabcss/reset-min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/static/tabcss/progression.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>/static/tabcss/style.css" rel="stylesheet">
<!-- 组织架构 -->
<link href="<?php echo base_url(); ?>/static/css/plugins/treeview/bootstrap-treeview.css" rel="stylesheet">
</head>
<body class="h">
<!-- CRM start -->
<!-- leftNav start -->
<div class="container-fluid h">
<div class="h crmNav pl" style="width:220px;">
	<div class="h pr">
		<nav class="navbar-static-side h">
			<ul class="nav">
				<li class="nav-header tc">
					<div class="btn-group tc auto">
						<img alt="image" class="img-rounded w load cp" src="<?php echo $base_url; ?>/static/img/logo.png">
					</div>
        		</li>
			</ul>
			<ul id="accordion" class="accordion pl" data-index="1">
				<li class="open">
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->客户管理<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl" style="display:block;">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/add_customer">
						<?php //var_dump($user_id=$_SESSION['user_id']->id);
						?>添加客户<b></b></a></li>
						
						<?php if($huixiao){ ?>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/hx_add_customer">
							添加会销客户<b></b></a></li>
						<?php }	?>		
							
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan">我的客户<b></b></a></li>

						<?php if($is_zhuguan){ ?>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/zhuguan_customer?&zhuguan=1">下级录入<b></b></a></li>
						<?php } ?>

						<?php $id=$_SESSION['user_id']; if($id->type==5){ ?>
							<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/noassign_customer?&zhuguan=1">未指派客户<b></b></a></li>
						<?php } ?>
						
						<?php $id=$_SESSION['user_id']; if($id->id==1){ ?>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/zhuguan_customer?&zhuguan=admin">客户信息<b></b></a></li>
						<?php } ?>
						
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/will_customer?&will_status=1,&zhuguan=1">重点客户<b></b></a></li>
						<?php $id=$_SESSION['user_id']; if($id->type!=5){ ?>
							<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/want_topublic">即将调入公海客户<b></b></a></li>
						<?php } ?>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/public_customer?isPublic=1">公海客户<b></b></a></li>
						
						
						<?php if($huixiao){ ?>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/hx_public_customer?isPublic=1">会销公海客户<b></b></a></li>
						<?php }	?>		
						
						
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan?&linkType=1&linkDay=0">未联系客户<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan?&linkType=3&linkDay=0">今日已联系客户<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan?&linkType=2&linkDay=0">今日待联系客户<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan?&linkType=2&linkDay=1">明日待联系客户<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan?&linkType=2&linkDay=3">3日内待联系<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/cusMan?&linkType=2&linkDay=5">5日内待联系<b></b></a></li>
					</ul>
					</li>
						<?php if($huixiao_unuse){ ?>
						<li>	
						<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->会销客户管理<i class="fa fa-chevron-down"></i></div>
							<ul class="submenu pl">
							<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/hx_add_customer">
							添加会销客户<b></b></a></li>
							<!--<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/hx_cusMan">我的会销客户<b></b></a></li>
							-->
							<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/customer/menulist/hx_public_customer?isPublic=1">会销公海客户<b></b></a></li>
							</ul>	
						</li>		
						<?php }	?>				
				<li>
			
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->共享客户<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/share/my_share_customer?&share=1">我共享的<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/share/my_share_customer?&share=2">共享我的<b></b></a></li>
					</ul>
				</li>
			</ul>
			<ul data-index="2" class="hide accordion pl">
				<li>
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->组织架构<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/users/menulist/addUser">添加用户<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/users/menulist/user_admin">用户管理<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/users/menulist/sys_structure">组织架构<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/quit/add_quit">添加离职<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/quit">离职信息<b></b></a></li>
					</ul>
				</li>
			</ul>
			<ul data-index="3" class="hide accordion pl">
				<li>
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->系统反馈<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/feedback/menulist/sys_feedback">我的反馈<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/feedback/menulist/sys_feedback_list">反馈列表<b></b></a></li>
					</ul>
				</li>
			</ul>
			<ul data-index="4" class="hide accordion pl">
				<li>
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->统计分析<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/statistical/new_customer_sta">新增客户统计<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/statistical/all_customer_sta">客户所有者统计<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/statistical/tion_customer_sta">客户分类统计<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/statistical/follow_customer_sta">跟进记录统计<b></b></a></li>
					</ul>
				</li>
			</ul>
			<ul data-index="5" class="hide accordion pl">
				<li>
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->日志管理<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/log/customer_circulation_log">客户流转历史<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/log/customer_log">客户日志<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/log/customer_link_log">客户联系人日志<b></b></a></li>
					</ul>
				</li>
			</ul>
			<ul data-index="6" class="hide accordion pl">
				<li>
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->关键词<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/keywords_category/add_keywords">添加关键词<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/keywords_category/add_keyword_category">添加关键词类别<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/keywords_category/keywords_list">关键词列表<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/keywords_category/keywords_select">关键词查询<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/keywords_category/category_list">关键词类别列表<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/keywords_category/update_category_log">关键词类别日志<b></b></a></li>
					</ul>
				</li>
			</ul>
			<ul data-index="7" class="hide accordion pl">
				<li>
					<div class="link"><!-- <i class="fa fa-paint-brush"></i> -->产品管理<i class="fa fa-chevron-down"></i></div>
					<ul class="submenu pl">
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/product/product_list">产品列表<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/product/add_product">添加产品<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/product/product_class">产品分类<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/product/product_select">产品选择<b></b></a></li>
						<li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/product/add_contract">添加合同<b></b></a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<div class="col-lg-12 ml245 pl">
	<div class="row crow bb explain col-lg-11 pt20 pl10 pb10">
		<ul class="nav nav-pills topNav pr">
		  <li data-num="1" role="presentation" class="active"><a href="javascript:void(0);">客户管理</a></li>
			<?php if(isExist("zuzhijiagou_Modular",$power)){ ?>
		  <li data-num="2" role="presentation"><a href="javascript:void(0);">组织架构</a></li>
			<?php } ?>
		  <li data-num="3" role="presentation"><a href="javascript:void(0);">系统反馈</a></li>
			<?php if(isExist("tongjifenxi_Modular",$power)){ ?>
		  <li data-num="4" role="presentation"><a href="javascript:void(0);">统计分析</a></li>
			<?php } ?>
			<li role="presentation" class="hide" data-num="5"><a href="javascript:void(0);">日志管理</a></li>
			<li data-num="6" role="presentation"><a href="javascript:void(0);">关键词</a></li>
			<li data-num="7" role="presentation"><a href="javascript:void(0);">产品管理</a></li>
			<div class="dropdown pa">
				<span class="dropdown-toggle cp" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <i class="fa fa-user"></i><?php echo $user[0]->name; ?><span class="caret"></span>
				  </span>
				  <ul class="dropdown-menu">
				    <li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/users/menulist/updatePass">修改密码</a></li>
				    
				    <?php $user_id=$_SESSION['user_id']; if($user_id->id==1){ ?>
				    <li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/system/regression_public">系统设置</a></li>
				    <li><a href="javascript:void(0);" data-href="<?=base_url(); ?>index.php/my_tags/">标签管理</a></li>
				    <li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/channel">咨询渠道</a></li>
				    <li><a href="javascript:void(0);" data-href="<?=base_url();?>index.php/position/add_position">职位设置</a></li>
				    <?php } ?>
				    <li role="separator" class="divider"></li>
				    <li><a href="<?=base_url();?>index.php/users/logout">退出</a></li>
				  </ul>
			</div>
			<ul class="nav navbar-top-links pa" style="top:-24px;right:10%;">                    
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell f26 black"></i> <span class="label label-primary showMessage"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a data-href="<?=base_url();?>index.php/mail" >
                                <div>
                                    <i class="fa fa-envelope fa-fw "></i> 您有<b class="showRead"></b>条未读消息
                                    <span class="pull-right hide text-muted small">4分钟前</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider hide"></li>
                        <li class="hide">
                            <div class="text-center link-block">
                                <a data-href="<?=base_url();?>index.php/users/menulist/user_info">
                                    <strong>查看所有 </strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
		</ul>

	</div>
	<div class="row pt70" id="show">

	</div>
	<div class="crow">
		<div class="footer col-lg-11 tr pr100">
			@山东社动电商
		</div>
	</div>
</div>
</div>
<!-- leftNav end -->
<!-- CRM end -->

<!-- 路径跳转 -->
<script type="text/javascript">
//初始化中间区域
var _url="<?php echo base_url(); ?>index.php/users/index_list?type=4";
$.loadPage(_url);

//初始化菜单
$(function(){
$('.load').click(function(event) {
	  location.reload();
});
$('.submenu a').click(function(event) {
	$(this).parent().addClass('on').siblings().removeClass('on');
	var href = $(this).attr('data-href');

	$.ajax({
	    type: "POST",
	    url: href,
	    success: function(data){
	         $("#show").html(data);
	    }
	});
});
$.get('<?=base_url();?>index.php/mail/get_unread_message', function(data) {
		if (data == 0) {
			$('.showRead').html('0');
			$('.showMessage').addClass('hide');
		}else{
			$('.showMessage').html(data);
			$('.showRead').html(data);
		}

});
$('.dropdown-menu a').click(function(event) {

	var href = $(this).attr('data-href');
	// alert(href)
	$.ajax({
	    type: "POST",
	    url: href,
	    success: function(data){
	        $("#show").html(data);
	    }
	});
});
	// 每一分钟调用方法查询未读信息
	window.setInterval(function(){
		$.get('<?=base_url();?>index.php/mail/get_unread_message', function(data) {
			if (data == 0) {
				$('.showMessage').addClass('hide');
				$('.showRead').html('0');
			}else{
				$('.showMessages').html(data);
				$('.showRead').html(data);

			}

		});
	},30000);
})
</script>
</body>
</html>

