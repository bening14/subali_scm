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
                                <!-- <li class="breadcrumb-item active">Catatan Project, masukan semua project ke dalam sini</li> -->
                            </ol>

                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalProject"><i class="fa fa-plus"></i> Register Project</button>
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
                            <i class="fas fa-table me-1"></i>
                            List Project
                        </div>
                        <div class="card-body">
                            <table id="table-project" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Project</th>
                                        <th>Klien</th>
                                        <th>Nilai Project</th>
                                        <th>BRD</th>
                                        <th>Quotation</th>
                                        <th>Kontrak</th>
                                        <th>BASTP</th>
                                        <th>Status</th>
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



    <div class="modal fade" id="modalProject" tabindex="-1" aria-labelledby="modalProjectLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProjectLabel">Register Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama_project" class="form-label">Nama Project</label>
                                    <input type="text" class="form-control" id="nama_project">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="klien" class="form-label">Klien</label>
                                    <select class="form-control" name="klien" id="klien">
                                        <option value="">--Pilih Klien--</option>
                                        <?php
                                        foreach ($klien as $key => $value) {
                                        ?>
                                            <option value="<?= $value['id'] . '-' . $value['nama_klien'] ?>"><?= $value['nama_klien'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="jumlah_md" class="form-label">Man Days</label>
                                    <input type="text" class="form-control" id="jumlah_md">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="amount" class="form-label">Amount (Rp)</label>
                                    <input type="text" class="form-control" id="amount">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="uraian" class="form-label">Uraian</label>
                                    <textarea class="form-control" name="uraian" id="uraian" cols="30" rows="5"></textarea>
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
                    <form id="form-data-3">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">Dokumen Number</label>
                                    <input type="text" class="form-control" id="dokumen">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_project" class="form-label">Pilih PDF File</label>
                                    <input id="file_upload" type="file" class="form-control">
                                    <input type="hidden" class="form-control" id="id_upload">
                                    <input type="hidden" class="form-control" id="kategori_upload">
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

    <div class="modal fade" id="brdModal" tabindex="-1" role="dialog" aria-labelledby="brdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="brdModallLabel">BRD View</h5>
                </div>
                <div class="modal-body" id="brdid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quotationModallLabel">Quotation View</h5>
                </div>
                <div class="modal-body" id="quotationid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kontrakModal" tabindex="-1" role="dialog" aria-labelledby="kontrakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kontrakModallLabel">Kontrak Kerja View</h5>
                </div>
                <div class="modal-body" id="kontrakid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bastpModal" tabindex="-1" role="dialog" aria-labelledby="bastpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bastpModallLabel">BERITA ACARA SERAH TERIMA PRODUK (BASTP) View</h5>
                </div>
                <div class="modal-body" id="bastpid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModallLabel">Informasi Project</h5>
                </div>
                <div class="modal-body">
                    <div class="row" id="judul_project">
                        <div class="col-4"><strong>Nama Project</strong></div>
                        <div class="col-8">Aplikasi HRIS</div>
                    </div>
                    <div class="row" id="deskripsi_project">
                        <div class="col-4"><strong>Deskripsi</strong></div>
                        <div class="col-8">Ini adalah aplikasi HRIS Ini adalah aplikasi HRIS Ini adalah aplikasi HRIS Ini adalah aplikasi HRIS </div>
                    </div>
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
    $('#klien').select2({
        dropdownParent: $('#modalProject')
    });

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
                'url': '<?= base_url() ?>prjt/ajax_table_project',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return `<strong>` + data.nama_project + `<strong><br><strong>.:. </strong>&nbsp;` + data.uraian
                    // return data.nama_project + `<br><button type="button" class="btn btn-sm btn-primary" onclick="showinfo('` + data.id + `')"><i class="fa fa-book"></i> info</button>`
                }
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
                    return data.amount + `<br><span class="badge rounded-pill bg-info">` + data.jumlah_md + ` MD</span>`
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.brd_number == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadbrd('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return data.brd_number + `<br><button type="button" class="btn btn-sm btn-danger" onclick="showbrd('` + data.brd_file + `')"><i class="fa fa-file-pdf"></i> BRD</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="resetfile('` + data.id + `','brd')"><i class="fa fa-sync-alt"></i></button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.quotation_number == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadquotation('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return data.quotation_number + `<br><button type="button" class="btn btn-sm btn-danger" onclick="showquotation('` + data.quotation_file + `')"><i class="fa fa-file-pdf"></i> Quotation</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="resetfile('` + data.id + `','quotation')"><i class="fa fa-sync-alt"></i></button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.kontrak_kerja_number == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadkontrak('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return data.kontrak_kerja_number + `<br><button type="button" class="btn btn-sm btn-danger" onclick="showkontrak('` + data.kontrak_kerja_file + `')"><i class="fa fa-file-pdf"></i> Kontrak</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="resetfile('` + data.id + `','kontrak')"><i class="fa fa-sync-alt"></i></button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.bastp_number == '') {
                        return `<small style="color: red;font-style: italic;">*File harus PDF</small><br><button type="button" class="btn btn-sm btn-success" onclick="uploadbastp('` + data.id + `')"><i class="fa fa-file-upload"></i> Upload</button>`
                    } else {
                        return data.bastp_number + `<br><button type="button" class="btn btn-sm btn-danger" onclick="showbastp('` + data.bastp_file + `')"><i class="fa fa-file-pdf"></i> BASTP</button>&nbsp;<button type="button" class="btn btn-sm btn-warning" onclick="resetfile('` + data.id + `','bastp')"><i class="fa fa-sync-alt"></i></button>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.status_project == 'OPEN') {
                        return `<strong>` + data.balance + `</strong><br><span class="badge bg-danger">OPEN</span>`
                    } else if (data.status_project == 'CLOSED') {
                        return `<strong>` + data.balance + `</strong><br><span class="badge bg-success">CLOSED</span>`
                    } else if (data.status_project == 'LEADS') {
                        return `<strong>` + data.balance + `</strong><br><span class="badge bg-primary">LEADS</span>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.brd_number != '' || data.quotation_number != '' || data.kontrak_kerja_number != '' || data.bastp_number != '') {
                        return `
                        <a href="<?= base_url('prjt/payment/') ?>` + data.id + `" type="button" class="btn btn-sm btn-success"><i class="fa fa-money-bill"></i> Payment</a>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> </button>
                
                        `
                    }

                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });


    });

    function showinfo(id) {
        $('#infoModal').modal('show')

        $.ajax({
            url: '<?= base_url() ?>prjt/getproject',
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {

                var html = `<div class="col-4"><strong>Nama Project</strong></div><div class="col-8">` + result.nama_project + `</div>`
                var html2 = `<div class="col-4"><strong>Deskripsi</strong></div>
                        <div class="col-8">` + result.uraian + `</div>`
                $('#judul_project').html(html)
                $('#deskripsi_project').html(html2)
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })


    }

    function showbrd(brd) {
        $('#brdModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/brd/' + brd + '" width="700" height="400"></embed>'
        $('#brdid').html(html)
    }

    function showquotation(quotation) {
        $('#quotationModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/quotation/' + quotation + '" width="700" height="400"></embed>'
        $('#quotationid').html(html)
    }

    function showkontrak(kontrak) {
        $('#kontrakModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/kontrak_kerja/' + kontrak + '" width="700" height="400"></embed>'
        $('#kontrakid').html(html)
    }

    function showbastp(bastp) {
        $('#bastpModal').modal('show')
        var html = '<embed type="application/pdf" src="<?= base_url() ?>assets/pdf/bastp/' + bastp + '" width="700" height="400"></embed>'
        $('#bastpid').html(html)
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
                    url: '<?= base_url() ?>prjt/reset_data',
                    data: {
                        id: id,
                        jenis: jenis,
                        table: "tbl_project"
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

    function reload_table() {
        $('#table-project').DataTable().ajax.reload(null, false);
    }

    $("#form-data").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#nama_project').val() == '' || $('#klien').val() == '' || $('#jumlah_md').val() == '' || $('#amount').val() == '' || $('#uraian').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'tbl_project');
        form_data.append('nama_project', $("#nama_project").val());
        form_data.append('olah_klien', $("#klien").val());
        form_data.append('jumlah_md', $("#jumlah_md").val());
        form_data.append('amount', $("#amount").val());
        form_data.append('uraian', $("#uraian").val());

        var url_ajax = '<?= base_url() ?>prjt/insert_data_project'


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
                    $('#nama_project').val('')
                    $('#jumlah_md').val('')
                    $('#amount').val('')
                    $('#uraian').val('')
                    $('#modalProject').modal('hide');
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

    function uploadbrd(id) {
        $('#id_upload').val(id)
        $('#kategori_upload').val('brd')

        $('#uploadModal').modal('show')
    }

    function uploadquotation(id) {
        $('#id_upload').val(id)
        $('#kategori_upload').val('quotation')

        $('#uploadModal').modal('show')
    }

    function uploadkontrak(id) {
        $('#id_upload').val(id)
        $('#kategori_upload').val('kontrak')

        $('#uploadModal').modal('show')
    }

    function uploadbastp(id) {
        $('#id_upload').val(id)
        $('#kategori_upload').val('bastp')

        $('#uploadModal').modal('show')
    }

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
                    url: '<?= base_url() ?>prjt/delete_data',
                    data: {
                        id: id,
                        table: "tbl_project"
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

    $("#form-data-2").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#nama_klien_edit').val() == '' || $('#kategori_edit').val() == '' || $('#alamat_edit').val() == '' || $('#contact_edit').val() == '' || $('#hp_contact_edit').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'mst_klien');
        form_data.append('id', $("#id_edit").val());
        form_data.append('nama_klien', $("#nama_klien_edit").val());
        form_data.append('kategori', $("#kategori_edit").val());
        form_data.append('alamat', $("#alamat_edit").val());
        form_data.append('contact', $("#contact_edit").val());
        form_data.append('hp_contact', $("#hp_contact_edit").val());

        var url_ajax = '<?= base_url() ?>xyz/update_data_customer'

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
                    $('#editCustomer').modal('hide');
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

        if ($('#file_upload').val() == '' || $('#id_upload').val() == '' || $('#kategori_upload').val() == '' || $('#dokumen').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'tbl_project');
        form_data.append('id', $("#id_upload").val());
        form_data.append('dokumen', $("#dokumen").val());
        form_data.append('kategori_upload', $("#kategori_upload").val());
        if ($('#file_upload').val() !== "") {
            var file_data = $('#file_upload').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>prjt/update_file'

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