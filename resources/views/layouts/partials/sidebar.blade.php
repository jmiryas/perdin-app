<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    @component("components.nav-item")
    @slot("routeName")
    dashboard.index
    @endslot

    @slot("navItemName")
    Dashboard
    @endslot
    @endcomponent

    @role("admin")
    <li class="nav-heading">Master Data</li>

    @component("components.nav-item")
    @slot("routeName")
    admin.countries.index
    @endslot

    @slot("navItemName")
    Daftar Negara
    @endslot
    @endcomponent

    @component("components.nav-item")
    @slot("routeName")
    admin.islands.index
    @endslot

    @slot("navItemName")
    Daftar Pulau
    @endslot
    @endcomponent

    @component("components.nav-item")
    @slot("routeName")
    admin.provinces.index
    @endslot

    @slot("navItemName")
    Daftar Provinsi
    @endslot
    @endcomponent

    @component("components.nav-item")
    @slot("routeName")
    admin.cities.index
    @endslot

    @slot("navItemName")
    Daftar Kota/Kabupaten
    @endslot
    @endcomponent

    @component("components.nav-item")
    @slot("routeName")
    admin.roles.index
    @endslot

    @slot("navItemName")
    Daftar Role
    @endslot
    @endcomponent

    @component("components.nav-item")
    @slot("routeName")
    admin.users.index
    @endslot

    @slot("navItemName")
    Daftar Pengguna
    @endslot
    @endcomponent

    <li class="nav-heading">Perjalanan Dinas</li>

    @component("components.nav-item")
    @slot("routeName")
    admin.travels.index
    @endslot

    @slot("navItemName")
    Daftar Perdin
    @endslot
    @endcomponent
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

    @component("components.nav-item")
    @slot("routeName")
    travels.index
    @endslot

    @slot("navItemName")
    PerdinKu
    @endslot
    @endcomponent
    @endrole()

  </ul>

</aside>