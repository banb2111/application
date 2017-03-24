
    <style>
        /* Additional style to fix warning dialog position */

        #alertmod_table_list_2 {
            top: 900px !important;
        }
    </style>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <h3 class="mb20">反馈列表</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="w150">反馈人</th>
                            <th class="w150">反馈时间</th>
                            <th>反馈内容</th>
                        </tr>
                    </thead>
                    <?php foreach($feedback as $k=>$v){ ?>
                    <tr>
                        <td><?php echo $v->name; ?></td>
                        <td><?php echo date('y-m-d H:i:s',$v->add_time); ?></td>
                        <td><?php echo $v->description; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

