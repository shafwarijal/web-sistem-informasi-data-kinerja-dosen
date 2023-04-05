    <div class="modal fade" id="editDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Edit Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('dosen/update_data/' . $nidn, ['class' => 'form-edit']); ?>
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nidn" name="nidn" value="<?= $nidn; ?>">
                            <div class="invalid-feedback errorNidn">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= $nama_dosen; ?>">
                            <div class="invalid-feedback errorNamaDosen">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="gelar" name="gelar" value="<?= $gelar; ?>">
                            <div class="invalid-feedback errorGelar">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip" name="nip" value="<?= $nip; ?>">
                            <div class="invalid-feedback errorNip">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jekel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <?php if ($jekel == 'L') : ?>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="jekel" name="jekel" value="L" <?= 'checked' ?>>
                                    <label class="form-check-label" for="jekel">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="jekel2" name="jekel" value="P">
                                    <label class="form-check-label" for="jekel2">Perempuan</label>
                                </div>
                            <?php elseif ($jekel == 'P') : ?>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="jekel" name="jekel" value="L">
                                    <label class="form-check-label" for="jekel">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="jekel2" name="jekel" value="P" <?= 'checked' ?>>
                                    <label class="form-check-label" for="jekel2">Perempuan</label>
                                </div>
                                <div class="invalid-feedback errorJekel">
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="jabatan_akademik" class="col-sm-3 col-form-label">Jabatan Akademik</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan_akademik" name="jabatan_akademik" value="<?= $jabatan_akademik; ?>">
                            <div class="invalid-feedback errorJabatanAkademik">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="program_studi" class="col-sm-3 col-form-label">Program Studi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?= $program_studi; ?>">
                            <div class="invalid-feedback errorProgramStudi">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" value="">
                            <div class="invalid-feedback errorPassword">

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirm" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="">
                            <div class="invalid-feedback errorPasswordConf">

                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm btn-update">Update</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.form-edit').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btn-update').attr('disable', 'disabled');
                        $('.btn-update').html('<i class="fas fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btn-update').removeAttr('disable');
                        $('.btn-update').html('Update');
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
                                timer: 1800
                            })

                            $('#editDosen').modal('hide');
                            getDosen();
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