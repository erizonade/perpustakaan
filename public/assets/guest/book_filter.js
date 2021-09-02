$(function () {
    
    $(document).on("click", ".judul_buku", function () {
        let search = $("#judul_buku").val()
        $("#books-filter").empty()
        BOOK(search)
    })

    function BOOK(search) {
        $.ajax({
            url: "/guest/filter_book/" + search,
            type: "GET",
            beforeSend: function () {
                swalLoading()
            },
            success: function (data) {
                let res = data.response
                if (res.success == 200)
                {
                    if (res.data.length > 0)
                    {
                        $.each(res.data, function (key, val) {
                            book = `<div class="card" style="width: 18rem;">
                            <img src="/data/images/`+val.foto+`" width="277px" height="200px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td><b>Judul Buku</b></td>
                                        <td> : </td>
                                        <td><b>`+val.title+`</b></td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Rilis</td>
                                        <td> : </td>
                                        <td>`+val.publication_year+`</td>
                                    </tr>
                                    <tr>
                                        <td>Creator</td>
                                        <td> : </td>
                                        <td>`+val.name+`</td>
                                    </tr>
                                </table>
                            </div>
                        </div>`
                            
                            $("#books-filter").append(book)
                        })
                    } else {
                        book = `Pencarian Kamu Tidak Ada Silakan Gunakan Kalimat lain`
                        
                        $("#books-filter").append(book)
                    }
                }
            },
            complete: function () {
                swal.close()
            }
        })
    }
})