<div class="modal inmodal fade" id="next_quitMan_info" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" style="font-size:18px;font-weight: normal;">确认离职信息</h4>
                </div>
                <div class="modal-body p10 clearfix">
                    <form class="form-horizontal m-t" id="add" method="post" action="http://nbcrm.my/index.php/customer/customer_add">
                             <div class="col-sm-12 col-md-8 col-lg-12">  
                              <div class="form-group">
                                     <label class="col-sm-3 control-label">离职人</label>
                                     <div class="col-sm-9 col-lg-9 col-md-9 ">
                                        <div class="radio">
                                          <label class="inputSuccess4">
                                          </label>
                                        </div>
                                     </div>
                                 </div>                                
                                 <div class="form-group group hide quitInfo">
                                     <label class="col-sm-3 control-label">离职人信息</label>
                                     <div class="col-sm-9">
                                        <div class="radio">
                                          <label>
                                             <p>姓名:<span class="fb uname">jay</span></p>
                                             <p>账号:<span class="fb ename">jay</span></p>
                                             <p>部门:<span class="fb dname">jay</span></p>
                                          </label>
                                        </div>
                                        
                                     </div>
                                 </div>      

                               <div class="form-group">
                                     <label class="col-sm-3 control-label">交接人</label>
                                     <div class="col-sm-9 col-lg-9 col-md-9 ">
                                        <div class="radio">
                                          <label class="inputSuccess">
                                            
                                          </label>
                                        </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-sm-3 control-label">交接内容</label>
                                     <div class="col-sm-9 col-lg-9 col-md-9">
                                        <div class="radio">
                                          <label>
                                            交接客户信息: <span class="inputcontent"></span>个
                                          </label>
                                        </div>
                                        
                                     </div>
                                 </div>  
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">账号处理方式</label>
                                    <div class="col-sm-9">
                                        <div class="radio">
                                          <label>
                                            禁用账号
                                          </label>
                                        </div>
                                    </div>
                                </div>                                
                                 <div class="form-group hide">
                                    <label class="col-sm-3 control-label">离职时间</label>
                                    <div class="col-sm-9 ">
                                      <div class="radio">
                                          <label class="next">
                                            
                                          </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">备注</label>
                                    <div class="col-sm-9">
                                        <textarea name="content" disabled  id="" class="form-control content" row="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="confirm_leave">确认离职</button>
                    <button class="btn btn-default" id=""  data-dismiss="modal">返回修改</button>
                </div>
            </div>
        </div>
    </div>