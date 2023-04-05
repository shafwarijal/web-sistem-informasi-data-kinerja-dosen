<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>


<div id="user_content">
    <main>

        <div class="container">
            <div class="card card-body mt-4">
                <div class="row g-2">

                    <div class="col-md-2">
                        <a href="" class="btn btn-primary mt-2 mb-2 btn-add-hki">Tambah Data</a>

                    </div>

                    <div class="col-md-5">
                        <select name="s_jenis" id="s_jenis" class="form-control mt-2 mb-2">
                            <option value="" selected="selected">Jenis HKI</option>
                            <option value="Hak Cipta">Hak Cipta</option>
                            <option value="Paten Sederhana">Paten Sederhana</option>
                        </select>

                    </div>
                    <div class="col-md-5">

                        <input type="text" id="s_search" class="form-control mt-2 mb-2" placeholder="Cari">
                    </div>


                </div>
            </div>
        </div>

        <div class="container" id="list_hki">

        </div>
    </main>





    <script>
        function getHki(page, jenis, search) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('hki/get_hki') ?>",
                data: {
                    page: page,
                    jenis: jenis,
                    search: search,
                },
                success: function(data) {
                    $('#list_hki').html(data);
                }
            });
        }

        $("#s_jenis").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#s_jenis").change();

        $(document).ready(function() {
            getHki();

            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                var jenis = $("#s_jenis").val();
                var search = $("#s_search").val();
                getHki(page, jenis, search);
            });

            $('#s_search').keyup(function() {
                var page = "1";
                var jenis = $("#s_jenis").val();
                var search = $("#s_search").val();
                getHki(page, jenis, search);
            });

            $('#s_jenis').change(function() {
                var page = "1";
                var jenis = $("#s_jenis").val();
                var search = $("#s_search").val();
                getHki(page, jenis, search);
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