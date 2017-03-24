<div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">           
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="min-height:45PX;">
                    <h5>添加合同</h5>
                </div>                    
                 <div class="ibox-content col-sm-12" style="padding-top:0;">
                    <form class="form-horizontal m-t" id="addKey" method="post" action="">
                         <div class="col-sm-12 col-md-8 col-lg-6">  
                            <div class="form-group">
                                 <label class="col-sm-3 control-label">合同编号</label>
                                 <div class="col-sm-3 col-lg-8 col-md-8">
                                     <input id="" name="contract_id" class="form-control" type="text" required=""required="true" value="" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">客户名称</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="" name="customer_name" class="form-control" type="text" required=""required="true" value="" >
                                     <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                        <span id="inputSuccess4Status" class="sr-only">(success)</span>
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">合同报价</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="" name="contract_price" class="form-control" type="text" required=""required="true" value="" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">合同生效时间</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="next_time" name="next_time" class="layer-date form-control w" style="max-width:100%;" required=""required="true">
                                      <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                      <span id="inputSuccessStatus" class="sr-only">(success)</span>
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">实付价格</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="" name="" class="form-control" type="text" required=""required="true" value="" >
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">合同备注</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                    <textarea name=""  class="form-control"></textarea>
                                 </div>
                             </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-sm-3 control-label">附件</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                <input type="file" id="exampleInputFile">
                            </div>
                              </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label class="col-sm-3 control-label">联系人</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                    <select name="" id="" class="form-control">
                                        <option value="">-请选择-</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">合同签约时间</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                      <input id="sign" name="sign" class="layer-date form-control w" style="max-width:100%;" required=""required="true">
                                      <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                      <span id="inputSuccessStatus" class="sr-only">(success)</span>
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">合同到期时间</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                     <input id="expire" name="expire" class="layer-date form-control w" style="max-width:100%;" required=""required="true">
                                      <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                      <span id="inputSuccessStatus" class="sr-only">(success)</span>
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">合同执行时间</label>
                                 <div class="col-sm-8 col-lg-8 col-md-8">
                                      <input id="implement" name="implement" class="layer-date form-control w" style="max-width:100%;" required=""required="true">
                                      <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true" style="right:16px;"></span>
                                      <span id="inputSuccessStatus" class="sr-only">(success)</span>
                                 </div>
                                 <div class="col-sm-1 errorStar">*</div>
                             </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-lg-8">
                                    <a class="btn btn-primary" >添加产品</a>
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>序号</td>
                            <td>产品名称</td>
                            <td>所属分类</td>
                            <td>所属产品线</td>
                            <td>产品类型</td>
                            <td>政策成本</td>
                            <td>标准报价</td>
                            <td>操作</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>.com域名</td>
                            <td>域名</td>
                            <td>前端</td>
                            <td>独立产品</td>
                            <td>1200</td>
                            <td>1000</td>
                            <td><a href="">删除</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 初始化时间 -->
    <script type="text/javascript">
        $(function(){
            // 获取当前时间
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
            $('#next_time').click(function(event) {
                laydate({
                    elem: "#next_time",
                    event: "",
                    format: "YYYY/MM/DD",                    
                    festival: true,
                    min: laydate.now(),
                    max: "2099-06-16 23:59:59",
                    start: getNowFormatDate()
                });
            });
            $('#sign').click(function(event) {
                laydate({
                    elem: "#sign",
                    event: "",
                    format: "YYYY/MM/DD",                    
                    festival: true,
                    min: laydate.now(),
                    max: "2099-06-16 23:59:59",
                    start: getNowFormatDate()
                });
            });
            $('#expire').click(function(event) {
                laydate({
                    elem: "#expire",
                    event: "",
                    format: "YYYY/MM/DD",                    
                    festival: true,
                    min: laydate.now(),
                    max: "2099-06-16 23:59:59",
                    start: getNowFormatDate()
                });
            });
             $('#implement').click(function(event) {
                laydate({
                    elem: "#implement",
                    event: "",
                    format: "YYYY/MM/DD",                    
                    festival: true,
                    min: laydate.now(),
                    max: "2099-06-16 23:59:59",
                    start: getNowFormatDate()
                });
            });
        })
    </script>
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