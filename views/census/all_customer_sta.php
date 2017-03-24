    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
             <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title clearfix">
                        <h5 class="pull-left">客户所有者统计</h5>
                        <div class="form-horizontal">
                        	 <div class="col-lg-6 col-md-6">
                    	        <div class="form-group">
                    	           <label for="inputEmail3" class="col-sm-3 control-label">部门</label>
                    	           <div class="col-sm-9">
                    	            <select class="form-control" id="department">
                                          <option value="0">全部</option>
                                        <?php foreach($department as $k=>$v){ ?>
                                            <option value="<?=$v['id']?>"><?=$v['name']?></option>
                                        <?php } ?>
                                        </select>
                    	           </div>
                    	         </div>             	
                        	</div>
                        	
                        </div>
                       
                        <div class="btn-group pull-right hide" id="" role="group">
                            <button type="button" class="btn btn-outline btn-primary active">日</button>
                            <button type="button" class="btn btn-outline btn-primary">周</button>
                            <button type="button" class="btn btn-outline btn-primary">月</button>                           
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <button class="btn btn-primary" id="chaxun">查询</button>
                        </div>
                    </div>
                    <div class="ibox-content clearfix" >
                         <table class="table" id="all_customer" >

                         </table>
                        <div id="cus_count"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script type="text/javascript">
   $(document).ready(function() {
       all_customer_sta();
       $("#chaxun").click(function(){
           var department= $("#department").val();
           all_customer_sta(department);
       });
      $('#reservation').daterangepicker(null, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#reservation2').daterangepicker(null, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
       function  all_customer_sta(department){
           $.post("<?=base_url();?>index.php/statistical/all_user_owner",{"department":department},function(data){
               var str='<thead> <tr class="fb">'+
                   '<td>销售员</td>'+
                   '<td>客户数量</td>'+
                   '<td>比率</td>'+
                   '</tr></thead>';
               var cus_count=0;
               $.each(data,function(i,item){
                   str+='<tr>'+
                       '<td>'+item.ename+'</td>'+
                       '<td>'+item.num+'</td>'+
                       '<td>'+item.baifen+'</td>'+
                       '</tr>';
                   cus_count+=parseInt(item.num);
               });
               $("#cus_count").html("合计："+cus_count);
               $("#all_customer").html(str);
           },"json");
       }
   });
   </script>
 