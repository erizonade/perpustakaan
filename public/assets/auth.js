$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $("#form-login-user").submit(function () {
        $(".text-danger").empty();
        data = [];
        let login = {
            url: "/login",
            type: "POST",
            data: data,
            beforeSend: function () {
                swalLoading()
            },
            error: function (xhr)
            {
              
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $("#"+key).closest('div').append("<span class='text-danger'>"+val+"</span>")
                    })
                }

            },
            success: function (data) {
                let res = data.response

                if (res.success == 200) {
                    window.location.href = res.url
                }else if (res.error == 401) {
                    swallError('Opps',res.message)
                }
            },
            complete: function () {
                swal.close()
            }
        }
        $(this).ajaxSubmit(login)
        return false;
    })

    $("#form-password").submit(function () {
        $(".text-danger").empty();
        data = [];
        let login = {
            url: "/reset_password",
            type: "POST",
            data: data,
            error: function (xhr)
            {
              
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $("#"+key).closest('div').append("<span class='text-danger'>"+val+"</span>")
                    })
                }

            },
            success: function (data) {
                let res = data.response

                if (res.success == 200) {
                    swallSuccess('Success', res.message)
                }
            }
        }
        $(this).ajaxSubmit(login)
        return false;
    })

})