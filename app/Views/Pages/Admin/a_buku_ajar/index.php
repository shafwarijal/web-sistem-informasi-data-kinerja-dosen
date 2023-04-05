<?= $this->extend('pages/admin/template_admin'); ?>


<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">


            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Tabel Buku Ajar
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2 btn-add"><i class="fas fa-plus-square"></i> Tambah Data</a>

                    <!-- Get Data -->
                    <div class="table-responsive list-buku-ajar">

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="view-form" style="display: none;"></div>

    <script type="text/javascript">
        // Function get product ajax
        function getBukuAjar() {
            $.ajax({
                url: "<?= base_url('buku_ajar/get_buku_ajar') ?>",
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
        }

        // view output
        $(document).ready(function() {
            getBukuAjar();

            $('.btn-add').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('buku_ajar/get_add_buku_ajar'); ?>",
                    dataType: "json",
                    success: function(response) {
                        $('.view-form').html(response.output).show();

                        $('#addBukuAjar').modal('show')
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });
    </script>


    <?= $this->endSection(); ?>