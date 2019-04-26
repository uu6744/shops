<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新增采购单</title>
    <link rel="stylesheet" href="/css/spec.css"/>
    <style>
        input::-webkit-outer-spin-button,input::-webkit-inner-spin-button{ 
         -webkit-appearance: none !important;            
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <form action="{{url('')}}" method="post" enctype="multipart/form-data">
        <!--post请求token-->
        {{ csrf_field() }}
        <div class="row">
            {{-- <div class="r-right col-md-12 col-xs-12">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <span class="gys"><i>*</i>供应商</span>
                             <div class="input-group">
                                <div class="form-control gsy-search"> <span>点击选择供应商</span>
                                    <input type="text" class="input-search" aria-label="..." placeholder="">
                                </div>
                                <div class="input-group-btn gys-select">
                                    <button type="button" class="btn btn-default dropdown-toggle clear"> <span class="glyphicon glyphicon-remove"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right gysList">
                                        @foreach ($suppliers as $v)
                                            <li data-id="{{$v->id}}"><a href="#">{{$v->s_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div> --}}

                <div class="table">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="row">
                                   <th style="width:50px;max-width: 50px;text-align: center;"></th>
                                   <th style="width:50px;max-width: 50px;text-align: center;"></th>
                                   @foreach($specValues as $k => $v)
                                   <th style="width:150px;text-align: center;">{{$k}}</th>
                                   @endforeach
                                   <th style="text-align: center;">商品规格</th>
                                   <th style="width:100px;text-align: center;">单位</th>
                                   <th style="width:200px;text-align: center;">采购数</th>
                                   <th style="width:140px;text-align: center;">采购单价（元）</th>
                                   <th style="width:140px;text-align: center;">小计（元）</th>
                                </tr>
                            </thead>
                            <tbody class="tableList">
                                <tr class="row">
                                    <td style="width:50px;max-width: 50px;text-align: center;" class="tr_sort">1</td>
                                    <td style="width:50px;max-width: 50px;text-align: center;">
                                        <div class="tc">
                                            <span class="glyphicon glyphicon-plus" style="margin-right:5px"></span>
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </div>
                                    </td>
                                    <td style="text-align: left;" colspan="2">
                                        <div class="autocomplete-column column-select">
                                            <div class="ant-select-more select-more">
                                                <input type="text" placeholder="请选择所需颜色"/>
                                                <ul class="selectList">
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td style="width:100px;text-align: center;"></td>
                                    <td style="width:200px;text-align: center;">
                                        <div class="cgs"></div>
                                    </td>
                                    <td style="width:140px;text-align: center;">
                                        <div class="cgs"></div>
                                    </td>
                                    <td style="width:140px;text-align: center;">
                                        <div class="cgs"></div>
                                    </td>
                                </tr>
                                <!--合计-->
                                {{-- <tr class="row table-tbody">
                                    <td style="width:50px;max-width: 50px;text-align: center;">合计</td>
                                    <td style="width:50px;max-width: 50px;text-align: center;"></td>
                                    <td style="text-align: left;" colspan="4"></td>
                                    <td style="width:200px;text-align: center;" class="trCount">0</td>
                                    <td style="width:140px;text-align: center;"></td>
                                    <td style="width:140px;text-align: center;" class="trTitle">0.00
                                    </td>
                                </tr> --}}
                            </tbody>
                            <!--总计-->
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="9">
                                        <div class="paycount" style="text-align: left; float: right;margin-right: 20px;">
                                            <div>
                                                <span style="float:left;line-height:32px;">其他金额：</span>
                                                <div class="ant-input-number edit-table-money-input ant-input-number-handler-hide" style="width: 150px;float: left;">
                                                    <div class="ant-input-number-input-wrap" role="spinbutton" aria-valuemin="0" aria-valuemax="100000000" aria-valuenow="0">
                                                        <input name="other_amount" min="0" max="100000000" class="ant-input-number-input reat" autocomplete="off" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top:10px;">
                                                <span style="float:left;line-height:32px;">应付金额：</span>
                                                <span class="paycount-total" style="float:left;line-height:32px;color:red;font-size:24px;">0.00</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                </div>
                    <!--日期等表单 strat-->
                {{-- <div class="primary row" style="overflow: hidden;">
                        <div class="form-horizontal">
                            <div class="col-lg-4 col-xs-12">
                                <div class="form-group">
                                    <div  class="col-sm-3" style="text-align: right;line-height: 34px;">
                                    <label>日期</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <!-- <input type="date" name="cg_datetime" class="form-control" id="register_time" placeholder=""> -->
                                        <input type="text" name="cg_datetime" class="layui-input form-control" id="test5" placeholder="请选择" autocomplete="off" style="cursor: pointer;">
                                    </div>
                                </div>
                                <!--采购订单号 start-->
                                <div class="form-group">
                                    <div  class="col-sm-3" style="text-align: right;line-height: 34px;">
                                        <label>采购订单号</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input name="cg_code" readonly="true" value="{{$cg_code}}" type="text" class="form-control"  placeholder="">
                                    </div>
                                </div>
                                <!--end-->
                                <!--采购员 start-->
                                <div class="form-group">
                                    <div  class="col-sm-3" style="text-align: right;line-height: 34px;">
                                        <label>采购员</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <!-- <input name="cg_person" type="text" class="form-control"  placeholder="请输入采购员名称"> -->
                                        <select name="cg_person">
                                            @foreach ($cg_person AS $v)
                                                <option value="{{$v->id}}">{{$v->name}}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red;font-size:12px;"></span>
                                    </div>
                                </div>
                                <!--end-->
                            </div>
                            <div class="col-lg-4 col-xs-12">
                                <!--备注 start-->
                                <div class="form-group">
                                    <div  class="col-sm-3" style="text-align: right;line-height: 34px;">
                                        <label>备注</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea name="remark" class="form-control"  placeholder="请输入备注信息，最多不超过100字" style="height: 80px;">新增采购单</textarea>
                                        <span style="color:red;font-size:12px;"></span>
                                    </div>
                                </div>
                                <!--end-->
                                <!--制单人 start-->
                                <div class="form-group">
                                    <!-- <div class="col-sm-3" style="text-align: right;line-height: 34px;">
                                        <label>制单人</label>
                                    </div> -->
                                    <div class="col-sm-9">
                                        <input name="add_person" value="{{$add_person}}" readonly="true" type="hidden" placeholder="张先生" class="form-control"/>
                                        <input type="hidden" name="add_person_id" value="{{$add_person_id}}">
                                    </div>
                                </div>
                                <!--end-->
                            </div>
                        </div>
                </div> --}}
                    <!--日期等表单 end-->
                    <div class="fixed ">
                        <div>
                            <a href="/admin/purchase" class="btn btn-default"><span>返 回</span></a>
                            <button type="submit" class="btn btn-primary submit"><span>保 存</span></button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- 供应商id -->
        <input type="hidden" id="supplier_id" name="supplier_id" value="0">
        <!-- 总金额 -->
        <input type="hidden" id="all_amount" name="all_amount" value="0">
        <!-- 供应货品-点击出现html -->
        <input type="hidden" id="supplierProduct_selectList">
        <!-- 供应货品-表格tr html -->
        <input type="hidden" id="pros_tr">
        <!-- 供应货品-下拉html obj -->
        <input type="hidden" id="html_select">
        <!-- 供应货品-原始下拉html obj -->
        <input type="hidden" id="html_select_old">
        <!-- 商品数据 -->
        <input type="hidden" id="pro_datas">
    </form>
</div>
<script type="text/javascript">
    function loadJs(path,callback){
        var header=document.getElementsByTagName("head")[0];
        var script=document.createElement('script');
        script.setAttribute('src',path);
        header.appendChild(script);
        //对于浏览器的判断是ie还是其他
        if(!/*@cc_on!@*/false){
            script.onload=function(){
                console.log("非ie");
                callback();
            }
        }else{
            script.onreadystatechange=function(){
                if(script.readystate=="loaded" ||script.readState=='complate'){
                    console.log("ie");
                    callback();
                }
            }
        }
    }
    // loadJs("/js/spec.js",function(){
    //     console.log("JS已经加载完成")
    // });
</script>
</body>
</html>