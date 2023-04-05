<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>


<div id="user_content">
    <main>

        <div class="container">
            <div class="card card-body mt-4">
                <div class="row g-2">

                    <div class="col-md-2">
                        <a href="" class="btn btn-primary mt-2 mb-2 btn-add-jurnal">Tambah Data</a>

                    </div>

                    <div class="col-md-5">
                        <select name="s_tingkat" id="s_tingkat" class="form-control mt-2 mb-2">
                            <option value="" selected="selected">Tingkat</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Regional">Regional</option>
                        </select>
                    </div>
                    <div class="col-md-5">

                        <input type="text" id="s_search" class="form-control mt-2 mb-2" placeholder="Cari">
                    </div>


                </div>
            </div>
        </div>

        <div class="container" id="list_jurnal">

        </div>
    </main>





    <script>
        function getJurnal(page, tingkat, search) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('jurnal/get_jurnal') ?>",
                data: {
                    page: page,
                    tingkat: tingkat,
                    search: search,
                },
                success: function(data) {
                    $('#list_jurnal').html(data);
                }
            });
        }

        $("#s_tingkat").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#s_tingkat").change();

        $(document).ready(function() {
            getJurnal();

            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                var tingkat = $("#s_tingkat").val();
                var search = $("#s_search").val();
                getJurnal(page, tingkat, search);
            });
            $('#s_search').keyup(function() {
                var page = "1";
                var tingkat = $("#s_tingkat").val();
                var search = $("#s_search").val();
                getJurnal(page, tingkat, search);
            });

            $('#s_tingkat').change(function() {
                var page = "1";
                var tingkat = $("#s_tingkat").val();
                var search = $("#s_search").val();
                getJurnal(page, tingkat, search);
            });


            // function load_data(page, jurusan, keyword) {
            //     $.ajax({
            //         url: "data.php",
            //         method: "POST",
            //         data: {
            //             page: page,
            //             jurusan: jurusan,
            //             keyword: keyword
            //         },
            //         success: function(data) {
            //             $('#data').html(data);
            //         }
            //     })
            // }
            // $(document).on('click', '.halaman', function() {
            //     var page = $(this).attr("id");
            //     var jurusan = $("#s_jurusan").val();
            //     var keyword = $("#s_keyword").val();

            //     load_data(page, jurusan, keyword);
            // });

            // $("#search").click(function() {
            //     var page = "1";
            //     var jurusan = $("#s_jurusan").val();
            //     var keyword = $("#s_keyword").val();

            //     load_data(page, jurusan, keyword);
            // });


        });
    </script>

    <?= $this->endSection(); ?>