<nav x-data="{ open: false }" class="nav-editorial">
    <div class="container-xl px-4 px-md-5">
        <div class="d-flex justify-content-between align-items-center" style="height: 64px;">
            <div class="d-flex align-items-center gap-5">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <span class="font-serif" style="font-size: 1.25rem; font-style: italic; color: var(--charcoal);">ID Holder</span>
                </a>

                <div class="d-none d-md-flex align-items-center gap-5">
                    <a href="{{ route('dashboard') }}" class="nav-link-editorial {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                </div>
            </div>

            <div class="d-none d-md-flex align-items-center">
                <div class="dropdown dropdown-editorial">
                    <button class="btn btn-link text-decoration-none editorial-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                        <svg class="ms-2" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"/></svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-md-none">
                <button @click="open = ! open" class="btn btn-link p-2" style="color: var(--muted);">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak style="border-top: 1px solid var(--border);" class="d-md-none">
        <div class="py-2 px-4">
            <a href="{{ route('dashboard') }}" class="nav-link-editorial d-block py-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </div>

        <div style="border-top: 1px solid var(--border);" class="py-3 px-4">
            <div class="mb-2" style="font-size: 0.875rem; font-weight: 500;">{{ Auth::user()->name }}</div>
            <div class="editorial-text mb-3">{{ Auth::user()->email }}</div>

            <a href="{{ route('profile.edit') }}" class="nav-link-editorial d-block py-2">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link-editorial d-block py-2 border-0 bg-transparent p-0">Log Out</button>
            </form>
        </div>
    </div>
</nav>