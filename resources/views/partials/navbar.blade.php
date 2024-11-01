<!-- resources/views/partials/navbar.blade.php -->
<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
    <div class="avatar avatar-online">
        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
    </div>
</a>
<ul class="dropdown-menu dropdown-menu-end">
    <li>
        <a class="dropdown-item" href="#">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </div>
                <div class="flex-grow-1">
                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                    <small class="text-muted"> {{ Auth::user()->getRoleNames()->first() }}
                    </small>
                </div>
            </div>
        </a>
    </li>
    <li>
        <div class="dropdown-divider"></div>
    </li>
    <li>
        <a href="{{ route('logout') }}" class="dropdown-item preview-item"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="row">
                <div class="col">
                    <i class="bx bx-power-off me-2"></i>
                </div>
                <div class="col" style="margin-left: -120px">
                    <span class="fw-semibold d-block">Logout</span>
                </div>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
