<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <img src="{{asset('assets/img/logo.jpg')}}" width="150" height="40" class="shadow-light rounded-square">
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="">AK</a>
      </div>
      
      <ul class="sidebar-menu">
          <li class="menu-header">Admin</li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
              @if ($menu->user === 1)
                <li><a class="nav-link" href="{{ url('user') }}">User</a></li>    
              @endif
            </ul>
          </li>
          @if ($menu->estimasi === 1 OR $menu->spk === 1)
          <li class="menu-header">Estimator</li>
          @endif
          @if ($menu->estimasi === 1)
          <li ><a class="nav-link" href="{{ url('estimasi') }}"><i class="far fa-circle"></i> <span>Estimasi</span></a></li>
          @endif
          @if ($menu->spk === 1)
          <li><a class="nav-link" href="{{ url('asuransi') }}"><i class="far fa-circle"></i> <span>SPK Asuransi</span></a></li>
          @endif
          @if ($menu->spk === 1)
          <li class="menu-header">Logistik</li>
          <li ><a class="nav-link" href="{{ url('logistik') }}"><i class="far fa-circle"></i> <span>HPP & Mark Up</span></a></li>
          @endif
          @if ($menu->penawaran === 1)
          <li class="menu-header">Service Advisor</li>
          <li><a class="nav-link" href="{{ url('penawaran') }}"><i class="far fa-circle"></i> <span>Penawaran</span></a></li>
          @endif
          @if ($menu->penawaranhpp === 1 OR $menu->spkhpp === 1)
          <li class="menu-header">Controll Admin</li>
          @endif
          @if ($menu->penawaranhpp === 1)
          <li><a class="nav-link" href="{{ url('penawaran-hpp') }}"><i class="far fa-circle"></i> <span>Penawaran vs HPP</span></a></li>
          @endif
          @if ($menu->spkhpp === 1)
          <li><a class="nav-link" href="{{ url('spk-hpp') }}"><i class="far fa-circle"></i> <span>SPK vs HPP</span></a></li>
          @endif
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div> --}}
    </aside>
  </div>