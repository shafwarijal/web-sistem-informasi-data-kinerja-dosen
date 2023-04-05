<!-- Modal -->
<div class="modal fade hide" id="editPenelitian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i>Edit Penelitian</h5>
                <button type="button" class="close" onclick="$('#editPenelitian').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('penelitian/update_data/' . $id_penelitian, ['class' => 'form-edit']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_penelitian" value="<?= $id_penelitian; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_ketua" class="col-sm-3 col-form-label">Nama Ketua</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" value="<?= $nama_dosen; ?>">
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
                    <label for="nama_anggota" class="col-sm-3 col-form-label">Nama Anggota</label>
                    <div class="col-sm-9">

                        <select class="js-example-basic-multiple form-control" name="nama_anggota[]" multiple="multiple">


                            <?=
                            $nama_anggota
                            ?>


                        </select>
                        <div class=" invalid-feedback errorGelar">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul_penelitian" class="col-sm-3 col-form-label">Judul Penelitian</label>
                    <div class="col-sm-9">
                        <textarea name="judul_penelitian" id="judul_penelitian" rows="4" class="form-control"><?= $judul_penelitian; ?></textarea>
                        <div class="invalid-feedback errorDesc">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_skema" class="col-sm-3 col-form-label">Nama Skema</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="nama_skema" id="nama_skema" onchange="if($(this).val()=='lainnya'){$(this).hide().prop('disabled',true);$('input[name=nama_skema]').show().prop('disabled', false).focus();$(this).val(null);}">
                            <option value="" selected="selected"><?= $nama_skema; ?></option>
                            <option value="Penelitian Dasar">Penelitian Dasar</option>
                            <option value="Penelitian Terapan">Penelitian Terapan</option>
                            <option value="Penelitian Pengembangan">Penelitian Pengembangan</option>
                            <option value="Penelitian Dasar Unggulan Perguruan Tinggi">Penelitian Dasar Unggulan Perguruan Tinggi</option>
                            <option value="Penelitian Terapan Unggulan Perguruan Tinggi">Penelitian Terapan Unggulan Perguruan Tinggi</option>
                            <option value="Penelitian Pengembangan Unggulan Perguruan Tinggi">Penelitian Pengembangan Unggulan Perguruan Tinggi</option>
                            <option value="Penelitian Tesis Magister">Penelitian Tesis Magister</option>
                            <option value="Penelitian Disertasi Doktor">Penelitian Disertasi Doktor</option>
                            <option value="Kajian Kebijakan Strategis">Kajian Kebijakan Strategis</option>
                            <option value="lainnya">Lainnya</option>

                        </select>
                        <input class="form-control" name="nama_skema" style="display:none;" disabled="disabled" onblur="if($(this).val()==''){$(this).hide().prop('disabled',true);$('select[name=nama_skema]').show().prop('disabled', false).focus();}">
                        <!-- <div class="invalid-feedback errorGelar">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jumlah_dana" class="col-sm-3 col-form-label">Jumlah Dana</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jumlah_dana" name="jumlah_dana" value="<?= $jumlah_dana; ?>">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun_penelitian" class="col-sm-3 col-form-label">Tahun Penelitian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun_penelitian" name="tahun_penelitian" value="<?= $tahun_penelitian; ?>" autocomplete="off">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bidang_penelitian" class="col-sm-3 col-form-label">Bidang Penelitian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="bidang_penelitian" name="bidang_penelitian" value="<?= $bidang_penelitian; ?>">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bidang_penelitian_lain" class="col-sm-3 col-form-label">Bidang Penelitian Lain</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="bidang_penelitian_lain" name="bidang_penelitian_lain" value="<?= $bidang_penelitian_lain; ?>">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tujuan_sosial_ekonomi" class="col-sm-3 col-form-label">Tujuan Sosial Ekonomi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tujuan_sosial_ekonomi" name="tujuan_sosial_ekonomi" value="<?= $tujuan_sosial_ekonomi; ?>">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tujuan_sosial_ekonomi_lain" class="col-sm-3 col-form-label">Tujuan Sosial Ekonomi Lain</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tujuan_sosial_ekonomi_lain" name="tujuan_sosial_ekonomi_lain" value="<?= $tujuan_sosial_ekonomi_lain; ?>">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#editPenelitian').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-update">Update</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tahun_penelitian").datepicker({
            autoHide: true,
            zIndex: 2048,
            format: 'yyyy',

        });
    });

    $("#nama_skema").change(function() {
        if ($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("#nama_skema").change();

    $('#nama_ketua').autocomplete({
        appendTo: '.form-edit',
        source: '/penelitian/get_Dosen',
        focus: function(event, ui) {
            $("#nama_ketua").val(ui.item.label);
            return false;
        },

        select: function(event, ui) {
            // Set selection
            $('#nama_ketua').val(ui.item.label); // display the selected text
            $('#nidn').val(ui.item.value); // save selected id to input
            return false;
        },
        focus: function(event, ui) {
            $("#nama_ketua").val(ui.item.label);
            $("#nidn").val(ui.item.value);
            return false;
        },


    });

    $('.modal').on('shown.bs.modal', function() {
        $('.js-example-basic-multiple').select2({
            multiple: true,
            dropdownParent: $(".js-example-basic-multiple").parent(),
            ajax: {
                url: "<?= base_url('/penelitian/getDosenAgt'); ?>",
                type: "post",
                delay: 250,
                dataType: 'json',
                // processResults: function(data) {
                //     console.log(data)
                //     return {
                //         results: response.data
                //     };
                // },
                data: function(params) {
                    return {
                        query: params.term, // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response.data
                    };
                },
                cache: true

            }
        });
    });


    $(document).ready(function() {
        $('#nama_skema option[value="<?= $nama_skema ?>"]').prop('selected', true);


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

                        if (response.error.judul_penelitian) {
                            $('#nama_dosen').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_penelitian);
                        } else {
                            $('#nama_dosen').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1200
                        })

                        $('#editPenelitian').modal('hide');
                        getPenelitian();
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