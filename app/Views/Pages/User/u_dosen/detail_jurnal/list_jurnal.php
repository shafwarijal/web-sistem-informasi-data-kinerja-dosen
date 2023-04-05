<div class="table-responsive">
    <table class="table table-bordered nowrap display table-hover" id="getJurnal" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Jurnal</th>
                <th>Nama Jurnal</th>
                <th>Nama Personil</th>
                <th>Issn</th>
                <th>Volume</th>
                <th>Nomor</th>
                <th>Halaman Awal</th>
                <th>Halaman Akhir</th>
                <th>Status Akreditasi</th>
                <th>Tingkat</th>
                <th>Tahun Jurnal</th>
                <th>Url</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Judul Jurnal</th>
                <th>Nama Jurnal</th>
                <th>Nama Personil</th>
                <th>Issn</th>
                <th>Volume</th>
                <th>Nomor</th>
                <th>Halaman Awal</th>
                <th>Halaman Akhir</th>
                <th>Status Akreditasi</th>
                <th>Tingkat</th>
                <th>Tahun Jurnal</th>
                <th>Url</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>



<script>
    $(document).ready(function() {
        $('#getJurnal tfoot th').each(function() {
            var title = $('#getJurnal thead th').eq($(this).index()).text();
            if (title !== 'No' && title !== 'Aksi') {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            }
        });

        var table = $('#getJurnal').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?= base_url('dosen/getAlljurnaldetail/' . $nama) ?>",

            scrollY: "550px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,

            fixedColumns: {
                left: 1,
                right: 1
            },

            columnDefs: [{
                defaultContent: "-",
                targets: "_all"
            }],

            columns: [{
                    target: 0,
                    searchable: false,
                    orderable: false,
                },
                {
                    target: 1,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 2,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 3,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 4,
                    render: function(data, type, row) {
                        return data;
                        //     if (data == 1){
                        //         return "Penelitian Dasar"
                        //     }
                        //     else if (data == 2) {

                        //     }



                        // }
                    }
                },
                {
                    target: 5,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 6,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 7,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 8,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 9,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 10,
                    render: function(data, type, row) {
                        return data;

                        // if (data == 1) {
                        //     return "Valid"
                        // } else if (data == 0) {
                        //     return "Invalid"
                        // }

                    }
                },
                {
                    target: 11,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 12,
                    render: function(data, type, row) {
                        return '<a href="' + data + '">Link</a>';
                    }
                },
                {
                    target: 13,
                    className: "text-center",
                    width: "10%",
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row) {
                        return '<button class="btn btn-success btn-sm mb-1 mr-1" onclick="editjurnal(&apos;' + data + '&apos;)">Update</button><button class="btn btn-danger btn-sm mb-1" onclick="deletesjurnal(&apos;' + data + '&apos;)">Delete</button>';
                    }
                },


            ],


            order: [
                [1, 'asc']
            ],
        });

        table.on('draw.dt', function() {
            var info = table.page.info();
            table.column(0, {
                search: 'applied',
                order: 'applied',
                page: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

        $(table.table().container()).on('keyup change', 'tfoot input', function() {
            table
                .column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });
        // var table = $('#getPenelitian').DataTable({
        //     scrollY: "600px",
        //     scrollX: true,
        //     scrollCollapse: true,
        //     paging: false,
        //     fixedColumns: {
        //         left: 2,
        //         right: 1
        //     }
        // });
    });

    function editjurnal(id_jurnal) {
        $.ajax({
            type: "post",
            url: "<?= base_url('jurnal/get_jurnal_edit'); ?>",
            data: {
                id_jurnal: id_jurnal
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('.view-form').html(response.output).show();
                    $('#editJurnal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deletesjurnal(id_jurnal) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You won't be able to revert this!`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('jurnal/delete_data'); ?>",
                    data: {
                        id_jurnal: id_jurnal
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.output) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.output,
                            });
                            getJurnal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>