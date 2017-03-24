<div class="wrapper wrapper-content">

    <!-- End Panel Style -->



    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <input type="hidden" id="sortType" value="<?=$sortType;?>"/>
        <div class="ibox-content">
            <div class="row row-lg">

                 <!--意向客户数量-->
                <input type="hidden" id="will_count" value="<?=$will_count;?>">
                <!--我的意向客户数量-->
                <input type="hidden" id="my_will_count" value="<?=$my_will_count;?>">

                <div class="col-sm-12 col-lg-10 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">下级录入的客户</h4>
                        <div class="example">

                            <div class="mb10 row" id="exampleTableEventsToolbar" role="group">
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <select name="" id="sousuo_type" class="form-control">
                                        <option <?php if ($type==1){?> selected="selected"<?php }?> value="1">客户名称</option>
                                        <option <?php if ($type==2){?> selected="selected"<?php }?> value="2">手机号</option>
                                        <option <?php if ($type==3){?> selected="selected"<?php }?> value="3">QQ</option>
                                        <option <?php if ($type==4){?> selected="selected"<?php }?> value="4">邮箱</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-5 col-lg-2">
                                    <div class="form-group has-feedback mb">
                                      <input type="text" class="form-control" id="text_sousuo" placeholder="输入名称,快速查找客户" value="<?=$sousuo_text;?>">
                                      <span style="pointer-events:auto;" class="cp glyphicon glyphicon-search form-control-feedback cp" id="sousuo" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-md-3 col-lg-2">
                                   <input type="text" class="form-control" id="next_cus" value="<?=$user_chis_name?>" data-toggle="modal" data-target="#chiscus" readonly="readonly" placeholder="查询下级客户">
                                </div>

                              <!--   <div class="col-lg-3 op">
                                    <form class="form-inline">
                                      <div class="form-group">
                                        <label for="exampleInputName">销售人员</label>
                                        <input type="text" class="form-control" id="exampleInputName" placeholder="Jane Doe">
                                      </div>
                                    </form>
                                </div> -->
                                <div class="col-sm-4 col-md-4 col-lg-3">
                                    <form class="form-inline">
                                      <div class="form-group">
                                        <label for="reservation">录入时间</label>
                                         <input type="text" readonly="readonly" name="reservation" id="reservation" style="width:230px;" class="f14 form-control" value="" />
                                        <span  class="glyphicon glyphicon-calendar calendar fa fa-calendar form-control-feedback" aria-hidden="true"></span>
                                      </div>
                                    </form>

                                    <div class="control-group hide">
                                        <div class="controls">
                                            <div class="input-prepend input-group">
                                                 <span class="add-on input-group-addon op">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt5 col-md-3 col-lg-2 tr">
                                   <!--  <a type="button" class="pr mybtn grey small f12"data-toggle="modal" data-target="#inport">
                                        <form action="/customer/excel_in" method="post" class="hide" enctype="multipart/form-data">
                                        </form>
                                        <i class="glyphicon glyphicon-import" aria-hidden="true"></i>导入
                                    </a> -->
                                    <span class="pr">
                                        <a type="button" id="" class="mybtn grey small f12 asc" data-toggle="dropdown">
                                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>排序
                                        </a>
                                        <ul class="dropdown-menu" id="sort_menu">
                                          <li><a  id="sort_lastContactDate" class=""><i class="fa fa-check hide"></i> 最后联系时间</a></li>
                                          <li><a  id="sort_Name"><i class="fa fa-check hide"></i> 客户名称</a></li>
                                          <li><a  id="sort_CreateDate"><i class="fa fa-check hide"></i> 创建时间</a></li>
                                        </ul>
                                    </span>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover zhuguan_table" id="myTable">
                                    <thead>
                                    <tr style="width:20px;">
                                        <th>
                                            <input  type="checkbox" class="all_xuan">
                                        </th>
                                        <th>公司名称</th>
                                        <th>重点客户</th>
                                        <th>联系人</th>
                                        <th>联系电话</th>
                                        <th>职位</th>
                                        <th>来源渠道</th>
                                        <? if($is_custom_service[0]['type']==5){?>
                                            <th>客户所有人</th>
                                        <?php }else{ ?>
                                            <th>最近一次跟进时间</th>
                                        <?php } ?>
                                        <th>最后一次跟进内容</th>
                                    </tr>
                                    </thead>
                                    <?php if(!empty($customer)){ ?>
                                        <?php foreach($customer as $k=>$v){?>
                                            <tr >
                                                <td class="tdClass"><input class="gouxuan" type="checkbox" value="<?php echo $v->cus_id; ?>"><input type="hidden"  value="<?php echo $v->cname; ?>"><input type="hidden"  value="<?php echo $v->sign_status; ?>"><input type="hidden"  value="<?php echo $v->public_state; ?>"><input type="hidden"  value="<?php echo $v->will_status; ?>"></td>
                                                <td class="not">
                                                    <?php echo $v->cname; ?>
                                                    <p class="mb">
                                                        <?php if($v->sign_status==1){ ?><span class="callSign cp">签约</span>  <?php }else{ ?><span class="callSign cp hide">签约</span><?php } ?>
                                                        <?php if ($v->extend_status==1): ?>
                                                            <span class="extension cp">推广</span>                                                            
                                                        <?php endif ?>
                                                    </p>

                                                </td>
                                                <?php if($v->will_status==1){ ?>
                                                    <td class="tc"><button class="will btn btn-primary  btn-xs br">是</button><input type="hidden" value="<?=$v->cus_id ?>" ></td>
                                                <?php }elseif($v->will_status==0){ ?>
                                                    <td class="tc"><button class="will btn btn-primary btn-default btn-xs br">否</button><input type="hidden" value="<?=$v->cus_id ?>" ></td>
                                                <?php } ?>
                                                <td class="not"><?php echo $v->linkman_name; ?></td>
                                                <td class="not" ><?php echo $v->linkman_mobile;?> <?php if(!empty($v->cus_tel)) echo '/<br/>'.$v->cus_tel;?></td>
                                                <td class="not"><?php echo $v->linkman_job;?></td>
                                                <td class="not" ><?php 
                                                    echo $v->channel_str; 
                                                ?></td>
                                                <td class="not" >
                                                    <? if($is_custom_service[0]['type']==5){?>
                                                        <?php echo $v->new_user_name; ?>
                                                    <?php }else{ ?>
                                                        <?php echo $v->last_follow_time; ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="not" ><?php echo $v->last_follow_content; ?></td>
                                            </tr>
                                        <?php }?>
                                    <?php }else{ ?>
                                        <div class="noCustomer ">
                                            <h3>没有符合条件的客户信息</h3>
                                        </div>
                                    <?php }?>
                                </table>
                            </div>
                            <div class="page">
                                <?php echo $pages;?>
                                <?php if(!empty($pages)){?>
                                    <input type="text" value="" class="tonumpage" style="text-align:center;margin-left:10px;width:40px;height:30px;border-radius:5px;border:1px solid #ccc;">
                                    <a id="tonumpage" title="跳转到指定页" data-href="" data-ci-pagination-page="">跳转</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Example Events -->
                </div>
                <!--签约状态-->
                <input type="hidden" id="sign_status" value=""/>
                <div class="col-sm-6 col-lg-1 col-md-1">
                     <div class="cusMtt">
                        <h4 class="">签约客户</h4>
                        <div class="mt5 qianyue">
                            <input type="checkbox" id="qianY" value='1'> <label for="qianY">是</label>
                            <span class="pull-right">
                                 <input type="checkbox" id="qianN" value='0' > <label for="qianN">否</label>
                            </span>
                        </div>
                    </div>    
                </div>
                <div class="col-sm-6 col-lg-1 col-md-1">
                     <div class="cusMtt">
                        <h4 class="">重点客户</h4>
                        <div class="mt5 zhongdian">
                            <input type="checkbox" id="zhongY" value='1'> <label for="zhongY">是</label>
                            <span class="pull-right">
                                 <input type="checkbox" id="zhongN" value='0'> <label for="zhongN">否</label>
                            </span>
                        </div>
                    </div>    
                </div>
                <div class="col-sm-6 col-lg-2 col-md-2">
                    <input type="hidden" id="cusValue" value="<?php echo $status; ?>">
                    <div class="cusMt">
                        <h4 class="">客户分类</h4>
                        <div class="mt10">
                            <input type="checkbox" id="wu" value='-1'>  <label for="wu">无分类</label>
                        </div>
                        <div class="mt10">
                            <input type="checkbox" id="A" value='1'>  <label for="A">A类客户</label>
                        </div>
                        <div class="mt10">
                            <input type="checkbox" id="B" value='2'>  <label for="B">B类客户</label>
                        </div>
                        <div class="mt10">
                            <input type="checkbox" id="C" value='3'>  <label for="C">C类客户</label>
                        </div>
                        <div class="mt10">
                            <input type="checkbox" id="D" value='4'>  <label for="D">D类客户</label>
                        </div>
                    </div>
                    <div class="bags">
                        <h4 class="">标签列表</h4>
                        <ul class="clearfix">
                            <input type="hidden" id="tag_val" value="<?php echo $tag; ?>">
                            <?php foreach($label as $k=>$val){?>
                                <li>
                                <span class="cp">
                                    <i class="fa fa-fw fa-square-o"></i><?=$val->tag;?>
                                    <input type="hidden" class="tag_id" value="<?=$val->id;?>"/>
                                </span>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Panel Other -->

</div>
<!-- 侧边栏内容 -->
<div id="doc-oc-demo3" class="am-offcanvas">
    <div class="closeoffcanvas"></div>
    <div class="am-offcanvas-bar am-offcanvas-bar-flip">
        <div class="am-offcanvas-content">
            <div class="row">
                <div class="">
                    <div class="col-sm-1">
                        <img src="<?php echo $base_url; ?>/static/img/avatar_company.png" alt="" class="cusTop">
                    </div>
                    <div class="col-sm-8">
                        <!-- <h1 class="title">
                            <span id="state"></span>
                            <span id="cus_name"></span>
                        </h1> -->
                        <!-- // @zzr edit at 2016-12-08 16:40 -->
                        <h1 class="title">
                               <span id="state"></span>
                               <span id="cus_name"></span>
                               <!-- <span class="callMail cp" id="in_customer_text" data-toggle="modal" data-target="#gonghai">转入公海</span> -->
                               <?php if(isExist("qianyue_function",$power)){ ?><span class="callIPone cp sign" title="将客户设置为签约客户" data-toggle="modal" data-target="#sign" >设置签约</span><?php } ?>
                               <? if($is_custom_service[0]['type']==5){?><span class="cp appointSale hide" id="appoint_Sale_id"  data-toggle="modal" data-target="#appointSale" >指定销售</span><? } ?>
                        </h1>
                        <div class="tagShow hide">
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
                    <div class="col-sm-3">
                        <div class="edit clearfix hide">
                            <a  title="编辑客户资料" class="pull-right cus_up"><i class="fa fa-pencil f12"></i></a>
                        </div>
                        <div class="avatars pull-right">
                            <!-- 显示指定销售人员 -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">

                <div class="mt30">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">跟进记录</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">需求记录</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">报价记录</a>
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
                                                <input type="hidden" id="custo_id" />
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
                                                <div class="form-group mb10">
                                                    <label for="content" class="col-sm-3 control-label hide">跟进内容</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="content" id="content" rows="3"required="" aria-required="true" placeholder="跟进内容"></textarea>
                                                    </div>

                                                </div>
                                               <div class="form-group mb10" style="">
                                                    <div class="col-lg-2">
                                                        <span class="bell cp" title="设置下次跟进时间">
                                                            <i class="fa fa-bell-o f12"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-2 col-sm-offset-8">
                                                        <button class="btn btn-primary add_follow"  id="">提交</button>
                                                    </div>
                                                 </div>
                                                 <div class="form-group nextFollow pr hide ml mr pl">
                                                    <div class="icon"><div class="iconbg"></div></div>
                                                        <label for="next_time" class="col-sm-4 control-label pl pr" style="padding-top:2px;">下次跟进时间</label>
                                                        <div class="col-sm-8 pr">
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
                            <div id="tab-2" class="tab-pane table-responsive" >
                                <button class="btn btn-primary mt10 add_linkman" data-toggle="modal" data-target="#add_linkman_win">添加客户联系人</button>
                                <table class="table mt10 table-hover" id="tab-2_linkman">

                                </table>
                            </div>


                            <!-- 需求记录 -->
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <div class="">
                                        <div class="">
                                            <div class="form-horizontal m-t">
                                                <input type="hidden" id="custo_id" />
                                                <div class="form-group mb10">
                                                    <label for="content" class="col-sm-3 control-label hide">跟进内容</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="content" id="content_demand" rows="3"required="" aria-required="true" placeholder="请填写需求跟进内容"></textarea>
                                                    </div>

                                                </div>
                                               <div class="form-group mb10" style="">
                                                   <!--  <div class="col-lg-2">
                                                        <span class="bell cp" title="设置下次跟进时间">
                                                            <i class="fa fa-bell-o f12"></i>
                                                        </span>
                                                    </div> -->
                                                    <div class="col-sm-2 col-sm-offset-8" style="float:right">
                                                        <button class="btn btn-primary add_follow_demand" id="">提交</button>
                                                    </div>
                                                 </div>
                                                 <div class="form-group nextFollow pr hide ml mr pl">
                                                    <div class="icon"><div class="iconbg"></div></div>
                                                        <label for="next_time" class="col-sm-4 control-label pl pr" style="padding-top:2px;">下次跟进时间</label>
                                                        <div class="col-sm-8 pr">
                                                            <input id="next_time" name="next_time" class="layer-date">
                                                        </div>
                                                    </div>

                                                <div class="form-group hide">
                                                    <div class="col-sm-2 col-sm-offset-10">
                                                        <button class="btn btn-primary add_follow_demand"  id="">提交1</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div id="follow_demand" class="pb40">
                                            <!--跟进记录-->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- 报价记录表 -->
                            <div id="tab-4" class="tab-pane">
                                <div class="panel-body">
                                    <div class="">
                                        <div class="">
                                            <div class="form-horizontal m-t">
                                                <input type="hidden" id="custo_id" />
                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 hide control-label">报价金额</label>
                                                    <div class="col-sm-12 ">
                                                        <!-- <select name="type" id="type" class="form-control">
                                                            <option value="1" selected="selected">电话</option>
                                                            <option value="2">邮件</option>
                                                            <option value="3">QQ</option>
                                                            <option value="4">微信</option>
                                                        </select> -->
                                                        <input type="text" id="follow_price_val" name="follow_price" class="form-control" value="" placeholder="请输入报价金额，例如：18000 请输入数字">
                                                    </div>
                                                </div>
                                                <div class="form-group mb10">
                                                    <label for="content" class="col-sm-3 control-label hide">跟进内容</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="content" id="content_price" rows="3"required="" aria-required="true" placeholder="备注信息"></textarea>
                                                    </div>

                                                </div>
                                               <div class="form-group mb10" style="">
                                                   <!--  <div class="col-lg-2">
                                                        <span class="bell cp" title="设置下次跟进时间">
                                                            <i class="fa fa-bell-o f12"></i>
                                                        </span>
                                                    </div> -->
                                                    <div class="col-sm-2 col-sm-offset-8" style="float:right">
                                                        <button class="btn btn-primary add_follow_price" id="">提交</button>
                                                    </div>
                                                 </div>
                                                 <div class="form-group nextFollow pr hide ml mr pl">
                                                    <div class="icon"><div class="iconbg"></div></div>
                                                        <label for="next_time" class="col-sm-4 control-label pl pr" style="padding-top:2px;">下次跟进时间</label>
                                                        <div class="col-sm-8 pr">
                                                            <input id="next_time" name="next_time" class="layer-date">
                                                        </div>
                                                    </div>

                                                <div class="form-group hide">
                                                    <div class="col-sm-2 col-sm-offset-10">
                                                        <button class="btn btn-primary add_follow_price"  id="">提交1</button>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div id="follow_price" class="pb40">
                                            <!--跟进记录-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" id="customer_info">

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>/static/js/tableCheckbox.js"></script>
<script src="<?php echo base_url(); ?>/static/js/demo/feedback-validate.js"></script>

<script>
    $("#myTable").tableCheck("success");
</script>
<!-- 导入弹出框 -->
<div class="modal inmodal fade" id="inport" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title ">客户信息导入</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="excel_in_form" enctype="multipart/form-data" action="<?php echo base_url() ;?>index.php/customer/excel_in">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">文件名</label>
                        <div class="col-sm-8 col-sm-offset-1">
                            <input type="file"  name="filename" placeholder="">
                            <p>导入客户模板<a href="<?php echo base_url(); ?>/uploadfiles/file/客户导入.xls">下载</a></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-primary" id="excel_in_id"  data-dismiss="modal">导入</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="repeat" value="<?=$repeat_customer;?>"/>
<!-- 导入表格信息 start -->
<div class="modal inmodal fade" id="tableError" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:14px;"><i class="fa fa-exclamation-circle" style="color:red"></i> 以下客户信息导入失败,可能是公司名称或联系人手机号重复</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>公司名称</td>
                        <td>手机号</td>
                    </tr>
                    <?php foreach($repeat_customer as $k=>$v){ ?>
                        <tr>
                            <td><?=$v['cname']?></td>
                            <td><?=$v['lmobile']?></td>
                        </tr>
                    <?php }?>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- 导入表格信息 end -->

<script type="text/javascript">
    $(function (){
        $("#excel_in_id").click(function(){
            $("#excel_in_form").submit();
        }) ;
    });
</script>
<!-- 导出excel弹出框 -->
<div class="modal inmodal fade" id="export" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title ">客户信息导出</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="excel_out_form" action="<?php echo base_url() ;?>index.php/customer/excel_out">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">文件名</label>
                        <div class="col-sm-8 col-sm-offset-1">
                            <input type="text" class="form-control" name="excel_name" id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-primary" id="excel_out_id"  data-dismiss="modal">导出</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal fade" id="gonghai" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title in_text " style="font-size:18px;font-weight: normal;"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-9">
                        <button class="btn btn-primary" id="in_public_customer"  data-dismiss="modal">确认</button>
                        <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 签约客户确定 -->
<div class="modal inmodal fade" id="sign" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="text-align:left;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <!-- <h4 class="modal-title sign_text" style="font-size:18px;font-weight: normal;"></h4> -->
                <h4 class="modal-title sign_text" style="font-size:18px;font-weight: normal;margin-bottom:10px;"></h4>

                <input id="sign_value" class="form-control" name="signvalue" placeholder="请输入签单金额，例如:88888 (纯数字格式)" style="marign-top:5px;width:60%;inline-block" type="text">

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
<!-- 签约客户确定 -->
<!-- <div class="modal inmodal fade" id="appointSale" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title sign_text" style="font-size:18px;font-weight: normal;">指定销售人员</h4>
            </div>
            <div class="modal-body p10">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputName2">部门：</label>
                        <select name="" id="exampleInputName2" class="form-control">
                            <option value="">请选择</option>
                            <option value="">商务一部</option>
                            <option value="">商务二部</option>
                        </select>
                    </div>
                    <button type='button' class="btn btn-primary">查询</button>
                </form>
                <table class="table mt10">
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>用户名</td>
                        <td>用户姓名</td>
                        <td>部门</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>admin</td>
                        <td>tom</td>
                        <td>总经办</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id=""  data-dismiss="modal" >确认</button>
                <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div> -->
<!-- // @zzr edit at 2016-12-09 10:14 -->
<!-- 指定销售 -->
<div class="modal inmodal fade" id="appointSale" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">指定销售人员</h4>
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


<!-- 查询指定下级的数据 -->
<div class="modal inmodal fade" id="chiscus" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">查询下级跟进的客户数据</h4>
            </div>
            <div class="modal-body p10 clearfix">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="exampleInputName2">部门：</label>
                    <select name="exampleInputName2" id="exampleInputName2" class="form-control">
                        <!-- <option value="">请选择</option> -->
                        <?php foreach($chis_deparments as $k=>$v){ ?>
                        <option value="<?=$v['id'];?>"><?=$v['name'];?></option>
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

                  <button type='button' class="btn btn-primary" id="chis_query">查询</button>
                </form>
                <table class="table mt10" id="chisuser_table2">
                </table>
                 <span class="mes_pR pull-left">
                     <a onclick="up('#chiscus')">上一页</a>
                     <a onclick="down('#chiscus')">下一页</a>
                 </span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="chis_get_user" >确认</button>
                <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<!-- 添加客户联系人 -->
<div class="modal inmodal fade" id="add_linkman_win" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">添加客户联系人<br/>客户名称:【<span class="added_cus_name"></span>】</h4>
            </div>
            <div class="modal-body p10 clearfix">

                 <form class="form-horizontal" method="post" action="<?php echo base_url() ;?>index.php/customer/linkman" id="adduser_form">
                        <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"/>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">姓名</label>
                             <div class="col-sm-9">
                                 <input id="" name="ladd_name" class="form-control" type="text" required="" aria-required="true">
                             </div>
                             <div class="col-sm-1 errorStar">*</div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">手机号</label>
                             <div class="col-sm-9">
                                 <input id="" name="ladd_mobile" class="form-control" type="text"required="" maxlength="11" aria-required="true">
                                 <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                             </div>
                             <div class="col-sm-1 errorStar">*</div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">QQ</label>
                             <div class="col-sm-9">
                                 <input id="" name="ladd_qq" class="form-control" type="text" >
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">微信</label>
                             <div class="col-sm-9">
                                 <input id="" name="ladd_wechat" class="form-control" type="text" >
                             </div>
                         </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-9">
                                <input id="" name="ladd_email" class="form-control" type="email">
                                <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span> -->
                            </div>
                        </div>
                     <div class="form-group">
                         <label class="col-sm-2 control-label">职位</label>
                         <div class="col-sm-9">
                             <select name="ladd_position_id" id="" class="form-control">
                                 <?php foreach($position as $k=>$v){?>
                                     <option <?php if($v->if_default==1){?> selected="selected" <?php }?> value="<?php echo $v->id; ?>" ><?php echo $v->name; ?></option>
                                 <?php }?>
                             </select>
                         </div>
                     </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">备注</label>
                             <div class="col-sm-9">
                                <textarea class="form-control" name="ladd_remark" rows="3"></textarea>
                             </div>
                         </div>
    
                </form>
            
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="sub_add_linkman">添加</button>
                <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>



<!-- 编辑客户联系人 -->
<div class="modal inmodal fade" id="edit_linkman_win" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="font-size:18px;font-weight: normal;">编辑客户联系人<br/>客户名称:【<span class="added_cus_name"></span>】</h4>
            </div>
            <div class="modal-body p10 clearfix">

                 <form class="form-horizontal" method="post" action="<?php echo base_url() ;?>index.php/customer/linkman" id="adduser_form">
                        <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>"/>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">姓名</label>
                             <div class="col-sm-9">
                                 <input id="" name="ledit_name" class="form-control" type="text" required="" aria-required="true">
                             </div>
                             <div class="col-sm-1 errorStar">*</div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">手机号</label>
                             <div class="col-sm-9">
                                 <input id="" name="ledit_mobile" class="form-control" type="text"required="" maxlength="11" aria-required="true">
                                 <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                             </div>
                             <div class="col-sm-1 errorStar">*</div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">QQ</label>
                             <div class="col-sm-9">
                                 <input id="" name="ledit_qq" class="form-control" type="text" >
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">微信</label>
                             <div class="col-sm-9">
                                 <input id="" name="ledit_wechat" class="form-control" type="text" >
                             </div>
                         </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-9">
                                <input id="" name="ledit_email" class="form-control" type="email">
                                <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span> -->
                            </div>
                        </div>
                     <div class="form-group">
                         <label class="col-sm-2 control-label">职位</label>
                         <div class="col-sm-9">
                             <select name="ledit_position_id" id="" class="form-control">
                                 <?php foreach($position as $k=>$v){?>
                                     <option <?php if($v->if_default==1){?> selected="selected" <?php }?> value="<?php echo $v->id; ?>" ><?php echo $v->name; ?></option>
                                 <?php }?>
                             </select>
                         </div>
                     </div>
                         <div class="form-group">
                             <label class="col-sm-2 control-label">备注</label>
                             <div class="col-sm-9">
                                <textarea class="form-control" name="ledit_remark" rows="3"></textarea>
                             </div>
                         </div>
    
                </form>
            
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="sub_edit_linkman">保存</button>
                <input type="hidden" value="" name="edit_linkman_id">
                <button class="btn btn-default" id=""  data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>




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


        // 执行增加客户联系人
        $('#sub_add_linkman').click(function(){

            var ladd_name = $.trim($('input[name=ladd_name]').val());
            if(ladd_name == ''){
                alert('请输入客户姓名');
                return;
            }
            var ladd_mobile = $.trim($('input[name=ladd_mobile]').val());
            if(ladd_mobile == ''){
                alert('请输入客户手机号');
                return;
            }

            var mobilepreg = /^1[3|4|5|7|8][0-9]\d{8}$/;
            if(!mobilepreg.test(ladd_mobile)){
                alert('手机号码有误');
                return;
            }

            var custo_id=$("#custo_id").val();

            $.post("<?php echo base_url(); ?>index.php/customer/linkman",{
                    "customer_id":custo_id, 
                    "ladd_name" : ladd_name,
                    "ladd_mobile": ladd_mobile, 
                    "ladd_qq": $('input[name=ladd_qq]').val(), 
                    "ladd_wechat": $('input[name=ladd_wechat]').val(), 
                    "ladd_email": $('input[name=ladd_email]').val(),
                    "ladd_position_id": $('select[name=ladd_position_id]').val(),
                    "ladd_remark": $('textarea[name=ladd_remark]').val()
                },function (data) {
                        var info = eval(data);
                        if(info.s == 'ok'){
                            $('#add_linkman_win').modal('hide');

                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/customer/ajax_linkman",
                                data: "customer_id="+custo_id,
                                success: function(data){
                                    $("#tab-2_linkman").html(data);
                                }
                            });

                        }else{
                            alert(info.msg);
                        }
                    },'json');
        });


        // 弹出编辑框并自动加载联系人内容
        $(document).on("click","a.cus_linkman_info",function(){
            
            $('.added_cus_name').text($('#cus_name').text());

            var link_id = $(this).attr('link_id');

            $('input[name=edit_linkman_id]').val(link_id);

             $.post("<?php echo base_url(); ?>index.php/customer/ajax_linkman_info",{'link_id':link_id},function(data){
                var info = eval(data);
                if(info.s == 'ok'){

                    $('input[name=ledit_name]').val(info.linkman.name);
                    $('input[name=ledit_mobile]').val(info.linkman.mobile);
                    $('input[name=ledit_qq]').val(info.linkman.qq);
                    $('input[name=ledit_wechat]').val(info.linkman.wechat);
                    $('input[name=ledit_email]').val(info.linkman.email);
                    $('input[name=ledit_mobile]').val(info.linkman.mobile);
                    $('select[name=ledit_position_id] option').removeAttr('selected');
                    $('select[name=ledit_position_id] option').each(function(i){

                        if(info.linkman.position_id == $('select[name=ledit_position_id] option').eq(i).val()){
                            $('select[name=ledit_position_id] option').eq(i).attr('selected','selected');
                        }
                    });

                    $('textarea[name=ledit_remark]').val(info.linkman.remark);

                    $('#edit_linkman_win').modal('show');


                }else{
                    alert(info.msg);
                }

            },'json')

        });   



         // 执行编辑客户联系人
        $('#sub_edit_linkman').click(function(){
            
            var ladd_name = $.trim($('input[name=ledit_name]').val());
            if(ladd_name == ''){
                alert('请输入客户姓名');
                return;
            }
            var ladd_mobile = $.trim($('input[name=ledit_mobile]').val());
            if(ladd_mobile == ''){
                alert('请输入客户手机号');
                return;
            }

            var mobilepreg = /^1[3|4|5|7|8][0-9]\d{8}$/;
            if(!mobilepreg.test(ladd_mobile)){
                alert('手机号码有误');
                return;
            }

            var custo_id=$("#custo_id").val();
            var link_id=$("input[name=edit_linkman_id]").val();

            $.post("<?php echo base_url(); ?>index.php/customer/update_linkman",{
                "customer_id":custo_id, 
                    "link_id":link_id, 
                    "ladd_name" : ladd_name,
                    "ladd_mobile": ladd_mobile, 
                    "ladd_qq": $('input[name=ledit_qq]').val(), 
                    "ladd_wechat": $('input[name=ledit_wechat]').val(), 
                    "ladd_email": $('input[name=ledit_email]').val(),
                    "ladd_position_id": $('select[name=ledit_position_id]').val(),
                    "ladd_remark": $('textarea[name=ledit_remark]').val()
                },function (data) {
                        var info = eval(data);
                        if(info.s == 'ok'){
                            $('#edit_linkman_win').modal('hide');

                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/customer/ajax_linkman",
                                data: "customer_id="+custo_id,
                                success: function(data){
                                    $("#tab-2_linkman").html(data);
                                }
                            });

                        }else{
                            alert(info.msg);
                        }
                    },'json');
        }); 



        $(".add_linkman").click(function(){
            $('.added_cus_name').text($('#cus_name').text());
            // var customer_id=$("#custo_id").val();
            // $('body').removeClass('am-offcanvas-page');
            // var _url ="<?php echo  base_url();?>index.php/customer/linkman/"+customer_id;
            // $.loadPage(_url);
        });





        // 新增跟进记录
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

    
        // 新增需求记录
        $(".add_follow_demand").click(function(){
            // var type = $("#type").val();
            var type = '0';
            var content=$("#content_demand").val();
            // var next_time=$("#next_time").val();
            var next_time = 0;
            var custo_id = $("#custo_id").val();
            if(content){
                $.post("<?php echo base_url(); ?>index.php/follow/add_follow_cusdemand",
                    {"customer_id": custo_id, "type": type, "content": content, "next_time": next_time},
                    function (data) {
                        if (data == 'succ') {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/follow/follow_cusdemand",
                                data: "customer_id=" + custo_id,
                                success: function (data) {
                                    $("#follow_demand").html(data);
                                    $("#content_demand").val("");
                                    // $("#next_time").val("");
                                    // $("#type").val("1");
                                }
                            });
                        } else {
                            alert('跟进添加存在错误！');
                        }
                    });
            }else{
                showInfo('请填写跟进内容','error');
            }
        });

        // 报价记录
        $(".add_follow_price").click(function(){
            var type = $("#follow_price_val").val();
            // var type = '0';
            var content=$("#content_price").val();
            // var next_time=$("#next_time").val();
            var next_time = 0;
            var custo_id = $("#custo_id").val();
            if(content){
                $.post("<?php echo base_url(); ?>index.php/follow/add_follow_cusprice",
                    {"customer_id": custo_id, "type": type, "content": content, "next_time": next_time},
                    function (data) {
                        if (data == 'succ') {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/follow/follow_cusprice",
                                data: "customer_id=" + custo_id,
                                success: function (data) {
                                    $("#follow_price").html(data);
                                    $("#content_price").val("");
                                    // $("#next_time").val("");
                                    // $("#type").val("1");
                                }
                            });
                        } else {
                            alert('跟进添加存在错误！');
                        }
                    });
            }else{
                showInfo('请填写跟进内容','error');
            }
        });
    

        $(".cus_up").click(function(){
            var customer_id=$("#custo_id").val();
            $('body').removeClass('am-offcanvas-page');
            var _url="<?php echo  base_url();?>index.php/customer/customer_update/"+customer_id;
            $.loadPage(_url);
        });

        /*点击table触发复选框*/
        $('.zhuguan_table').find("td.not").click(function(){
            var ww = $(window).width()-800;
            $('.closeoffcanvas').width(ww);
            $('body').addClass('am-offcanvas-page');
            $('#doc-oc-demo3').addClass('am-active');
            $('#doc-oc-demo3').attr('data-garbage', 'true');
            $('.am-offcanvas-bar').addClass('am-offcanvas-bar-active');
            var _tr = $(this).parents('tr');
            var id= _tr.find(":checkbox").attr("value");
            var name=_tr.find(":checkbox").next().attr('value');
            var sign_status=_tr.find(":checkbox").next().next().attr('value');
            var public_state=_tr.find(":checkbox").next().next().next().attr('value');
            var will_status=_tr.find(":checkbox").next().next().next().next().attr('value');
            var cous=$("#custo_id").val(id);
            //签约客户不能转入公海
            if(sign_status==1){
                $("#in_customer_text").addClass("hide");
                $(".sign").addClass("hide");
            }else{
                $("#in_customer_text").removeClass("hide");
                $(".sign").removeClass("hide");
            }
            //意向客户不能转入公海
            if(will_status==1){
                $("#in_customer_text").addClass("hide");
            }else{
                $("#in_customer_text").removeClass("hide");
            }

            if(id!=cous){
                $("#cus_name").text(name);
                cus_status(id);
                $('#follow_price_val').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/follow/follow_customer",
                    data: "customer_id="+id,
                    success: function(data){
                        $("#follow").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/follow/follow_cusdemand",
                    data: "customer_id="+id,
                    success: function(data){
                         $("#follow_demand").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/follow/follow_cusprice",
                    data: "customer_id="+id,
                    success: function(data){
                         $("#follow_price").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/ajax_linkman",
                    data: "customer_id="+id,
                    success: function(data){
                        $("#tab-2_linkman").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/customer_info",
                    data: "customer_id="+id+"&public=1",
                    success: function(data){
                        $("#customer_info").html(data);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/cus_tag",
                    data: "customer_id="+id,
                    success: function(data){
                        $("#cus_tag").html(data);
                    }
                });
                // 已指派给销售的客户售前客服主管不能再次指派
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/customer/customer_status",
                    data: "customer_id="+id,
                    success: function(data){
                        if(data == '0' || data == 0){
                            // $('#appoint_Sale_id').addClass('hide');
                            // @zzr edit at 2017-02-16 10:46 售前主管扔可操作
                            $("#appoint_Sale_id").removeClass("hide");
                        }else{
                            $('#appoint_Sale_id').removeClass('hide');
                        }
                    }
                });
            }
        });
        $('.closeoffcanvas').on('click', function(event) {
            var ww = $(window).width()-800;
            $(this).width(ww);
            $('table').find('tr').find(':checkbox').removeAttr('checked');
            $('table').find('tr').removeClass('success');
            $('#doc-oc-demo3').removeClass('am-active');
            $('body').removeClass('am-offcanvas-page');
            $('#doc-oc-demo3').removeAttr('data-garbage');
            $('.am-offcanvas-bar').removeClass('am-offcanvas-bar-active');

        });  
        $('#doc-oc-demo3').on('open.offcanvas.amui', function() {
        }).on('close.offcanvas.amui', function() {
            $('table').find('.success').find('input[type="checkbox"]').removeAttr('checked');
            $('table').find('.success').removeClass('success');
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
            // 客户分类
            var status = "<?=$status; ?>";
            var statusArrays = status.split(",");
            for(var i = 0; i < statusArrays.length; i++) {
                if(statusArrays[i] == "") {
                    continue;
                }
                $('.cusMt input[value="' +statusArrays[i] + '"]').attr("checked", "checked");
            }
            // 重点客户
            var will_status = "<?=$will_status; ?>";
            var will_statusArrays = will_status.split(",");
            for(var i = 0; i < will_statusArrays.length; i++) {
                if(will_statusArrays[i] == "") {
                    continue;
                }
                $('.zhongdian input[value="' +will_statusArrays[i] + '"]').attr("checked", "checked");
            }
            // 签约客户
            var sign_status = "<?=$sign_status; ?>";
            var sign_statusArrays = sign_status.split(",");
            for(var i = 0; i < sign_statusArrays.length; i++) {
                if(sign_statusArrays[i] == "") {
                    continue;
                }
                $('.qianyue input[value="' +sign_statusArrays[i] + '"]').attr("checked", "checked");
            }
            // 标签
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
 
        $('.cusMt input').click(function(event) {
            var checkedInputs = $(".cusMt input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&status="+temp+"&will_status=<?=$_GET['will_status'] ?>&sign_status=<?=$_GET['sign_status'] ?>&tag=<?php echo $_GET['tag']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        });
        // 签约客户右侧查询条件
        $('.qianyue input').click(function(event) {
            var checkedInputs = $(".qianyue input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&sign_status="+temp+"&will_status=<?= $_GET['will_status'] ?>&status=<?=$_GET['status']?>&tag=<?php echo $_GET['tag']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        });
         // 重点客户右侧查询条件
        $('.zhongdian input').click(function(event) {
            var checkedInputs = $(".zhongdian input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&user_chis=<?= $_GET['user_chis'] ?>&will_status="+temp+"&sign_status=<?= $_GET['sign_status'] ?>&status=<?=$_GET['status']?>&tag=<?php echo $_GET['tag']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
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
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&user_chis=<?= $_GET['user_chis'] ?>&tag="+temp+"&will_status=<?= $_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&status=<?php echo $_GET['status']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
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
    // alert(getNowFormat2())
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
                var _url="<?php echo base_url(); ?>index.php/customer/in_public_customer?&cus_id="+temp;
                $.loadPage(_url);
            }else{
                alert('请勾选你要转移的客户');
            }
        });
        $("#sort_lastContactDate").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&sortType=1&user_chis=<?= $_GET['user_chis'] ?>&will_status=<?= $_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&tag=<?=$_GET['tag']?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&status=<?php echo $_GET['status']; ?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        });
        $("#sort_Name").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&sortType=2&user_chis=<?= $_GET['user_chis'] ?>&will_status=<?= $_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&tag=<?=$_GET['tag']?>&status=<?php echo $_GET['status']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        })
        $("#sort_CreateDate").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&sortType=3&user_chis=<?= $_GET['user_chis'] ?>&will_status=<?= $_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&tag=<?=$_GET['tag']?>&status=<?php echo $_GET['status']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        });
        var sortType= $("#sortType").val();
        if (sortType==2) {
            $('#sort_Name').parent('li').addClass('on');
            $('#sort_CreateDate').parent('li').removeClass('on');
            $('#sort_lastContactDate').parent('li').removeClass('on');

        };
        if (sortType==3) {
            $('#sort_Name').parent('li').removeClass('on');
            $('#sort_CreateDate').parent('li').addClass('on');
            $('#sort_lastContactDate').parent('li').removeClass('on');

        };
        if (sortType==1) {
            $('#sort_Name').parent('li').removeClass('on');
            $('#sort_CreateDate').parent('li').removeClass('on');
            $('#sort_lastContactDate').parent('li').addClass('on');


        };
        var repeat= $("#repeat").val();
        if(repeat){
            $('#btn').trigger("click")
        }
        //转入公海
        $("#in_public_customer").click(function(){
            var id=$("#custo_id").val();
            var _url="<?php echo base_url(); ?>index.php/customer/in_public_customer?&cus_id="+id;
            $.loadPage(_url);
        });
        $("#in_customer_text").click(function(){
            var cname=$("#cus_name").text();
            $(".in_text").html('您确定将'+cname+'客户转入到公海中吗？');
        });
        $("#sousuo").click(function(){
            var type=$("#sousuo_type").val();
            var sousuo_text=$("#text_sousuo").val();
            var _url= "<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&type="+type+"&sousuo_text="+sousuo_text+"&will_status=<?= $_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&status=<?php echo $_GET['status']; ?>&tag=<?=$_GET['tag'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        });

        //点击签约
        $('.sign').click(function(event) {
            var id=$("#custo_id").val();
            var cname=$("#cus_name").text();
            $(".sign_text").text("您确定要把"+cname+"客户设置成签约客户吗？");
            $("#determine_sign").click(function(){

                $(this).attr('disabled','disabled');
                var _this = $(this);

                var sign_val = $.trim($('#sign_value').val());

                // if(sign_val == ''){
                //     alert('请输入签单金额');
                //     _this.removeAttr('disabled');
                //     return;
                // }

                // if(sign_val == '0'){
                //     alert('签单金额不能为0');
                //     _this.removeAttr('disabled');
                //     return;
                // }

                // if(isNaN(sign_val)){
                //     alert('请输入正确的签单金额');
                //     _this.removeAttr('disabled');
                //     return;
                // }

                $.post('<?php echo base_url();?>index.php/customer/set_sign',{"cus_id":id ,'sign_val':sign_val},function(data){
                    // $("#in_customer_text").addClass("hide");
                    // $(".sign").addClass("hide");
                    // $("input:checked").parent().next().find('span').removeClass('hide');

                    var info = eval(data);
                    if(info.s == 'error'){
                        alert(info.msg);
                        _this.removeAttr('disabled');
                        return;
                    }else if(info.s == 'ok'){
                        _this.removeAttr('disabled');
                        $("#in_customer_text").addClass("hide");
                        $(".sign").addClass("hide");
                        $("input:checked").parent().next().find('span').removeClass('hide');

                        $('#sign').css('display','none');
                        $('#sign').removeClass('in');
                        $('.modal-backdrop').remove();
                    }
                },'json');
            });
        });
    });
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
    $(function(){

        $('#tab-2_linkman').on('click', '.link', function(event) {
           $('body').removeClass('am-offcanvas-page');
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

        // 分页跳转
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

        // 指定跳页
         $('#tonumpage').click(function(event){            
            var tonumpage = $.trim($('.tonumpage').val());
            tonumpage = parseInt(tonumpage);
            if(!isNaN(tonumpage) && tonumpage>0){
                var href = $('.pagination li:last a').attr('data-href');
                var last_li_a = $('.pagination li:last a'); 
                if(href == 'javascript:void(0);'){
                    var href = $('.pagination li:last').prev().children('a').attr('data-href'); 
                    last_li_a = $('.pagination li:last').prev().children('a');
                }
                var pagenum = last_li_a.attr('data-ci-pagination-page');
                var reg= eval('/per_page='+pagenum+'/');
                href = href.replace(reg, 'per_page=');
                if(/&per_page=$/.test(href)){
                    href = href.replace(reg, 'per_page=') + tonumpage;
                }
                $.ajax({
                    type: "POST",
                    url: href,
                    success: function(data){
                        $("#show").html(data);
                    }
                });
            }
        });


    })
</script>
<script>
    $(function(){
        // 获取时间段
        $('.applyBtn').on('click', function(event) {
            var daterangepicker_start= $('input[name="daterangepicker_start"]').val();
            var daterangepicker_end= $('input[name="daterangepicker_end"]').val();
            var _url= "<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&user_chis=<?= $_GET['user_chis'] ?>&start_time="+daterangepicker_start+"&end_time="+daterangepicker_end+"&will_status=<?= $_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text'];?>&status=<?php echo $_GET['status']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&isPublic=<?=$_GET['isPublic'];?>&tag=<?=$_GET['tag'];?>&zhuguan=<?=$_GET['zhuguan']?>";
            $.loadPage(_url);
        });





        // @zzr edit at 2016-12-09 10:18
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
                str+='<tr>'+
                    '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                    '<td>'+item.usname+'</td>'+
                    '<td>'+item.ename+'</td>'+
                    '<td>'+item.dname+'</td>'+
                    '</tr>';
            });
            $("#table2").html(str);
        },"json");

        var chis_department_ids = "<?=$channel_ids?>";
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
                        '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                        '<td>'+item.usname+'</td>'+
                        '<td>'+item.ename+'</td>'+
                        '<td>'+item.dname+'</td>'+
                        '</tr>';
                });
                $("#table2").html(str);
            },"json");
        });

        // 查询下级部门的员工
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


        var will_count= $("#will_count").val();
        var my_will_count= $("#my_will_count").val();
        var num=will_count-my_will_count;
        //意向客户的切换
        $('.will').click(function(event) {
            var will_status;
            var will=$(this).html();
            if(num!=0||will=="是"){
                $(this).toggleClass('btn-default');
                if ($(this).html()=='否') {                   
                    $(this).html('是');
                     $(this).parent().siblings('.tdClass').find('.will_status_class').val('1');
                    will_status=1;
                    num--;
                }else{
                    $(this).html('否');
                    $('#in_customer_text').removeClass('hide');
                    $(this).parent().siblings('.tdClass').find('.will_status_class').val('0');
                    will_status=0;
                    num++;
                }
            }else{
                // alert("重点客户数量不能超过"+will_count+"个");
                showInfo("重点客户数量不能超过"+will_count+"个",'error');
            }
            var id=$(this).next().val();
            $.post("<?=base_url();?>index.php/customer/will_status_update",{"id":id,"will_status":will_status},function(){})
        });


        //指定销售
        $("#sale_user").click(function(){
           var cus_id= $("#custo_id").val();
           var user_id=$('input[name="user_id"]:checked').val();
            if (user_id) {
                $.post("<?=base_url();?>index.php/customer/appoint_sale",{"cus_id":cus_id,"user_id":user_id},function(){
                    $('.appointSale').addClass('hide');
                    $('#appointSale').modal('hide');
                    showInfo('成功','success');
                    //当前指定的销售
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/customer/appoint_users",
                        data: "customer_id="+id,
                        success: function(data){
                            var data=eval("("+data+")");
                            var str="";
                            $.each(data, function(index, val) {
                                str+='<img src="<?php echo $base_url; ?>/static/img/avatar_person.png"  title="姓名:'+val.ename+' 电话:'+val.emobile+'">';
                            });
                            $(".avatars").html(str);
                        }
                    });
                })
            }else{
                showInfo('请勾选您要指定的用户',"error");
            }
        });


        // 查询指定下级员工的客户
        $("#chis_get_user").click(function(){
           // var cus_id= $("#custo_id").val();
           var user_id=$('input[name="user_id"]:checked').val();
           var user_name = $('input[name="user_id"]:checked').parent().next().next().text();
           $('#next_cus').val(user_name);
           // alert(user_id);
           // return;
            if (user_id) {
                $('#chiscus').modal('hide');
                var _url="<?php echo base_url(); ?>index.php/customer/zhuguan_customer?&user_chis="+user_id+"&will_status=<?=$_GET['will_status'] ?>&sign_status=<?= $_GET['sign_status'] ?>&status=<?=$_GET['status']?>&tag=<?php echo $_GET['tag']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>&zhuguan=<?=$_GET['zhuguan']?>";
                $.loadPage(_url);
                $('#chiscus').modal('hide');

                if($('.modal-backdrop')){
                    $('.modal-backdrop').remove();
                }

                // $.post("<?=base_url();?>index.php/customer/appoint_sale",{"cus_id":cus_id,"user_id":user_id},function(){
                //     $('.appointSale').addClass('hide');
                //     $('#appointSale').modal('hide');
                //     showInfo('成功','success');
                //     //当前指定的销售
                //     $.ajax({
                //         type: "POST",
                //         url: "<?php echo base_url(); ?>index.php/customer/appoint_users",
                //         data: "customer_id="+id,
                //         success: function(data){
                //             var data=eval("("+data+")");
                //             var str="";
                //             $.each(data, function(index, val) {
                //                 str+='<img src="<?php echo $base_url; ?>/static/img/avatar_person.png"  title="姓名:'+val.ename+' 电话:'+val.emobile+'">';
                //             });
                //             $(".avatars").html(str);
                //         }
                //     });
                // })
            }else{
                showInfo('请勾选您要指定的用户',"error");
            }
        });
    
    })
</script>