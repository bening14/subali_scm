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
                            <h4 class="mt-4">Overtime</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Catatan Overtime karyawan</li>
                            </ol>
                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="fa fa-plus"></i> Ajukan Overtime</button>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List Overtime
                        </div>
                        <div class="card-body">
                            <table id="table-karyawan" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Jabatan</th>
                                        <th>Pekerjaan</th>
                                        <th>Jam Lembur</th>
                                        <th>Durasi (Jam)</th>
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

    <div class="modal fade" id="modalCustomer" tabindex="-1" aria-labelledby="modalCustomerLabel" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCustomerLabel">Ajukan Overtime</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                                    <select name="nama_karyawan" id="nama_karyawan" class="form-control">
                                        <option value="Diana Alfi Nur Khasanah">Diana Alfi Nur Khasanah</option>
                                        <option value="Rizal Rahmana">Rizal Rahmana</option>
                                        <option value="Amalia Nailur Rahmah">Amalia Nailur Rahmah</option>
                                        <option value="Galuh Sari Puspa Murtti">Galuh Sari Puspa Murtti</option>
                                        <option value="Ilham Mubarok">Ilham Mubarok</option>
                                        <option value="Zidan Alif Maulana">Zidan Alif Maulana</option>
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" value="P001" readonly>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" value="ENGINEER" readonly>
                                </div>
                            </div><!--end col-->

                            <div class="col-xxl-12">
                                <div>
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal">
                                </div>
                            </div><!--end col-->

                            <div class="col-xxl-6">
                                <div>
                                    <label for="awal" class="form-label">Jam Awal Overtime</label>
                                    <input type="time" class="form-control" id="awal">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="akhir" class="form-label">Jam Selesai Overtime</label>
                                    <input type="time" class="form-control" id="akhir">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="uraian_pekerjaan" class="form-label">Pekerjaan</label>
                                    <textarea name="pekerjaan" id="uraian_pekerjaan" cols="30" rows="5" class="form-control"></textarea>
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
    var as = '<?= $this->session->userdata("role_id") ?>'
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
                'url': '<?= base_url() ?>hr/ajax_table_overtime',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-left py-1',
                "data": "data.nama_karyawan"
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
                "data": "data.uraian_pekerjaan",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return `<span class="badge bg-success">Mulai : ` + data.awal + `</span><br><span class="badge bg-warning">Akhir : ` + data.akhir + `</span>`
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.lama_lembur",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.approval == 'WAITING') {
                        return `<span class="badge bg-primary">WAITING</span>`
                    } else if (data.approval == 'APPROVED') {
                        return `<span class="badge bg-success">APPROVED</span>`
                    } else {
                        return `<span class="badge bg-danger">REJECT</span>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.approval == 'WAITING') {
                        if (as == '1') {
                            return `<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>
                            &nbsp;<button type="button" class="btn btn-sm btn-success" onclick="approve('` + data.id + `')"><i class="fa fa-thumbs-up"></i> Approve</button>
                            &nbsp;<button type="button" class="btn btn-sm btn-danger" onclick="reject('` + data.id + `')"><i class="fa fa-thumbs-down"></i> Reject</button>`
                        } else {
                            return `<button type="button" class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>`
                        }
                    } else {
                        return `-`
                    }
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
        e.preventDefault()

        if ($('#nama_karyawan').val() == '' || $('#nik').val() == '' || $('#jabatan').val() == '' || $('#tanggal').val() == '' || $('#awal').val() == '' || $('#akhir').val() == '' || $('#uraian_pekerjaan').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'tbl_overtime');
        form_data.append('nama_karyawan', $("#nama_karyawan").val());
        form_data.append('nik', $("#nik").val());
        form_data.append('jabatan', $("#jabatan").val());
        form_data.append('tanggal', $("#tanggal").val());
        form_data.append('awal', $("#awal").val());
        form_data.append('akhir', $("#akhir").val());
        form_data.append('uraian_pekerjaan', $("#uraian_pekerjaan").val());

        var url_ajax = '<?= base_url() ?>hr/insert_data_overtime'

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
                    $('#awal').val('')
                    $('#akhir').val('')
                    $('#uraian_pekerjaan').val('')

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
                    url: '<?= base_url() ?>hr/delete_data',
                    data: {
                        id: id,
                        table: "tbl_overtime"
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

    $('#nama_karyawan').on('change', function() {
        $.ajax({
            url: '<?= base_url() ?>hr/getkaryawan',
            data: {
                name: $('#nama_karyawan').val(),
                table: "user"
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $('#nik').val(result.nik)
                $('#jabatan').val(result.jabatan)
            }
        })
    })

    function approve(id) {
        $.ajax({
            url: '<?= base_url() ?>hr/approvalovertime',
            data: {
                id: id,
                table: "tbl_overtime",
                decision: 'APPROVED'
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire(
                        'Approved!',
                        'Overtime disetujui.',
                        'success'
                    )
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    }

    function reject(id) {
        $.ajax({
            url: '<?= base_url() ?>hr/approvalovertime',
            data: {
                id: id,
                table: "tbl_overtime",
                decision: 'REJECT'
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire(
                        'Rejected!',
                        'Overtime ditolak.',
                        'success'
                    )
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    }
</script>