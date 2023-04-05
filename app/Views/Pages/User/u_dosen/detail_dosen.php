<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <div class="row">

                <?php

                foreach ($detail->getResultArray() as $row) :
                    $nama = $row['nama_dosen'];

                ?>
                    <div class="col-md-12">
                        <div class="card card-body mt-4">
                            <div class="row">
                                <div class="col-sm-3">NIDN</div>
                                <div class="col-sm-9">: <?php echo $row['nidn']; ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-3">Nama Dosen</div>
                                <div class="col-sm-9">: <?= $nama; ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-3">Gelar</div>
                                <div class="col-sm-9">: <?= $row['gelar']; ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-3">Nip</div>
                                <div class="col-sm-9">: <?= $row['nip'];  ?></div>
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
                                <div class="col-sm-9">: <?= $row['jabatan_akademik']; ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-3">Program Studi</div>
                                <div class="col-sm-9">: <?= $row['program_studi']; ?></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <div class="<?php echo $row['nidn'] == session()->get('nidn') ? 'show' : 'hidden' ?>">
                                        <div class="row mt-1">
                                            <div class="col">
                                                <button class="btn btn-success btn-sm mb-1" onclick="edit('<?= $row['nidn']; ?>')">
                                                    Edit
                                                </button>

                                                <button class="btn btn-danger btn-sm mb-1" onclick="ubahpass('<?= $row['nidn']; ?>')">
                                                    Ubah Password
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <?php
                endforeach;

                ?>

                <div class="col-md-12 mt-4">
                    <div class="card " id="tabs">
                        <div class="card-header text-center">
                            <ul class="nav nav-tabs card-header-tabs tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-tab="tab-1">Penelitian</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="tab-2">Pemakalah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="tab-3">Jurnal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="tab-4">HKI</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-tab="tab-5">Buku Ajar</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-bodyy active" id="tab-1">
                            <div class="table-responsive list-penelitian">
                            </div>
                        </div>
                        <div class="card-bodyy" id="tab-2">
                            <div class="table-responsive list-pemakalah">
                            </div>
                        </div>
                        <div class="card-bodyy" id="tab-3">
                            <div class="table-responsive list-jurnal">
                            </div>
                        </div>
                        <div class="card-bodyy" id="tab-4">
                            <div class="table-responsive list-hki">
                            </div>
                        </div>
                        <div class="card-bodyy" id="tab-5">
                            <div class="table-responsive list-buku-ajar">
                            </div>
                        </div>

                    </div>

                </div>





            </div>


        </div>

    </main>

    <script type="text/javascript">
        // $(function() {
        //     $("#tabs").tabs();
        // });
        function getPenelitian() {


            $.ajax({
                url: "<?= base_url('dosen/get_penelitian_detail/' . $nidn) ?>",
                "processing": true,
                "serverSide": true,
                dataType: "json",
                success: function(response) {
                    $('.list-penelitian').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        };

        function getPemakalah() {


            $.ajax({
                url: "<?= base_url('dosen/get_pemakalah_detail/' . $nidn) ?>",
                "processing": true,
                "serverSide": true,
                dataType: "json",
                success: function(response) {
                    $('.list-pemakalah').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        };

        function getJurnal() {

            $.ajax({
                url: "<?= base_url('dosen/get_jurnal_detail/' . $nama) ?>",
                "processing": true,
                "serverSide": true,
                dataType: "json",
                success: function(response) {
                    $('.list-jurnal').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        };

        function getHki() {

            $.ajax({
                url: "<?= base_url('dosen/get_hki_detail/' . $nidn) ?>",
                "processing": true,
                "serverSide": true,
                dataType: "json",
                success: function(response) {
                    $('.list-hki').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        };

        function getBukuAjar() {

            $.ajax({
                url: "<?= base_url('dosen/get_buku_ajar_detail/' . $nidn) ?>",
                "processing": true,
                "serverSide": true,
                dataType: "json",
                success: function(response) {
                    $('.list-buku-ajar').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        };

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

        function ubahpass(nidn) {
            $.ajax({
                type: "post",
                url: "<?= base_url('dosen/get_ubah_password'); ?>",
                data: {
                    nidn: nidn
                },
                dataType: "json",
                success: function(response) {
                    if (response.output) {
                        $('.view-form').html(response.output).show();
                        $('#ubahpassDosen').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }



        $(document).ready(function() {
            getPenelitian();

            getPemakalah();

            getJurnal();

            getHki();

            getBukuAjar();


            // getJurnal();



            // $("#tabs").tabs({
            //     "activate": function(event, ui) {
            //         $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            //     }
            // });


            $('.tabs li a').click(function(event, ui) {
                event.preventDefault();
                var tab_id = $(this).attr('data-tab')
                $('.tabs li a').removeClass('active')
                $('.card-bodyy').removeClass('active')
                $(this).addClass('active')
                $("#" + tab_id).addClass('active')
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            })
        })
    </script>

    <?= $this->endSection(); ?>