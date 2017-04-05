
<div class="wrapper wrapper-content">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <input type="hidden" id="sortType" value="<?=$sortType;?>"/>
        <div class="ibox-content">
            <div class="row row-lg">

                <div class="col-sm-12 col-lg-10 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">公海客户</h4>
						<span style="color:green">(后期可能会随机
						取出100条，目前一条也没有没办法取，若改动会详细描述使用方式)</span>
                        <div class="example">
                            <div class="alert alert-success hide" id="examplebtTableEventsResult" role="alert">
                                事件结果
                            </div>
                            <div class="mb10 row" id="exampleTableEventsToolbar" role="group">
                               <div class="col-lg-2 mt5">
                                   <!--<a type="button" id="jianhui" class="mybtn grey small f12">
                                       <i class="fa fa-lock" aria-hidden="true"></i>全部捡回
                                   </a>-->
                                   <span class="pr">
                                       <a type="button" id="" class="mybtn grey small f12 asc" data-toggle="dropdown">
                                           <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>排序
                                       </a>
                                       <ul class="dropdown-menu" id="sort_menu">
                                        <!--  <li><a  id="sort_lastContactDate" class=""><i class="fa fa-check hide"></i> 最后联系时间</a></li>
                                         <li><a  id="sort_Name"><i class="fa fa-check hide"></i> 客户名称</a></li>
                                         <li><a  id="sort_CreateDate"><i class="fa fa-check hide"></i> 创建时间</a></li> -->

                                          <li><a  id="sort_addtime" class=""><i class="fa fa-check hide"></i> 按录入时间(降序)</a></li>
                                          <li><a  id="sort_topublictime"><i class="fa fa-check hide"></i> 按调入公海时间(降序)</a></li>

                                       </ul>
                                   </span>
                               </div>
                               <div class="col-sm-12 col-md-6 col-lg-7">
                                   <div class="col-sm-4 col-md-6 col-lg-3">
                                       <select name="" id="sousuo_type" class="form-control">
                                           <option <?php if ($type==1){?> selected="selected"<?php }?> value="1">客户名称</option>
                                           <option <?php if ($type==2){?> selected="selected"<?php }?> value="2">手机号</option>
                                           <option <?php if ($type==3){?> selected="selected"<?php }?> value="3">QQ</option>
                                           <option <?php if ($type==4){?> selected="selected"<?php }?> value="4">邮箱</option>
                                           <option <?php if ($type==10){?> selected="selected"<?php }?> value="10">推广客户</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-6 col-md-6 col-lg-5">
                                       <div class="form-group has-feedback mb">
                                         <input type="text" class="form-control" id="text_sousuo" placeholder="输入名称,快速查找客户" value="<?=$sousuo_text;?>">
                                         <span class="glyphicon glyphicon-search form-control-feedback cp" id="sousuo" style="pointer-events:auto;" aria-hidden="true"></span>
                                       </div>
                                   </div>                                                                    
                               </div>
                               <div class="col-sm-4 col-md-4 col-lg-3 hide">
                                   <div class="control-group ">
                                       <div class="controls">
                                           <div class="input-prepend input-group">

                                                <span class="add-on input-group-addon op">
                                                   <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                               </span>
                                               <input type="text" readonly="readonly" style="width:240px;position: absolute;" name="reservation" id="reservation" class="abs-right form-control" value="2016-7-14 - 2016-7-15" />
                                               <span class="glyphicon glyphicon-calendar calendar fa fa-calendar form-control-feedback" aria-hidden="true"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div> 


                               <!-- <div class="col-sm-12 mt5 col-md-3 col-lg-3 tr">
                                    <a type="button" class="pr mybtn grey small f12"data-toggle="modal" data-target="#inport">
                                        <form action="/customer/excel_in" method="post" class="hide" enctype="multipart/form-data">
                                        </form>
                                        <i class="glyphicon glyphicon-import" aria-hidden="true"></i>导入
                                    </a>
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
                                    <span class="pr more">
                                        <a href="#" title="更多操作" data-toggle="dropdown" class="button grey small"><i class="fa fa-chevron-down"></i> 更多操作</a>
                                        <ul class="dropdown-menu" id="operationMenu">
                                          <li><a id="add_reply_link" message="请选择需要转移的客户" href="#setshare-popup" title="将选择的客户转移给其他同事" class="popup-link"><i class="fa fa-mail-reply-all"></i> 转移客户</a></li>
                                          <li><a id="add_share_link" message="请选择需要共享的客户" href="#setshare-popup" title="将选择的客户共享给其他同事" class="popup-link"><i class="fa fa-share-alt"></i> 共享客户</a></li>
                                          <li><a id="remove_share_link" style="display: none;" message="请选择需要取消共享的客户" href="#removeshare-popup" title="取消客户信息的共享" class="popup-link"><i class="fa fa-share-alt"></i> 取消共享</a></li>
                                        </ul>
                                    </span>
                                </div> -->



                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover public_table" id="myTable">
                                    <thead>
                                    <tr style="width:20px;">
                                        <th>
                                            <input  type="checkbox">
                                        </th>
                                        <th>操作</th>
                                        <th>公司名称</th>
                                        <th>联系人</th>
                                        <th>联系电话</th>
                                        <th>职位</th>
                                        <th>来源渠道</th>
                                        <? if($is_custom_service[0]['type']==5){?>
                                            <th>最近一次跟进时间</th>
                                        <?php }else{ ?>
                                            <th>最近一次跟进时间</th>
                                        <?php } ?>
                                        <!-- <th>网址</th> -->
                                        <th>最后一次跟进内容</th>
										<th>最初录入部门</th>
                                    </tr>
                                    </thead>
                                    <?php if(!empty($customer)){ ?>
                                    <?php foreach($customer as $k=>$v){?>
                                        <tr >
                                            <td class="tdClass"><input type="checkbox" value="<?php echo $v->cus_id; ?>"><input type="hidden"  value="<?php echo $v->cname; ?>"><input type="hidden"  value="<?php echo $v->sta; ?>"></td>
                                            <!--                                                <td>-->
                                            <!--                                                    <span class="mr5">-->
                                            <!--                                                        <a  data-index="100" class="J_menuTab cus_up">修改</a>-->
                                                                                                     <input type="hidden" value="<?php echo $v->cus_id;?>"/>
                                            <!--                                                    </span>-->
                                            <!--                                                    <span>-->
                                            <!--                                                        <a  class="J_menuTab add_linkman">增加联系人</a>-->
                                            <!--                                                        <input type="hidden" value="--><?php //echo $v->cus_id;?><!--"/>-->
                                            <!--                                                    </span>-->
                                            <!--
                                                                                            </td>-->
                                             <td><a  class="jianhui_class" >捡回</a> <input type="hidden" value="<?php echo $v->cus_id;?>"/></td>

                                            <td class="not" >
                                              <?php echo $v->cname; ?>

                                              <p class="mb">
                                                  <?php if($v->sign_status==1){ ?><span class="callSign cp">签约</span>  <?php }else{ ?><span class="callSign cp hide">签约</span><?php } ?>
                                                  <?php if ($v->extend_status==1): ?>
                                                      <span class="extension cp">推广</span>                                                            
                                                  <?php endif ?>
                                              </p>

                                            </td>
                                            <td class="not" ><?php echo $v->linkman_name; ?></td>
                                            <td class="not" ><?php echo $v->linkman_mobile;?> <?php if(!empty($v->cus_tel)) echo '/<br/>'.$v->cus_tel;?></td>
                                            <td class="not" ><?php echo $v->linkman_job;?></td>
                                             <td class="not" ><?php 
                                                echo $v->channel_str; 
                                            ?></td>
                                            <td class="not" >
                                                <? if($is_custom_service[0]['type']==5){?>
                                                    <?php echo $v->last_follow_time; ?>
                                                <?php }else{ ?>
                                                    <?php echo $v->last_follow_time; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- <td class="not" data-am-offcanvas="{target: '#doc-oc-demo3'}"><?php echo $v->linkman_URL; ?></td> -->
                                            <td class="not" ><?php echo $v->last_follow_content; ?></td>
											<td class="not" ><?php echo $v->dname; ?></td>
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

                     <div class="cusMt_ch" style="margin-top:10px;">
                        <h4 class="" style="border-bottom:1px solid #ccc; padding-bottom: 4px;">客户来源渠道</h4>
                        <div class="mtch">
                            <input type="checkbox" id="all_ch" value='-1'>  <label for="all_ch">不限</label>
                        </div>


                        <?php
                          foreach($all_channels as $all_ch_val){
                        ?>  
                        <div class="mtch">
                            <input type="checkbox" id="ch_<?=$all_ch_val['id']?>" value='<?=$all_ch_val['id']?>'>  <label for="ch_<?=$all_ch_val['id']?>"><?php echo $all_ch_val['channel_name']; ?></label>
                        </div>
                         <?php

                          }
                         ?>


                        <!-- <div class="mt10">
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
                        </div> -->
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
                       <div class="col-sm-10">
                           <h1 class="title">
                               <span id="state"></span>
                               <span id="cus_name"></span>
                               <span class="callIPone cp" id="hx_out_hx_public_customer">捡回</span>
                               <span class="callMail cp hide">发邮件</span>
                           </h1>
                           <div class="tagShow">
                               <div id="cus_tag" style="float: left;"></div>
                                <a href="#" class="editTag hide" style="float: left;"><i class="fa fa-pencil"></i> 修改标签</a>
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
                       <div class="col-sm-1 hide">
                           <div class="edit">
                                <a  title="编辑客户资料" class="pull-right cus_up hide"><i class="fa fa-pencil f12"></i></a>
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
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">联系人</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="">
                                        <div class="hide">
                                            <div class="form-horizontal m-t">
                                                <input type="hidden" id="custo_id"/>
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
                                <button class="btn btn-primary mt10 add_linkman hide">添加客户联系人</button>
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
</div>

<script type="text/javascript">
    $(function(){
        $('#inputEmail3').focus();
        $(".add_linkman").click(function(){
            var customer_id=$("#custo_id").val();
            var _url="<?php echo  base_url();?>index.php/customer/linkman/"+customer_id;
            $.loadPage(_url);
        });
        $(".cus_up").click(function(){
            var customer_id=$("#custo_id").val();
            var _url="<?php echo  base_url();?>index.php/customer/customer_update/"+customer_id;
            $.loadPage(_url);
        });

        /*点击table触发复选框*/
        $(".public_table").find("td.not").click(function(){
            var ww = $(window).width()-800;
            $('.closeoffcanvas').width(ww);
            $('body').addClass('am-offcanvas-page');
            $('#doc-oc-demo3').addClass('am-active');
            $('#doc-oc-demo3').attr('data-garbage', 'true');
            $('.am-offcanvas-bar').addClass('am-offcanvas-bar-active');
            var _tr = $(this).parents('tr');
            var id= _tr.find(":checkbox").attr("value");
            var name=_tr.find(":checkbox").next().attr('value');
            var state=_tr.find(":checkbox").next().next().attr('value');
            var cous=$("#custo_id").val(id);
            if(id!=cous){
                $("#cus_name").text(name);
                cus_status(id);
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
                    url: "<?php echo base_url(); ?>index.php/customer/ajax_linkman",
                    data: "customer_id="+id+"&public=1",
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
            }
        });
          // 点击关闭右侧
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
            // alert(status);
            var statusArrays = status.split(",");
            for(var i = 0; i < statusArrays.length; i++) {
                if(statusArrays[i] == "") {
                    continue;
                }
                $('.cusMt input[value="' +statusArrays[i] + '"]').attr("checked", "checked");
            }
            var tags="<?=$tag?>";
            // alert(tags);
            var tagsArrays = tags.split(",");
            for(var i = 0; i < tagsArrays.length; i++) {
                if(tagsArrays[i] == "") {
                    continue;
                }
                // alert(tagsArrays[i]);
                $('input[value="'+ tagsArrays[i] +'"]').prev().attr("class","fa fa-fw fa-check-square-o");
            }
            // alert('标签');
            
            // @zzr edit at 2016-12-19 14:30
            var chids = "<?= $chids; ?>";
            var chidsArrays = chids.split(",");
            for(var i = 0; i < chidsArrays.length; i++) {
                if(chidsArrays[i] == "") {
                    continue;
                }
                $('.cusMt_ch input[value="' +chidsArrays[i] + '"]').attr("checked", "checked");
            }
        }
        initStatus();
        // 客户表右侧查询条件
//        var arr = [];
        $('.cusMt input').click(function(event) {
            
            // 意向度
            var checkedInputs = $(".cusMt input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }

            // 来源渠道分类
            var checkedInputs_ch = $(".cusMt_ch input:checked");
            var chids = "";
            if(!checkedInputs_ch){
                chids=-1;
            }
            for(var i = 0; i < checkedInputs_ch.size(); i++) {
                chids += checkedInputs_ch[i].value + ",";
            }

            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&status="+temp+"&chids="+chids+"&tag=<?php echo $_GET['tag']; ?>&cus_state=<?=$_GET['cus_state'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        });


        // 客户来源渠道查询条件
        $('.cusMt_ch input').click(function(event) {

            // 意向度
            var checkedInputs = $(".cusMt input:checked");
            var temp = "";
            if(!checkedInputs){
                temp=-1;
            }
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }

            // 来源渠道分类
            var checkedInputs_ch = $(".cusMt_ch input:checked");
            var chids = "";
            if(!checkedInputs_ch){
                chids=-1;
            }
            for(var i = 0; i < checkedInputs_ch.size(); i++) {
                chids += checkedInputs_ch[i].value + ",";
            }

            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&status="+temp+"&chids="+chids+"&tag=<?php echo $_GET['tag']; ?>&cus_state=<?=$_GET['cus_state'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>";
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


            // 来源渠道分类
            var checkedInputs_ch = $(".cusMt_ch input:checked");
            var chids = "";
            if(!checkedInputs_ch){
                chids=-1;
            }
            for(var i = 0; i < checkedInputs_ch.size(); i++) {
                chids += checkedInputs_ch[i].value + ",";
            }

            noCustomer ()
            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&tag="+temp+"&chids="+chids+"&status=<?php echo $_GET['status']; ?>&cus_state=<?=$_GET['cus_state'];?>&sortType=<?=$_GET['sortType']?>&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text']?>&start_time=<?=$_GET['start_time']?>&end_time=<?=$_GET['end_time']?>&isPublic=<?=$_GET['isPublic'];?>";
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
        // $('.noCustomer')
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
        //分页跳转
        $('.pagination').on('click', 'a', function(event) {
            var href = $(this).attr('data-href');
            $.ajax({
                type: "POST",
                url: href,
                success: function(data){
                    $("#show").html(data);
                }
            });
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

<script>
    $(function(){

        $("#jianhui").click(function(){
            var checkedInputs = $(".tdClass input:checked");
            var temp="";
            for(var i = 0; i < checkedInputs.size(); i++) {
                temp += checkedInputs[i].value + ",";
            }
            if(temp){
                var _url="<?php echo base_url(); ?>index.php/customer/hx_out_hx_public_customer?&cus_id="+temp;
                $.loadPage(_url);
            }else{
               showInfo('请勾选要捡回的客户！',"error");
            }
        });
        $(".jianhui_class").click(function(){
            var cus_id=$(this).next().val();
            var _url="<?php echo base_url(); ?>index.php/customer/hx_out_hx_public_customer?&cus_id="+cus_id;
            $.loadPage(_url);
        })
        $("#hx_out_hx_public_customer").click(function(){
            var id=$("#custo_id").val();
            var _url="<?php echo base_url(); ?>index.php/customer/hx_out_hx_public_customer?&cus_id="+id;
            $.loadPage(_url);
        });

        // @zzr edit at 2016-12-19 16:38 按录入时间排序
        $("#sort_addtime").click(function(){
           var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&sortType=10&tag=<?=$_GET['tag']?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&status=<?php echo $_GET['status']; ?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        });
        // @zzr edit at 2016-12-19 16:43 按导入公海时间排序
        $("#sort_topublictime").click(function(){
           var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&sortType=11&tag=<?=$_GET['tag']?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&status=<?php echo $_GET['status']; ?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        });



        $("#sort_lastContactDate").click(function(){
           var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&sortType=1&tag=<?=$_GET['tag']?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&status=<?php echo $_GET['status']; ?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        });
        $("#sort_Name").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&sortType=2&tag=<?=$_GET['tag']?>&status=<?php echo $_GET['status']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        })
        $("#sort_CreateDate").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&sortType=3&tag=<?=$_GET['tag']?>&status=<?php echo $_GET['status']; ?>&linkType=<?=$_GET['linkType'];?>&linkDay=<?=$_GET['linkDay'];?>&type=<?=$_GET['type'];?>&sousuo_text=<?=$_GET['sousuo_text'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>";
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
        $("#sousuo").click(function(){
            var type=$("#sousuo_type").val();
            var sousuo_text=$("#text_sousuo").val();
            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&type="+type+"&sousuo_text="+sousuo_text+"&status=<?php echo $_GET['status']; ?>&cus_state=<?=$_GET['cus_state'];?>&sortType=<?=$_GET['sortType']?>&tag=<?=$_GET['tag'];?>&start_time=<?=$_GET['start_time'];?>&end_time=<?=$_GET['end_time'];?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        });
// 获取时间段
        $('.applyBtn').on('click', function(event) {
            var daterangepicker_start= $('input[name="daterangepicker_start"]').val();
            var daterangepicker_end= $('input[name="daterangepicker_end"]').val();
            var _url="<?php echo base_url(); ?>index.php/customer/menulist/hx_public_customer?&start_time="+daterangepicker_start+"&end_time="+daterangepicker_end+"&type=<?=$_GET['type']?>&sousuo_text=<?=$_GET['sousuo_text'];?>&status=<?php echo $_GET['status']; ?>&cus_state=<?=$_GET['cus_state'];?>&sortType=<?=$_GET['sortType']?>&tag=<?=$_GET['tag'];?>&isPublic=<?=$_GET['isPublic'];?>";
            $.loadPage(_url);
        });
    });
</script>



<script>
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
    //$(document).ready(function() {
        $(".daterangepicker").remove();
        $('#reservation').daterangepicker(null, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

    $("#myTable").tableCheck("success");


// });
</script>

<style type="text/css">
.cusMt_ch{
  border-bottom: 1px solid #ccc;
}

.cusMt_ch .mtch{
  width: 100%;
  font-size: 12px;
}
  
</style>