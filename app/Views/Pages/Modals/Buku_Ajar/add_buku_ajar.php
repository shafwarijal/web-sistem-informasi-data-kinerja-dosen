<!-- Modal -->
<div class="modal fade hide" id="addBukuAjar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Buku Ajar</h5>
                <button type="button" class="close" onclick="$('#addBukuAjar').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('buku_ajar/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_buku_ajar" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_buku_ajar" name="nama_buku_ajar" value="<?php echo session()->get('role') == "2" ? session()->get('nama_user') : '' ?>" <?php echo session()->get('role') == "2" ? 'readonly' : '' ?>>
                        <!-- <div class="invalid-feedback errorNidn"> BELUM DI BENERIN 

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nidn_buku_ajar" class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn_buku_ajar" name="nidn_buku_ajar" value="<?php echo session()->get('role') == "2" ? session()->get('nidn') : '' ?>" readonly>

                    </div>
                </div>


                <div class="form-group row">
                    <label for="judul_buku_ajar" class="col-sm-3 col-form-label">Judul Buku Ajar</label>
                    <div class="col-sm-9">
                        <textarea name="judul_buku_ajar" id="judul_buku_ajar" rows="4" class="form-control"></textarea>
                        <div class="invalid-feedback errorJudul">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="isbn" class="col-sm-3 col-form-label">ISBN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="isbn" name="isbn">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>


                <div class="form-group row">
                    <label for="jumlah_halaman" class="col-sm-3 col-form-label">Jumlah Halaman</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jumlah_halaman" name="jumlah_halaman">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="penerbit" name="penerbit">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun_buku_ajar" class="col-sm-3 col-form-label">Tahun Buku Ajar</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun_buku_ajar" name="tahun_buku_ajar" autocomplete="off" placeholder="Tahun">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan_invalid" class="col-sm-3 col-form-label">Keterangan Invalid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan_invalid" name="keterangan_invalid">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#addBukuAjar').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tahun_buku_ajar").datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy',

        });
    });

    $('#nama_buku_ajar').autocomplete({
        appendTo: '.form-add',
        source: '/buku_ajar/get_Dosen',
        focus: function(event, ui) {
            $("#nama_buku_ajar").val(ui.item.label);
            return false;
        },
        
        select: function(event, ui) {
            // Set selection
            $('#nama_buku_ajar').val(ui.item.label); // display the selected text
            $('#nidn_buku_ajar').val(ui.item.value); // save selected id to input
            return false;
        },
        focus: function(event, ui) {
            $("#nama_buku_ajar").val(ui.item.label);
            $("#nidn_buku_ajar").val(ui.item.value);
            return false;
        },


    });

    $(document).ready(function() {
        $('.form-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-save').attr('disable', 'disabled');
                    $('.btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-save').removeAttr('disable');
                    $('.btn-save').html('Save');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nidn) {
                            $('#nidn').addClass('is-invalid');
                            $('.errorNidn').html(response.error.nidn);
                        } else {
                            $('#nidn').removeClass('is-invalid');
                            $('.errorNidn').html('');
                        }

                        if (response.error.judul_penelitian) {
                            $('#nama_dosen').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_penelitian);
                        } else {
                            $('#nama_dosen').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                        // if (response.error.jekel) {
                        //     $('#jekel').addClass('is-invalid');
                        //     $('.errorJekel').html(response.error.jekel);
                        // } else {
                        //     $('#jekel').removeClass('is-invalid');
                        //     $('.errorJekel').html('');
                        // }
                        // if (response.error.jekel) {
                        //     $('#jekel2').addClass('is-invalid');
                        //     $('.errorJekel').html(response.error.jekel);
                        // } else {
                        //     $('#jekel2').removeClass('is-invalid');
                        //     $('.errorJekel').html('');
                        // }

                        // if (response.error.program_studi) {
                        //     $('#program_studi').addClass('is-invalid');
                        //     $('.errorProgramStudi').html(response.error.program_studi);
                        // } else {
                        //     $('#program_studi').removeClass('is-invalid');
                        //     $('.errorProgramStudi').html('');
                        // }

                        // if (response.error.password) {
                        //     $('#password').addClass('is-invalid');
                        //     $('.errorPassword').html(response.error.password);
                        // } else {
                        //     $('#password').removeClass('is-invalid');
                        //     $('.errorPassword').html('');
                        // }

                        // if (response.error.password_confirm) {
                        //     $('#password_confirm').addClass('is-invalid');
                        //     $('.errorPasswordConf').html(response.error.password_confirm);
                        // } else {
                        //     $('#password_confirm').removeClass('is-invalid');
                        //     $('.errorPasswordConf').html('');
                        // }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1800
                        })

                        $('#addBukuAjar').modal('hide');
                        getBukuAjar();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>