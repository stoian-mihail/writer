<div class="row justify-content-center mt-1">
    <ul class="nav nav-tabs row justify-content-center">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('settings-about') ? 'active' : '' }}"
                href="{{ route('settings-about') }}">Despre noi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('settings-terms') ? 'active' : '' }}"
                href="{{ route('settings-terms') }}">Termeni si conditii</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('settings-confidentiality') ? 'active' : '' }}"
                href="{{ route('settings-confidentiality') }}">Confidentialitate</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('settings-contact') ? 'active' : '' }}"
                href="{{ route('settings-contact') }}">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('change-password-view') ? 'active' : '' }}"
                href="{{ route('change-password-view') }}">Schimbare parola</a>
        </li>
    </ul>
</div>
