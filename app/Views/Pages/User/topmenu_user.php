<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <div id="nav_active">
        <ul class="navbar-nav mt-4">
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('user'); ?>">HOME</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('penelitian'); ?>">PENELITIAN</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('pemakalah'); ?>">PEMAKALAH</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('jurnal'); ?>">JURNAL</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('hki'); ?>">HKI</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('buku_ajar'); ?>">BUKU AJAR</a>
            </li>
            <!-- <li class="nav-item dropdown mx-2">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PUBLIKASI
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li> -->
            <li class="nav-item mx-2">
                <a class="nav-link" href="<?= base_url('dosen'); ?>">DOSEN</a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav ms-auto mt-4">
        <li class="nav-item dropdown mx-2">
            <a class="nav-link" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Tambah Data
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                <li><a class="dropdown-item btn-add-penelitian" href="">Penelitian</a></li>
                <li><a class="dropdown-item btn-add-pemakalah" href="">Pemakalah</a></li>
                <li><a class="dropdown-item btn-add-jurnal" href="">Jurnal</a></li>
                <li><a class="dropdown-item btn-add-hki" href="">HKI</a></li>
                <li><a class="dropdown-item btn-add-buku-ajar" href="">Buku Ajar</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown mx-2">
            <a class="nav-link" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span><?= session()->get('nama_user'); ?></span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="<?= base_url('dosen/detail_dosen/' . session()->get('nidn')) ?>">Profil</a></li>
                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
            </ul>
        </li>
    </ul>


</div>


<script type="text/javascript">
    // view output
    $(document).ready(function() {
        // $('.btn-logout').click(function() {

        //     $.ajax({
        //         url: "<?= base_url('auth/logout'); ?>",
        //         dataType: "json",

        //     });
        // });

        $('.btn-add-penelitian').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('penelitian/get_add_penelitian'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.view-form').html(response.output).show();

                    $('#addPenelitian').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.btn-add-pemakalah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('pemakalah/get_add_pemakalah'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.view-form').html(response.output).show();

                    $('#addPemakalah').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.btn-add-dosen').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('dosen/get_add_dosen'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.view-form').html(response.output).show();

                    $('#addDosen').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.btn-add-jurnal').click(function(e) {
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



        $('.btn-add-hki').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('hki/get_add_hki'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.view-form').html(response.output).show();

                    $('#addHki').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.btn-add-buku-ajar').click(function(e) {
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