<!-- Modal -->



<div class="modal fade hide" id="addPenelitian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Penelitian</h5>
                <button type="button" class="close" onclick="$('#addPenelitian').modal('hide');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('penelitian/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_ketua" class="col-sm-3 col-form-label">Nama Ketua</label>
                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" value="<?php echo session()->get('role') == "2" ? session()->get('nama_user') : '' ?>" <?php echo session()->get('role') == "2" ? 'readonly' : '' ?>>

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
                    <label for="nama_anggota" class="col-sm-3 col-form-label">Nama Anggota</label>
                    <div class="col-sm-9">
                        <select class="js-example-basic-multiple form-control" name="nama_anggota[]" multiple="multiple">
                            <option value='0'>-- Dosen --</option>
                        </select>
                        <div class="invalid-feedback errorGelar">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="judul_penelitian" class="col-sm-3 col-form-label">Judul Penelitian</label>
                    <div class="col-sm-9">
                        <textarea name="judul_penelitian" id="judul_penelitian" rows="4" class="form-control"></textarea>
                        <div class="invalid-feedback errorJudul">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_skema" class="col-sm-3 col-form-label">Nama Skema</label>
                    <div class="col-sm-9">


                        <select class="form-control" name="nama_skema" id="nama_skema" onchange="if($(this).val()=='lainnya'){$(this).hide().prop('disabled',true);$('input[name=nama_skema]').show().prop('disabled', false).focus();$(this).val(null);}">
                            <option value="" selected="selected">Pilih</option>
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
                        <input type="text" class="form-control" id="jumlah_dana" name="jumlah_dana">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun_penelitian" class="col-sm-3 col-form-label">Tahun Penelitian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tahun_penelitian" name="tahun_penelitian" autocomplete="off" placeholder="Tahun">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bidang_penelitian" class="col-sm-3 col-form-label">Bidang Penelitian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="bidang_penelitian" name="bidang_penelitian">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bidang_penelitian_lain" class="col-sm-3 col-form-label">Bidang Penelitian Lain</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="bidang_penelitian_lain" name="bidang_penelitian_lain">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tujuan_sosial_ekonomi" class="col-sm-3 col-form-label">Tujuan Sosial Ekonomi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tujuan_sosial_ekonomi" name="tujuan_sosial_ekonomi">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tujuan_sosial_ekonomi_lain" class="col-sm-3 col-form-label">Tujuan Sosial Ekonomi Lain</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tujuan_sosial_ekonomi_lain" name="tujuan_sosial_ekonomi_lain">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>






            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="$('#addPenelitian').modal('hide');">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    // function toggle($toBeHidden, $toBeShown) {
    //     $toBeHidden.hide().prop('disabled', true);
    //     $toBeShown.show().prop('disabled', false).focus();
    // }

    // function showOptions(nama_skema) {
    //     var $select = $(`select[name=${nama_skema}]`);
    //     toggle($(`input[name=${nama_skema}]`), $select);
    //     $select.val(null);
    // }


    // function showCustomInput(nama_skema) {
    //     toggle($(`select[name=${nama_skema}]`), $(`input[name=${nama_skema}]`));
    // }

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
        appendTo: '.form-add',
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
                            title: 'Berhasil',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1200
                        })

                        $('#addPenelitian').modal('hide');
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