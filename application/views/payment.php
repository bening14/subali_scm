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

    <link href="<?= base_url('assets/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />

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
                            <h4 class="mt-4">Project</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Catatan Project, masukan semua project ke dalam sini</li>
                            </ol>

                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-success" onclick="showmodalinvoice()"><i class="fa fa-plus"></i> Input Invoice</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <strong>NOTE : </strong><br>1. Untuk Klien baru, Project dengan nilai <strong>diatas</strong> Rp. 10,000,000 Wajib disertai KONTRAK KERJA dan BASTP<br>
                                2. Project dengan nilai <strong>dibawah</strong> Rp. 10,000,000 cukup dengan QUOTATION yang di tanda tangani kembali oleh klien
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-table me-1"></i>
                                    List Project
                                </div>
                                <div class="col-6" style="text-align: right">
                                    <a href="<?= base_url('prjt') ?>" type="button" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-project" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Project</th>
                                        <th>Klien</th>
                                        <th>Invoice No</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                        <th>PPN</th>
                                        <th>Faktur</th>
                                        <th>Payment</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="modalInvoice" tabindex="-1" aria-labelledby="modalInvoiceLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInvoiceLabel">Input Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="invoice_number" class="form-label">Invoice Number</label>
                                    <input type="hidden" class="form-control" id="id_project">
                                    <input type="hidden" class="form-control" id="nama_project">
                                    <input type="hidden" class="form-control" id="id_klien">
                                    <input type="hidden" class="form-control" id="nama_klien">
                                    <input type="text" class="form-control" id="invoice_number">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="amount" class="form-label">Amount (Rp) - Tanpa PPN</label>
                                    <input type="text" class="form-control" id="amount">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="remark" class="form-label">Remark</label>
                                    <input type="text" class="form-control" id="remark">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="remark" class="form-label">Pilih file PDF</label>
                                    <input id="file_upload_invoice" type="file" class="form-control">
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

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModallLabel">Upload Data</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-2">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" id="date_payment">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">Pilih PDF File Bukti Transfer/Bukti Receive</label>
                                    <input id="file_upload_payment" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload">
                                    <input type="hidden" class="form-control" id="id_project_payment">
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

    <div class="modal fade" id="uploadModalfaktur" tabindex="-1" role="dialog" aria-labelledby="uploadModalfakturLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalfakturLabel">Upload Data</h5>
                </div>
                <div class="modal-body">
                    <form id="form-data-3">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">Faktur Pajak</label>
                                    <input type="text" class="form-control" id="faktur_pajak">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">NTPN</label>
                                    <input type="text" class="form-control" id="ntpn">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">Pilih PDF File Faktur Pajak</label>
                                    <input id="file_upload" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload">
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

    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModallLabel">Invoice View</h5>
                </div>
                <div class="modal-body" id="invoiceid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fakturModal" tabindex="-1" role="dialog" aria-labelledby="fakturModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fakturModallLabel">Faktur View</h5>
                </div>
                <div class="modal-body" id="fakturid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModallLabel">Payment View</h5>
                </div>
                <div class="modal-body" id="paymentid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

    <script src="<?= base_url('assets/js/select2.min.js') ?>"></script>

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
        $("#table-project").DataTable({
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
                'url': '<?= base_url() ?>prjt/ajax_table_payment',
                'type': 'post',
                'data': {
                    id: '<?= $this->uri->segment("3") ?>'
                },
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.nama_project",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return data.nama_klien + `<br><span class="badge rounded-pill bg-danger">ID-` + data.id_klien + `</span>`
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return data.invoice_number + `<br><button type="button" class="btn btn-sm btn-danger" onclick="showinvoice('` + data.invoice_file + `')"><i class="fa fa-file-pdf"></i> Lihat</button>`
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.amount",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.remark",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return data.ppn + `<br><span class="badge rounded-pill bg-primary">NTPN-` + data.ntpn + `</span>`
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.ppn_file == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadppn('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return data.faktur_pajak + `<br><button type="button" class="btn btn-sm btn-danger" onclick="showfaktur('` + data.ppn_file + `')"><i class="fa fa-file-pdf"></i> Lihat</button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.payment_file == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadpayment('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="showpayment('` + data.payment_file + `')"><i class="fa fa-file-pdf"></i> Lihat</button>`
                    }
                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });


    });

    function showmodalinvoice() {
        $('#modalInvoice').modal('show')

        $.ajax({
            url: '<?= base_url() ?>prjt/getproject',
            type: "post",
            data: {
                id: '<?= $this->uri->segment("3") ?>'
            },
            dataType: "json",
            success: function(result) {
                $('#id_project').val(result.id)
                $('#nama_project').val(result.nama_project)
                $('#id_klien').val(result.id_klien)
                $('#nama_klien').val(result.nama_klien)
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })
    }

    function showinvoice(invoice) {
        $('#invoiceModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/invoice/' + invoice + '" width="700" height="400"></embed>'
        $('#invoiceid').html(html)
    }

    function showfaktur(faktur) {
        $('#fakturModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/faktur_pajak/' + faktur + '" width="700" height="400"></embed>'
        $('#fakturid').html(html)
    }

    function showpayment(payment) {
        $('#paymentModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/payment/' + payment + '" width="700" height="400"></embed>'
        $('#paymentid').html(html)
    }

    function reload_table() {
        $('#table-project').DataTable().ajax.reload(null, false);
    }

    $("#form-data").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#invoice_number').val() == '' || $('#amount').val() == '' || $('#remark').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'tbl_invoice');
        form_data.append('id_project', $("#id_project").val());
        form_data.append('nama_project', $("#nama_project").val());
        form_data.append('id_klien', $("#id_klien").val());
        form_data.append('nama_klien', $("#nama_klien").val());
        form_data.append('invoice_number', $("#invoice_number").val());
        form_data.append('amount', $("#amount").val());
        form_data.append('remark', $("#remark").val());
        if ($('#file_upload_invoice').val() !== "") {
            var file_data = $('#file_upload_invoice').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>prjt/insert_data_invoice'

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
                    $('#remark').val('')
                    $('#amount').val('')
                    $('#invoice_number').val('')
                    $('#modalInvoice').modal('hide')
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

    function uploadppn(id) {
        $('#id_upload').val(id)
        $('#kategori_upload').val('ppn')

        $('#uploadModalfaktur').modal('show')
    }

    function uploadpayment(id) {
        $('#id_upload').val(id)
        $('#id_project_payment').val('<?= $this->uri->segment("3") ?>')

        $('#uploadModal').modal('show')
    }

    $("#form-data-2").submit(function(e) {
        e.preventDefault()

        if ($('#date_payment').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'tbl_invoice');
        form_data.append('id', $("#id_upload").val());
        form_data.append('id_project', $("#id_project_payment").val());
        form_data.append('date_payment', $("#date_payment").val());
        if ($('#file_upload_payment').val() !== "") {
            var file_data = $('#file_upload_payment').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>prjt/update_file_payment'

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
                    $('#uploadModal').modal('hide');
                    $('#date_payment').val('')
                    $('#file_upload').val('')

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

    $("#form-data-3").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#id_upload').val() == '' || $('#ntpn').val() == '' || $('#faktur_pajak').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'tbl_invoice');
        form_data.append('id', $("#id_upload").val());
        form_data.append('faktur_pajak', $("#faktur_pajak").val());
        form_data.append('ntpn', $("#ntpn").val());
        if ($('#file_upload').val() !== "") {
            var file_data = $('#file_upload').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>prjt/update_file_faktur'

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
                    $('#uploadModalfaktur').modal('hide');
                    $('#dokumen').val('')
                    $('#file_upload').val('')

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