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
        .waktu {
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            color: #fff;
            background-color: #000;
        }

        .histori {
            font-size: 10px;
            font-style: italic;
        }

        .camera {
            /* display: flex; */
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: 1% auto;
            position: relative;
            /* height: 500px; */

        }

        canvas {
            /* margin-top: -143px; */
            margin-top: -143px;
            /* width: 400;
            margin-left: auto;
            margin-right: auto;
            display: block; */
        }

        @media screen and (max-width: 992px) {
            #canvas {
                width: 0%;
            }

            #canvas2 {
                width: 0%;
            }

            .btn-clock-in.btn:not(.btn-link):not(.btn-circle) {
                font-size: 13px;
            }

            .btn-clock-out.btn:not(.btn-link):not(.btn-circle) {
                font-size: 13px;
            }
        }

        @media screen and (max-width: 400px) {
            #canvas {
                width: 100%;
            }

            #canvas2 {
                width: 100%;
            }

            .btn-clock-in.btn:not(.btn-link):not(.btn-circle) {
                font-size: 10px;
            }

            .btn-clock-in.btn:not(.btn-link):not(.btn-circle) i {
                font-size: 11px;
                position: relative;
                top: 1px;
                left: -3px;
                text-align: center;
                margin: -2px;
            }

            .btn-clock-out.btn:not(.btn-link):not(.btn-circle) {
                font-size: 10px;
            }

            .btn-clock-out.btn:not(.btn-link):not(.btn-circle) i {
                font-size: 11px;
                position: relative;
                top: 1px;
                left: -3px;
                text-align: center;
                margin: -2px;
            }
        }

        .img-thumbnail {
            background-color: transparent;
            border: none;
        }

        /* spinner */
        .overlay {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            background: rgba(255, 255, 255, 0.8) url("<?= base_url('assets/bsb/images/spin.gif') ?>") center no-repeat;
        }

        /* Turn off scrollbar when body element has the loading class */
        body.loading {
            overflow: hidden;
        }

        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay {
            display: block;
        }

        .alert {
            width: 500px;
            width: 343px;
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
                <div class="container-fluid px-4" id="body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="mt-4">Absensi</h4>
                            <!-- <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Database karyawan</li>
                            </ol> -->
                        </div>
                        <div class="col-6 mt-5 text-right" style="text-align: right;">
                            <?= $tanggal ?>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center"> <img src="<?= base_url('assets/image/karyawan/' . $this->session->userdata('photo')) ?>" class="rounded" alt="karyawan" style="width: 128px;">

                                    <h5 class="mt-3"><?= $this->session->userdata('name') ?></h5>
                                    <h6>NIK. <?= $this->session->userdata('nik') ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <p class="waktu"><small id="jam"></small> : <small id="menit"></small> : <small id="detik"></small><small> <?= date('A') ?></small> </p>

                            </div>
                            <div class="row">
                                <div class="col-6" style="text-align: right;">
                                    <button type="button" class="btn btn-sm btn-success" id="clock_in"> Clock IN</button>
                                </div>
                                <div class="col-6" style="text-align: left;">
                                    <button type="button" class="btn btn-sm btn-danger" id="clock_out"> Clock OUT</button>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-body">


                            <div class="container text-center" id="absen">
                                <div class="camera cam_clock_in">
                                    <div class="upload-loading"></div>
                                    <!-- <div style="display: block; width: 100%;">a</div> -->

                                    <video playsinline id="video" class="" style="width: 400; margin-left: auto; margin-right: auto; display: block;"></video>
                                    <!-- <div id="loading" style="color: white;"><strong>Mohon tunggu browser sedang mengaktifkan kamera Anda...</strong></div> -->
                                    <canvas id="canvas"></canvas>
                                    <img src="<?= base_url('/assets/bsb/images/absensi/') ?>" class="img-thumbnail" alt="...">
                                    <p class="histori1">
                                    </p>
                                </div>
                                <div class="camera cam_clock_out">
                                    <div class="upload-loading2"></div>
                                    <!-- <div style="display: block; width: 100%;">a</div> -->

                                    <video playsinline id="video2" class="" style="width: 400; margin-left: auto; margin-right: auto; display: block;"></video>
                                    <!-- <div id="loading2" style="color: white;"><strong>Mohon tunggu browser sedang mengaktifkan kamera Anda...</strong></div> -->
                                    <canvas id="canvas2"></canvas>
                                    <img src="<?= base_url('/assets/bsb/images/absensi/') ?>" class="img-thumbnail" alt="...">
                                    <p class="histori2">
                                    </p>

                                </div>
                                <div class="text-center btn_clock_in">
                                    <button class="btn btn-primary btn-md btn-take-photo" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Ambil Foto
                                    </button>
                                    <button class="btn btn-primary btn-md btn-retake-photo" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Ambil Ulang Foto
                                    </button>
                                    <button class="btn btn-primary btn-md btn-simpan mt-4" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Simpan
                                    </button>
                                    <button class="btn btn-danger btn-md btn-back" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Back
                                    </button>
                                </div>
                                <div class="text-center btn_clock_out">
                                    <button class="btn btn-primary btn-md btn-take-photo2" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Ambil Foto
                                    </button>
                                    <button class="btn btn-primary btn-md btn-retake-photo2" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Ambil Ulang Foto
                                    </button>
                                    <button class="btn btn-primary btn-md btn-simpan2 mt-4" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Simpan
                                    </button>
                                    <button class="btn btn-danger btn-md btn-back2" style="max-width: 100%; width: 200px;margin-top:10px;" type="button">

                                        Back
                                    </button>
                                </div>
                                <!-- <div class="overlay"></div> -->
                                <div class="overlay">
                                    <div id='loading-text' style="text-align:center;padding-top: 220px;font-weight:bold;">Sistem Sedang Mengambil Lokasi Absen...</div>
                                    <div id='loading' style="text-align:center;padding-top: 220px;font-weight:bold;">Mohon tunggu browser sedang mengaktifkan kamera Anda..</div>
                                    <div id='loading2' style="text-align:center;padding-top: 220px;font-weight:bold;">Mohon tunggu browser sedang mengaktifkan kamera Anda...</div>
                                </div>
                                <!-- <div class="overlay2"></div> -->



                            </div>

                            <center>
                                <div class="alert alert-success" id="alert_in" style="display:none;">
                                    Sukses CLOCK IN!
                                </div>
                                <div class="alert bg-green" id="alert_out" style="display:none;">
                                    Sukses CLOCK OUT!
                                </div>
                                <div class="alert bg-pink" id="alert_error" style="display:none;">
                                    Anda belum Clock IN!
                                </div>
                                <div class="alert bg-pink" id="alert_double" style="display:none;">
                                    Anda sudah melakukan CLOCK IN sebelumnya!
                                </div>
                                <div class="alert bg-pink" id="alert_finish" style="display:none;">
                                    Anda sudah melakukan CLOCK IN dan CLOCK OUT sebelumnya!
                                </div>
                            </center>


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
    $(document).ready(function() {

        $.ajax({
            url: '<?= base_url('hr/getClock') ?>',
            data: {
                nik: '<?= $this->session->userdata('nik') ?>',
                attendance_date: '<?= date('Y-m-d') ?>',
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result != 500) {
                    if (result.clock_in != '0000-00-00 00:00:00') {
                        $('.histori').append('<small> - CLOCK IN [ ' + result.clock_in + '] </small>')
                    }
                    if (result.clock_out != '0000-00-00 00:00:00') {
                        $('.histori').append('<br><small> - CLOCK OUT [ ' + result.clock_out + '] </small>')
                    }
                }

            }
        });
    });

    window.setTimeout("waktu()", 1000);

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = waktu.getHours();
        document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("detik").innerHTML = waktu.getSeconds();
    }
</script>

<script>
    $('#alert_in').hide(500)
    $('#alert_out').hide(500)
    $('#alert_error').hide(500)
    $('#alert_finish').hide(500)
    $('#alert_double').hide(500)
    $('.btn-simpan').hide(500)
    $('.btn-simpan2').hide(500)
    $('#loading-text').hide()
    $('#loading').hide()
    $('#loading2').hide()
    $('.btn-back').hide()
    $('.btn-back2').hide()
    $(document).ready(function() {
        $("#absen").hide()
    });

    $('.btn-back').on('click', function() {
        // $("#head").show()
        $("#body").show()
        $("#absen").hide()
        window.location = '<?= base_url("karyawan") ?>'
    })

    $('.btn-back2').on('click', function() {
        // $("#head").show()
        $("#body").show()
        $("#absen").hide()
        window.location = '<?= base_url("karyawan") ?>'
    })

    function check_camera() {
        if ($('#canvas').hasClass('change-width')) {
            $('#loading').hide()
            $(".btn-take-photo").show()
            $('.btn-back').show()
            $('body').removeClass('loading');
        } else {
            $('#loading').show()
            $(".btn-take-photo").hide()
            $('.btn-back').hide()
            $('body').addClass('loading');
        }
    }

    function check_camera2() {
        if ($('#canvas2').hasClass('change-width')) {
            $('#loading2').hide()
            $(".btn-take-photo2").show()
            $('.btn-back2').show()
            $('body').removeClass('loading');
        } else {
            $('#loading2').show()
            $(".btn-take-photo2").hide()
            $('.btn-back2').hide()
            $('body').addClass('loading');
        }
    }
    var data_lat = ''
    var data_lng = ''
    var data_radius = ''
    // Calculate and display the distance between markers
    function haversine_distance(mk1A, mk1B, mk2A, mk2B) {
        var R = 3958.8; // Radius of the Earth in miles
        var rlat1 = mk1A * (Math.PI / 180); // Convert degrees to radians
        var rlat2 = mk2A * (Math.PI / 180); // Convert degrees to radians
        var difflat = rlat2 - rlat1; // Radian difference (latitudes)
        var difflon = (mk2B - mk1B) * (Math.PI / 180); // Radian difference (longitudes)

        var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
        return d;
    }

    $('#clock_in').on('click', function() {
        $(".btn-take-photo").hide()
        $.ajax({
            url: '<?= base_url('hr/getClock') ?>',
            data: {
                nik: '<?= $this->session->userdata('nik') ?>',
                attendance_date: '<?= date('Y-m-d') ?>',
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                // var countDataImg = result.lenght
                // console.log('ini' + result)
                if (result != 500) {
                    if (result.image_in != null) {
                        // console.log('ada foto')
                        $('#alert_in').hide(500)
                        $('#alert_out').hide(500)
                        $('#alert_error').hide(500)
                        $('#alert_finish').hide(500)
                        $('#alert_double').hide(500)
                        $('.btn-simpan').show()
                        $('.btn-simpan2').hide()
                        $('.cam_clock_out').hide()
                        $('.cam_clock_in').show()
                        $('.btn_clock_out').hide()
                        $('.btn_clock_in').show()
                        // $("#head").hide()
                        $("#body").hide()
                        $("#absen").show()
                        $('.cam_clock_in').find('img').remove()
                        $('.cam_clock_in').append(
                            `<img src="<?= base_url() ?>/assets/bsb/images/clock_in/${result.image_in}" class="img-thumbnail" alt="${result.image_in}">`
                        )
                        if (result.clock_in != '0000-00-00 00:00:00') {
                            $('.cam_clock_in').find('.histori1').remove()
                            $('.cam_clock_in').append('<p class="histori1"><small>CLOCK IN [ ' + result.clock_in + ' ' + result.zona + ' ] </small></p>')
                        }
                        $('#canvas').hide()
                        $('.btn-back').show()
                        $('#video').height('0px');
                        $(".btn-take-photo,.btn-retake-photo, .btn-simpan").hide()
                    } else {
                        $('#video').height('');
                        do_in()
                    }

                } else {
                    $('#video').height('');
                    do_in()
                }


            }
        });
    });

    function do_in() {
        // console.log('tidak ada foto')
        $('.cam_clock_in').find('img').remove()
        $('.cam_clock_in').find('.histori1').remove()
        check_camera()
        $('#alert_in').hide(500)
        $('#alert_out').hide(500)
        $('#alert_error').hide(500)
        $('#alert_finish').hide(500)
        $('#alert_double').hide(500)
        $('.btn-simpan').show()
        $('.btn-simpan2').hide()
        $('.cam_clock_out').hide()
        $('.cam_clock_in').show()
        $('.btn_clock_out').hide()
        $('.btn_clock_in').show()
        // $("#head").hide()
        $("#body").hide()
        $("#absen").show()


        $(".btn-retake-photo, .btn-simpan").hide()
        var streamSetting;
        var isPhotoReady = false

        var canvas = document.querySelector('#canvas'),
            context = canvas.getContext('2d'),
            video = document.querySelector("#video")
        // $("#canvas").hide()


        $(function(e) {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.enumerateDevices().then(function(devices) {

                    var html = ''
                    devices.forEach(function(e) {
                        if (e.kind == "videoinput") {
                            html += `<option value="${e.deviceId}">${e.label}</option>`
                        }
                    })
                    $("#video-source").html(html)
                })


                navigator.mediaDevices.getUserMedia({
                    video: {

                        facingMode: "user",
                        // width: 320,
                        // height: 768
                    },
                    audio: false,
                }).then(function(stream) {
                    video.srcObject = stream
                    streamSetting = stream.getVideoTracks()[0].getSettings()
                    // console.log(streamSetting.aspectRatio)
                    video.muted = true;
                    video.playsInline = true;
                    video.play()
                    video.style.width = '320px'
                    $('#canvas').addClass('change-width')
                    check_camera()
                })
            } else alert("oops your browser not allowed!")

            $("#video-source").on("change", function(e) {
                const id = $(this).val()
                navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "user",
                        deviceId: id ? {
                            exact: id
                        } : undefined
                    },
                    audio: false,
                }).then(function(stream) {
                    video.srcObject = stream
                    streamSetting = stream.getVideoTracks()[0].getSettings()
                    // console.log(streamSetting.aspectRatio)
                    video.muted = true;
                    video.playsInline = true;
                    video.play()
                })
            })


            $(".btn-simpan").on("click", function(e) {
                $('.btn-simpan').attr('disabled', 'disabled')
                // console.log(isPhotoReady)
                if (isPhotoReady) {
                    // _sh.setLoading(".upload-loading")
                    // $("#canvas").hide()
                    $('#alert_in').append('')
                    $('body').addClass('loading');
                    $('#loading-text').show()
                    $('.btn-simpan').attr('disabled', 'disabled')
                    $(".btn-retake-photo, .btn-simpan").hide()
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {

                                // Calculate and display the distance between markers
                                // var distance = haversine_distance(-7.9605254, 112.66477, -7.960454, 112.664721);
                                // var distance = haversine_distance(-7.9605254, 112.66477, -7.960684363432781, 112.66463487949548);
                                // get_data_loc()
                                $.ajax({
                                    url: '<?php echo base_url('admin/getDataLocation'); ?>',
                                    type: "post",
                                    data: {},
                                    cache: false,
                                    dataType: 'JSON',
                                    success: function(result) {
                                        $('body').addClass('loading');
                                        $('#loading-text').show()
                                        $('.btn-simpan').attr('disabled', 'disabled')
                                        $(".btn-retake-photo, .btn-simpan").hide()
                                        // $('#myModal').modal('hide');
                                        // console.log(result)
                                        var count_loc = result.length
                                        // console.log(count_loc)

                                        if (count_loc != 0) {
                                            result.forEach((e) => {
                                                // console.log(e.longitude)
                                                data_lat = e.latitude
                                                data_lng = e.longitude
                                                data_radius = e.radius
                                            })

                                        } else {
                                            data_lat = -7.9605227
                                            data_lng = 112.6647725
                                            data_radius = '10'
                                        }

                                        console.log('data db ' + data_lat)
                                        console.log('data db ' + data_lng)
                                        var distance = haversine_distance(position.coords.latitude, position.coords.longitude, data_lat, data_lng);
                                        console.log('data loc now ' + position.coords.latitude)
                                        console.log('data loc now ' + position.coords.longitude)

                                        var data_meter = ''
                                        data_meter = Math.round(distance.toFixed(5) / 0.00062137)
                                        console.log(distance.toFixed(5))
                                        console.log('data meter ' + data_meter)
                                        var check_radius = []

                                        for (let i = 0; i <= data_radius; i++) {
                                            check_radius.push(i)
                                        }
                                        // if (data_radius == '10') {
                                        //     var i = 0
                                        //     for (let i = 0; i <= 10; i++) {
                                        //         check_radius.push(i)
                                        //     }
                                        //     // [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                        // } else if (data_radius == '25') {
                                        //     var i = 0
                                        //     for (let i = 0; i <= 25; i++) {
                                        //         check_radius.push(i)
                                        //     }
                                        //     //[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25]
                                        // } else {
                                        //     var i = 0
                                        //     for (let i = 0; i <= 50; i++) {
                                        //         check_radius.push(i)
                                        //     }
                                        //     // [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50]
                                        // }

                                        console.log(check_radius)
                                        if (check_radius.indexOf(data_meter) !== -1) {
                                            // console.log('ada pada radius yang ditentukan')
                                            $('body').addClass('loading');
                                            $('#loading-text').show()
                                            $('.btn-simpan').attr('disabled', 'disabled')
                                            $(".btn-retake-photo, .btn-simpan").hide()
                                            $.ajax({
                                                url: '<?= base_url('karyawan/addIn') ?>',
                                                data: {
                                                    img: canvas.toDataURL("image/png", 0.5),
                                                    tipe: function() {
                                                        return $("#tipe").val()
                                                    },
                                                    nik: '<?= $this->session->userdata('nik') ?>',
                                                    attendance_date: '<?= date('Y-m-d') ?>',
                                                    clock_in_latitude: position.coords.latitude,
                                                    clock_in_longitude: position.coords.longitude,

                                                },
                                                type: "POST",
                                                dataType: 'json',
                                                cache: false,
                                                success: function(data) {
                                                    $('body').addClass('loading');
                                                    $('#loading-text').show()
                                                    $('.btn-simpan').attr('disabled', 'disabled')
                                                    $(".btn-retake-photo, .btn-simpan").hide()
                                                    // $(".upload-loading").html("")
                                                    // $("#canvas").show()
                                                    //getClock jika ada

                                                    data.forEach((e) => {
                                                        if (e.result == 200) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_in').show(500)
                                                            $('#alert_in').append('<b>[ ' + e.clock + ' ' + e.zona + ' ]</b>')
                                                            $.ajax({
                                                                url: '<?= base_url('hr/getClock') ?>',
                                                                data: {
                                                                    nik: '<?= $this->session->userdata('nik') ?>',
                                                                    attendance_date: '<?= date('Y-m-d') ?>',
                                                                },
                                                                type: 'post',
                                                                dataType: 'json',
                                                                success: function(result) {
                                                                    if (result != 500) {
                                                                        $('.histori').append('<small> - CLOCK IN [ ' + result.clock_in + ' ' + result.zona + ' ] </small>')
                                                                    }

                                                                }
                                                            });
                                                            $('#alert_out').hide(500)
                                                            $('#alert_error').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('200')
                                                        } else if (e.result == 400) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            // isPhotoReady = false
                                                            // $(".btn-retake-photo, .btn-simpan").hide()
                                                            // $(".btn-take-photo").show()
                                                            // $("#canvas").hide()
                                                            // $("#video").show()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_error').hide(500)
                                                            $('#alert_finish').show(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('400')
                                                        } else if (e.result == 500) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady = false
                                                            $(".btn-retake-photo, .btn-simpan").hide()
                                                            $(".btn-take-photo").show()
                                                            $("#canvas").hide()
                                                            $("#video").show()

                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b> Anda belum Clock IN!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('500')
                                                        } else if (e.result == 501) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady = false
                                                            $(".btn-retake-photo, .btn-simpan").hide()
                                                            $(".btn-take-photo").show()
                                                            $("#canvas").hide()
                                                            $("#video").show()

                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b>File Foto Corrupted!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('500')
                                                        } else if (e.result == 502) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady = false
                                                            $(".btn-retake-photo, .btn-simpan").hide()
                                                            $(".btn-take-photo").show()
                                                            $("#canvas").hide()
                                                            $("#video").show()

                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b>Pilih Shift terlebih dahulu!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('500')
                                                        } else if (e.result == 503) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady = false
                                                            $(".btn-retake-photo, .btn-simpan").hide()
                                                            $(".btn-take-photo").show()
                                                            $("#canvas").hide()
                                                            $("#video").show()

                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b>Anda libur hari ini!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('500')
                                                        } else {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').append('<b>Mohon ada kesalahan pada sistem ini!</b>')
                                                            $('.btn-simpan').removeAttr("disabled")
                                                            $('.btn-back').show()
                                                            // console.log('200 else')
                                                        }


                                                    })
                                                },
                                                error: function(x, s, e) {
                                                    // _sh.errror_req_handler(x, base_url)
                                                    // $("#head").show()
                                                    $("#body").show()
                                                    $("#absen").hide()
                                                    $('#alert_error').append('<b>Mohon ada kesalahan pada sistem!</b>')
                                                    $(".upload-loading").html("")
                                                    $("#canvas").show()
                                                    $('.btn-simpan').removeAttr("disabled")
                                                    $('body').removeClass('loading');
                                                    $('#loading-text').hide()
                                                    $('.btn-back').show()
                                                    // console.log('error')
                                                }
                                            })

                                        } else {

                                            isPhotoReady = false
                                            $(".btn-retake-photo, .btn-simpan").hide()
                                            $(".btn-take-photo").show()
                                            $("#canvas").hide()
                                            $("#video").show()

                                            // $("#head").show()
                                            $("#body").show()
                                            $("#absen").hide()
                                            $('#alert_error').show(500)
                                            $('#alert_in').hide(500)
                                            $('#alert_out').hide(500)
                                            $('#alert_finish').hide(500)
                                            $('#alert_double').hide(500)
                                            $('.btn-simpan').removeAttr("disabled")
                                            $('#alert_error').text('')
                                            $('#alert_error').append('<b>Maaf Anda berada diluar lokasi yang ditentukan!</b>')
                                            $('body').removeClass('loading');
                                            $('#loading-text').hide()
                                            $('.btn-back').show()
                                            // console.log('tidak pada radius yang ditentukan')
                                        }
                                    }
                                });

                                // var a = 'ada'
                                // if (a == 'a') {

                                // }



                            },
                            function(error) {
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf anda menolak akses geolocation!</b>')
                                        $('.btn-simpan').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back').show()
                                        // _sh.swalDanger("Maaf anda menolak akses geolocation!")
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf lokasi tidak ditemukan!</b>')
                                        $('.btn-simpan').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back').show()
                                        // _sh.swalDanger("Maaf lokasi tidak ditemukan!")
                                        break;
                                    case error.TIMEOUT:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf gps anda terlalu lemot!</b>')
                                        $('.btn-simpan').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back').show()
                                        // _sh.swalDanger("Maaf gps anda terlalu lemot!")
                                    default:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf gps anda error!</b>')
                                        $('.btn-simpan').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back').show()
                                        // _sh.swalDanger("Maaf gps anda error!")
                                        break;
                                }
                            }
                        )
                    } else {
                        // $("#head").show()
                        $("#body").show()
                        $("#absen").hide()
                        $('#alert_error').append('<b>Maaf device anda tidak support dengan geolocation!</b>')
                        $('.btn-simpan').removeAttr("disabled")
                        $('body').removeClass('loading');
                        $('#loading-text').hide()
                        $('.btn-back').show()
                        // _sh.swalDanger("Maaf device anda tidak support dengan geolocation!")
                    }
                } else {
                    // $("#head").show()
                    $("#body").show()
                    $("#absen").hide()
                    $('#alert_error').append('<b>Mohon ambil photo terlebih dahulu</b>')
                    $('.btn-simpan').removeAttr("disabled")
                    $('body').removeClass('loading');
                    $('#loading-text').hide()
                    $('.btn-back').show()
                    // _sh.swalDanger("Mohon ambil photo terlebih dahulu")
                }
            })

            // <video playsinline="" id="video" class="" style="margin-left: auto; margin-right: auto; display: none; width: 320px;"></video>
            // CanvasRenderingContext2D {
            //     canvas: canvas #canvas.change - width,
            //     globalAlpha: 1,
            //     globalCompositeOperation: 'source-over',
            //     filter: 'none',
            //     imageSmoothingEnabled: true,
            //     …
            // }
            // canvas: canvas #canvas.change - width
            // direction: "ltr"
            // fillStyle: "#000000"
            // filter: "none"
            // font: "10px sans-serif"
            // fontKerning: "auto"
            // fontStretch: "normal"
            // fontVariantCaps: "normal"
            // globalAlpha: 1
            // globalCompositeOperation: "source-over"
            // imageSmoothingEnabled: true
            // imageSmoothingQuality: "low"
            // letterSpacing: "0px"
            // lineCap: "butt"
            // lineDashOffset: 0
            // lineJoin: "miter"
            // lineWidth: 1
            // miterLimit: 10
            // shadowBlur: 0
            // shadowColor: "rgba(0, 0, 0, 0)"
            // shadowOffsetX: 0
            // shadowOffsetY: 0
            // strokeStyle: "#000000"
            // textAlign: "start"
            // textBaseline: "alphabetic"
            // textRendering: "auto"
            // wordSpacing: "0px"

            $(".btn-take-photo").on("click", function(e) {

                video.defaultPlaybackRate = .4;
                $(".btn-retake-photo").show()
                $(".btn-take-photo").hide()
                $(".btn-back").hide()
                isPhotoReady = true;
                const cameraWidth = streamSetting.width
                const cameraHeight = streamSetting.height
                const parentWidth = $(".camera").width()
                const canvasWidth = parentWidth > 700 ? 700 : parentWidth;
                const canvasHeight = canvasWidth / streamSetting.aspectRatio;
                canvas.width = canvasWidth
                canvas.height = canvasHeight

                canvas.width = video.clientWidth;
                canvas.height = video.clientHeight;
                videoActuallyPlaying = true;
                // canvas.width = 1920;
                // canvas.height = 1080;
                // console.log(video)
                // $("#canvas").width("100%")
                // context.clearRect(0, 0, 1280, 1280);
                context.drawImage(video, 0, 0, canvas.width, canvas.height)



                // resizeSVG(video, function(e) {
                //     context.clearRect(0, 0, 1280, 1280);
                //     context.drawImage(this, 0, 0);
                // });

                // context.getImageData(0, 0, canvas.width, canvas.height);
                // context.clearRect(0, 0, canvas.width, canvas.height);

                // const frame = context.getImageData(0, 0, canvas.width, canvas.height);
                // const length = frame.data.length;
                // const data = frame.data;

                // for (let i = 0; i < length; i += 4) {
                //     const red = data[i + 0];
                //     const green = data[i + 1];
                //     const blue = data[i + 2];
                //     if (green > 100 && red > 100 && blue < 43) {
                //         data[i + 3] = 0;
                //     }
                // }
                // context.putImageData(frame, 0, 0);
                // console.log(context)
                let image = canvas.toDataURL('image/jpeg');
                // console.log(image)
                $("#canvas").show()
                $("#video").hide()
                $(".btn-simpan").show()
                if (isPhotoReady == true) {
                    document.getElementById("canvas").style.marginTop = "-13px";
                } else {
                    document.getElementById("canvas").style.marginTop = "-143px";
                }
                // var element = document.getElementByClass('camera');

                // $(".camera").style.height = '0px';
            })
            // if (isPhotoReady == true) {
            //     $(".btn-back").hide()
            // } else {
            //     $(".btn-back").show()
            // }
            $(".btn-retake-photo").on("click", function(e) {
                $(".btn-retake-photo, .btn-simpan").hide()
                $(".btn-take-photo").show()
                $("#canvas").hide()
                $("#video").show()

                // remove style height di sini
            })
        })
    }

    $('#clock_out').on('click', function() {
        $(".btn-take-photo2").hide()
        $.ajax({
            url: '<?= base_url('hr/getClock') ?>',
            data: {
                nik: '<?= $this->session->userdata('nik') ?>',
                attendance_date: '<?= date('Y-m-d') ?>',
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result != 500) {
                    if (result.image_out != null) {
                        // console.log('ada foto')
                        $('#alert_in').hide(500)
                        $('#alert_out').hide(500)
                        $('#alert_error').hide(500)
                        $('#alert_finish').hide(500)
                        $('#alert_double').hide(500)
                        $('.btn-simpan').hide()
                        $('.btn-simpan2').show()
                        $('.cam_clock_out').show()
                        $('.cam_clock_in').hide()
                        $('.btn_clock_out').show()
                        $('.btn_clock_in').hide()
                        // $("#head").hide()
                        $("#body").hide()
                        $("#absen").show()
                        $('.cam_clock_out').find('img').remove()
                        $('.cam_clock_out').append(
                            `<img src="<?= base_url() ?>/assets/bsb/images/clock_out/${result.image_out}" class="img-thumbnail" alt="${result.image_out}">`
                        )
                        if (result.clock_out != '0000-00-00 00:00:00') {
                            $('.cam_clock_out').find('.histori2').remove()
                            $('.cam_clock_out').append('<p class="histori2"><small>CLOCK OUT [ ' + result.clock_out + ' ' + result.zona + ' ] </small></p>')
                        }
                        $('#canvas2').hide()
                        $('.btn-back2').show()
                        $('#video2').height('0px');
                        $(".btn-take-photo2,.btn-retake-photo2, .btn-simpan2").hide()
                    } else {
                        $('#video2').height('');
                        do_out()
                    }

                } else {
                    $('#video2').height('');
                    do_out()
                }
            }
        });

    });

    function do_out() {
        // console.log('tidak ada foto')
        $('.cam_clock_out').find('img').remove()
        $('.cam_clock_out').find('.histori2').remove()
        check_camera2()
        $('#alert_in').hide(500)
        $('#alert_out').hide(500)
        $('#alert_error').hide(500)
        $('#alert_finish').hide(500)
        $('#alert_double').hide(500)
        $('.btn-simpan').hide()
        $('.btn-simpan2').show()
        $('.cam_clock_out').show()
        $('.cam_clock_in').hide()
        $('.btn_clock_out').show()
        $('.btn_clock_in').hide()
        // $("#head").hide()
        $("#body").hide()
        $("#absen").show()



        // $("#canvas").hide()
        $(".btn-retake-photo2, .btn-simpan2").hide()
        var streamSetting;
        var isPhotoReady2 = false

        var canvas = document.querySelector('#canvas2'),
            context = canvas.getContext('2d'),
            video = document.querySelector("#video2")

        $(function(e) {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.enumerateDevices().then(function(devices) {

                    var html = ''
                    devices.forEach(function(e) {
                        if (e.kind == "videoinput") {
                            html += `<option value="${e.deviceId}">${e.label}</option>`
                        }
                    })
                    $("#video-source").html(html)
                })


                navigator.mediaDevices.getUserMedia({
                    video: {

                        facingMode: "user",
                        // width: 320,
                        // height: 768
                    },
                    audio: false,
                }).then(function(stream) {
                    video.srcObject = stream
                    streamSetting = stream.getVideoTracks()[0].getSettings()
                    // console.log(streamSetting.aspectRatio)
                    video.muted = true;
                    video.playsInline = true;
                    video.play()
                    video.style.width = '320px'
                    $('#canvas2').addClass('change-width')
                    check_camera2()
                })
            } else alert("oops your browser not allowed!")

            $("#video-source").on("change", function(e) {
                const id = $(this).val()
                navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "user",
                        deviceId: id ? {
                            exact: id
                        } : undefined
                    },
                    audio: false,
                }).then(function(stream) {
                    video.srcObject = stream
                    streamSetting = stream.getVideoTracks()[0].getSettings()
                    // console.log(streamSetting.aspectRatio)
                    video.muted = true;
                    video.playsInline = true;
                    video.play()
                })
            })

            $(".btn-simpan2").on("click", function(e) {

                if (isPhotoReady2) {
                    $('.btn-simpan2').attr('disabled', 'disabled')
                    // _sh.setLoading(".upload-loading")
                    // $("#canvas2").hide()
                    $('#alert_out').append('')
                    $('body').addClass('loading');
                    $('#loading-text').show()
                    $('.btn-simpan2').attr('disabled', 'disabled')
                    $(".btn-retake-photo2, .btn-simpan2").hide()
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {

                                $.ajax({
                                    url: '<?php echo base_url('admin/getDataLocation'); ?>',
                                    type: "post",
                                    data: {},
                                    cache: false,
                                    dataType: 'JSON',
                                    success: function(result) {
                                        $('body').addClass('loading');
                                        $('#loading-text').show()
                                        $('.btn-simpan2').attr('disabled', 'disabled')
                                        $(".btn-retake-photo2, .btn-simpan2").hide()
                                        // $('#myModal').modal('hide');
                                        // console.log(result)
                                        var count_loc = result.length
                                        // console.log(count_loc)

                                        if (count_loc != 0) {
                                            result.forEach((e) => {
                                                // console.log(e.longitude)
                                                data_lat = e.latitude
                                                data_lng = e.longitude
                                                data_radius = e.radius
                                            })

                                        } else {
                                            data_lat = -7.9605227
                                            data_lng = 112.6647725
                                            data_radius = '10'
                                        }
                                        console.log('data db ' + data_lat)
                                        console.log('data db ' + data_lng)
                                        var distance = haversine_distance(position.coords.latitude, position.coords.longitude, data_lat, data_lng);
                                        console.log('data loc now ' + position.coords.latitude)
                                        console.log('data loc now ' + position.coords.longitude)
                                        var data_meter = ''
                                        data_meter = Math.round(distance.toFixed(5) / 0.00062137)
                                        console.log(distance.toFixed(5))
                                        console.log('data meter ' + data_meter)
                                        var check_radius = []

                                        for (let i = 0; i < data_radius; i++) {
                                            check_radius.push(i)
                                        }

                                        // if (data_radius == '10') {
                                        //     var i = 0
                                        //     for (let i = 0; i <= 10; i++) {
                                        //         check_radius.push(i)
                                        //     }
                                        //     // [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                        // } else if (data_radius == '25') {
                                        //     var i = 0
                                        //     for (let i = 0; i <= 25; i++) {
                                        //         check_radius.push(i)
                                        //     }
                                        //     //[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25]
                                        // } else {
                                        //     var i = 0
                                        //     for (let i = 0; i <= 50; i++) {
                                        //         check_radius.push(i)
                                        //     }
                                        //     // [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50]
                                        // }

                                        console.log(check_radius)
                                        if (check_radius.indexOf(data_meter) !== -1) {
                                            // console.log('ada pada radius yang ditentukan')
                                            $('body').addClass('loading');
                                            $('#loading-text').show()
                                            $('.btn-simpan2').attr('disabled', 'disabled')
                                            $(".btn-retake-photo2, .btn-simpan2").hide()
                                            $.ajax({
                                                url: '<?= base_url('karyawan/addOut') ?>',
                                                data: {
                                                    img: canvas.toDataURL("image/png", 0.5),
                                                    tipe: function() {
                                                        return $("#tipe").val()
                                                    },
                                                    // id_attendance: id_attendance
                                                    nik: '<?= $this->session->userdata('nik') ?>',
                                                    attendance_date: '<?= date('Y-m-d') ?>',
                                                    clock_out_latitude: position.coords.latitude,
                                                    clock_out_longitude: position.coords.longitude,

                                                    // latitude: position.coords.latitude,
                                                    // longitude: position.coords.longitude
                                                },
                                                type: "POST",
                                                dataType: 'json',
                                                cache: false,
                                                success: function(data) {
                                                    // $(".upload-loading").html("")
                                                    // $("#canvas2").show()
                                                    $('body').addClass('loading');
                                                    $('#loading-text').show()
                                                    $('.btn-simpan2').attr('disabled', 'disabled')
                                                    $(".btn-retake-photo2, .btn-simpan2").hide()

                                                    // console.log(data)
                                                    // console.log(data.clock)

                                                    // _sh.swalSuccess("data berhasil disimpan")
                                                    // location.hash = "#/satpam/absensi/absen-success"

                                                    //getClock jika ada
                                                    data.forEach((e) => {
                                                        if (e.result == 200) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_out').show(500)
                                                            $('#alert_out').append('<b>[ ' + e.clock + ' ' + e.zona + ' ]</b>')
                                                            $.ajax({
                                                                url: '<?= base_url('hr/getClock') ?>',
                                                                data: {
                                                                    nik: '<?= $this->session->userdata('nik') ?>',
                                                                    attendance_date: '<?= date('Y-m-d') ?>',
                                                                },
                                                                type: 'post',
                                                                dataType: 'json',
                                                                success: function(result) {
                                                                    if (result != 500) {
                                                                        $('.histori').append('<br><small> - CLOCK OUT [ ' + result.clock_out + ' ' + result.zona + ' ] </small>')
                                                                    }
                                                                }
                                                            })
                                                            $('#alert_in').hide(500)
                                                            $('#alert_error').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()
                                                        } else if (e.result == 400) {
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            // isPhotoReady2 = false
                                                            // $(".btn-retake-photo2, .btn-simpan2").hide()
                                                            // $(".btn-take-photo2").show()
                                                            // $("#canvas2").hide()
                                                            // $("#video2").show()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_error').hide(500)
                                                            $('#alert_finish').show(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()
                                                        } else if (e.result == 500) {
                                                            // console.log(e.result)
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady2 = false
                                                            $(".btn-retake-photo2, .btn-simpan2").hide()
                                                            $(".btn-take-photo2").show()
                                                            $("#canvas2").hide()
                                                            $("#video2").show()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b> Anda belum Clock IN!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()
                                                        } else if (e.result == 501) {
                                                            // console.log(e.result)
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady2 = false
                                                            $(".btn-retake-photo2, .btn-simpan2").hide()
                                                            $(".btn-take-photo2").show()
                                                            $("#canvas2").hide()
                                                            $("#video2").show()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b>File Foto Corrupted!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()
                                                        } else if (e.result == 502) {
                                                            // console.log(e.result)
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady2 = false
                                                            $(".btn-retake-photo2, .btn-simpan2").hide()
                                                            $(".btn-take-photo2").show()
                                                            $("#canvas2").hide()
                                                            $("#video2").show()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b>Pilih Shift terlebih dahulu!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()

                                                        } else if (e.result == 503) {
                                                            // console.log(e.result)
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            isPhotoReady2 = false
                                                            $(".btn-retake-photo2, .btn-simpan2").hide()
                                                            $(".btn-take-photo2").show()
                                                            $("#canvas2").hide()
                                                            $("#video2").show()
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').show(500)
                                                            $('#alert_error').html('<b>Anda libur hari ini!</b>')
                                                            $('#alert_in').hide(500)
                                                            $('#alert_out').hide(500)
                                                            $('#alert_finish').hide(500)
                                                            $('#alert_double').hide(500)
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()

                                                        } else {
                                                            // $("#head").show()
                                                            $("#body").show()
                                                            $("#absen").hide()
                                                            $('#alert_error').append('<b>Maaf ada kesalahan pada sistem ini!</b>')
                                                            $('body').removeClass('loading');
                                                            $('#loading-text').hide()
                                                            $('.btn-simpan2').removeAttr("disabled")
                                                            $('.btn-back2').show()
                                                        }




                                                    })
                                                },
                                                error: function(x, s, e) {
                                                    // _sh.errror_req_handler(x, base_url)

                                                    // $("#head").show()
                                                    $("#body").show()
                                                    $("#absen").hide()
                                                    $('#alert_error').append('<b>Maaf ada kesalahan pada sistem!</b>')
                                                    $(".upload-loading").html("")
                                                    $("#canvas2").show()
                                                    $('.btn-simpan2').removeAttr("disabled")
                                                    $('body').removeClass('loading');
                                                    $('#loading-text').hide()
                                                    $('.btn-back2').show()
                                                }
                                            })
                                        } else {
                                            // console.log('tidak pada radius yang ditentukan')
                                            isPhotoReady2 = false
                                            $(".btn-retake-photo2, .btn-simpan2").hide()
                                            $(".btn-take-photo2").show()
                                            $("#canvas2").hide()
                                            $("#video2").show()
                                            // $("#head").show()
                                            $("#body").show()
                                            $("#absen").hide()
                                            $('#alert_error').show(500)
                                            $('#alert_in').hide(500)
                                            $('#alert_out').hide(500)
                                            $('#alert_finish').hide(500)
                                            $('#alert_double').hide(500)
                                            $('.btn-simpan2').removeAttr("disabled")
                                            $('#alert_error').text('')
                                            $('#alert_error').append('<b>Maaf Anda berada diluar lokasi yang ditentukan!</b>')
                                            $('body').removeClass('loading');
                                            $('#loading-text').hide()
                                            $('.btn-back2').show()
                                        }
                                    }
                                });
                            },
                            function(error) {
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf anda menolak akses geolocation!</b>')
                                        $('.btn-simpan2').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back2').show()
                                        // _sh.swalDanger("Maaf anda menolak akses geolocation!")
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf lokasi tidak ditemukan!</b>')
                                        $('.btn-simpan2').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back2').show()
                                        // _sh.swalDanger("Maaf lokasi tidak ditemukan!")
                                        break;
                                    case error.TIMEOUT:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf gps anda terlalu lemot!</b>')
                                        $('.btn-simpan2').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back2').show()
                                        // _sh.swalDanger("Maaf gps anda terlalu lemot!")
                                    default:
                                        // $("#head").show()
                                        $("#body").show()
                                        $("#absen").hide()
                                        $('#alert_error').append('<b>Maaf gps anda error!</b>')
                                        $('.btn-simpan2').removeAttr("disabled")
                                        $('body').removeClass('loading');
                                        $('#loading-text').hide()
                                        $('.btn-back2').show()
                                        // _sh.swalDanger("Maaf gps anda error!")
                                        break;
                                }
                            }
                        )
                    } else {
                        // $("#head").show()
                        $("#body").show()
                        $("#absen").hide()
                        $('#alert_error').append('<b>Maaf device anda tidak support dengan geolocation!</b>')
                        $('.btn-simpan2').removeAttr("disabled")
                        $('body').removeClass('loading');
                        $('#loading-text').hide()
                        $('.btn-back2').show()
                    }
                    // _sh.swalDanger("Maaf device anda tidak support dengan geolocation!")
                } else {
                    // $("#head").show()
                    $("#body").show()
                    $("#absen").hide()
                    $('#alert_error').append('<b>Mohon ambil photo terlebih dahulu</b>')
                    $('.btn-simpan2').removeAttr("disabled")
                    $('body').removeClass('loading');
                    $('#loading-text').hide()
                    $('.btn-back2').show()
                    // _sh.swalDanger("Mohon ambil photo terlebih dahulu")
                }
            })

            $(".btn-take-photo2").on("click", function(e) {

                video.defaultPlaybackRate = .4;
                $(".btn-back2").hide()
                $(".btn-retake-photo2").show()
                $(".btn-take-photo2").hide()
                isPhotoReady2 = true;
                const cameraWidth = streamSetting.width
                const cameraHeight = streamSetting.height
                const parentWidth = $(".camera").width()
                const canvasWidth = parentWidth > 700 ? 700 : parentWidth;
                const canvasHeight = canvasWidth / streamSetting.aspectRatio;
                canvas.width = canvasWidth
                canvas.height = canvasHeight
                // $("#canvas2").width("100%")

                canvas.width = video.clientWidth;
                canvas.height = video.clientHeight;
                videoActuallyPlaying = true;

                context.drawImage(video, 0, 0, canvas.width, canvas.height)

                $("#canvas2").show()
                $("#video2").hide()
                $(".btn-simpan2").show()
                if (isPhotoReady2 == true) {
                    document.getElementById("canvas2").style.marginTop = "-13px";
                } else {
                    document.getElementById("canvas2").style.marginTop = "-143px";
                }
            })
            // if (isPhotoReady2 == true) {
            //     $(".btn-back2").hide()
            // } else {
            //     $(".btn-back2").show()
            // }
            $(".btn-retake-photo2").on("click", function(e) {
                $(".btn-retake-photo2, .btn-simpan2").hide()
                $(".btn-take-photo2").show()
                $("#canvas2").hide()
                $("#video2").show()
                // remove style height di sini
            })
        })
    }

    // var resizeSVG = function(svgImg, callback) {
    //     // create an iframe
    //     var iframe = document.createElement('iframe');
    //     // so we don't see it
    //     iframe.height = 0;
    //     iframe.width = 0;
    //     iframe.onload = function() {
    //         var doc = iframe.contentDocument;
    //         var svg = doc.querySelector('svg');
    //         // get the computed width and height of your img element
    //         // should probably be tweaked
    //         var bbox = svgImg.getBoundingClientRect();
    //         // if it's a relative width
    //         if (svg.width.baseVal.unitType !== 1) {
    //             svg.setAttribute('width', bbox.width);
    //         }
    //         // or a relative height
    //         if (svg.height.baseVal.unitType !== 1) {
    //             svg.setAttribute('height', bbox.height);
    //         }
    //         // serialize our updated svg
    //         var svgData = (new XMLSerializer()).serializeToString(svg);
    //         var svgURL = 'data:image/svg+xml; charset=utf8, ' + encodeURIComponent(svgData);
    //         // create a new Image Object that ill be draw on the canvas
    //         var img = new Image();
    //         img.onload = callback;
    //         img.src = svgURL;
    //         // remove the iframe
    //         document.body.removeChild(iframe);
    //     };
    //     iframe.src = svgImg.src;
    //     document.body.appendChild(iframe);
    // }
    // $('body').addClass('loading');
</script>