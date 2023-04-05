<!-- Modal -->


<div class="modal fade" id="addDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Dosen</h5>
                <button type="button" class="close" onclick="$('#addDosen').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('dosen/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn" name="nidn">
                        <div class="invalid-feedback errorNidn">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen">
                        <div class="invalid-feedback errorNamaDosen">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="gelar" name="gelar">
                        <div class="invalid-feedback errorGelar">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nip" name="nip">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="jekel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="form-check col-sm-9">
                        <input type="radio" class="form-check-input" id="jekel" name="jekel" value="L">
                        <label class="form-check-label" for="jekel">
                            Laki laki
                        </label> <br>
                        <input type="radio" class="form-check-input" id="jekel2" name="jekel" value="P">
                        <label class="form-check-label" for="jekel2">
                            Perempuan
                        </label> <br>
                        <div class="invalid-feedback errorJekel">
                        </div>
                    </div>

                </div> -->
                <div class="form-group row">
                    <label for="jekel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="jekel" name="jekel" value="L">
                            <label class="form-check-label" for="jekel">Laki-laki</label>

                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="jekel2" name="jekel" value="P">
                            <label class="form-check-label" for="jekel2">Perempuan</label>
                        </div>
                        <div class="invalid-feedback errorJekel">
                        </div>
                    </div><br>

                </div>
                <!-- <fieldset class="form-group">
                    <div class="row">

                        <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="jekel1" name="jekel" value="L">
                                <label class="form-check-label" for="jekel1">
                                    Laki laki
                                </label>
                                <div class="invalid-feedback errorJekel">
                                </div>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="jekel2" name="jekel" value="P">
                                <label class="form-check-label" for="jekel2">
                                    Perempuan
                                </label>
                                <div class="invalid-feedback errorJekel">
                                </div>
                            </div>
                            <div class="invalid-feedback errorJekel">
                            </div>
                        </div>
                    </div>
                </fieldset> -->
                <!-- <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    First radio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Second radio
                                </label>
                            </div>
                            <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                                <label class="form-check-label" for="gridRadios3">
                                    Third disabled radio
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset> -->
                <div class="form-group row">
                    <label for="jabatan_akademik" class="col-sm-3 col-form-label">Jabatan Akademik</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan_akademik" name="jabatan_akademik">
                        <div class="invalid-feedback errorJabatanAkademik">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="program_studi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="program_studi" name="program_studi">
                        <div class="invalid-feedback errorProgramStudi">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        <div class="invalid-feedback errorPassword">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirm" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" autocomplete="new-password">
                        <div class="invalid-feedback errorPasswordConf">

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#addDosen').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
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

                        if (response.error.nama_dosen) {
                            $('#nama_dosen').addClass('is-invalid');
                            $('.errorNamaDosen').html(response.error.nama_dosen);
                        } else {
                            $('#nama_dosen').removeClass('is-invalid');
                            $('.errorNamaDosen').html('');
                        }

                        if (response.error.jekel) {
                            $('#jekel').addClass('is-invalid');
                            $('.errorJekel').html(response.error.jekel);
                        } else {
                            $('#jekel').removeClass('is-invalid');
                            $('.errorJekel').html('');
                        }
                        if (response.error.jekel) {
                            $('#jekel2').addClass('is-invalid');
                            $('.errorJekel').html(response.error.jekel);
                        } else {
                            $('#jekel2').removeClass('is-invalid');
                            $('.errorJekel').html('');
                        }

                        if (response.error.program_studi) {
                            $('#program_studi').addClass('is-invalid');
                            $('.errorProgramStudi').html(response.error.program_studi);
                        } else {
                            $('#program_studi').removeClass('is-invalid');
                            $('.errorProgramStudi').html('');
                        }

                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('.errorPassword').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('.errorPassword').html('');
                        }

                        if (response.error.password_confirm) {
                            $('#password_confirm').addClass('is-invalid');
                            $('.errorPasswordConf').html(response.error.password_confirm);
                        } else {
                            $('#password_confirm').removeClass('is-invalid');
                            $('.errorPasswordConf').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1200
                        })

                        $('#addDosen').modal('hide');
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