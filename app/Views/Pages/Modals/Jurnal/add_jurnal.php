<!-- Modal -->
<div class="modal fade hide" id="addJurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i>Add Jurnal</h5>
                <button type="button" class="close" onclick="$('#addJurnal').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('jurnal/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="judul_jurnal" class="col-sm-3 col-form-label">Judul Jurnal</label>
                    <div class="col-sm-9">
                        <textarea name="judul_jurnal" id="judul_jurnal" rows="4" class="form-control"></textarea>
                        <div class="invalid-feedback errorJudulJurnal">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_jurnal" class="col-sm-3 col-form-label">Nama Jurnal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_jurnal" name="nama_jurnal">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_personil" class="col-sm-3 col-form-label">Nama Personil</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_personil" name="nama_personil">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="issn" class="col-sm-3 col-form-label">Issn</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="issn" name="issn">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="volume" class="col-sm-3 col-form-label">Volume</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="volume" name="volume">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="nomor1" class="col-sm-3 col-form-label">Nomor</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomor1" name="nomor1">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="halaman_awal" class="col-sm-3 col-form-label">Halaman Awal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="halaman_awal" name="halaman_awal">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="halaman_akhir" class="col-sm-3 col-form-label">Halaman Akhir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="halaman_akhir" name="halaman_akhir">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_akreditasi" class="col-sm-3 col-form-label">Status Akreditasi</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status_akreditasi" id="status_akreditasi">
                            <option value="">Pilih</option>
                            <option value="Terakreditasi">Terakreditasi</option>
                            <option value="Tidak Terakreditasi">Tidak Terakreditasi</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tingkat" class="col-sm-3 col-form-label">Tingkat</label>
                    <div class="col-sm-9">

                        <select class="form-control" name="tingkat" id="tingkat">
                            <option value="">Pilih</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Regional">Regional</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun_jurnal" class="col-sm-3 col-form-label">Tahun Jurnal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun_jurnal" name="tahun_jurnal" autocomplete="off" placeholder="Tahun">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Url</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="url" name="url">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#addJurnal').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tahun_jurnal").datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy',

        });
    });

    $("#status_akreditasi").change(function() {
        if ($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("#status_akreditasi").change();

    $("#tingkat").change(function() {
        if ($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("#tingkat").change();

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
                        if (response.error.judul_jurnal) {
                            $('#judul_jurnal').addClass('is-invalid');
                            $('.errorJudulJurnal').html(response.error.nidn);
                        } else {
                            $('#judul_jurnal').removeClass('is-invalid');
                            $('.errorJudulJurnal').html('');
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

                        $('#addJurnal').modal('hide');
                        getJurnal();
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