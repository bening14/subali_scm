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
                            <h4 class="mt-4">Petty Cash</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Pengeluaran/Pembelian Barang Perusahaan</li>
                            </ol>
                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="fa fa-plus"></i> Request Cash</button>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List Petty Cash
                        </div>
                        <div class="card-body">
                            <table id="table-petty" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subjek</th>
                                        <th>Nominal (Rp)</th>
                                        <th>Req. Date</th>
                                        <th>Req. Person</th>
                                        <th>Status</th>
                                        <th>Bukti Transfer</th>
                                        <th>Kwitansi</th>
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
                    <h5 class="modal-title" id="modalCustomerLabel">Request Cash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="subjek" class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subjek">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="amount" class="form-label">Nominal (Rp)</label>
                                    <input type="text" class="form-control" id="amount">
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

    <div class="modal fade" id="modalbayar" tabindex="-1" role="dialog" aria-labelledby="modalbayarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalbayarlLabel">Bukti Transfer View</h5>
                </div>
                <div class="modal-body" id="bayarid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalkwitansi" tabindex="-1" role="dialog" aria-labelledby="modalkwitansiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalkwitansilLabel">Kwitansi View</h5>
                </div>
                <div class="modal-body" id="kwitansiid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadModalpajak" tabindex="-1" role="dialog" aria-labelledby="uploadModalpajakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalpajaklLabel">Upload Data</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-4">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="file_upload_bayar" class="form-label">Pilih PDF File Bukti Transfer</label>
                                    <input id="file_upload_bayar" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload_bayar">
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

    <div class="modal fade" id="uploadModalkwitansi" tabindex="-1" role="dialog" aria-labelledby="uploadModalkwitansiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalkwitansilLabel">Upload Data</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-5">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="file_upload_kwitansi" class="form-label">Pilih PDF File Kwitansi</label>
                                    <input id="file_upload_kwitansi" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload_kwitansi">
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

    <div class="modal fade" id="modalapproval" tabindex="-1" role="dialog" aria-labelledby="modalapprovalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalapprovalLabel">Reason Approve/Reject</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-6">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="reason" class="form-label">Reason</label>
                                    <input type="text" class="form-control" id="reason">
                                    <input type="hidden" class="form-control" id="id_petty">
                                    <input type="hidden" class="form-control" id="approval">
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
    var a = '<?= $this->session->userdata("role_id") ?>'
    <?php $target = 0; ?>
    $(function() {
        $("#table-petty").DataTable({
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
                'url': '<?= base_url() ?>fa/ajax_table_petty',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-left py-1',
                "data": "data.subjek",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.amount",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.req_person",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.status_approval == 'APPROVE') {
                        return `<span class="badge bg-success">APPROVED</span><br><strong>Reason : </strong>` + data.reason
                    } else if (data.status_approval == 'REJECT') {
                        return `<span class="badge bg-danger">REJECT</span><br><strong>Reason : </strong>` + data.reason
                    } else {
                        return `-`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.file_bayar == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadbayar('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="showbayar('` + data.file_bayar + `')"><i class="fa fa-file-pdf"></i> Bukti Transfer</button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.bukti_kwitansi == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadkwitansi('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="showkwitansi('` + data.bukti_kwitansi + `')"><i class="fa fa-file-pdf"></i> Kwitansi</button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.file_bayar != '') {
                        return `-`
                    } else {
                        if (a == '1') {
                            return `<button type="button" class="btn btn-sm btn-primary" onclick="approve('` + data.id + `')"><i class="fa fa-thumbs-up"></i> Approve</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="reject('` + data.id + `')"><i class="fa fa-thumbs-down"></i> Reject</button>&nbsp;<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</&button>`
                        } else {
                            return `<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>`
                        }
                    }

                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function reload_table() {
        $('#table-petty').DataTable().ajax.reload(null, false);
    }

    function showbayar(bayar) {
        $('#modalbayar').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/petty_transfer/' + bayar + '" width="700" height="400"></embed>'
        $('#bayarid').html(html)
    }

    function showkwitansi(kwitansi) {
        $('#modalkwitansi').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/petty_kwitansi/' + kwitansi + '" width="700" height="400"></embed>'
        $('#kwitansiid').html(html)
    }

    function uploadbayar(id) {
        $('#id_upload_bayar').val(id)

        $('#uploadModalpajak').modal('show')
    }

    function uploadkwitansi(id) {
        $('#id_upload_kwitansi').val(id)

        $('#uploadModalkwitansi').modal('show')
    }



    $("#form-data").submit(function(e) {
        e.preventDefault()

        if ($('#subjek').val() == '' || $('#amount').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'tbl_petty_cash');
        form_data.append('subjek', $("#subjek").val());
        form_data.append('amount', $("#amount").val());

        var url_ajax = '<?= base_url() ?>fa/insert_data_petty'

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
                    $('#subjek').val('')
                    $('#amount').val('')

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
                        table: "tbl_petty_cash"
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

    function reject(id) {
        $('#modalapproval').modal('show')
        $('#id_petty').val(id)
        $('#approval').val('REJECT')
    }

    function approve(id) {
        $('#modalapproval').modal('show')
        $('#id_petty').val(id)
        $('#approval').val('APPROVE')
    }

    $("#form-data-4").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_petty_cash');
        form_data.append('id', $("#id_upload_bayar").val());
        if ($('#file_upload_bayar').val() !== "") {
            var file_data = $('#file_upload_bayar').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>fa/update_file_bayar'

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
                    $('#uploadModalpajak').modal('hide');
                    $('#file_upload_bayar').val('')

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
        form_data.append('table', 'tbl_petty_cash');
        form_data.append('id', $("#id_upload_kwitansi").val());
        if ($('#file_upload_kwitansi').val() !== "") {
            var file_data = $('#file_upload_kwitansi').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>fa/update_file_kwitansi'

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
                    $('#uploadModalkwitansi').modal('hide');
                    $('#file_upload_kwitansi').val('')

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

    $("#form-data-6").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_petty_cash');
        form_data.append('id', $("#id_petty").val());
        form_data.append('reason', $("#reason").val());
        form_data.append('status_approval', $("#approval").val());


        var url_ajax = '<?= base_url() ?>fa/reason_aproval'

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
                    $('#modalapproval').modal('hide');
                    $('#reason').val('')

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