<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('assets/img/icons/logo-bartech.png') }}"
                style="display: block; max-width: 100%; margin: auto; z-index: 10" alt="">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MAIN</span>
        </li>
        <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('slider.index') ? 'active' : '' }}">
            <a href="{{ route('slider.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-slideshow'></i>
                <div data-i18n="Analytics">Slider</div>
            </a>
        </li>
        <li
            class="menu-item {{ request()->routeIs('training.index') || request()->routeIs('sertifikat.index') || request()->routeIs('training.edit') || request()->routeIs('training.show') || request()->routeIs('sertifikat.show') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-data'></i>
                <div data-i18n="Account Settings">Data Pelatihan</div>
            </a>
            <ul
                class="menu-sub {{ request()->routeIs('training.index') || request()->routeIs('sertifikat.index') || request()->routeIs('training.edit') || request()->routeIs('training.show') | request()->routeIs('sertifikat.show') ? 'show' : '' }}">
                <li class="menu-item {{ request()->routeIs('training.index') || request()->routeIs('training.edit') || request()->routeIs('training.show') ? 'active' : '' }}">
                    <a href="{{ route('training.index') }}" class="menu-link">
                        <div data-i18n="Account">Daftar Pelatihan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('sertifikat.index') | request()->routeIs('sertifikat.show') ? 'active' : '' }}">
                    <a href="{{ route('sertifikat.index') }}" class="menu-link">
                        <div data-i18n="Account">Daftar Peserta</div>
                    </a>
                </li>
            </ul>
        </li>

        @if (auth()->user()->can('sertifikat-list') && auth()->user()->can('training-list'))
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">( Super Admin Only )</span>
            </li>
            {{-- 2 untuk Super Admin --}}
            <li
                class="menu-item {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'active open' : '' }} ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div data-i18n="Account Settings">Access Control List</div>
                </a>
                <ul
                    class="menu-sub {{ request()->routeIs('users.index') || request()->routeIs('roles.index') ? 'show' : '' }}">
                    <li class="menu-item {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <div data-i18n="Account">Role & Permission</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class="menu-link">
                            <div data-i18n="Account">User</div>
                        </a>
                    </li>


                </ul>
            </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
