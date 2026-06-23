<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden transition-opacity opacity-0" onclick="toggleSidebar()"></div>

<aside id="mobile-sidebar" class="h-screen w-64 fixed left-0 top-0 bg-gray-100 flex flex-col p-4 pt-20 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300">
    <nav class="flex flex-col gap-1 flex-1">
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span> Dashboard
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.akun.persetujuan') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.akun.persetujuan') }}">
            <span class="material-symbols-outlined">fact_check</span> Persetujuan Akun
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.mahasiswa.index') }}">
            <span class="material-symbols-outlined">school</span> Data Mahasiswa
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.bendahara.*') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.bendahara.index') }}">
            <span class="material-symbols-outlined">manage_accounts</span> Manajemen Bendahara
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.pengurus.*') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.pengurus.index') }}">
            <span class="material-symbols-outlined">supervisor_account</span> Manajemen Pengurus
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.anggota.*') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.anggota.index') }}">
            <span class="material-symbols-outlined">group</span> Manajemen Mahasiswa
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.settings.*') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }} transition-all font-headline font-medium text-sm" href="{{ route('admin.settings.index') }}">
            <span class="material-symbols-outlined">settings</span> Pengaturan Web
        </a>
    </nav>

    <div class="mt-auto flex flex-col gap-1 border-t border-outline-variant/10 pt-4">
        <form id="logout-form" method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="button" onclick="showLogoutModal()" id="btn-logout-admin"
                class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container/20 transition-all font-headline font-medium text-sm">
                <span class="material-symbols-outlined">logout</span> Keluar
            </button>
        </form>
    </div>
</aside>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mobile-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }
    }
</script>
