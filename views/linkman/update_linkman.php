<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑客户联系人</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ;?>index.php/customer/update_linkman?&per_page=<?= $str= $_SERVER['HTTP_REFERER'];$page=substr($str, -1);?>" id="adduser_form">
                        <?php foreach($linkman as $k=>$val){ ?>
                        <input type="hidden" name="cus_id" value="<?php echo $val['customer_id']; ?>"/>
                            <input type="hidden" name="link_id" value="<?php echo $val['id']; ?>"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input id="" name="name" class="form-control" type="text" required="" aria-required="true" value="<?=$val['name']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电话</label>
                            <div class="col-sm-9">
                                <input id="" name="mobile" class="form-control" type="text"required="" aria-required="true" value="<?=$val['mobile']?>">
                                <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">QQ</label>
                            <div class="col-sm-9">
                                <input id="" name="qq" class="form-control" type="text" value="<?=$val['qq']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">微信</label>
                            <div class="col-sm-9">
                                <input id="" name="wechat" class="form-control" type="text" value="<?=$val['wechat']?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-9">
                                <input id="" name="email" class="form-control"type="email" value="<?=$v['email']?>">
                                <!-- <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">职位</label>
                            <div class="col-sm-9">
                                <select name="position_id" id="" class="form-control">
                                    <?php foreach($position as $k=>$va){?>
                                        <option <?php if($v['position_id']==$va->id){?> selected="selected" <?php }?> value="<?php echo $va->id; ?>" ><?php echo $va->name; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">备注</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="remark" rows="3" value="<?=$val['remark']?>"><?=$val['remark']?></textarea>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-2">
                                <input class="btn btn-primary" type="button" id="customer_add_id" value="确认修改"/>
                                <a class="btn btn-default quxiao">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>/static/js/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>/static/js/plugins/validate/messages_zh.min.js"></script>
<script src="<?php echo base_url(); ?>/static/js/demo/customer-validate-demo.min.js"></script>
</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/form_validate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:16 GMT -->
</html>
<script type="text/javascript">
    $(function(){
        $("#customer_add_id").click(function(){
            $.submitForm('#adduser_form');
            // $("").submit();
        })
        $(".quxiao").click(function(){
            var _url="<?php echo base_url(); ?>index.php/customer";
            $.loadPage(_url);
        });
    });
</script>
