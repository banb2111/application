
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="setting" method="post" action="<?php echo base_url();?>index.php/system/regression_public">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">超出默认天数未跟进客户回归客户池</label>
                                <div class="col-sm-5">
                                    <input id="" name="customer_time" class="form-control" type="text" aria-required="true" aria-invalid="true" value="<?=$system[0]['customer_time']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">意向客户数量</label>
                                <div class="col-sm-5">
                                    <input id="" name="will_count" class="form-control" type="text" aria-required="true" aria-invalid="true" value="<?=$system[0]['will_count']?>">
                                </div>
                                <div class="col-sm-1 mt10">人</div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-4">
                                    <button class="btn btn-primary" type="button" id="save">保存</button>
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
    <script src="<?php echo base_url(); ?>/static/js/demo/setting-validate-demo.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#save').click(function(event) {
            $.submitForm("#setting");
        });
    })
</script>