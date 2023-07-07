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
                            <h4 class="mt-4">SPT Masa PPN</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Report SPT</li>
                            </ol>
                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="fa fa-plus"></i> Register SPT</button>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List SPT Masa PPN
                        </div>
                        <div class="card-body">
                            <table id="table-spt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Periode</th>
                                        <th>Waktu Penyampaian</th>
                                        <th>Bukti Elektronik</th>
                                        <th>File SPT</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="modalCustomer" tabindex="-1" aria-labelledby="modalCustomerLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCustomerLabel">Register SPT Masa PPN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="periode" class="form-label">Periode</label>
                                    <input type="text" class="form-control" id="periode">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="waktu_penyampaian" class="form-label">Waktu Penyampaian</label>
                                    <input type="date" class="form-control" id="waktu_penyampaian">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fakturModalbayar" tabindex="-1" role="dialog" aria-labelledby="fakturModalbayarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fakturModalbayarlLabel">Bukti Penerimaan Elektronik View</h5>
                </div>
                <div class="modal-body" id="buktiid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sptmodal" tabindex="-1" role="dialog" aria-labelledby="sptmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sptmodalLabel">SPT Masa PPN View</h5>
                </div>
                <div class="modal-body" id="sptid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadbukti" tabindex="-1" role="dialog" aria-labelledby="uploadbuktiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadbuktiLabel">Upload Data</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-4">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="file_upload_bukti" class="form-label">Pilih PDF File Bukti Penerimaan Elektronik</label>
                                    <input id="file_upload_bukti" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload_bukti">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadsptmasa" tabindex="-1" role="dialog" aria-labelledby="uploadsptmasaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadsptmasaLabel">Upload Data</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-5">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="file_upload_spt" class="form-label">Pilih PDF File SPT Masa PPN</label>
                                    <input id="file_upload_spt" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload_spt">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
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
        $("#table-spt").DataTable({
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
                'url': '<?= base_url() ?>fa/ajax_table_spt',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.periode",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.waktu_penyampaian",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.bukti_penerimaan == '') {
                        return `<small style="color: red;font-style: italic;">*Bukti Penerimaan Elektronik-File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadbukti('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="showbukti('` + data.bukti_penerimaan + `')"><i class="fa fa-file-pdf"></i> Bukti Penerimaan Elektronik</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="resetfile('` + data.id + `','bukti')"><i class="fa fa-sync-alt"></i></button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.spt == '') {
                        return `<small style="color: red;font-style: italic;">*SPT Masa PPN-File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadspt('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="showspt('` + data.spt + `')"><i class="fa fa-file-pdf"></i> SPT Masa PPN</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="resetfile('` + data.id + `','spt')"><i class="fa fa-sync-alt"></i></button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return `<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>`

                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function reload_table() {
        $('#table-spt').DataTable().ajax.reload(null, false);
    }

    function showbukti(bukti) {
        $('#fakturModalbayar').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/bukti_elektronik/' + bukti + '" width="700" height="400"></embed>'
        $('#buktiid').html(html)
    }

    function showspt(spt) {
        $('#sptmodal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/spt_ppn/' + spt + '" width="700" height="400"></embed>'
        $('#sptid').html(html)
    }

    function uploadspt(id) {
        $('#id_upload_spt').val(id)

        $('#uploadsptmasa').modal('show')
    }

    function uploadbukti(id) {
        $('#id_upload_bukti').val(id)

        $('#uploadbukti').modal('show')
    }

    function resetfile(id, jenis) {
        // alert(id, jenis)
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menghapus file, silahkan upload ulang!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>fa/reset_data',
                    data: {
                        id: id,
                        jenis: jenis,
                        table: "tbl_spt_masa_ppn"
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil di hapus.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })
    }


    $("#form-data").submit(function(e) {
        e.preventDefault()

        if ($('#periode').val() == '' || $('#waktu_penyampaian').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'tbl_spt_masa_ppn');
        form_data.append('periode', $("#periode").val());
        form_data.append('waktu_penyampaian', $("#waktu_penyampaian").val());

        var url_ajax = '<?= base_url() ?>fa/insert_data_spt'

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
                    $('#modalCustomer').modal('hide');
                    $('#periode').val('')
                    $('#waktu_penyampaian').val('')

                    reload_table()

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

    function delete_data(id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>fa/delete_data',
                    data: {
                        id: id,
                        table: "tbl_spt_masa_ppn"
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil di hapus.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })
    }

    $("#form-data-4").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_spt_masa_ppn');
        form_data.append('id', $("#id_upload_bukti").val());
        if ($('#file_upload_bukti').val() !== "") {
            var file_data = $('#file_upload_bukti').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>fa/update_file_bukti'

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
                    $('#uploadbukti').modal('hide');
                    $('#file_upload_bukti').val('')

                    reload_table()

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

    $("#form-data-5").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_spt_masa_ppn');
        form_data.append('id', $("#id_upload_spt").val());
        if ($('#file_upload_spt').val() !== "") {
            var file_data = $('#file_upload_spt').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>fa/update_file_spt'

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
                    $('#uploadsptmasa').modal('hide');
                    $('#file_upload_spt').val('')

                    reload_table()

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