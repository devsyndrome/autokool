<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Autokool</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">AK</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
              <li><a class="nav-link" href="{{ url('user') }}">User</a></li>
            </ul>
          </li>
          <li class="menu-header">Estimator - SA</li>
          <li ><a class="nav-link" href="{{ url('estimasi') }}"><i class="far fa-square"></i> <span>Estimasi</span></a></li>
          <li class="menu-header">Logistik</li>
          <li ><a class="nav-link" href="{{ url('logistik') }}"><i class="far fa-square"></i> <span>Logistik</span></a></li>
          <li class="menu-header">Penawaran - SA</li>
          <li><a class="nav-link" href="{{ url('penawaran') }}"><i class="fas fa-pencil-ruler"></i> <span>Penawaran</span></a></li>
          <li><a class="nav-link" href="{{ url('spk-asuransi') }}"><i class="fas fa-pencil-ruler"></i> <span>Check SPK Asuransi</span></a></li>
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div> --}}
    </aside>
  </div>