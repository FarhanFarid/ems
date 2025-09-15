<!-- Sidebar (keep this file self-contained) -->
<div id="sidebar" style="position:fixed; top:0; left:0; height:100vh; width:240px; background-color:#FC9FB1; padding-top:60px; transition:left 0.25s ease; z-index:1102;">
    <a class="menu-link {{ request()->routeIs('apps.index') ? 'active' : '' }}" href="{{ route('apps.index') }}" style="display:block; color:#2e8005; padding:12px 20px; text-decoration:none; font-weight:500; font-size:13px;">
        <i class="bi bi-house" style="font-size:13px; color:#2e8005;"></i>
        <span>Dashboard</span>
    </a>
    {{-- <a href="#" style="display:block; color:#2e8005; padding:12px 20px; text-decoration:none; font-weight:500; font-size:13px;">
        <i class="bi bi-people" style="font-size:13px; color:#2e8005;"></i> <span>Users</span>
    </a>
    <a href="#" style="display:block; color:#2e8005; padding:12px 20px; text-decoration:none; font-weight:500; font-size:13px;">
        <i class="bi bi-gear" style="font-size:13px; color:#2e8005;"></i> <span>Settings</span>
    </a> --}}
</div>

<!-- Toggle Button (separate so it's always visible) -->
<div id="sidebar-toggle" style="position:fixed; top:15px; left:195px; width:35px; height:35px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 2px 6px rgba(0,0,0,0.18); transition:left 0.25s ease; z-index:1103; background:#FCBACB; color:#2e8005;">
    <i class="bi bi-list" style="font-size:13px; color:#2e8005;"></i>
</div>
