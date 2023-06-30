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

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours() + ' :';
            document.getElementById("menit").innerHTML = waktu.getMinutes() + ' :';
            document.getElementById("detik").innerHTML = waktu.getSeconds() + ' WIB ';
            if (waktu.getHours() == "08" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('A');
            } else if (waktu.getHours() == "08" && waktu.getMinutes() == "30" && waktu.getSeconds() == "00") {
                cekstatus('A');
            } else if (waktu.getHours() == "09" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('B');
            } else if (waktu.getHours() == "10" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('C');
            } else if (waktu.getHours() == "11" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('D');
            } else if (waktu.getHours() == "12" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('E');
            } else if (waktu.getHours() == "13" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('F');
            } else if (waktu.getHours() == "14" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('G');
            } else if (waktu.getHours() == "15" && waktu.getMinutes() == "00" && waktu.getSeconds() == "00") {
                cekstatus('H');
            }
        }
        // var sec = document.getElementById("detik").html();
        // console.log(waktu());
    </script>

    <style>
        .jam-digital {
            overflow: hidden;
            width: 100%;
            margin: 0px auto;
            border: 5px solid #efefef;
        }

        .kotak {
            float: left;
            width: 150px;
            height: 60px;
            /* background-color: #000; */
        }

        .jam-digital p {
            color: #000;
            font-size: 36px;
            text-align: center;
            margin-top: 0px;
        }

        .tengah {
            font-size: 24px;
            text-align: center;
            margin-top: 30px;
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
                            <h4 class="mt-4">Follow-Up Diskusi</h4>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Selalu cek diskusi Tokopedia dan WA apakah ada chat terbaru dari customer</li>
                            </ol>
                        </div>
                        <div class="col-6">

                            <div class="alert alert-danger mt-4" role="alert">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="jam-digital">
                                            <div class="kotak">
                                                <p id="jam"></p>
                                            </div>
                                            <div class="kotak">
                                                <p id="menit"></p>
                                            </div>
                                            <div class="kotak">
                                                <p id="detik"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="text-align: right;display: none;" id="btn_punch">
                                        <button type="button" class="btn btn-success" id="punch_action">Punch <i class="far fa-hand-point-right"></i></button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Jadwal daily follow up
                        </div>
                        <div class="card-body">
                            <table id="table-chat" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Waktu</th>
                                        <th>Actual Clock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
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
        $("#table-chat").DataTable({
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
                'url': '<?= base_url() ?>xyz/ajax_table_chat',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.waktu",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.actual_clock == '0000-00-00 00:00:00') {
                        return `-`
                    } else {
                        return data.actual_clock
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.status_reminder == 'OPEN') {
                        return `<button type="button" class="btn btn-sm btn-danger">Open</button>`
                    } else {
                        return `<button type="button" class="btn btn-sm btn-success">Close</button>`
                    }
                }
            }, ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        //ketika page direfresh harus cek apakah sudah cek pesan?
        var date = new Date();

        jam = new Date().getHours();
        if (jam == "08") {
            cekstatus('A');
        } else if (jam == "09") {
            cekstatus('B');
        } else if (jam == "10") {
            cekstatus('C');
        } else if (jam == "11") {
            cekstatus('D');
        } else if (jam == "12") {
            cekstatus('E');
        } else if (jam == "13") {
            cekstatus('F');
        } else if (jam == "14") {
            cekstatus('G');
        } else if (jam == "15") {
            cekstatus('H');
        }
    });


    function cekstatus(kategori) {


        $.ajax({
            url: '<?= base_url() ?>xyz/cek_reminder',
            type: "post",
            data: {
                kategori: kategori
            },
            dataType: "json",
            success: function(result) {
                if (result == "200") {
                    Swal.fire(
                        'Daily Check',
                        'Cek diskusi Tokopedia & WhatsApp',
                        'info'
                    )

                    var audio = new Audio('<?= base_url('assets/sound/') ?>gabung.mp3');
                    audio.play();
                    audio.loop = true;

                    $('#btn_punch').show()
                } else {
                    console.log('Data sudah terisi')
                }
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })
    }

    $('#punch_action').on('click', function() {

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Pastikan tidak lupa untuk membaca dan membalas chat di Tokopedia & WA!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>xyz/punch',
                    type: "post",
                    dataType: "json",
                    success: function(result) {
                        if (result == "200") {
                            Swal.fire(
                                'Punched!',
                                'Terima kasih telah melakukan tugas dengan baik.',
                                'success'
                            )
                            setTimeout(function() {
                                location.reload();
                            }, 3 * 1000);
                            // location.reload()
                        } else {
                            console.log('problem updated')
                        }
                    },
                    error: function(err) {
                        console.log(err.responseText)
                    }
                })
            }
        })


    })
</script>