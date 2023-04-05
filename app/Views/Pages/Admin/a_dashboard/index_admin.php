<?= $this->extend('pages/admin/template_admin'); ?>


<?= $this->section('content'); ?>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
            <div class="row">


                <div class="col-sm-2 mt-4">
                    <div class="card border-left-danger">
                        <a href="<?= base_url('dosen'); ?>" style="text-decoration:none;">
                            <div class="card-body">
                                <div class="font-weight-bold text-danger text-uppercase mb-1">Dosen</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_dosen ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mt-4">
                    <div class="card border-left-primary">
                        <a href="<?= base_url('penelitian'); ?>" style="text-decoration:none;">
                            <div class="card-body">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">Penelitian</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penelitian ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mt-4">
                    <div class="card border-left-warning">
                        <a href="<?= base_url('pemakalah'); ?>" style="text-decoration:none;">
                            <div class="card-body">
                                <div class="font-weight-bold text-warning text-uppercase mb-1">Pemakalah</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pemakalah ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mt-4">
                    <div class="card border-left-success">
                        <a href="<?= base_url('jurnal'); ?>" style="text-decoration:none;">
                            <div class="card-body">
                                <div class="font-weight-bold text-success text-uppercase mb-1">Jurnal</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_jurnal ?></div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mt-4">
                    <div class="card border-left-ungu">
                        <a href="<?= base_url('hki'); ?>" style="text-decoration:none;">
                            <div class="card-body">
                                <div class="font-weight-bold text-ungu text-uppercase mb-1">HKI</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_hki ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mt-4">
                    <div class="card border-left-info">
                        <a href="<?= base_url('buku_ajar'); ?>" style="text-decoration:none;">
                            <div class="card-body">
                                <div class="font-weight-bold text-info text-uppercase mb-1">Buku Ajar</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_buku_ajar ?></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Data Kinerja Dosen
                        </div>
                        <div class="card-body"><canvas id="tampilgrafiktahun"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">

                            <i class="fas fa-chart-pie mr-1"></i> Tingkat Data Kinerja Dosen

                        </div>

                        <div class="col-md-12 ms-3 me-3">

                            <select class="form-control mt-3" name="jenis" id="jenis" aria-label="Default select example">
                                <option value="pemakalah">Pemakalah</option>
                                <option value="jurnal">Jurnal</option>
                            </select>
                        </div>


                        <div class="card-body viewtampilgrafiktingkat">

                        </div>
                    </div>
                </div>
            </div>

    </main>

    <script>
        function tampilgrafik() {
            $.ajax({
                type: "post",
                url: "<?= base_url('admin/tampilgrafiktingkat') ?>",
                data: {
                    jenis: $('#jenis').val()
                },
                dataType: "json",

                success: function(response) {

                    $('.viewtampilgrafiktingkat').html(response.output);

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }

        // var myChart = document.getElementById('myChart');
        // var data_myChart = [];
        // var label_myChart = [];

        // <?php foreach ($grafik_tahun_penelitian->getResult() as $key => $value) : ?>
        //     data_myChart.push(<?= $value->jumlah ?>);
        //     label_myChart.push(<?= $value->tahun ?>);
        // <?php endforeach ?>

        // var data_penelitian = {
        //     datasets: [{
        //         label: 'jumlah',
        //         data: data_myChart,
        //         backgroundColor: [
        //             'rgba(255, 99, 132, 0.2)',
        //             'rgba(54, 162, 235, 0.2)',
        //             'rgba(255, 206, 86, 0.2)',
        //             'rgba(75, 192, 192, 0.2)',
        //             'rgba(153, 102, 255, 0.2)',
        //             'rgba(255, 159, 64, 0.2)'
        //         ],
        //     }],
        //     labels: label_myChart,
        // }

        // var chart_myChart = new Chart(myChart, {
        //     type: 'bar',
        //     data: data_penelitian
        // });


        var ctx1 = document.getElementById('tampilgrafiktahun').getContext('2d');
        var tampilgrafiktahun = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($tahun->getResultArray() as $tahunpem) : ?><?= $tahunpem['tahun_penelitian'] ?>, <?php endforeach ?>],
                datasets: [{
                        label: 'Penelitian',
                        data: [<?= $total ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            // rotation: 90,
                            anchor: 'end',
                            align: 'end',
                            color: [
                                'rgba(255, 99, 132, 1)',
                            ],
                        }
                    }, {
                        label: 'Pemakalah',
                        data: [<?= $totalpemakalah ?>],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            // rotation: 90,
                            anchor: 'end',
                            align: 'end',
                            color: [
                                'rgba(54, 162, 235, 1)',
                            ],
                        }

                    },
                    {
                        label: 'Jurnal',
                        data: [<?= $totaljurnal ?>],
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.6)',
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            // rotation: 90,
                            anchor: 'end',
                            align: 'end',
                            color: [
                                'rgba(255, 206, 86, 1)',
                            ],
                        }
                    },

                    {
                        label: 'HKI',
                        data: [<?= $totalhki ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            // rotation: 90,
                            anchor: 'end',
                            align: 'end',
                            color: [
                                'rgba(75, 192, 192, 1)',
                            ],
                        },

                    },

                    {
                        label: 'Buku Ajar',
                        data: [<?= $totalbukuajar ?>],
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.6)',
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1,
                        datalabels: {
                            // rotation: 90,
                            anchor: 'end',
                            align: 'end',
                            color: [
                                'rgba(153, 102, 255, 1)',
                            ],
                        }
                    },


                ]


            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    datalabels: {

                        font: {

                            weight: 'bold',
                        },
                        formatter: (value) => {
                            if (value == 0) {
                                return '';
                            } else {
                                return value;
                            }
                        },

                    }
                },

                // aspectRatio: 1.43,
                aspectRatio: 1.45,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $(document).ready(function() {
            tampilgrafik();

            $('#jenis').change(function(e) {
                e.preventDefault();
                tampilgrafik();
            })
        });
    </script>


    <?= $this->endSection(); ?>