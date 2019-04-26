$(document).ready(function(){
    /*日期时间选择*/
     laydate.render({
       elem: '#test5' ,
       type: 'datetime',
       value: new Date()
     });

    //全选或全不选
    $("#allChecbox").click(function(){
        if(this.checked){
            $("[name=items]:checkbox").prop("checked",true)
        }else{
            $("[name=items]:checkbox").prop("checked",false)
        }
    })

    //复选框的点击事件
    $("[name=items]:checkbox").click(function(){
        var flag=true;
        $("[name=items]:checkbox").each(function(){
            if(!this.checked){
                flag=false;
            }
        })
        $("#allChecbox").prop("checked",flag)
    })

    //全部分类
    $(".modal-header .dropdown-menu").on("click","li",function(e){
        var val= $(this).html();
        console.log(val)
        $(".modal-header #dLabel .all").html(val)
    })

    //页面搜索框
    $(".input-search").focus(function(){
        $(".gsy-search span").css("display","none")
        $(".gysList").css("display","block")
    })
    $(".input-search").click(function(){
        $(".gsy-search span").css("display","none")
        $(".input-search").css("opacity","1")
    })

    // 供应商选择
    $(".gysList").on("click","li",function(){
        var val = $(this).html();
        if($('#supplier_id').val() == 0){
            var id = $(this).attr('data-id');// 供应商id
            $('#supplier_id').val(id);// 赋值供应商id
            $(".gsy-search span").css("display","block")
            $(".input-search").css("opacity","0")
            $(".input-search").val("")
            $(".gsy-search span").html(val);
            $(".gysList").css("display","none");
            supplierProduct(); // ajax 获取供应商供应货品
        }else{
            if(confirm("是否确定修改供应商？修改供应商后，将清除已选择的商品数据！")){
                window.location.href="";
            }else{
                $(".gsy-search span").css("display","block")
                $(".input-search").css("opacity","0")
                $(".input-search").val("")
                $(".gysList").css("display","none");
            }
        }
    })
    // 清除供应商
    $(".clear").click(function(){
        if($('#supplier_id').val() == 0){
            $(".gsy-search span").html("");
            $(".input-search").val("");
            $('#supplier_id').val(0);// 重置供应商id
        }else{
            if(confirm("是否确定修改供应商？修改供应商后，将清除已选择的商品数据！")){
                window.location.href="";
            }else{
                $(".gsy-search span").css("display","block")
                $(".input-search").css("opacity","0")
                $(".input-search").val("")
                $(".gysList").css("display","none");
            } 
        }
    })

    //增加tr行-商品数据
    $("body").on("click","tr .glyphicon-plus",function(){
        var supplierProduct_selectList = $('#supplierProduct_selectList').val();
        if(supplierProduct_selectList==undefined){
            supplierProduct_selectList = '';
        }
        var html=$('<tr class="row">'+
        '<td style="width:50px;max-width: 50px;text-align: center;" class="tr_sort"></td>'+
        '<td style="width:50px;max-width: 50px;text-align: center;"> <div class="tc"> <span class="glyphicon glyphicon-plus" style="margin-right:5px"></span> <span class="glyphicon glyphicon-minus"></span> </div> </td>'+
        '<td style="text-align: left;" colspan="2"> <div class="autocomplete-column column-select"> <div class="ant-select-more select-more"> <input type="text" placeholder="输入编码/商品名称"/><ul class="selectList">'+supplierProduct_selectList+'</ul> </div></div> </td>'+
        '<td style="text-align: center;"></td>'+
        '<td style="width:100px;text-align: center;"></td>'+
        '<td style="width:200px;text-align: center;" class="tdCount"></td>'+
        '<td style="width:140px;text-align: center;"></td>'+
        '<td style="width:140px;text-align: center;" class="tdTitle"></td>'+
        '</tr>')
        $(".table-tbody").before(html);
        $('.selectList').each(function(){
            $(this).html(supplierProduct_selectList);
        })
        //如果tr只有两个就不允许再减
        trPlus();
        trSort();
    })

    //减少tr行-商品数据
    $("body").on("click","tr .glyphicon-minus",function(){
        var pro_id = $(this).attr('data-id');
        // 重置点击下拉列表数据
        if($('#html_select').val()){
            var html_select = JSON.parse($('#html_select').val());
            var html_select_old = JSON.parse($('#html_select_old').val());
            if(html_select_old[pro_id]!=undefined){
                html_select[pro_id] = html_select_old[pro_id];
            }
            var html_select_add = '';
            for(var i in html_select){
                html_select_add += html_select[i];
            }
            if(html_select_add==undefined){
                html_select_add = '';
            }
            $('#html_select').val(JSON.stringify(html_select));
            $('#supplierProduct_selectList').val(html_select_add);
            $('.selectList').each(function(){
                $(this).html(html_select_add);
            })
        }
        $(this).parent().parent().parent().next()
        $(this).parent().parent().parent().remove();
        // 如果tr只有两个就不允许再减
        trPlus();
        trSort();
        doTotal();
    })

    // 失去焦点重新计算金额
    $(".tableList").on("keyup",".tdCount",function(){
        var count=$(this).val();  
       //如果输入小数提示并清空
        if(count.indexOf(".")>=0){
            $(this).css("border","1px solid red");
            $(this).val(0.00);
            $(this).next().html("不能为小数");
        }else{
              $(this).css("border","1px solid #CDD9E6");
              $(this).next().html("");
        }
        //计算小计
        var dj=$(this).parent().parent().next().children().children(".tdDj").val();
        $(this).parent().parent().next().next().children(".tdTitle").html(($(this).val()*dj).toFixed(2));
        //计算总计
        doTotal();
    })
    // 失去焦点重新计算金额
    $(".tableList").on("keyup",".tdDj",function(){
        var dj=$(this).val();
        var count=$(this).parent().parent().prev().children().children(".tdCount").val();
        $(this).parent().parent().next().children(".tdTitle").html((dj*count).toFixed(2));
        doTotal();
    });
    // 失去焦点重新计算金额
    $(".reat").keyup(function(){
        doTotal();
    })

    $(".tableList").on("click",".select-more",function(){
        $(this).children(".selectList"). css("display","block")
    })
    $(".tableList").on("mouseleave",".column-select",function(){
        $(this).children().children(".selectList"). css("display","none")
    })
    // 商品下拉选择事件
    $(".tableList").on("click",".selectList li",function(){
        var pro_id = $(this).attr('data-id');//选择商品的id
        var html_pros = $('#pros_tr').val();//供应商品列表
        var html_pros = JSON.parse(html_pros);
        var html = html_pros[pro_id];// 待填充的html
        // 重置点击下拉列表
        var html_select = JSON.parse($('#html_select').val());
        delete html_select[pro_id];
        var html_select_add = '';
        // console.log(html_select);
        for(var i in html_select){
            html_select_add += html_select[i];
        }
        if(html_select_add == undefined){
            html_select_add = '';
        }
        $('#html_select').val(JSON.stringify(html_select));
        $('#supplierProduct_selectList').val(html_select_add);
        $(this).parent().parent().parent().parent().parent().next().before(html);
        $(this).parent().parent().parent().parent().parent().remove();
        // 重置下拉
        $('.selectList').each(function(){
            $(this).html(html_select_add);
        })
        //如果tr只有两个就不允许再减
        trPlus();
        trSort();
        doTotal();
    })
    /* 重置表格排序 */
   function trSort(){
    var sort = 1;
    $(".tr_sort").each(function(){
        $(this).html(sort);
        sort++;
    })
   }
 /* 如果tr只有两个就不允许再减了 */
 function trPlus(){
    if($(".tableList tr").length==2){
        $(".glyphicon-minus").css("display","none")
    }else{
        $(".glyphicon-minus").css("display","inline-block")
    }
 }
 trPlus();

 /* 总计 */
 function doTotal(){
    var zj = 0;
    $(".tdTitle").each(function(){
        var sum = Number($(this).html());
        zj += sum;
        $(".trTitle").html(zj.toFixed(2));
    })
    var trCount = 0;
    $(".tdCount").each(function(){
        var sum = Number($(this).val());
        trCount += sum;
        $(".trCount").html(trCount)
    })
    var reat = Number($(".reat").val());
    $(".paycount-total").html(zj+reat);
    var sum = Number($(".trTitle").html());
    $(".paycount-total").html((sum+reat).toFixed(2));
    // 总价格隐藏域
    $("#all_amount").val((sum+reat).toFixed(2));
 }

 /*提交验证*/
 $(".submit").click(function(e){
    //验证采购员是否为空
    var val=$("[name='cg_person']").val();
    var bz=$("[name='remark']").val();
    console.log(bz)
    if(val==""){
       $("[name='cg_person']").next().html("采购员不能为空");
       return false;
    }
    else if(bz==""){
         $("[name='remark']").next().html("备注不能为空");
       return false;
    }
   //验证数量是否为0
   $(".tdCount").each(function(){
      var vals=$(this).val();
      if(vals==0){
        $(this).css("border","1px solid red");
        $(this).next().html("不能为0");
        e.preventDefault()          
       }
    })
   //验证单价是否为0
   $(".tdDj").each(function(){
      var vals=$(this).val();
      if(vals==0){
         alert("单价不能为0，请重新输入！")
         $(this).css("border","1px solid red");
         e.preventDefault()
       }
    })
 })

  /*当采购员不为空时 span为空*/
  $("[name='cg_person']").blur(function(){
    if(!$(this).val()==""){
        $(this).next().html("");
    }
  })
  /*当备注不为空时 span为空*/
  $("[name='remark']").blur(function(){
    if(!$(this).val()==""){
        $(this).next().html("");
    }
  })
  /* 小计 */
 function sum(c,t,title){
    var count=c.val();
    var tdDj=t.val();
    $(title).html(count*tdDj);
 }
 sum($(".tdCount"),$(".tdDj"),$(".tdTitle"));
 /* ajax token */
 $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
 /* 下拉商品选择事件 */
 function supplierProduct(){
    var supplier_id = $('#supplier_id').val();
    if(supplier_id == 0){
        alert('请先选择供应商');
        return false;
    }
    $.ajax({
        type: 'POST',
        url: "/admin/purchase/supplierProduct",
        data: {
            supplier_id:supplier_id
        },
        dataType: 'json',
        success: function (res) {
            if(res.status == 0){
                alert('暂无供应货品');
            }else{
                var datas = res.datas; 
                $('#pro_datas').val(JSON.stringify(datas));
                $('.selectList').html('');
                var html = '';// supplierProduct_selectList点击下拉选择数据html
                var html_pros = new Object;// 商品行元素html
                var html_select = new Object;// 点击下拉
                for(var i=0;i<datas.length;i++){
                    html += '<li data-id='+datas[i].id+'><div>'+datas[i].bar_code+' '+datas[i].name+'  【'+datas[i].spec+'】 </div></li>';
                    html_select[datas[i].id] = '<li data-id='+datas[i].id+'><div>'+datas[i].bar_code+' '+datas[i].name+'  【'+datas[i].spec+'】 </div></li>';
                    var count = 0;
                    var dj = datas[i].supplier_price;
                    html_pros[datas[i].id] = '<tr class="row">'+
                                '<td style="width:50px;max-width: 50px;text-align: center;" class="tr_sort">'+i+'</td>'+
                                '<td style="width:50px;max-width: 50px;text-align: center;">'+
                                '<div class="tc">'+
                                '<span class="glyphicon glyphicon-plus" style="margin-right:5px"></span>'+
                                '<span class="glyphicon glyphicon-minus" data-id="'+datas[i].id+'"></span>'+
                                '</div>'+
                                '</td>'+
                                '<td style="width:150px;text-align: center;"><input type="hidden" name="pro[pro_price_id][]" value="'+datas[i].id+'">'+datas[i].bar_code+'</td>'+
                                '<td style="width:300px;text-align: center;">'+datas[i].name+'</td>'+
                                '<td style="text-align: center;">'+datas[i].spec+'</td>'+
                                '<td style="width:100px;text-align: center;">'+datas[i].unit+'</td>'+
                                '<td style="width:200px;text-align: center;"><div class="cgs"> <input name="pro[buy_count][]" type="number" min="0" max="1000000000" value='+count+' class="ant-input-number-input tdCount each"/><span class="cw"></span></div></td>'+
                                '<td style="width:140px;text-align: center;"> <div class="cgs"> <input name="pro[buy_price][]" type="text" value='+dj+' class="ant-input-number-input tdDj"/> </div> </td>'+
                                '<td style="width:140px;text-align: center;"> <div class="cgs tdTitle each"> '+(count*dj).toFixed(2)+'</div> </td>'+
                                '</tr>)'
                }
                var html_pros = JSON.stringify(html_pros);
                var html_select = JSON.stringify(html_select);
                $('.selectList').html(html);
                $('#supplierProduct_selectList').val(html);
                $('#pros_tr').val(html_pros);
                $('#html_select').val(html_select);
                $('#html_select_old').val(html_select);
            }
        }
    })
  }
});

