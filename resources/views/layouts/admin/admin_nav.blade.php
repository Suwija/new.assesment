<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('home') }}">
            <span class="align-middle">Assessment System</span>
        </a>
        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="/img/profile-default.svg"
                    class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title ">
                        {{ Auth::user()->name }}
                    </a>
                    @if(Auth::user()->is_admin==1)
                    <div class="sidebar-user-subtitle">Administrator</div>
                    @else
                    <div class="sidebar-user-subtitle">Assessor</div>
                    @endif
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-item @if (url()->current() == route('home')) active @endif">
                <a class="sidebar-link" href="{{ route('home') }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
                </a>
            </li>
            <li class="sidebar-item @if (url()->current() == route('summary')) active @endif">
                <a class="sidebar-link" href="{{ route('summary') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Summary</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Bantuan</strong>
                <div class="mb-3 text-sm">
                    Mengalami masalah ?
                </div>
                <a href="#" target="_blank" class="btn btn-outline-primary btn-block">Hubungi Kami</a>
            </div>
        </div>
    </div>
</nav>
