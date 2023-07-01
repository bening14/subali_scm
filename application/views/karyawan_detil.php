<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/image/tech.png') ?>">
    <title>Dashboard - PORTAL SCM</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?= base_url('assets/') ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link href="<?= base_url('assets/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="<?= base_url('assets/css/responsive.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('assets/css/buttons.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Sweet Alerts js -->
    <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <!-- Sweet alert init js-->
    <script src="<?= base_url('assets/js/pages/sweetalerts.init.js') ?>"></script>

    <style>
        .image_upload>input {
            display: none;
        }
    </style>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">PORTAL SCM</a>

    </nav>

    <div class="pt-5">
        <?php include('menu_header.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="mt-4">Karyawan</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Database karyawan</li>
                            </ol>
                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <a href="<?= base_url('hr') ?>" type="button" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center"> <img id="photouser" src="<?= base_url('assets/image/karyawan/' . $karyawan['photo']) ?>" class="rounded" alt="karyawan" style="width: 128px;">
                                    <p class="image_upload mt-3">
                                        <label for="userImage">
                                            <a class="btn btn-warning btn-sm"><i class="fa fa-camera"></i> Ubah Photo</a>
                                        </label>
                                        <input type="file" name="userImage" id="userImage">
                                    </p>
                                    <h5 class="mt-3"><?= $karyawan['name'] ?></h5>
                                    <h6>NIK. <?= $karyawan['nik'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <form id="form-data">
                                    <div class="row mb-3">
                                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jabatan" value="<?= $karyawan['jabatan'] ?>">
                                            <input type="hidden" class="form-control" id="id" value="<?= $karyawan['id'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="userid" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="userid" value="<?= $karyawan['userid'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="alamat" value="<?= $karyawan['alamat'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" value="<?= $karyawan['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="no_ktp" class="col-sm-2 col-form-label">No. KTP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no_ktp" value="<?= $karyawan['no_ktp'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tempat_lahir" value="<?= $karyawan['tempat_lahir'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="tanggal_lahir" value="<?= $karyawan['tanggal_lahir'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                <?php
                                                if ($karyawan['jenis_kelamin'] == 'LAKI-LAKI') {
                                                    echo '<option value="LAKI-LAKI">LAKI-LAKI</option>
                                                            <option value="PEREMPUAN">PEREMPUAN</option>';
                                                } else {
                                                    echo '<option value="PEREMPUAN">PEREMPUAN</option>
                                                        <option value="LAKI-LAKI">LAKI-LAKI</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="agama" value="<?= $karyawan['agama'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="status_kawin" class="col-sm-2 col-form-label">Status Kawin</label>
                                        <div class="col-sm-10">
                                            <select name="status_kawin" id="status_kawin" class="form-control">
                                                <?php
                                                if ($karyawan['status_kawin'] == 'KAWIN') {
                                                    echo '<option value="KAWIN">KAWIN</option>
                                                            <option value="BELUM KAWIN">BELUM KAWIN</option>
                                                            <option value="JANDA/DUDA">JANDA/DUDA</option>';
                                                } elseif ($karyawan['status_kawin'] == 'BELUM KAWIN') {
                                                    echo '<option value="BELUM KAWIN">BELUM KAWIN</option>
                                                        <option value="KAWIN">KAWIN</option>
                                                        <option value="JANDA/DUDA">JANDA/DUDA</option>';
                                                } else {
                                                    echo '<option value="JANDA/DUDA">JANDA/DUDA</option>
                                                    <option value="KAWIN">KAWIN</option>
                                                    <option value="BELUM KAWIN">BELUM KAWIN</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="orang_dekat" class="col-sm-2 col-form-label">Orang dekat yang dihubungi dalam kondisi darurat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="orang_dekat" value="<?= $karyawan['orang_dekat'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="hubungan_orang_dekat" class="col-sm-2 col-form-label">Hubungan dengan orang dekat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="hubungan_orang_dekat" value="<?= $karyawan['hubungan_orang_dekat'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="hp_orang_dekat" class="col-sm-2 col-form-label">HP orang dekat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="hp_orang_dekat" value="<?= $karyawan['hp_orang_dekat'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="bank" class="col-sm-2 col-form-label">Akun Bank</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bank" value="<?= $karyawan['bank'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="rekening" class="col-sm-2 col-form-label">Nomor Rekening</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rekening" value="<?= $karyawan['rekening'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="npwp" class="col-sm-2 col-form-label">Nomor NPWP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="npwp" value="<?= $karyawan['npwp'] ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" style="margin-top: 20px;">

                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/') ?>js/scripts.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="<?= base_url('assets/') ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('assets/') ?>assets/demo/chart-bar-demo.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
    <!-- <script src="<?= base_url('assets/') ?>js/datatables-simple-demo.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/js/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jszip.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/pages/datatables.init.js') ?>"></script>
</body>

</html>

<script>
    <?php $target = 0; ?>
    $(function() {
        $("#table-karyawan").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>hr/ajax_table_karyawan',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return ` <img src="<?= base_url('assets/image/karyawan/') ?>` + data.photo + `" class="rounded" alt="karyawan" style="margin-right: 10px;">` +
                        data.name
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.nik",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.jabatan",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.userid",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return data.alamat + `<br>HP. ` + data.phone
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return `<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="edit_data('` + data.id + `')"><i class="fa fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-success" onclick="detil_data('` + data.id + `')"><i class="fa fa-book"></i> Detil</button>`

                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function reload_table() {
        $('#table-karyawan').DataTable().ajax.reload(null, false);
    }



    $("#form-data").submit(function(e) {
        // alert('OK')
        e.preventDefault()


        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('id', $("#id").val());
        form_data.append('jabatan', $("#jabatan").val());
        form_data.append('alamat', $("#alamat").val());
        form_data.append('phone', $("#phone").val());
        form_data.append('no_ktp', $("#no_ktp").val());
        form_data.append('tempat_lahir', $("#tempat_lahir").val());
        form_data.append('tanggal_lahir', $("#tanggal_lahir").val());
        form_data.append('jenis_kelamin', $("#jenis_kelamin").val());
        form_data.append('agama', $("#agama").val());
        form_data.append('status_kawin', $("#status_kawin").val());
        form_data.append('orang_dekat', $("#orang_dekat").val());
        form_data.append('hubungan_orang_dekat', $("#hubungan_orang_dekat").val());
        form_data.append('hp_orang_dekat', $("#hp_orang_dekat").val());
        form_data.append('bank', $("#bank").val());
        form_data.append('rekening', $("#rekening").val());
        form_data.append('npwp', $("#npwp").val());

        var url_ajax = '<?= base_url() ?>hr/update_data_karyawan'


        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire(
                        'Success!',
                        result.message,
                        'success'
                    )
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    $('#userImage').on('change', function() {
        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('id', $('#id').val());
        if ($('#userImage').val() !== "") {
            var file_data = $('#userImage').prop('files')[0];
            form_data.append('file', file_data);
        }


        url_ajax = '<?= base_url() ?>hr/update_setting_gambar'


        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    $('#photouser').attr('src', `<?= base_url('assets/image/karyawan/') ?>` + result.photo)
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })
</script>