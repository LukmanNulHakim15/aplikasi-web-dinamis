<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>digital creative Tech | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
  <!-- <script src="<?php echo base_url(); ?>assets/fontawesome/css/all.min.css"></script> -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url(''); ?>" class="logo">
        <span class="logo-mini"><b>MN</b></span>
        <span class="logo-lg"><b>digital creative Tech</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle Navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <?php 
                   $id_user = $this->session->userdata('id');
                $user = $this->db->query("SELECT * FROM registrasi where id= ?",[$id_user])->row();

                ?>
                <span class="hidden-xs">Hallo 😊 <b><?php echo $user->name; ?></b></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header"> 
                  <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
                  <p>
                    <?php echo $user->name; ?>
                    <small>Hak Akses : <?php echo $user->name; ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url().'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url().'dashboard/logout' ?>" class="btn btn-default btn-flat">Keluar</a>
                  </div>
                </li>
              </ul>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <?php 
                $id_user = $this->session->userdata('id');
                $user = $this->db->query("SELECT * FROM registrasi where id= ?",[$id_user])->row();
              ?>
              <p><?php echo $user->name; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
          </div>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAAVIGATION</li>
            <li>
              <a href="<?php echo base_url('dashboard'); ?>">
                <i class="fa fa-dashboard"></i>
                <span>DASHBOARD</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'dashboard/kategori'?>">
                <i class="fa fa-th"></i>
                <span>KATEGORI</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'artikel' ?>">
                <i class="fas fa-pencil-alt"></i>
                <span>ARTIKEL</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'pages' ?>">
                <i class="fa fa-files-o"></i>
                <span>PAGES</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'dashboard/pengguna' ?>">
                <i class="fa fa-users"></i>
                <span>PENGGUNA & HAK AKSES</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'dashboard/pengaturan' ?>">
                <i class="fa fa-edit"></i>
                <span>PENGATURAN WEBSITE</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'dashboard/profil' ?>">
                <i class="fa fa-user"></i>
                <span>PROFIL</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'dashboard/ganti_password' ?>">
                <i class="fa fa-lock"></i>
                <span>GANTI PASSWORD</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url().'dashboard/logout' ?>">
                <i class="fa fa-share"></i>
                <span>KELUAR</span>
              </a>
            </li>
          </ul>
        </div>
      </section>
    </aside>
