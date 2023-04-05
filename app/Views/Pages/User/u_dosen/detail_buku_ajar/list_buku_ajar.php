<div class="table-responsive">
    <table class="table table-bordered nowrap display table-hover" id="getBukuAjar" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NDIN</th>
                <th>Nama Lengkap</th>
                <th>Judul Buku Ajar</th>
                <th>ISBN</th>
                <th>Jumlah Halaman</th>
                <th>Penerbit</th>
                <th>Keterangan Invalid</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>NDIN</th>
                <th>Nama Lengkap</th>
                <th>Judul Buku Ajar</th>
                <th>ISBN</th>
                <th>Jumlah Halaman</th>
                <th>Penerbit</th>
                <th>Keterangan Invalid</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>



<script>
    $(document).ready(function() {
        $('#getBukuAjar tfoot th').each(function() {
            var title = $('#getBukuAjar thead th').eq($(this).index()).text();
            if (title !== 'No' && title !== 'Aksi') {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            }
        });

        var table = $('#getBukuAjar').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?= base_url('dosen/getAllbukuajardetail/' . $nidn) ?>",

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
                    className: "text-center",
                    width: "10%",
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row) {
                        if (row[1] == <?= session()->get('nidn') ?>) {
                            return '<button class="btn btn-success btn-sm mb-1 mr-1" onclick="editbukuajar(&apos;' + data + '&apos;)">Update</button><button class="btn btn-danger btn-sm mb-1" onclick="deletesbukuajar(&apos;' + data + '&apos;)">Delete</button>';
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

    function editbukuajar(id_buku_ajar) {
        $.ajax({
            type: "post",
            url: "<?= base_url('buku_ajar/get_buku_ajar_edit'); ?>",
            data: {
                id_buku_ajar: id_buku_ajar
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('.view-form').html(response.output).show();
                    $('#editBukuAjar').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deletesbukuajar(id_buku_ajar) {
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
                    url: "<?= base_url('buku_ajar/delete_data'); ?>",
                    data: {
                        id_buku_ajar: id_buku_ajar
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.output) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.output,
                            });
                            getBukuAjar();
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