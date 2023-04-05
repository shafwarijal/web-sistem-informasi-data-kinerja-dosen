<!-- Modal -->
<div class="modal fade hide" id="addPemakalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Pemakalah</h5>
                <button type="button" class="close" onclick="$('#addPemakalah').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pemakalah/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo session()->get('role') == "2" ? session()->get('nama_user') : '' ?>" <?php echo session()->get('role') == "2" ? 'readonly' : '' ?>>
                        <!-- <div class="invalid-feedback errorNidn"> BELUM DI BENERIN 

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn" name="nidn" value="<?php echo session()->get('role') == "2" ? session()->get('nidn') : '' ?>" readonly>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_pemakalah" class="col-sm-3 col-form-label">Status Pemakalah</label>
                    <div class="col-sm-9">
                        <select class="form-control select" name="status_pemakalah" id="status_pemakalah">
                            <option value="" selected="selected">Pilih</option>
                            <option value="Pemakalah Biasa">Pemakalah Biasa</option>
                            <option value="Invited / Keynote Speaker">Invited / Keynote Speaker</option>
                        </select>
                        <div class="invalid-feedback errorGelar">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul_makalah" class="col-sm-3 col-form-label">Judul Makalah</label>
                    <div class="col-sm-9">
                        <textarea name="judul_makalah" id="judul_makalah" rows="4" class="form-control"></textarea>
                        <div class="invalid-feedback errorJudul">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_forum" class="col-sm-3 col-form-label">Nama Forum</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_forum" name="nama_forum">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="institusi_penyelenggara" class="col-sm-3 col-form-label">Institusi Penyelenggara</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="institusi_penyelenggara" name="institusi_penyelenggara">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_mulai_pelaksanaan" class="col-sm-3 col-form-label">Tanggal Mulai Pelaksanaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_mulai_pelaksanaan" name="tgl_mulai_pelaksanaan" autocomplete="off" placeholder="yyyy-mm-dd">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_akhir_pelaksanaan" class="col-sm-3 col-form-label">Tanggal Akhir Pelaksanaan</label>
                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="tgl_akhir_pelaksanaan" name="tgl_akhir_pelaksanaan" autocomplete="off" placeholder="yyyy-mm-dd">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>





                <div class="form-group row">
                    <label for="kd_sts_berkas_makalah" class="col-sm-3 col-form-label">Status Berkas Makalah</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="kd_sts_berkas_makalah" name="kd_sts_berkas_makalah">
                            <option value="" selected="selected">Pilih</option>
                            <option value="1">Valid</option>
                            <option value="0">Invalid</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan_invalid" class="col-sm-3 col-form-label">Keterangan Invalid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan_invalid" name="keterangan_invalid">

                    </div>
                </div>


                <div class="form-group row">
                    <label for="tempat_pelaksanaan" class="col-sm-3 col-form-label">Tempat Pelakasaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tempat_pelaksanaan" name="tempat_pelaksanaan">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="tahun_pemakalah" class="col-sm-3 col-form-label">Tahun Pemakalah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun_pemakalah" name="tahun_pemakalah" autocomplete="off" placeholder="Tahun">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tingkat" class="col-sm-3 col-form-label">Tingkat</label>
                    <div class="col-sm-9">

                        <select class="form-control" name="tingkat" id="tingkat">
                            <option value="" selected="selected">Pilih</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Regional">Regional</option>
                        </select>
                    </div>
                </div>







            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#addPemakalah').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tgl_akhir_pelaksanaan").datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy-mm-dd',

        });
    });

    $(function() {
        $("#tgl_mulai_pelaksanaan").datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy-mm-dd',

        });
    });

    $(function() {
        $("#tahun_pemakalah").datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy',

        });
    });

    $("#status_pemakalah").change(function() {
        if ($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("#status_pemakalah").change();

    $("#kd_sts_berkas_makalah").change(function() {
        if ($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("#kd_sts_berkas_makalah").change();

    $("#tingkat").change(function() {
        if ($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("#tingkat").change();


    $('#nama').autocomplete({
        appendTo: '.form-add',
        source: '/pemakalah/get_Dosen',
        focus: function(event, ui) {
            $("#nama").val(ui.item.label);
            return false;
        },
        // select: function(event, ui) {
        //     $("#cari").val(ui.item.label);

        //     $("#results").text(ui.item.email);
        //     return false;
        // },

        // function(request, response) {
        //     $.ajax({
        //         url: "",
        //         type: "post",
        //         dataType: "json",
        //         data: {
        //             search: request.term,
        //         },
        //         success: function(data) {

        //             response(data.data);
        //         }
        //     });

        // },
        // select: function(event, data) {
        //     $('#nama_ketua').val(ui.item.lebel);
        //     $('#nidn').val(ui.item.value);

        //     return false;
        // },
        // focus: function(event, ui) {
        //     $('#nama_ketua').val(ui.item.lebel);
        //     $('#nidn').val(ui.item.value);

        //     return false;
        // },
        select: function(event, ui) {
            // Set selection
            $('#nama').val(ui.item.label); // display the selected text
            $('#nidn').val(ui.item.value); // save selected id to input
            return false;
        },
        focus: function(event, ui) {
            $("#nama").val(ui.item.label);
            $("#nidn").val(ui.item.value);
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
                            $('#nama').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_penelitian);
                        } else {
                            $('#nama').removeClass('is-invalid');
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
                            title: 'Berhasil',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1800
                        })

                        $('#addPemakalah').modal('hide');
                        getPemakalah();
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