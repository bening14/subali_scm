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
                            <h4 class="mt-4">Karyawan</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Database karyawan</li>
                            </ol>
                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="fa fa-plus"></i> Tambah Karyawan</button>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List Karyawan
                        </div>
                        <div class="card-body">
                            <table id="table-karyawan" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
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
                    <h5 class="modal-title" id="modalCustomerLabel">Tambah Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama_klien" class="form-label">Nama Klien</label>
                                    <input type="text" class="form-control" id="nama_klien">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="alamat" class="form-label">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="Badan Usaha">Badan Usaha</option>
                                        <option value="Yayasan">Yayasan</option>
                                        <option value="Perorangan">Perorangan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="contact" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contact">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="hp_contact" class="form-label">HP Contact Person</label>
                                    <input type="text" class="form-control" id="hp_contact">
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

    <div class="modal fade" id="editCustomer" tabindex="-1" aria-labelledby="editCustomerLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-2">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nama_klien_edit" class="form-label">Nama Klien</label>
                                    <input type="text" class="form-control" id="nama_klien_edit">
                                    <input type="hidden" class="form-control" id="id_edit">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="kategori_edit" class="form-label">Kategori</label>
                                    <select name="kategori_edit" id="kategori_edit" class="form-control">
                                        <option value="Badan Usaha">Badan Usaha</option>
                                        <option value="Yayasan">Yayasan</option>
                                        <option value="Perorangan">Perorangan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="alamat_edit" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat_edit">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="contact_edit" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_edit">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="hp_contact_edit" class="form-label">HP Contact Person</label>
                                    <input type="text" class="form-control" id="hp_contact_edit">
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

    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModallLabel">Project Klien</h5>
                </div>
                <div class="modal-body" id="klienproject">
                    <!-- <table id="table-klien-project" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Klien</th>
                                <th>Project</th>
                                <th>Man Days</th>
                                <th>Amount</th>
                                <th>Register Date</th>
                            </tr>
                        </thead>
                    </table> -->
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
                    
                    <a href="<?= base_url('hr/karyawan/') ?>` + data.id + `" type="button" class="btn btn-sm btn-success")"><i class="fa fa-book"></i> Detil</a>`

                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function reload_table() {
        $('#table-customer').DataTable().ajax.reload(null, false);
    }

    function project_data(id) {
        $('#projectModal').modal('show')
        var tabel = `<table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%"><thead><tr><th>#</th><th>Klien</th><th>Project</th><th>Man Days</th><th>Amount</th><th>Register Date</th></tr></thead>`
        var body = `<tbody>`
        var body2 = `</tbody>`
        var end = `</table>`
        var html = ''
        var no = 1
        $.ajax({
            url: '<?= base_url() ?>xyz/getproject',
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {
                result.forEach(d => {
                    html = html + `<tr><td>` + no + `</td><td>` + d.nama_klien + `</td><td>` + d.nama_project + `</td><td>` + d.jumlah_md + `</td><td>` + new Intl.NumberFormat().format(d.amount) + `</td><td>` + d.date_created + `</td></tr>`
                    no++
                });

                $('#klienproject').html(tabel + html + body + body2 + end)
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })
    }

    $("#form-data").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#nama_klien').val() == '' || $('#kategori').val() == '' || $('#alamat').val() == '' || $('#contact').val() == '' || $('#hp_contact').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'mst_klien');
        form_data.append('nama_klien', $("#nama_klien").val());
        form_data.append('kategori', $("#kategori").val());
        form_data.append('alamat', $("#alamat").val());
        form_data.append('contact', $("#contact").val());
        form_data.append('hp_contact', $("#hp_contact").val());

        var url_ajax = '<?= base_url() ?>xyz/insert_data_customer'


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
                    $('#nama_klien').val('')
                    $('#kategori').val('')
                    $('#alamat').val('')
                    $('#contact').val('')
                    $('#hp_contact').val('')
                    $('#modalCustomer').modal('hide');
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
                    url: '<?= base_url() ?>xyz/delete_data',
                    data: {
                        id: id,
                        table: "mst_klien"
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

    function edit_data(id) {
        $('#editCustomer').modal('show')
        $('#id_edit').val(id)

        $.ajax({
            url: '<?= base_url() ?>xyz/getcustomer',
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {
                $('#nama_klien_edit').val(result.nama_klien)
                $('#kategori_edit').val(result.kategori)
                $('#alamat_edit').val(result.alamat)
                $('#contact_edit').val(result.contact)
                $('#hp_contact_edit').val(result.hp_contact)
            },
            error: function(err) {
                console.log(err.responseText)
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
</script>