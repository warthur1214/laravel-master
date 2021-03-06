@extends("base")

@section("style")

    <link rel="stylesheet" href="{{asset("/resources/plugins/datatables/dataTables.bootstrap.css")}}">
    <style type="text/css">
        .img_browser {
            height: 300px;
            width: 400px;
        }

        .textarea_width {
            width: 60%;
            float: left;
        }
    </style>
@endsection

@section("body")
    <body>
    <section class="content-header">
        <h1>
            修改农产品信息
        </h1>
    </section>
    <div class="box box-cus box-cus-form">
        <div class="alert alert-error" style="display:none;">
            <span>信息不能为空，请输入</span>
        </div>
        <div class="box-body">

            <input type="hidden" class="form-control" id="app_url"
                   value="{{config('app.url')}}">
            <form role="form" id="info_form">
                <table class="table table-bordered">
                    <tbody>
                    <tr class="form-group">
                        <td class="title" colspan="2"><i class="fa fa fa-info-circle"></i> 添加农产品</td>
                        <input type="hidden" id="crop_id" value="{{$cropInfo['id']}}">
                    </tr>
                    <tr class="form-group">
                        <th>农产品编码 <span class="text-red">*</span></th>
                        <td>
                            <input type="text" class="form-control" id="crop_number" name="crop_number"
                                   value="{{$cropInfo['crop_number']}}" placeholder="农产品编码" readonly>
                        </td>
                    </tr>
                    <tr class="form-group">
                        <th>农产品名称 <span class="text-red">*</span></th>
                        <td>
                            <input type="text" class="form-control" id="crop_name" name="crop_name"
                                   value="{{$cropInfo['crop_name']}}" placeholder="农产品名称">
                        </td>
                    </tr>
                    <tr class="form-group">
                        <th>产品重量 <span class="text-red">*</span></th>
                        <td>
                            <input type="text" class="form-control"  style="width: 60%;float: left;" id="crop_weight" name="crop_weight"
                                   value="{{$cropInfo['crop_weight']}}" placeholder="产品重量"> &nbsp;&nbsp;&nbsp;&nbsp;kg
                        </td>
                    </tr>
                    <tr class="form-group">
                        <th>选择批次 <span class="text-red">*</span></th>
                        <td>
                            <select name="batch_id" id="batch_id" class="form-group" title="选择批次">
                                @foreach($batchInfo as $b)
                                    <option value="{{$b['id']}}" {{$b['id']==$cropInfo['batch_id'] ? 'selected' : ''}}>{{$b['batch_name']}}</option>
                                @endforeach
                            </select>
                            <span class="span1"><a href="{{config('app.url')}}/batch/batchList"
                                                   class="a1">请确认选择</a></span>
                        </td>
                    </tr>
                    <tr class="form-group">
                        <th>农产品品类 <span class="text-red">*</span></th>
                        <td>
                            <select name="variety_id" id="variety_id" class="form-group" title="选择农产品品类">
                                @foreach($varietyInfo as $var)
                                    <option value="{{$var['id']}}" {{$var['id']==$cropInfo['variety_id'] ? 'selected' : ''}}>{{$var['variety_name']}}</option>
                                @endforeach
                            </select>
                            <span class="span1"><a href="{{config('app.url')}}/variety/varietyList"
                                                   class="a1">请确认选择</a></span>
                        </td>
                    </tr>
                    <tr class="form-group">
                        <th>上传图片</th>
                        <td colspan="5">
                            <input type="file" class="form-control" style="width: 60%;float: left;" id="crop_img" name="crop_img" placeholder="农产品图片">
                            <span class="span1 a1" style="margin-left: 20px;">推荐图片大小在500KB以内</span>
                        </td>
                    </tr>

                    <tr class="form-group">
                        <th>图片预览</th>
                        <td colspan="5">
                            <div class="form-group">
                                <img src="{{$cropInfo['crop_img']}}" class="img_browser" id="img_browser"
                                     title="建议上传 400*300像素">
                            </div>
                        </td>
                    </tr>
                    <tr class="form-group">
                        <th>农产品描述</th>
                        <td colspan="5">
                            <div class="form-group"><textarea class="form-control textarea_width" id="crop_describe"
                                                              name="crop_describe"
                                                              placeholder="输入农产品描述信息">{{$cropInfo['crop_describe']}}</textarea>
                                <span class="span1 a1">描述用于手机页面，建议55个字以内</span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="box-footer clearfix text-center">
            <button type="submit" class="btn btn-primary" id="submit"><i class="fa fa-save"></i> 提交</button>
            <a href="{{config('app.url')}}/crop/cropList" class="btn btn-default"><i class="fa fa-arrow-left"></i>
                返回</a>
        </div>
    </div>
    </body>
@endsection

@section("script")
    <!-- DataTables -->
    <script src="{{asset("/resources/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/resources/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/resources/plugins/jQuery/jquery.validate.min.js")}}"></script>
    <script src="{{asset("/resources/plugins/jQuery/additional-methods.min.js")}}"></script>
    <script src="{{asset("/resources/js/crop/editCrop.js")}}"></script>
@endsection

@section("js")
    <script type="text/javascript">
        //待上传图片预览
        $("#crop_img").change(function () {
            var objUrl = getObjectURL(this.files[0]);
            if (objUrl) {
                $("#img_browser").attr("src", objUrl);
            }
        });

        //建立一個可存取到該file的url
        function getObjectURL(file) {
            var url = null;
            window.createObjectURL = undefined;
            if (window.createObjectURL != undefined) { // basic
                url = window.createObjectURL(file);
            } else if (window.URL != undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file);
            } else if (window.webkitURL != undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file);
            }
            return url;
        }
    </script>
@endsection