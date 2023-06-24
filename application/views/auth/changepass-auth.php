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
    <title>Password Reset - SCM PORTAL</title>
    <link href="<?= base_url('assets/') ?>css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted">Enter your new password.</div>
                                    <form id="form-data">
                                        <!-- <form action="<?= base_url('auth/action_change') ?>" method="post"> -->
                                        <?= $this->session->flashdata('message') ?>
                                        <div class="alert alert-success" role="alert" id="sukses" style="display: none;">
                                            Your password has been changed
                                        </div>
                                        <div class="alert alert-danger" role="alert" id="gagal" style="display: none;">
                                            Error! Please contact administrator
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="hidden" class="form-control" name="email" id="email" value="<?= $email ?>">
                                            <input class="form-control" type="password" name="password1" id="password1" required />
                                            <label for="inputEmail">Password</label>
                                            <small class="text-danger" id="error-match" style="display: none;">Password doesn't match</small>

                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="password" name="password2" id="password2" required />
                                            <label for="inputEmail">Ulangi Password</label>
                                            <small class="text-danger" id="error-match2" style="display: none;">Password doesn't match</small>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="<?= base_url('auth') ?>">Return to login</a>
                                            <button class="btn btn-primary" type="submit">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="#">Need an account? Please contact administrator!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SCM 2023</div>
                        <!-- <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div> -->
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/') ?>js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</body>

</html>

<script>
    $("#form-data").submit(function(e) {
        e.preventDefault()

        if ($('#password1').val() != $('#password2').val()) {
            $('#error-match').show()
            $('#error-match2').show()
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('email', $("#email").val());
        form_data.append('password', $("#password1").val());

        var url_ajax = '<?= base_url() ?>auth/action_change'


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
                    $('#error-match').hide()
                    $('#error-match2').hide()
                    $('#sukses').show()
                } else {
                    $('#error-match').hide()
                    $('#error-match2').hide()
                    $('#gagal').show()
                }
            },
            error: function(err) {
                console.log(err.responseText)
            }
        })
    })
</script>