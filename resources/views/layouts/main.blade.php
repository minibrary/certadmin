<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @stack('title')
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset("bootstrap/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset("plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("dist/css/AdminLTE.min.css") }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset("dist/css/skins/_all-skins.min.css") }}">
  <!-- Quicksand Font -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500" rel="stylesheet">
  <style>
  @media (min-width: 768px) {
    .adsense-sidebar {
        width: 230px;
        margin-top: 10px;
    }
  }
  </style>

  @stack('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google AdSense Page Contents-->
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-2882078161937378",
      enable_page_level_ads: true
    });
  </script>
  <!-- End Google AdSense -->

</head>
<!-- Fixed Header, Minimized Sidebar (Test)
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse fixed">
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C.V</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Certivel</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="user-image">
              <span class="hidden-xs">
                @if (empty(Auth::user()->name))
                {{ Auth::user()->email }}
                @endif
                {{ Auth::user()->name }}
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle">

                <p>
                  @if (empty(Auth::user()->name))
                  {{ Auth::user()->email }}
                  @endif
                  {{ Auth::user()->name }}

                  <small>Member since {{ Auth::user()->created_at->format('d M Y') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle">
        </div>
        <div class="pull-left info">
          <p>
            @if (empty(Auth::user()->name))
            {{ Auth::user()->email }}
            @endif
            {{ Auth::user()->name }}
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <li>
          <a href="{{ url('/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="header">Certificates</li>
        <li>
          <a href="{{ url('/list/create') }}"><i class="fa fa-plus text-green"></i><span> Add Certificate<span></a>
        </li>
        <li>
          <a href="{{ url('/list') }}"><i class="fa fa-circle-o text-aqua"></i><span> List all</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-aqua">{{ App\Certificate::where('user_id', Auth::user()->id)->count() }}</small>
            </span>
          </a>
        </li>
        <li>
          <a href="{{ url('/list/warning') }}"><i class="fa fa-circle-o text-yellow"></i><span> Warning</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">{{ App\Certificate::where('user_id', Auth::user()->id)->whereBetween('daysleft', [30, 90])->count() }}</small>
            </span>
          </a>
        </li>
        <li>
          <a href="{{ url('/list/danger') }}"><i class="fa fa-circle-o text-red"></i><span> Danger</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ App\Certificate::where('user_id', Auth::user()->id)->where('daysleft', '<', '30')->count() }}</small>
            </span>
          </a>
        </li>

        <!-- AdSense Sidebar
        <div class="adsense-sidebar">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <ins class="adsbygoogle"
               style="display:block"
               data-ad-client="ca-pub-2882078161937378"
               data-ad-slot="5151793841"
               data-ad-format="auto"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
        Adsense Sidebar -->
        
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  @yield('content')
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Certivel-2 -->
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-2882078161937378"
       data-ad-slot="5930523049"
       data-ad-format="auto"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://minibrary.com">Minibrary</a></strong> All rights reserved.
  </footer>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset("plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("bootstrap/js/bootstrap.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("plugins/fastclick/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/app.min.js") }}"></script>
<!-- Sparkline
<script src="{{ asset("plugins/sparkline/jquery.sparkline.min.js") }}"></script>
-->

<!-- jvectormap
<script src="{{ asset("plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}"></script>
<script src="{{ asset("plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}"></script>
-->

<!-- SlimScroll 1.3.0 -->
<script src="{{ asset("plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>


<!-- ChartJS 1.0.1
<script src="{{ asset("plugins/chartjs/Chart.min.js") }}"></script>
-->


<script src="{{ asset("dist/js/demo.js") }}"></script>

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-79008729-4', 'auto');
  ga('send', 'pageview');

</script>





@stack('js')
@stack('script')
</body>
</html>
