var table;
$(document).ready(function () {

    //删除模块
    function delMoudle() {
        //处理删除用户事件
        var id = $(this).attr('index');
        var success = $('.alert_page_success');
        var error = $('.alert_page_error');

        if (confirm('确实要删除该节点吗?')) {
            $.ajax({
                url: 'delCrop/' + id,
                type: "post",
                dataType: "json",
                success: function (result) {
                    if (result.status == 0) {
                        success.hide();
                        //设置msg
                        error.text(result.msg);
                        error.show();
                        setTimeout(function () {
                            error.hide();
                        }, 3000);
                        return;
                    }
                    error.hide();
                    success.text(result.msg);
                    success.show();

                    //重新加载列表
                    table.ajax.reload();

                    setTimeout(function () {
                        success.hide();
                        error.hide();
                    }, 3000);
                }
            });
        }
    }

    //datatables 初始化
    var table = $('#example1').DataTable({
        "columnDefs": [
            {"searchable": false, "orderable": false, "targets": [0]},
            {"searchable": false, "orderable": false, "targets": [1]},
            {"searchable": false, "orderable": false, "targets": [2]},
            {"searchable": false, "orderable": false, "targets": [3]},
            {"searchable": false, "orderable": true, "targets": [4]},
            {"searchable": false, "orderable": true, "targets": [5]},
            {"searchable": false, "orderable": true, "targets": [6]},
            {"searchable": false, "orderable": true, "targets": [7]},
            {"searchable": false, "orderable": true, "targets": [8]},
            {"searchable": false, "orderable": true, "targets": [9]},
            {"searchable": false, "orderable": true, "targets": [10]}
        ],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "ajax": {
            "url": "cropListAjax",
            "type": "POST"
        },
        "order": [
            [0, "asc"]
        ],
        "columns": [
            {"data": "id"},
            {"data": "crop_name"},
            {"data": "crop_number"},
            {"data": "crop_weight"},
            {"data": "batch_name"},
            {"data": "variety_name"},
            {"data": "crop_describe"},
            {"data": "create_time"},
            {"data": "update_time"},
            {
                "data": null,
                "createdCell": function (td, cellData, rowData) {
                    $(td).html('<a href="cropCycle/'+rowData.id+'" class="btn btn-xs btn-primary">分配周期</a>');
                }
            },
            {
                "data": null,
                "createdCell": function (td, cellData, rowData) {
                    $(td).html("<a href='editCrop/" + rowData.id + "' class='btn btn-xs btn-primary'>查看</a> " +
                        "<a href='javascript:;' class='btn btn-xs btn-primary' cropNumber='" + rowData.crop_number +
                        "' cropWeight='" + rowData.crop_weight +
                        "' cropName='"+rowData.crop_name+"' cropId='" + rowData.id + "' id='scanBinCode'>打印二维码</a> " +
                        "<a href='javascript:void(0);' " + rowData.id + " class='btn btn-xs btn-danger deleteById' id='deleteById' index='" +
                        rowData.id + "'>删除</a>");
                }
            }
        ],
        "lengthMenu": [
            [50],
            [50]
        ],
        "language": {
            "emptyTable": "暂无数据",
            "lengthMenu": "_MENU_ 条/每页",
            "loadingRecords": "Please wait - loading...",
            "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
            "paginate": {
                "first": "首页",
                "last": "末页",
                "next": "下一页",
                "previous": "上一页"
            }
        }
    });

    /*重新加载table*/
    function reloadData(param) {
        table.settings()[0].ajax.data = param;
        table.ajax.reload();
    }

    $('#example1').on('click', '#deleteById', delMoudle);
    $('#example1').on('click', '#scanBinCode', scanBinCode);


    function scanBinCode() {
        var cropId = $(this).attr("cropId"),
            cropName = $(this).attr("cropName"),
            cropWeight = $(this).attr("cropWeight"),
            cropNumber = $(this).attr("cropNumber");

        window.location.href = $("#app_url").val()+"/crop/showBinCode/" + cropId + "/" + cropName + "/" + cropNumber + "/" + cropWeight;
    }

});
