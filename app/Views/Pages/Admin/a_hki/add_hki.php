<!-- Modal -->
<div class="modal fade hide" id="addHki" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add HKI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('hki/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_hki" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_hki" name="nama_hki">
                        <!-- <div class="invalid-feedback errorNidn"> BELUM DI BENERIN 

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nidn_hki" class="col-sm-3 col-form-label">NIDN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nidn_hki" name="nidn_hki" readonly>

                    </div>
                </div>


                <div class="form-group row">
                    <label for="judul_hki" class="col-sm-3 col-form-label">Judul HKI</label>
                    <div class="col-sm-9">
                        <textarea name="judul_hki" id="judul_hki" rows="4" class="form-control"></textarea>
                        <div class="invalid-feedback errorJudul">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_hki" class="col-sm-3 col-form-label">Jenis HKI</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="jenis_hki" id="jenis_hki">
                            <option value="">Pilih</option>
                            <option value="Hak Cipta">Hak Cipta</option>
                            <option value="Paten Sederhana">Paten Sederhana</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_pendaftaran" class="col-sm-3 col-form-label">Nomor Pendaftaran</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_hki" class="col-sm-3 col-form-label">Status HKI</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status_hki" id="status_hki">
                            <option value="">Pilih</option>
                            <option value="Terdaftar">Terdaftar</option>
                            <option value="Granted">Granted</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_hki" class="col-sm-3 col-form-label">Nomor HKI</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_hki" name="no_hki">
                        <div class="invalid-feedback errorNip">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kd_sts_berkas_hki" class="col-sm-3 col-form-label">Status Berkas HKI</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kd_sts_berkas_hki" id="kd_sts_berkas_hki">
                            <option value="">Pilih</option>
                            <option value="1">Valid</option>
                            <option value="0">Invalid</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan_invalid" class="col-sm-3 col-form-label">Keterangan Invalid</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan_invalid" name="keterangan_invalid">
                        <!-- <div class="invalid-feedback errorNip">

                        </div> -->
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $('#nama_hki').autocomplete({
        appendTo: '.form-add',
        source: '/hki/get_Dosen',
        focus: function(event, ui) {
            $("#nama_hki").val(ui.item.label);
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
        //     $('#nama_hki').val(ui.item.lebel);
        //     $('#nidn').val(ui.item.value);

        //     return false;
        // },
        // focus: function(event, ui) {
        //     $('#nama_hki').val(ui.item.lebel);
        //     $('#nidn').val(ui.item.value);

        //     return false;
        // },
        select: function(event, ui) {
            // Set selection
            $('#nama_hki').val(ui.item.label); // display the selected text
            $('#nidn_hki').val(ui.item.value); // save selected id to input
            return false;
        },
        focus: function(event, ui) {
            $("#nama_hki").val(ui.item.label);
            $("#nidn_hki").val(ui.item.value);
            return false;
        },


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
                            timer: 1800
                        })

                        $('#addHki').modal('hide');
                        getHki();
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