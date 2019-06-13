<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BPSDM Prov. Sulteng</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
<!-- </head> -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>BP</b>SDM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>BPSDM</b>Sulteng</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(\Auth::user()->photo!=null)
                <img src="{{ asset('storage/profile/'.\Auth::user()->photo) }}" class="user-image" alt="User Image">
              @else
                <!-- <img src="dist/img/avatar5.png" class="user-image" alt="User Image"> -->
              @endif
              <span class="hidden-xs">{{ Auth::User()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(\Auth::user()->photo!=null)
                  <img src="{{ asset('storage/profile/'.\Auth::user()->photo) }}" class="img-circle" alt="User Image">
                @else
                  <!-- <img src="dist/img/avatar5.png" class="img-circle" alt="User Image"> -->
                @endif
                <p>
                  {{ Auth::user()->name}}
                  <small><a href="#changepassword" class="badge bg-yellow" data-toggle="modal"> Ubah Password</a></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(\Auth::user()->photo!=null)
            <img src="{{ asset('storage/profile/'.\Auth::user()->photo) }}" class="img-circle" alt="User Image">
          @else
            <!-- <img src="dist/img/avatar5.png" class="img-circle" alt="User Image"> -->
          @endif
        </div>
        <div class="pull-left info">
          <p> {{ Auth::User()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">User Profile</li>
        <!-- profile user -->
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-child"></i> <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('profile') }}"><i class="fa fa-circle-o text-red"></i> Profile Saya</a></li>
          </ul>
        </li>
        <!-- training info that user can view -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span>Lihat Diklat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('opentraining') }}"><i class="fa fa-circle-o"></i> Diklat Yang Sedang Dibuka </a></li>
            <li><a href="{{ route('asparticipant') }}"><i class="fa fa-circle-o"></i> Diklat yang saya ikuti </a></li>
            <li><a href="{{ route('participant-history') }}"><i class="fa fa-circle-o"></i> History Diklat Saya </a></li>
          </ul>
        </li>
        <!-- end of user -->
        <li class="header">Admin BPSDM Navigation</li>
        <li class="treeview">
          @permission('management-diklat')
          <a href="#">
            <i class="fa fa-files-o text-red"></i>
            <span>Management Diklat</span>
          </a>
          @endpermission
          <ul class="treeview-menu">
            @permission('show-subjects')
            <li><a href="{{ route('matadiklat') }}"><i class="fa fa-circle-o text-red"></i> Mata Diklat</a></li>
            @endpermission
            @permission('show-speakers')
            <li><a href="{{ route('speakers') }}"><i class="fa fa-circle-o text-red"></i> Speakers/Widyaiswara</a></li>
            @endpermission
            @permission('show-trainings')
            <li><a href="{{ route('trainings') }}"><i class="fa fa-circle-o text-red"></i> Buat Diklat</a></li>
            @endpermission
          </ul>
        </li>
        @permission('show-management-participant')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-red"></i>
            <span>Management Peserta</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('trainingslist') }}"><i class="fa fa-circle-o text-red"></i>Diklat Yang sedang Berlangsung</a></li>
            <li><a href="{{ route('closedtraininglist') }}"><i class="fa fa-circle-o text-red"></i>Diklat Yang Lalu</a></li>
          </ul>
        </li>
        @endpermission
        @role('admin-bkpsdm')
        <li class="header">Admin BKPSDM Kab/Kota</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o text-blue"></i>
            <span>Management Diklat</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('trainingbkpsdm') }}"><i class="fa fa-circle-o text-blue"></i> Buat Diklat</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-blue"></i>
            <span>Management Peserta</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('currenttraininglistbkpsdm') }}"><i class="fa fa-circle-o text-blue"></i>Diklat Yang Sedang Berlangsung</a></li>
            <li><a href="{{ route('traininglistbkpsdm') }}"><i class="fa fa-circle-o text-blue"></i>Diklat Yang lalu</a></li>
          </ul>
        </li>
        @endrole
        @role('widyaiswara')
        <li class="header">Menu Widyaiswara</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i>
            <span>Widyaiswara / Speakers</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('myschedule') }}"><i class="fa fa-calendar-o text-blue"></i>Jadwal Saya</a></li>
            <li><a href="{{ route('learningmedia') }}"><i class="fa fa-folder-o text-blue"></i>Upload Perangkat Mengajar</a></li>
          </ul>
        </li>
        @endrole
        @role('superadministrator','administrator')
        <li class="header">Master Data</li>
        <li><a href="{{ route('lembaga') }}"><i class="fa fa-h-square text-red"></i> <span>Lembaga</span></a></li>
        <li><a href="{{ route('pic') }}"><i class="fa fa-circle-o text-yellow"></i> <span>PIC</span></a></li>
        @endrole
        @role('superadministrator')
        <li class="header">Superadmin</li>
        <li><a href="{{ route('users') }}"><i class="fa fa-users text-red"></i> <span>Users</span></a></li>
        <li><a href="{{ route('roles') }}"><i class="fa fa- fa-map-signs text-red"></i> <span>roles</span></a></li>
        <li><a href="{{ route('permissions') }}"><i class="fa fa- fa-key text-red"></i> <span>permissions</span></a></li>
        <li><a href="{{ route('permissionroles') }}"><i class="fa fa- fa-cog text-red"></i> <span>Role Permissions</span></a></li>
        <li><a href="{{ route('roleusers') }}"><i class="fa fa- fa-cog text-red"></i> <span>User Roles</span></a></li>
        @endrole
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
    <div class="modal modal-warning fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modalLabel">Ubah Password</h4>
              </div>
              <div class="modal-body">
                  <form method="post" id="frm_changepassword" action="{{ route('changepassword') }}">
                      @csrf
                      {{ method_field('PUT') }}
                      <div class="box-body">
                          <div class="form-group has-feedback">
                              <label for="password" class="control-label">Password Baru</label>

                              <input type="password" id="password" name="password" class="form-control" aria-describedby="helpBlock1" placeholder="Password baru" autofocus required>
                          </div>
                      </div>
                      <div class="box-body">
                          <div class="form-group has-feedback">
                              <label for="confirm_password" class="control-label">Ketik Ulang Password</label>

                              <input type="password" id="confirm_password" name="confirm_password" class="form-control" aria-describedby="helpBlock1" placeholder="Masukkan kembali password baru" required>
                          </div>
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-outline"> <i class="fa fa-save"></i> </button>
              </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2018.0.0
    </div>
    <strong>Copyright &copy; <a href="#">BPSDM Prov Sulteng</a>.</strong> All rights
    reserved.
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('jscript')
<!-- </body></html> -->
</body>
</html>
