<!--共享用户弹出框多选分页-->
<script>
    // 全选切换
    function funCheck (obj) {
        // alert(obj);
        var allCheck = $(obj).find("th").find(':checkbox');
        allCheck.click(function(event) {
            var set = $(this).parents('table').find('td').find(':checkbox')
            if($(this).prop("checked")){
                $.each(set,function(i,v){
                    $(v).prop("checked",true);
                });
            }else{
                $.each(set,function(i,v){
                    $(v).prop("checked",false);
                });
            }
        });
        var checks = $(obj).find('td').find(':checkbox');
        checks.click(function(event) {
            var leng = $(this).parents('table').find('td').find(':checkbox:checked').length;
            if(leng == checks.length){
                allCheck.prop('checked',true);
            }else{
                allCheck.prop("checked",false);
            }
        });
    }
    //弹框分页
    var num =1;
    var page = 10;
    $('#num').html(num);
    // 多选分页
    function mup (obj) {
        var checkedInputs = $(".tdClass input:checked");
        var cus_id="";
        for(var i = 0; i < checkedInputs.size(); i++) {
            cus_id += checkedInputs[i].value + ",";
        }
        var department_id = $(obj).find('select').val();
        num--;
        if (num<1) {
            num=1
        }
        $.post('<?=base_url();?>index.php/share/get_users',{"per_page":num,"department_id":department_id,"cus_id":cus_id}, function(data) {
            var str;
            str='<tr>'+
                '<th><input type="checkbox" /></th>'+
                '<th>用户名</th>'+
                '<th>用户姓名</th>'+
                '<th>部门</th>'+
                ' </tr>';
            $.each(data,function(i,item){
                str+='<tr>'+
                    '<td><input type="checkbox" name="user_id" value="'+item.id+'"></td>'+
                    '<td>'+item.usname+'</td>'+
                    '<td>'+item.ename+'</td>'+
                    '<td>'+item.dname+'</td>'+
                    '</tr>';
            });
            $(obj).find('table').html(str);
            funCheck('#share_colleagueTable');
        },"json");
    }
    function mdown (obj) {
        var checkedInputs = $(".tdClass input:checked");
        var cus_id="";
        for(var i = 0; i < checkedInputs.size(); i++) {
            cus_id += checkedInputs[i].value + ",";
        }
        var department_id = $(obj).find('select').val();
        $.post('<?=base_url();?>index.php/share/get_user_count',{"department_id":department_id,"cus_id":cus_id}, function(pages) {
            var count = 0;
            if (pages % page != 0) count = 1;
            var pagesize =parseInt(pages / page) + count;
            num++;
            if (num<1) {
                num=1
            }else if(num>pagesize){
                num=pagesize;
            }
            $.post('<?=base_url();?>index.php/share/get_users',{"per_page":num,"department_id":department_id,"cus_id":cus_id}, function(data) {
                var str;
                str='<tr>'+
                    '<th><input type="checkbox"/></th>'+
                    '<th>用户名</th>'+
                    '<th>用户姓名</th>'+
                    '<th>部门</th>'+
                    ' </tr>';
                $.each(data,function(i,item){
                    str+='<tr>'+
                        '<td><input type="checkbox" name="user_id" value="'+item.id+'"></td>'+
                        '<td>'+item.usname+'</td>'+
                        '<td>'+item.ename+'</td>'+
                        '<td>'+item.dname+'</td>'+
                        '</tr>';
                });
                $(obj).find('table').html(str);
                funCheck('#share_colleagueTable');
            },"json");
        });
    }
    //分享客户查询部门
    $('#share_colleague_query').click(function() {
        var checkedInputs = $(".tdClass input:checked");
        var temp="";
        for(var i = 0; i < checkedInputs.size(); i++) {
            temp += checkedInputs[i].value + ",";
        }
        var department_id = $('#share_colleague').find('select').val();
        $.post('<?=base_url();?>index.php/share/get_users',{"per_page":1,"department_id":department_id,"cus_id":temp}, function(data) {
            var str;
            str='<tr>'+
                '<th><input type="checkbox" /></th>'+
                '<th>用户名</th>'+
                '<th>用户姓名</th>'+
                '<th>部门</th>'+
                ' </tr>';
            $.each(data,function(i,item){
                str+='<tr>'+
                    '<td><input type="checkbox" name="user_id" value="'+item.id+'"></td>'+
                    '<td>'+item.usname+'</td>'+
                    '<td>'+item.ename+'</td>'+
                    '<td>'+item.dname+'</td>'+
                    '</tr>';
            });
            $("#share_colleagueTable").html(str);
            funCheck('#share_colleagueTable');
        },"json");
    });
</script>
