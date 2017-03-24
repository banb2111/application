<!-- 产品分类 -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12 col-lg-6 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">产品列表</h4>
                        <div class="example">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td>排序</td>
                                        <td>分类名称</td>
                                        <td>操作</td>
                                    </tr>
                                    <td>
                                        <input type="text" class="form-control w50" value="0">
                                    </td>
                                    <td>域名</td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr1">添加子类</a>
                                        <a href="javascript:void(0);" class="mr1" data-toggle="modal"data-target="#attribute">属性设置</a>
                                        <a href="javascript:void(0);" class="mr1">修改</a>
                                        <a href="javascript:void(0);" class="mr1">删除</a>
                                    </td>
                                </table>
                            </div>    	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 属性设置弹出框 -->
<div class="modal fade" id="attribute">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">属性设置</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="productClass">
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">属性名称</label>
            <div class="col-sm-10">
              <input type="" name="product_name" class="form-control" >
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">属性类型</label>
            <div class="col-sm-10">
              <select name="" id="" class="form-control">
                  <option value="">文本框</option>
                  <option value="">时间选择框</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">是否必填</label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <input type="radio" name="required" id="" value="option1" checked="checked"> 是
              </label>
              <label class="radio-inline">
                <input type="radio" name="required" id="" value="option2"> 否
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">禁止修改</label>
            <div class="col-sm-10">
              <label class="radio-inline">
                <input type="radio" name="stopUpdate" id="" value="option1" checked="checked"> 是
              </label>
              <label class="radio-inline">
                <input type="radio" name="stopUpdate" id="" value="option2"> 否
              </label>
               <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>提交之后将不能修改字段值</span>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">字段提示</label>
            <div class="col-sm-10">
              <input type="" class="form-control" >
               <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 对字段简短的提示,来说明这个字段是干什么的</span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"  data-dismiss="modal">关闭</button>
        <button type="button"id="save_product" class="btn btn-primary">保存</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(function(){
         // 验证
            var e = "<i class='fa fa-times-circle'></i>";
            var verify = $("#productClass").validate({
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
                var product_name = $('input[name="product_name"]').val();
                if(verify.form()) {                
                   alert(product_name);
                }
            })
    })
</script>