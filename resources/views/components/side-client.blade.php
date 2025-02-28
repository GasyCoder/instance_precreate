<!-- Menu -->
<aside id="layout-menu" class="flex-grow-0 layout-menu-horizontal menu-horizontal menu bg-menu-theme">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item @if(request()->routeIs('espaceClient')) active @endif">
                <a href="{{ route('espaceClient') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Accueil">Accueil</div>
                </a>
            </li>
            <!-- Apps -->
        </ul>
    </div>
</aside>
<!-- / Menu -->
