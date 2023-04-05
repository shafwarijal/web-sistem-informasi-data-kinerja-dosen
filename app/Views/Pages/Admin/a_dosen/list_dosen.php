<div class="table-responsive">
    <table class="table table-bordered nowrap table-hover display" id="getDosen" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama Dosen</th>
                <th>Gelar</th>
                <th>NIP</th>
                <th>JK</th>
                <th>Jabatan Akademik</th>
                <th>Program Studi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>NIDN</th>
                <th>Nama Dosen</th>
                <th>Gelar</th>
                <th>NIP</th>
                <th>JK</th>
                <th>Jabatan Akademik</th>
                <th>Program Studi</th>
                <th></th>

            </tr>
        </tfoot>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#getDosen tfoot th').each(function() {
            var title = $('#getDosen thead th').eq($(this).index()).text();
            if (title !== 'No' && title !== 'Aksi') {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            };
        });

        var table = $('#getDosen').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?= route_to('get.all.dosen') ?>",

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
                    width: "4%",
                    searchable: false,
                    orderable: false,
                },
                {
                    target: 1,
                    width: "9%",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 2,
                    className: "maxcol",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 3,
                    width: "13%",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 4,
                    width: "13%",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 5,
                    width: "1%",
                    render: function(data, type, row) {

                        if (data == 'L') {
                            return "Laki-Laki"
                        } else if (data == 'P') {
                            return "Perempuan"
                        }

                    }
                },
                {
                    target: 6,
                    width: "12%",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    target: 7,
                    width: "14%",
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
                        return '<button class="btn btn-success btn-sm mb-1 mr-1" onclick="edit(&apos;' + data + '&apos;)">Update</button><button class="btn btn-danger btn-sm mb-1" onclick="deletes(&apos;' + data + '&apos;)">Delete</button>';
                    }
                },


            ],
            createdRow: function(row) {
                var td = $(row).find(".maxcol");
                td.attr("title", td.html());
            },

            order: [
                [1, 'asc']
            ],

            // ajax: function(data, callback, settings) {
            //     var out = [];

            //     for (var i = data.start, ien = data.start + data.length; i < ien; i++) {
            //         out.push([i + '-1', i + '-2', i + '-3', i + '-4', i + '-5']);
            //     }

            //     setTimeout(function() {
            //         callback({
            //             draw: data.draw,
            //             data: out,
            //             recordsTotal: 100,
            //             recordsFiltered: 100
            //         });
            //     }, 50);
            // },

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



    function edit(nidn) {
        $.ajax({
            type: "post",
            url: "<?= base_url('dosen/get_dosen_edit'); ?>",
            data: {
                nidn: nidn
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('.view-form').html(response.output).show();
                    $('#editDosen').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deletes(nidn) {
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
                    url: "<?= base_url('dosen/delete_data'); ?>",
                    data: {
                        nidn: nidn
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.output) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.output,
                            });
                            getDosen();
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