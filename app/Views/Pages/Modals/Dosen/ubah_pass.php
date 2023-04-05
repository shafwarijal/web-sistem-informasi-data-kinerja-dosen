<div class="modal fade" id="ubahpassDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Edit Dosen</h5>
                <button type="button" class="close" onclick="$('#ubahpassDosen').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('dosen/update_data_pass/' . $nidn, ['class' => 'form-edit']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="nidn" value="<?= $nidn; ?>">
            <div class="modal-body">


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
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#ubahpassDosen').modal('hide');">Cancel</button>
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

                        $('#ubahpassDosen').modal('hide');
                        location.reload();

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