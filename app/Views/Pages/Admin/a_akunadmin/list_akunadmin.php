<div class="table-responsive">
    <table class="table table-bordered nowrap display table-hover" id="getAkunadmin" style="width:100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Admin</th>
                <th>Username</th>
                <th>Aksi</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Nama Admin</th>
                <th>Username</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>



<script>
    $(document).ready(function() {
        $('#getAkunadmin tfoot th').each(function() {
            var title = $('#getAkunadmin thead th').eq($(this).index()).text();
            if (title !== 'No' && title !== 'Aksi') {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            }
        });

        var table = $('#getAkunadmin').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?= route_to('get.all.akunadmin') ?>",

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
                    className: "text-center",
                    width: "10%",
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row) {
                        return '<button class="btn btn-success btn-sm mb-1 mr-1" onclick="edit(&apos;' + data + '&apos;)">Update</button><button class="btn btn-danger btn-sm mb-1" onclick="deletes(&apos;' + data + '&apos;)">Delete</button>';
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

    });

    function edit(id_admin) {
        $.ajax({
            type: "post",
            url: "<?= base_url('akunadmin/get_akunadmin_edit'); ?>",
            data: {
                id_admin: id_admin
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('.view-form').html(response.output).show();
                    $('#editAkunadmin').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deletes(id_admin) {
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
                    url: "<?= base_url('akunadmin/delete_data'); ?>",
                    data: {
                        id_admin: id_admin
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.output) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.output,
                            });
                            getAkunadmin();
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