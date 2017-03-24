<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12 col-lg-12 col-md-10">
                    <!-- Example Events -->
                    <div class="example-wrap">
                        <h4 class="example-title">关键字查询列表</h4>
                        <div class="example">
                            <div class="mb10 mt10 row form-inline" id="exampleTableEventsToolbar" role="group">                                
                                <div class="col-sm-4 col-md-4 col-lg-3">
                                      <div class="form-group">
                                        <label for="keyName">关键词名称</label>
                                        <input type="text" class="form-control" id="keyName" value="<?=$keyword_name;?>">
                                      </div>
                                </div>
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <label for="username">关键词类别</label>
                                    <select name="keyCategroy" id="" class="form-control">
                                        <option value="">请选择</option>
                                        <?php foreach ($keyword_category as $key => $value): ?>
                                            <option <?php if($category_id==$value['id']){?> selected="selected" <?php } ?> value="<?php echo $value['id'] ?>"><?php echo $value['category_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-5 col-lg-3">
                                   <div class="form-group">
                                        <label for="keyIndustry">关键词行业</label>
                                        <input type="text" name="keyIndustry" class="form-control" id="keyIndustry" value="<?=$industry_name?>">
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-primary" id="key_search">搜索</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr class="fb">
                                        <td>关键词名称</td>
                                        <td>类别</td>
                                        <td>行业</td>
                                        <td>第一页</td>
                                        <td>第二页</td>
                                        <td>第三页</td>
                                        <td>录入人</td>
                                        <td>录入时间</td>
                                    </tr>
                                    <?php if (!empty($keyword)){ ?>
                                        <?php foreach ($keyword as $key => $value){ ?>
                                            <tr class="optimization">
                                                <td><a class="baidu" href="http://www.baidu.com/s?wd=<?php echo $value['keyword'] ?>" target="_blank"><?php echo $value['keyword'] ?></a></td>
                                                <td><?php echo $value['category_name'] ?></td>
                                                <td><?php echo $value['industry'] ?></td>
                                                <td>
                                                    <?php if($value['one_chance']){?>
                                                        <p>概率：<?php echo $value['one_chance']?>%</p>
                                                    <?php } ?>
                                                    <?php if($value['one_time']){?>
                                                        <p>时间：<?php echo $value['one_time']?>天</p>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($value['two_chance']){?>
                                                        <p>概率：<?php echo $value['two_chance']?>%</p>
                                                    <?php } ?>
                                                    <?php if($value['two_time']){?>
                                                        <p>时间：<?php echo $value['two_time']?>天</p>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($value['three_chance']){?>
                                                        <p>概率：<?php echo $value['three_chance']?>%</p>
                                                    <?php } ?>
                                                    <?php if($value['three_time']){?>
                                                        <p>时间：<?php echo $value['three_time']?>天</p>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $value['ename'] ?></td>
                                                <td><?php echo date('Y-m-d',$value['add_time']) ?></td>
                                            </tr>
                                        <?php } ?>
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
<!-- 时间插件 -->
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
<script type="text/javascript">
    $(document).ready(function() {
        $(".daterangepicker").remove();
          $('#reservation').daterangepicker(null, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
          });
    });
</script>
<script type="text/javascript">
    // 搜索
    $('#key_search').click(function(event) {

        var name = $('#keyName').val();
        var keyCategroy = $('select[name="keyCategroy"]').val();
        var keyIndustry = $('input[name="keyIndustry"]').val();
        var _url="<?php echo base_url();?>index.php/keywords_category/keywords_list?&keyword="+name+"&category_id="+keyCategroy+"&industry_name="+keyIndustry+"";
        $.loadPage(_url);

    });
    // 点击优化跳转
    $('.optimization a').click(function(event) {
        var id = $(this).next().val();
        var _url = "<?=base_url(); ?>index.php/Keywords_category/optimize_set?&id="+id;
        $.loadPage(_url);
    });
</script>