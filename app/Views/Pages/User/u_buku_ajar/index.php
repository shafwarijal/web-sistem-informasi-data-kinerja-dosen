<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>


<div id="user_content">
    <main>

        <div class="container">
            <div class="card card-body mt-4">
                <div class="row g-2">

                    <div class="col-md-2">
                        <a href="" class="btn btn-primary mt-2 mb-2 btn-add-buku-ajar">Tambah Data</a>

                    </div>


                    <div class="col-md-10">

                        <input type="text" id="s_search" class="form-control mt-2 mb-2" placeholder="Cari">
                    </div>


                </div>
            </div>
        </div>

        <div class="container" id="list_buku_ajar">

        </div>
    </main>





    <script>
        function getBukuAjar(page, search) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('buku_ajar/get_buku_ajar') ?>",
                data: {
                    page: page,
                    search: search,
                },
                success: function(data) {
                    $('#list_buku_ajar').html(data);
                }
            });
        }



        $(document).ready(function() {
            getBukuAjar();

            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                var search = $("#s_search").val();
                getBukuAjar(page, search);
            });
            $('#s_search').keyup(function() {
                var page = "1";
                var search = $("#s_search").val();
                getBukuAjar(page, search);
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