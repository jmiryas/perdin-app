<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard.index') }}" style="background-color: {{ Route::current()->getName() == 'dashboard.index' ? '#227093' : '' }};">
          <i class="bi bi-grid" style="color: {{ Route::current()->getName() == 'dashboard.index' ? 'white' : '' }};"></i>
          <span style="color: {{ Route::current()->getName() == 'dashboard.index' ? 'white' : '' }};">Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @role("admin")
      <li class="nav-heading">Master Data</li>

      @can("read countries")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('countries.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Negara</span>
        </a>
      </li>
      @endcan

      @can("read islands")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('islands.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Pulau</span>
        </a>
      </li>
      @endcan

      @can("read provinces")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('provinces.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Provinsi</span>
        </a>
      </li>
      @endcan

      @can("read cities")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('cities.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Kota/Kabupaten</span>
        </a>
      </li>
      @endcan

      @can("read users")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('users.index') }}">
          <i class="bi bi-grid"></i>
          <span>Pengguna</span>
        </a>
      </li>
      @endcan
      @endrole

      <li class="nav-heading">Perjalanan Dinas</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('travels.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Perdin</span>
        </a>
      </li>

    </ul>

  </aside>