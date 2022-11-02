<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rajin Ngoding | Log in</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
    <link rel="stylesheet" href="<?php echo base_url();
                                    ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="<?php echo base_url();
                                    ?>assets/bower_components/Ionicons/css/ionicons.min.css">
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600itali
c">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url(); ?> "><b>Website</b>Saya</a>
        </div>
        <!-- /.login-logo -->
        <?php
        if (isset($_GET['alert'])) {
            if ($_GET['alert'] == "gagal") {
                echo "<div class='alert alert-danger font-weight-bold text-center'>Maaf! Username & Password Salah.</div>";
            } else if ($_GET['alert'] == "belum_login") {
                echo "<div class='alert alert-danger font-weight-bold text-center'>Anda Harus Login Terlebih Dulu!</div>";
            } else if ($_GET['alert'] == "logout") {
                echo "<div class='alert alert-success font-weight-bold text-center'>Anda Telah Logout!</div>";
            }
        }
        ?> 
        <div class="login-box-body">
            <p class="login-box-msg">www.digitalcreativeTech.com</p>
            <!-- <form action="<?php echo base_url().'login/aksi' ?>" method="post"> -->
            <form autocomplete="off" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <?php echo form_error('username'); ?>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <?php echo form_error('password'); ?>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <a href="<?php echo base_url('v_registrasi'); ?>">Registrasi</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url();
                    ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#submit').click(function(event) {
                event.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();

                $.ajax({
                    url: "<?php echo base_url('login'); ?>",
                    method: "POST",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(response) {
                      if(response.code == 200) {
                          Swal.fire({
                            type: "success",
                            title: "Login",
                            text: "Login anda berhasil"
                        })
                            .then(function (){
                                window.location.href = "Dashboard";
                        });

                      }
                    }
                })
            });
        });
    </script>

</body>

</html>