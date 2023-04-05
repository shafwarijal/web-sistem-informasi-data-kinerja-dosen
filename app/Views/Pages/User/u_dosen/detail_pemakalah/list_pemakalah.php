<div class="table-responsive">
    <table class="table table-bordered nowrap display table-hover" id="getPemakalah" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama Lengkap</th>
                <th>Status Pemakalah</th>
                <th>Judul Makalah</th>
                <th>Nama Forum</th>
                <th>Institusi Penyelenggara</th>
                <th>Tanggal Mulai Pelaksanaan</th>
                <th>Tanggal Akhir Pelaksanaan</th>
                <th>Tempat Pelaksanaan</th>
                <th>Status Berkas Makalah/th>
                <th>Keterangan Invalid</th>
                <th>Tahun Pemakalah</th>
                <th>Tingkat</th>
                <th>Aksi</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>NIDN</th>
                <th>Nama Lengkap</th>
                <th>Status Pemakalah</th>
                <th>Judul Makalah</th>
                <th>Nama Forum</th>
                <th>Institusi Penyelenggara</th>
                <th>Tanggal Mulai Pelaksanaan</th>
                <th>Tanggal Akhir Pelaksanaan</th>
                <th>Tempat Pelaksanaan</th>
                <th>Status Berkas Makalah/th>
                <th>Keterangan Invalid</th>
                <th>Tahun Pemakalah</th>
                <th>Tingkat</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>



<script>
    $(document).ready(function() {
        $('#getPemakalah tfoot th').each(function() {
            var title = $('#getPemakalah thead th').eq($(this).index()).text();
            if (title !== 'No' && title !== 'Aksi') {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            }
        });


        // var ses = <?= session()->get('nidn') ?>;
        // var usus = '<?= session()->get('nidn') ?>';

        // var oke = row.nidn_pem;

        var table = $('#getPemakalah').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?= base_url('dosen/getAllpemakalahdetail/' . $nidn) ?>",


            scrollY: "550px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,

            fixedColumns: {
                left: 2,
                right: 1
            },

            columnDefs: [{
                    defaultContent: "-",
                    targets: "_all"
                },
                // {
                //     target: 1,
                //     render: function(data, type, row, meta) {
                //         if (data == <?= session()->get('nidn') ?>) {
                //             table.columns(1).visible(false);
                //         }
                //     }
                // },
            ],

            columns: [{
                    target: 0,
                    searchable: false,
                    orderable: false,
                },
                {
                    target: 1,
                    render: function(data, type, row) {
                        // if (data == <?= session()->get('nidn') ?>) {
                        //     return "Sama"
                        // }
                        return data;
                        // if (data == <?= session()->get('nidn') ?>) {

                        //     table.columns(1).visible(false);
                        // }
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
                        if (data == 1) {
                            return "Valid"
                        } else if (data == 0) {
                            return "Invalid"
                        }

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
                        return data;
                    }
                },
                {
                    target: 13,
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 14,
                    className: "text-center",
                    width: "10%",
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row) {
                        if (row[1] == <?= session()->get('nidn') ?>) {
                            return '<button class="btn btn-success btn-sm mb-1 mr-1" onclick="editpemakalah(&apos;' + data + '&apos;)">Update</button><button class="btn btn-danger btn-sm mb-1" onclick="deletespemakalah(&apos;' + data + '&apos;)">Delete</button>';
                        } else {
        
                        }

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

    function editpemakalah(id_pemakalah) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pemakalah/get_pemakalah_edit'); ?>",
            data: {
                id_pemakalah: id_pemakalah
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('.view-form').html(response.output).show();
                    $('#editPemakalah').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deletespemakalah(id_pemakalah) {
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
                    url: "<?= base_url('pemakalah/delete_data'); ?>",
                    data: {
                        id_pemakalah: id_pemakalah
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.output) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.output,
                            });
                            getPemakalah();
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