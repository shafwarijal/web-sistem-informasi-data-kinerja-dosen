<!-- Modal -->



<div class="modal fade hide" id="addAkunadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Penelitian</h5>
                <button type="button" class="close" onclick="$('#addAkunadmin').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('akunadmin/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_admin" class="col-sm-3 col-form-label">Nama Admin</label>
                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="nama_admin" name="nama_admin">

                        <div class="invalid-feedback errorNama_admin">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nidn" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username">
                        <div class="invalid-feedback errorUsername">

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
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#addAkunadmin').modal('hide');">Cancel</button>
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
                        if (response.error.nama_admin) {
                            $('#nama_admin').addClass('is-invalid');
                            $('.errorNama_admin').html(response.error.nama_admin);
                        } else {
                            $('#nama_admin').removeClass('is-invalid');
                            $('.errorNama_admin').html('');
                        }

                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('.errorUsername').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('.errorUsername').html('');
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

                        $('#addAkunadmin').modal('hide');
                        getAkunadmin();
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