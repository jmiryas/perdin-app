<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dashboard.index') }}"
        style="background-color: {{ Route::current()->getName() == 'dashboard.index' ? '#227093' : '' }};">
        <i class="bi bi-grid" style="color: {{ Route::current()->getName() == 'dashboard.index' ? 'white' : '' }};"></i>
        <span style="color: {{ Route::current()->getName() == 'dashboard.index' ? 'white' : '' }};">Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @role("admin")
    <li class="nav-heading">Master Data</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.countries.index') }}">
        <i class="bi bi-grid"></i>
        <span>Daftar Negara</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.islands.index') }}">
        <i class="bi bi-grid"></i>
        <span>Daftar Pulau</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.provinces.index') }}">
        <i class="bi bi-grid"></i>
        <span>Daftar Provinsi</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.cities.index') }}">
        <i class="bi bi-grid"></i>
        <span>Daftar Kota/Kabupaten</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.roles.index') }}">
        <i class="bi bi-grid"></i>
        <span>Daftar Role</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.users.index') }}">
        <i class="bi bi-grid"></i>
        <span>Pengguna</span>
      </a>
    </li>

    <li class="nav-heading">Perjalanan Dinas</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.travels.index') }}">
        <i class="bi bi-grid"></i>
        <span>Daftar Perdin</span>
      </a>
    </li>
    @endrole

    @role("sdm")
    <li class="nav-heading">Perjalanan Dinas</li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Pengajuan Perdin</span><i
          class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('sdm.travels.index') }}">
            <i class="bi bi-circle"></i><span>Pengajuan Baru</span>
          </a>
        </li>
        <li>
          <a href="{{ route('sdm.travels.histories') }}">
            <i class="bi bi-circle"></i><span>Riwayat Pengajuan</span>
          </a>
        </li>
      </ul>
    </li>
    @endrole

    @role("pegawai")
    <li class="nav-heading">Perjalanan Dinas</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('travels.index') }}">
        <i class="bi bi-grid"></i>
        <span>PerdinKu</span>
      </a>
    </li>
    @endrole()

  </ul>

</aside>