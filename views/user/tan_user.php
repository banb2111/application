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
    // 单选分页
    function up (obj) {
         var department_id = $(obj).find('select').val();
        num--;
        if (num<1) {
            num=1
        }
        $.post('<?=base_url();?>index.php/users/get_users',{"per_page":num,"department_id":department_id}, function(data) {
            var str;
            str='<tr>'+
                '<th></th>'+
                '<th>用户名</th>'+
                '<th>用户姓名</th>'+
                '<th>部门</th>'+
                ' </tr>';
            $.each(data,function(i,item){
                str+='<tr>'+
                    '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                    '<td>'+item.usname+'</td>'+
                    '<td>'+item.ename+'</td>'+
                    '<td>'+item.dname+'</td>'+
                    '</tr>';
            });
            $(obj).find('table').html(str);
        },"json");
    }
    function down (obj) {
        var department_id = $(obj).find('select').val();
        $.post('<?=base_url();?>index.php/users/get_user_count',{"department_id":department_id}, function(pages) {
            var count = 0;
            if (pages % page != 0) count = 1;
            var pagesize =parseInt(pages / page) + count;
            num++;
            if (num<1) {
                num=1
            }else if(num>pagesize){
                num=pagesize;
            }
            $.post('<?=base_url();?>index.php/users/get_users',{"per_page":num,"department_id":department_id}, function(data) {
                var str;
                str='<tr>'+
                    '<th></th>'+
                    '<th>用户名</th>'+
                    '<th>用户姓名</th>'+
                    '<th>部门</th>'+
                    ' </tr>';
                $.each(data,function(i,item){
                    str+='<tr>'+
                        '<td><input type="radio" name="user_id" value="'+item.id+'"></td>'+
                        '<td>'+item.usname+'</td>'+
                        '<td>'+item.ename+'</td>'+
                        '<td>'+item.dname+'</td>'+
                        '</tr>';
                });
                // alert(str);
                 $(obj).find('table').html(str);
            },"json");
        });
    }
</script>