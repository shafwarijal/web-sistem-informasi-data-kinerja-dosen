<div id="getDosen">
    <div class="row">
        <?php
        foreach ($data_dosen->getResultArray() as $row) :

        ?>
            <div class="col-md-6">
                <div href="<?= base_url('dosen/detail_dosen/' . $row['nidn']) ?>" class="card card-body mt-4">
                    <div class="row">
                        <div class="col-sm-3">NIDN</div>
                        <div class="col-sm-9">: <?= $row['nidn'] ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-3">Nama Dosen</div>
                        <div class="col-sm-9">: <?= $row['nama_dosen'] ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-3">Gelar</div>
                        <div class="col-sm-9">: <?= $row['gelar'] ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-3">Jenis Kelamin</div>
                        <div class="col-sm-9">:
                            <?php
                            if ($row['jekel'] == 'L') {
                                echo "Laki-Laki";
                            } else if ($row['jekel'] == 'P') {
                                echo "Perempuan";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-3">Jabatan Akedemik</div>
                        <div class="col-sm-9">: <?= $row['jabatan_akademik'] ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-3">Program Studi</div>
                        <div class="col-sm-9">: <?= $row['program_studi'] ?></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-3"></div>
                        <div class="col ms-1">
                            <a class="btn btn-outline-secondary btn-sm mb-1" href="<?= base_url('dosen/detail_dosen/' . $row['nidn']) ?>">
                                Detail Dosen
                            </a>
                        </div>

                    </div>

                </div>
            </div>


        <?php
        endforeach
        ?>

    </div>

    <?php

    $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

    $limit = 10;
    $limit_start = ($page - 1) * $limit;
    $no = $limit_start + 1;

    foreach ($total->getResultArray() as $row) {
        $total_records = $row['jumlah'];
    }


    ?>

    <div class="row mt-4">
        <Div class="col">
            <p>Total baris : <?php echo $total_records; ?></p>
        </Div>
        <Div class="col">
            <nav class="mb-2">
                <ul class="pagination justify-content-end">
                    <?php
                    $jumlah_page = ceil($total_records / $limit);
                    $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
                    $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                    $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;



                    if ($page == 1) {
                        echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                    } else {
                        $link_prev = ($page > 1) ? $page - 1 : 1;
                        echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                        echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                    }

                    for ($i = $start_number; $i <= $end_number; $i++) {
                        $link_active = ($page == $i) ? ' active' : '';
                        echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
                    }

                    if ($page == $jumlah_page) {
                        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                        echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                    } else {
                        $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                        echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                        echo '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="#">Last</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </Div>
    </div>


</div>

</div>

<script>
    function detail(nidn) {
        $.ajax({
            type: "post",
            url: "<?= base_url('dosen/detail_dosen/'); ?>",
            data: {
                nidn: nidn
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('#detail_dosen').html(data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function edit(id_jurnal) {
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

    function deletes(id_jurnal) {
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