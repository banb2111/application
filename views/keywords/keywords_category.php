<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12 col-lg-12 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">关键词查询</h4>
                        <div class="example">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="fb">
                                        <td>类别名称</td>
                                        <td>类别价格</td>
                                        <td>录入人</td>
                                        <td>录入时间</td>
                                    </tr>
                                    <?php if ($category){ ?>
                                        <?php foreach ($category as $key => $value): ?>
                                        <tr>
                                            <td class="update"><a href="javascript:void(0);"><?php echo $value['category_name'] ?><span class="hide"><?php echo $value['id'] ?></span></a></td>
                                            <td><?php echo $value['category_price'] ?></td>
                                            <td><?php echo $value['ename'] ?></td>
                                            <td><?php echo date('Y-m-d',$value['add_time']) ?></td>
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
<!-- 修改类别名称 -->
<script type="text/javascript">
    $(function(){
        $('.update a').click(function(event) {
            var id = $(this).find('span').html();
            var _url = "<?=base_url(); ?>index.php/Keywords_category/update_keyword_category?&keywords_id="+id;
            $.loadPage(_url);
        });
    })
</script>
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