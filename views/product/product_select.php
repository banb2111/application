<div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">           
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:45PX;">
                    <h5>产品选择</h5>
                </div>                    
                 <div class="ibox-content col-sm-12" style="padding-top:0;">
                    <form class="form-horizontal m-t" id="addKey" method="post" action="">
                         <div class="col-sm-12 col-md-8 col-lg-6">  
                            <div class="form-group">
                                 <label class="col-sm-2 control-label">产品关键字</label>
                                 <div class="col-sm-7 col-lg-7 col-md-7">
                                     <input id="" name="product_name" class="form-control" type="text">
                                 </div>
                                 <div class="col-lg-2">
                                     <button class="btn btn-primary">搜索</button>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">选择产品</label>
                                 <div class="col-sm-7 col-lg-7 col-md-7">
                                     <textarea name="" id=""  class="form-control"></textarea>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">产品属性1</label>
                                 <div class="col-sm-7 col-lg-7 col-md-7">
                                     <input id="" name="product_name" class="form-control" type="text">
                                     <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>产品属性1的说明</span>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">选择关键词</label>
                                 <div class="col-sm-7 col-lg-7 col-md-7">
                                     <textarea name="" id=""  class="form-control"></textarea>
                                 </div>
                             </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">标准价格</label>
                                 <div class="col-sm-7 col-lg-7 col-md-7">
                                     <p class="mt7 fb" style="color:red;">6000</p>
                                 </div>
                             </div>
                              <div class="form-group">
                                <div class="col-sm-7 col-sm-offset-2">
                                    <button class="btn btn-primary" id="save_product" type="button">保存</button>
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
         // 验证
            var e = "<i class='fa fa-times-circle'></i>";
            var verify = $("#addKey").validate({
                rules: {
                    product_name: {
                        required: !0
                    }
                },
                messages: {
                    product_name: {
                        required: e + "必填"
                    }
                }
            })
            $("#save_product").click(function(){
                if(verify.form()) {                
                }
            })
    })
</script>