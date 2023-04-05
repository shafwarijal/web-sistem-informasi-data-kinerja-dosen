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
                        <input type="text" class="form-control" id="nama_skema" name="nama_skema">

                        <!-- <div class="invalid-feedback errorNip">

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
                        <input type="text" class="form-control" id="tahun_penelitian" name="tahun_penelitian">
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
                <!-- <div class="form-group row">
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

                </div> -->
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
                <!-- <div class="form-group row">
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
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="invalid-feedback errorPassword">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirm" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                        <div class="invalid-feedback errorPasswordConf">

                        </div>
                    </div>
                </div> -->


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
    $('#nama_ketua').autocomplete({
        appendTo: '.form-add',
        source: '/penelitian/get_Dosen',
        focus: function(event, ui) {
            $("#nama_ketua").val(ui.item.label);
            return false;
        },
        // select: function(event, ui) {
        //     $("#cari").val(ui.item.label);

        //     $("#results").text(ui.item.email);
        //     return false;
        // },

        // function(request, response) {
        //     $.ajax({
        //         url: "<?= site_url('/penelitian/get_Dosen') ?>",
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


                // success: function(data) {
                //     // Parse the returned json data
                //     // var opts = $.parseJSON(data);
                //     // Use jQuery's each to iterate over the opts value
                //     $.for(opts, function(i, d) {
                //         // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                //         $('#nama_anggota').append('<option value="' + d.value + '">' + d.label + '</option>');
                //     });
                // },

                // cache: true



                // data: function(params) {
                //     console.log(params)
                //     return {
                //         search: params.term, // search term
                //     };
                // },
                // processResults: function(response) {
                //     return {
                //         results: response.data
                //     };
                // },
                // cache: true
            }
        });
    });

    // $('#nama_anggota').select2({
    //     // appendTo: '.form-add',
    //     dropdownParent: $("#addPenelitian"),
    //     ajax: {
    //         url: "",
    //         type: "post",
    //         delay: 250,
    //         dataType: 'json',
    //         processResults: function(data) {
    //             console.log(data)
    //             return {
    //                 results: data
    //             };
    //         },

    //         cache: true
    //         // data: function(params) {
    //         //     console.log(params)
    //         //     return {
    //         //         search: params.term, // search term
    //         //     };
    //         // },
    //         // processResults: function(response) {
    //         //     return {
    //         //         results: response.data
    //         //     };
    //         // },
    //         // cache: true
    //     }


    // });
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