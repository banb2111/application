<div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">           
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:45PX;">
                    <h5>添加产品</h5>
                </div>                    
                 <div class="ibox-content col-sm-12" style="padding-top:0;">
                    <form class="form-horizontal m-t" id="addKey" method="post" action="">
                         <div class="col-sm-12 col-md-8 col-lg-6">  
                            <div class="form-group">
                                 <label class="col-sm-2 control-label">产品名称</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                     <input id="" name="product_name" class="form-control" type="text" required=""required="true" value="" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">所属分类</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                    <select name="" id="" class="form-control">
                                        <option value="">请选择所属分类</option>
                                    </select>
                                 </div>
                                 <!-- <div class="col-sm-1 errorStar">*</div> -->
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">所属产品线</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                    <select name="" id="" class="form-control">
                                        <option value="">请选择所属分类</option>
                                    </select>
                                 </div>
                                 <!-- <div class="col-sm-1 errorStar">*</div> -->
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-2 control-label">标准报价</label>
                                 <div class="col-sm-9 col-lg-9 col-md-9">
                                     <input id="" name="product_name" class="form-control" type="text" required=""required="true" value="" >
                                 </div>
                                 <!-- <div class="col-sm-1 errorStar">*</div> -->
                             </div>
                              <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-2">
                                    <button class="btn btn-primary" id="save_product" type="button">保存</button>
                                    <button class="btn btn-default" id="">重置</button>
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
                    keyword_id: {
                        required: !0
                    }
                },
                messages: {
                    keyword_id: {
                        keyword_id: e + "必填"
                    }
                }
            })
            $("#save_product").click(function(){
                var product_name = $('input[name="product_name"]').val();
                if(verify.form()) {                
                   alert(product_name);
                }
            })
    })
</script>