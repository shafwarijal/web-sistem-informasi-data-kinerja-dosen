<?= $this->extend('pages/admin/template_admin'); ?>


<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">


            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Tabel Jurnal
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2 btn-add"><i class="fas fa-plus-square"></i>Tambah Data</a>

                    <!-- Get Data -->
                    <div class="table-responsive list-jurnal">

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="view-form" style="display: none;"></div>

    <script type="text/javascript">
        // Function get product ajax
        function getJurnal() {
            $.ajax({
                url: "<?= base_url('jurnal/get_jurnal') ?>",
                "processing": true,
                "serverSide": true,
                dataType: "json",
                data: JSON.stringify,
                success: function(response) {
                    $('.list-jurnal').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }

        // view output
        $(document).ready(function() {
            getJurnal();

            $('.btn-add').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('jurnal/get_add_jurnal'); ?>",
                    dataType: "json",
                    success: function(response) {
                        $('.view-form').html(response.output).show();

                        $('#addJurnal').modal('show')
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });
    </script>


    <?= $this->endSection(); ?>