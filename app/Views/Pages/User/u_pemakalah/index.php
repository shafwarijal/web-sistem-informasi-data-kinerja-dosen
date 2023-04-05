<?= $this->extend('pages/user/template_user'); ?>


<?= $this->section('content'); ?>


<div id="user_content">
    <main>

        <div class="container">
            <div class="card card-body mt-4">
                <div class="row g-2">

                    <div class="col-md-2">
                        <a href="" class="btn btn-primary mt-2 mb-2 btn-add-pemakalah">Tambah Data</a>

                    </div>

                    <div class="col-md-5">
                        <select name="s_status" id="s_status" class="form-control mt-2 mb-2">
                            <option value="" selected="selected">Status Pemakalah</option>
                            <option value="Pemakalah Biasa">Pemakalah Biasa</option>
                            <option value="Invited / Keynote Speaker">Invited / Keynote Speaker</option>
                        </select>

                    </div>
                    <div class="col-md-5">

                        <input type="text" id="s_search" class="form-control mt-2 mb-2" placeholder="Cari">
                    </div>


                </div>
            </div>
        </div>

        <div class="container" id="list_pemakalah">

        </div>
    </main>





    <script>
        function getPemakalah(page, status, search) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('pemakalah/get_pemakalah') ?>",
                data: {
                    page: page,
                    status: status,
                    search: search,
                },
                success: function(data) {
                    $('#list_pemakalah').html(data);
                }
            });
        }

        $("#s_status").change(function() {
            if ($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty")
        });
        $("#s_status").change();

        $(document).ready(function() {
            getPemakalah();

            $(document).on('click', '.halaman', function() {
                var page = $(this).attr("id");
                var status = $("#s_status").val();
                var search = $("#s_search").val();
                getPemakalah(page, status, search);
            });
            $('#s_search').keyup(function() {
                var page = "1";
                var status = $("#s_status").val();
                var search = $("#s_search").val();
                getPemakalah(page, status, search);
            });

            $('#s_status').change(function() {
                var page = "1";
                var status = $("#s_status").val();
                var search = $("#s_search").val();
                getPemakalah(page, status, search);
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