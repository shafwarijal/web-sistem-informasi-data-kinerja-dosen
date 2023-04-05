<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>


<div id="user_content">
    <main>
        <div class="container">
            <div class="card card-body mt-4">
                <div class="row g-2">

                    <div class="col-md-2">
                        <select name="s_jekel" id="s_jekel" class="form-control mt-2 mb-2">
                            <option value="" selected="selected">Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-10">

                        <input type="text" id="s_search" class="form-control mt-2 mb-2" placeholder="Cari">
                    </div>


                </div>
            </div>
        </div>

        <div class="container" id="list_dosen">

        </div>
    </main>





    <script>
        function getDosen(page, jekel, search) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('dosen/get_dosen') ?>",
                data: {
                    page: page,
                    jekel: jekel,
                    search: search,
                },
                success: function(data) {
                    $('#list_dosen').html(data);
                }
            });
        }

        $("#s_jekel").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#s_jekel").change();

        $(document).ready(function() {
            getDosen();

            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                var jekel = $("#s_jekel").val();
                var search = $("#s_search").val();
                getDosen(page, jekel, search);
            });
            $('#s_search').keyup(function() {
                var page = "1";
                var jekel = $("#s_jekel").val();
                var search = $("#s_search").val();
                getDosen(page, jekel, search);
            });

            $('#s_jekel').change(function() {
                var page = "1";
                var jekel = $("#s_jekel").val();
                var search = $("#s_search").val();
                getDosen(page, jekel, search);
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