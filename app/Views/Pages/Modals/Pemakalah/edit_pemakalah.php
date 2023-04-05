<!-- Modal -->
<div class="modal fade" id="editPemakalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i>Edit Pemakalah</h5>
                <button type="button" class="close" onclick="$('#editPemakalah').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pemakalah/update_data/' . $id_pemakalah, ['class' => 'form-edit']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_pemakalah" value="<?= $id_pemakalah; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama_dosen; ?>">
                        <!-- <div class="invalid-feedback errorNidn"> BELUM DI BENERIN 

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn" name="nidn" value="<?= $nidn; ?>" readonly>

                        <div class="invalid-feedback errorNidn">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_pemakalah" class="col-sm-3 col-form-label">Status Pemakalah</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status_pemakalah" id="status_pemakalah">
                            <option value="">Pilih</option>
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
                        <textarea name="judul_makalah" id="judul_makalah" rows="4" class="form-control"><?= $judul_makalah; ?></textarea>
                        <div class="invalid-feedback errorJudul">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_forum" class="col-sm-3 col-form-label">Nama Forum</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_forum" name="nama_forum" value="<?= $nama_forum; ?>">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="institusi_penyelenggara" class="col-sm-3 col-form-label">Institusi Penyelenggara</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="institusi_penyelenggara" name="institusi_penyelenggara" value="<?= $institusi_penyelenggara; ?>">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_mulai_pelaksanaan" class="col-sm-3 col-form-label">Tanggal Mulai Pelaksanaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_mulai_pelaksanaan" name="tgl_mulai_pelaksanaan" autocomplete="off" value="<?= $tgl_mulai_pelaksanaan; ?>">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="tgl_akhir_pelaksanaan" class="col-sm-3 col-form-label">Tanggal Akhir Pelaksanaan</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl_akhir_pelaksanaan" name="tgl_akhir_pelaksanaan" value="<?= $tgl_akhir_pelaksanaan; ?>">
                        <div class="invalid-feedback errorNip">


                        </div>
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="tgl_akhir_pelaksanaan" class="col-sm-3 col-form-label">Tanggal Akhir Pelaksanaan</label>
                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="tgl_akhir_pelaksanaan" name="tgl_akhir_pelaksanaan" autocomplete="off" value="<?= $tgl_akhir_pelaksanaan; ?>">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>




                <div class="form-group row">
                    <label for="kd_sts_berkas_makalah" class="col-sm-3 col-form-label">Status Berkas Makalah</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="kd_sts_berkas_makalah" name="kd_sts_berkas_makalah">
                            <option value="">Pilih</option>
                            <option value="1">Valid</option>
                            <option value="0">Invalid</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan_invalid" class="col-sm-3 col-form-label">Keterangan Invalid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan_invalid" name="keterangan_invalid" value="<?= $keterangan_invalid; ?>">

                    </div>
                </div>


                <div class="form-group row">
                    <label for="tempat_pelaksanaan" class="col-sm-3 col-form-label">Tempat Pelakasaan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tempat_pelaksanaan" name="tempat_pelaksanaan" value="<?= $tempat_pelaksanaan; ?>">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="tahun_pemakalah" class="col-sm-3 col-form-label">Tahun Pemakalah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun_pemakalah" name="tahun_pemakalah" value="<?= $tahun_pemakalah; ?>" autocomplete="off">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
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


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#editPemakalah').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-update">Update</button>
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
    // $('#status_pemakalah option[value=' + $status_pemakalah + ']').prop('selected', true);
    // $("div.id_100 > select > option[value=" + value + "]").prop("selected",true);
    // $("select[name='status_pemakalah'] option[value=" + $status_pemakalah + "]").attr('selected', 'selected');
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
        appendTo: '.form-edit',
        source: '/pemakalah/get_Dosen',
        focus: function(event, ui) {
            $("#nama").val(ui.item.label);
            return false;
        },

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



        $('#status_pemakalah option[value="<?= $status_pemakalah ?>"]').prop('selected', true);

        $('#kd_sts_berkas_makalah option[value="<?= $kd_sts_berkas_makalah ?>"]').prop('selected', true);

        $('#tingkat option[value="<?= $tingkat; ?>"]').prop('selected', true);



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

                        if (response.error.judul_makalah) {
                            $('#nama_dosen').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_makalah);
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
                            title: 'Berhasil',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1800
                        })

                        $('#editPemakalah').modal('hide');
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