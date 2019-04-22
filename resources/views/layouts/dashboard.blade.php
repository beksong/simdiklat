<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BPSDM Prov. Sulteng</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
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
                  <small>Member since Nov. 2012</small>
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
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
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
        <li class="header">Admin BPSDM Navigation</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o text-red"></i>
            <span>Management Diklat</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('matadiklat') }}"><i class="fa fa-circle-o text-red"></i> Mata Diklat</a></li>
            <li><a href="{{ route('speakers') }}"><i class="fa fa-circle-o text-red"></i> Speakers/Widyaiswara</a></li>
            <li><a href="{{ route('trainings') }}"><i class="fa fa-circle-o text-red"></i> Buat Diklat</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-red"></i>
            <span>Management Peserta</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('trainingslist') }}"><i class="fa fa-circle-o text-red"></i>Data Peserta Diklat</a></li>
          </ul>
        </li>
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
            <li><a href="{{ route('traininglistbkpsdm') }}"><i class="fa fa-circle-o text-blue"></i>Data Peserta Diklat</a></li>
          </ul>
        </li>
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
        <li class="header">Master Data</li>
        <li><a href="{{ route('lembaga') }}"><i class="fa fa-h-square text-red"></i> <span>Lembaga</span></a></li>
        <li><a href="{{ route('pic') }}"><i class="fa fa-circle-o text-yellow"></i> <span>PIC</span></a></li>
        <li class="header">Superadmin</li>
        <li><a href="{{ route('users') }}"><i class="fa fa-users text-red"></i> <span>Users</span></a></li>
        <li><a href="{{ route('roles') }}"><i class="fa fa- fa-map-signs text-red"></i> <span>roles</span></a></li>
        <li><a href="{{ route('permissions') }}"><i class="fa fa- fa-key text-red"></i> <span>permissions</span></a></li>
        <li><a href="{{ route('permissionroles') }}"><i class="fa fa- fa-cog text-red"></i> <span>Role Permissions</span></a></li>
        <li><a href="{{ route('roleusers') }}"><i class="fa fa- fa-cog text-red"></i> <span>User Roles</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2018.0.0
    </div>
    <strong>Copyright &copy; <a href="#">BPSDM Prov Sulteng</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('jscript')
</body>
</html>
