<div class="card card-body mt-4" id="getJurnal">
    <div class="row">

        <?php
        foreach ($data_jurnal->getResultArray() as $row) :

        ?>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-2">Judul Jurnal</div>
                    <div class="col-sm-10"><?= $row['judul_jurnal'] ?></div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-2">Nama Jurnal</div>
                    <div class="col-sm-10"><?= $row['nama_jurnal'] ?></div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-2">Nama Personil</div>
                    <div class="col-sm-10"><?= $row['nama_personil'] ?></div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-2">Issn</div>
                    <div class="col-sm-10"><?= $row['issn'] ?>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-2"></div>
                    <div class="col">
                        <a class="btn btn-outline-primary" href="<?= $row['url'] ?>" target="_blank">Link</a>
                    </div>
                </div>





                <hr />

            </div>
        <?php
        endforeach
        ?>


        <?php

        $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

        $limit = 5;
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        foreach ($total->getResultArray() as $row) {
            $total_records = $row['jumlah'];
        }


        ?>

        <div class="row">
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