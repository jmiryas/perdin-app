<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route((string) $routeName) }}"
        style="background-color: {{ Route::current()->getName() == $routeName ? '#227093' : '' }};">
        <i class="bi bi-grid" style="color: {{ Route::current()->getName() == $routeName ? 'white' : '' }};"></i>
        <span style="color: {{ Route::current()->getName() == $routeName ? 'white' : '' }};">{{ $navItemName }}</span>
    </a>
</li>