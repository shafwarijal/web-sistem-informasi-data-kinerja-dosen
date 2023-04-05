<?= $this->extend('pages/admin/template_admin'); ?>


<?= $this->section('content'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="col-lg-3">
                <div class="card mt-4 ">
                    <?= form_open('export/laporan', ['target' => '_blank']) ?>
                    <div class="card-header">
                        Export Laporan Excel
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select name="jenis_data" id="jenis_data" name="jenis_data" class="form-control select mt-2 mb-2" required>
                                <option value="" selected="selected">Jenis Data</option>
                                <option value="penelitian">Penelitian</option>
                                <option value="pemakalah">Pemakalah</option>
                                <option value="jurnal">Jurnal</option>
                                <option value="hki">HKI</option>
                                <option value="buku_ajar">Buku Ajar</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control mt-2 mb-2" id="tahun_data" name="tahun_data" placeholder="Tahun" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2" name="btnexport">
                                Export Laporan
                            </button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </main>

    <div class="view-form" style="display: none;"></div>

    <script>
        $("#s_status").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#s_status").change();


        $("#jenis_data").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#jenis_data").change();
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

        $(function() {
            $("#tahun_data").datepicker({
                autoHide: true,
                zIndex: 2048,
                format: 'yyyy'
            });
        });
    </script>


    <?= $this->endSection(); ?>