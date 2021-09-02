
$(function () {
    LOAD()

    $(".created").click(function () {
        $("#id").val("")
        $(".text-danger").empty();
        $("#modal-creator").modal("show");
    })

    $(document).on("click", ".edit", function () {
        $(".text-danger").empty();
        $("#modal-creator").modal("show");
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/creator_book/" + id + "/edit",
            type: "GET",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    $.each(res.data, function (key, val) {
                        $("#"+key).val(val)
                    })
                }
            }
        })
    })

    $(document).on("click", ".delete", function () {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/creator_book/" + id,
            type: "DELETE",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    swallSuccess('Success', res.message)
                    LOAD()
                }
            }
        })
    })


    $("#form-creator").submit(function () {
        $(".text-danger").empty();
        data = [];

        let id = $("#id").val()
        if (id != '')
        {
            url = "/admin/creator_book/"+id+patch;
            type = "POST"
        } else {
            url = "/admin/creator_book";
            type = "POST"
            
        }

        let proses = {
            url: url,
            type: type,
            data: data,
            error: function (xhr)
            {
                ERROR_ALERT(xhr)
            },
            success: function (data) {
                let res = data.response
                if (res.success == 200) {
                    swallSuccess('Success', res.message)
                    LOAD()
                    $("#modal-creator").modal("hide");
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })


    function LOAD() {
        $("#creatorbooks").DataTable({
            "order" : [0,'desc'],
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "searching": true,
            "stateSave": true,
            "autoWidth": false,
            "ajax": function (data, callback, setting) {
                $.ajax({
                    url: "/admin/creator_book",
                    type: "GET",
                    data: data,
                    error: function (xhr) {
                        callback({
                            draw: 1,
                            recordsTotal: 0,
                            recordFiltered: 0,
                            data: []
                        })
                    },
                    success: function (data)
                    {
                        let res = data.response
                        if (res.success == 200)
                        {
                            callback(res.data)
                        }
                    }
                })
            }
        })
    }

})