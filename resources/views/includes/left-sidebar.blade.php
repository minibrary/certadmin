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
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="{{ url('/dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    <li class="header">Certificates</li>
    <li>
      <a href="{{ url('/list') }}"><i class="fa fa-circle-o text-aqua"></i> List all
        <span class="pull-right-container">
          <small class="label pull-right bg-aqua">{{ App\Certificate::count() }}</small>
        </span>
      </a>
    </li>
    <li>
      <a href="{{ url('/list/warning') }}"><i class="fa fa-circle-o text-yellow"></i> Warning
        <span class="pull-right-container">
          <small class="label pull-right bg-yellow">{{ App\Certificate::whereBetween('daysleft', [30, 90])->count() }}</small>
        </span>
      </a>
    </li>
    <li>
      <a href="{{ url('/list/danger') }}"><i class="fa fa-circle-o text-red"></i> Danger
        <span class="pull-right-container">
          <small class="label pull-right bg-red">{{ App\Certificate::where('daysleft', '<', '30')->count() }}</small>
        </span>
      </a>
    </li>
  </ul>
</section>
<!-- /.sidebar -->
