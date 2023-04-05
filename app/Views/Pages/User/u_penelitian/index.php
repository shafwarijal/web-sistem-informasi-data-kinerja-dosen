<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>


<div id="user_content">
    <main>

        <div class="container sticky-top1 collapse.show">
            <div class="card card-body mt-4">
                <div class="row g-2">

                    <div class="col-md-2">
                        <a href="" class="btn btn-primary mt-2 mb-2 btn-add-penelitian">Tambah Data</a>

                    </div>

                    <div class="col-md-5">
                        <select name="s_skema" id="s_skema" class="form-control mt-2 mb-2">
                            <option value="" selected="selected">Skema Penelitian</option>
                            <option value="Penelitian Dasar">Penelitian Dasar</option>
                            <option value="Penelitian Terapan">Penelitian Terapan</option>
                            <option value="Penelitian Pengembangan">Penelitian Pengembangan</option>
                            <option value="Penelitian Dasar Unggulan Perguruan Tinggi">Penelitian Dasar Unggulan Perguruan Tinggi</option>
                            <option value="Penelitian Terapan Unggulan Perguruan Tinggi">Penelitian Terapan Unggulan Perguruan Tinggi</option>
                            <option value="Penelitian Pengembangan Unggulan Perguruan Tinggi">Penelitian Pengembangan Unggulan Perguruan Tinggi</option>
                            <option value="Penelitian Tesis Magister">Penelitian Tesis Magister</option>
                            <option value="Penelitian Disertasi Doktor">Penelitian Disertasi Doktor</option>
                            <option value="Kajian Kebijakan Strategis">Kajian Kebijakan Strategis</option>
                        </select>

                    </div>
                    <div class="col-md-5">

                        <input type="text" id="s_search" class="form-control mt-2 mb-2" placeholder="Cari">
                    </div>


                </div>
            </div>
        </div>

        <div class="container" id="list_penelitian">

        </div>
    </main>





    <script>
        function getPenelitian(page, skema, search) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('penelitian/get_penelitian') ?>",
                data: {
                    page: page,
                    skema: skema,
                    search: search,

                },
                success: function(data) {
                    $('#list_penelitian').html(data);
                }
            });
        }

        $("#s_skema").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#s_skema").change();

        $(document).ready(function() {
            getPenelitian();


            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                var skema = $("#s_skema").val();
                var search = $("#s_search").val();
                getPenelitian(page, skema, search);
            });
            $('#s_search').keyup(function() {
                var page = "1";
                var skema = $("#s_skema").val();
                var search = $("#s_search").val();
                getPenelitian(page, skema, search);
            });

            $('#s_skema').change(function() {
                var page = "1";
                var skema = $("#s_skema").val();
                var search = $("#s_search").val();
                getPenelitian(page, skema, search);
            });

        });
    </script>

    <?= $this->endSection(); ?>