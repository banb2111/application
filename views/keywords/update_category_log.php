<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12 col-lg-12 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">关键词类别日志</h4>
                        <div class="example">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="fb">
                                        <td>类别名称</td>
                                        <td>原属性</td>
                                        <td>新属性</td>
                                        <td>操作人</td>
                                        <td>操作时间</td>
                                    </tr>
                                    <?php if ($category_log){ ?>
                                        <?php foreach ($category_log as $key => $value): ?>
                                        <tr>
                                            <td><?php echo $value['category_name'] ?></td>
                                            <td>
                                                <?php if ($value['ord_cate_name']): ?>
                                                    <p>名称:<?php echo $value['ord_cate_name'] ?></p>
                                                <?php endif ?>
                                                <?php if ($value['ord_cate_price']): ?>
                                                    <p>价格:<?php echo $value['ord_cate_price'] ?></p>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <?php if ($value['new_cate_name']): ?>
                                                    <p>名称:<?php echo $value['new_cate_name'] ?></p>
                                                <?php endif ?>
                                                <?php if ($value['new_cate_price']): ?>
                                                    <p>价格:<?php echo $value['new_cate_price'] ?></p>
                                                <?php endif ?>
                                            </td>
                                            <td><?php echo $value['ename'] ?></td>
                                            <td>
                                                <?php echo date('Y-m-d H:i:s',$value['update_time']) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    <?php }else{ ?>
                                        <div class="noCustomer ">
                                            <h3>没有符合条件的客户信息</h3>
                                        </div>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="page">
                                <?php echo $pages;?>
                            </div>
                        </div>
                    </div>
                    <!-- End Example Events -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Panel Other -->

</div>
<script type="text/javascript">
// 分页
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
</script>