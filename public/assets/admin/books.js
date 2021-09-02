
$(function () {
    LOAD()

    $(".created").click(function () {
        $("#id").val("")
        $(".text-danger").empty();
        $("#modal-book").modal("show");
    })

    $(document).on("click", ".edit", function () {
        $(".text-danger").empty();
        $("#modal-book").modal("show");
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/book/" + id + "/edit",
            type: "GET",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    let val = res.data;
                    $("#id").val(val.id)
                    $("#creator_id").val(val.creator_id)
                    $("#publication_year").val(val.publication_year)
                    $("#title").val(val.title)
                    $("#status").val(val.status)
                }
            }
        })
    })

    $(document).on("click", ".delete", function () {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/book/" + id,
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


    $("#form-book").submit(function () {
        $(".text-danger").empty();
        data = [];

        let id = $("#id").val()
        if (id != '')
        {
            url = "/admin/book/"+id+patch;
            type = "POST"
        } else {
            url = "/admin/book";
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
                    $("#modal-book").modal("hide");
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })


    function LOAD() {
        $("#books").DataTable({
            "order" : [0,'desc'],
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "searching": true,
            "stateSave": true,
            "autoWidth": false,
            "ajax": function (data, callback, setting) {
                $.ajax({
                    url: "/admin/book",
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