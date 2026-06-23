<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Manajemen Pengurus - Admin - {{ app_setting('app_name', 'MONET') }}</title>
<link rel="icon" type="image/png" href="{{ app_setting('favicon', 'https://cdn-1.yourmonet.web.id/images/monet.png') }}">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "secondary": "#4c5d8d", "tertiary": "#7b2600", "outline-variant": "#c3c6d6",
                    "surface-container-low": "#f3f4f6", "outline": "#737685", "on-primary": "#ffffff",
                    "secondary-fixed": "#dae2ff", "inverse-surface": "#2e3132", "inverse-primary": "#b2c5ff",
                    "secondary-fixed-dim": "#b4c5fb", "on-secondary-fixed-variant": "#344573",
                    "on-secondary": "#ffffff", "error-container": "#ffdad6", "surface-variant": "#e1e2e4",
                    "surface-dim": "#d9dadc", "surface-container": "#edeef0", "surface-container-high": "#e7e8ea",
                    "on-secondary-fixed": "#021945", "on-surface-variant": "#434654", "background": "#f8f9fb",
                    "on-secondary-container": "#415382", "surface-tint": "#0c56d0", "inverse-on-surface": "#f0f1f3",
                    "surface-container-highest": "#e1e2e4", "surface-container-lowest": "#ffffff",
                    "on-primary-fixed-variant": "#0040a2", "secondary-container": "#b6c8fe", "on-primary-fixed": "#001848",
                    "on-primary-container": "#c4d2ff", "tertiary-container": "#a33500", "on-tertiary-container": "#ffc6b2",
                    "on-surface": "#191c1e", "on-error-container": "#93000a", "primary-container": "#0052cc",
                    "surface": "#f8f9fb", "on-background": "#191c1e", "primary": "#003d9b",
                    "primary-fixed": "#dae2ff", "error": "#ba1a1a"
                },
                borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.75rem", "full": "0.75rem" },
                fontFamily: { "headline": ["Manrope"], "body": ["Inter"], "label": ["Inter"] }
            },
        },
    }
</script>
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="bg-surface font-body text-on-surface">

<nav class="fixed top-0 w-full z-50 bg-gray-50/85 backdrop-blur-md shadow-sm flex justify-between items-center px-4 md:px-8 h-16 font-headline antialiased">
    <div class="flex items-center gap-4 md:gap-8">
        <button onclick="toggleSidebar()" class="md:hidden mr-2 text-on-surface hover:text-primary transition-colors flex items-center"><span class="material-symbols-outlined text-[28px]">menu</span></button>
        <img src="{{ app_setting('logo_light', 'https://cdn-1.yourmonet.web.id/images/monet2.png') }}" alt="{{ app_setting('app_name', 'MONET') }}" class="h-8 w-auto object-contain"/>
    </div>
    <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
            <div class="text-sm font-black text-blue-900 leading-tight">{{ Auth::user()->name }}</div>
            <div class="text-[10px] uppercase tracking-widest text-outline font-bold mt-0.5">Admin</div>
        </div>
        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-bold shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
</nav>

@include('components.sidebar-admin')

<main class="md:ml-64 p-4 pt-20 md:p-8 md:pt-20 min-h-screen">
    <header class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Manajemen Pengurus</h1>
            <p class="text-on-surface-variant font-body mt-1">Daftar pengurus dan pembuatan akun pengurus baru.</p>
        </div>
    </header>

    @if (session('error'))
        <div class="mb-6 p-4 bg-error-container rounded-xl border border-error/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-error">error</span>
            <p class="text-on-error-container text-sm">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="p-6 border-b border-outline-variant/30 flex flex-col sm:flex-row justify-between items-center gap-4 bg-surface-container-low/50">
            <h2 class="text-lg font-bold text-on-surface shrink-0">Daftar Pengurus</h2>
            
            <form action="{{ route('admin.pengurus.index') }}" method="GET" class="w-full sm:max-w-md relative flex-1 flex group">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">search</span>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari pengurus..." class="w-full pl-10 pr-12 py-2 text-sm rounded-xl border border-outline-variant bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 p-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded-lg transition-all flex items-center justify-center" title="Cari">
                    <span class="material-symbols-outlined text-[16px]">send</span>
                </button>
            </form>

            <button onclick="showAddModal()" class="w-full sm:w-auto bg-primary text-on-primary font-bold py-2 px-4 rounded-xl shadow-md hover:bg-primary/90 hover:shadow-lg transition-all flex items-center justify-center gap-2 text-sm shrink-0">
                <span class="material-symbols-outlined text-lg">person_add</span>
                Tambah Akun
            </button>
        </div>
        <div class="overflow-x-auto overflow-y-auto max-h-[520px]">
            <table class="w-full text-left border-collapse text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-outline-variant/30 text-on-surface-variant uppercase text-[11px] font-bold tracking-wider sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4">Profil</th>
                        <th class="px-6 py-4">Asal Departemen</th>
                        <th class="px-6 py-4">Peran</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse($pengurus as $p)
                        <tr class="hover:bg-surface-container/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($p->avatar)
                                        @php
                                            $av = $p->avatar;
                                            $avatarUrl = (str_starts_with($av, 'http://') || str_starts_with($av, 'https://')) ? $av : '/storage/' . $av;
                                        @endphp
                                        <img src="{{ $avatarUrl }}" alt="{{ $p->name }}" class="w-10 h-10 rounded-full object-cover shadow-sm shrink-0" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container font-bold text-lg shrink-0" style="display:none; align-items:center; justify-content:center;">
                                            {{ strtoupper(substr($p->name, 0, 1)) }}
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-lg shrink-0">
                                            {{ strtoupper(substr($p->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-on-surface">{{ $p->name }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $p->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-on-surface-variant font-medium">
                                    {{ $p->department ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                                    PENGURUS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <form id="delete-form-{{ $p->id }}" action="{{ route('admin.pengurus.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('delete-form-{{ $p->id }}')" class="p-2 rounded-xl text-error hover:bg-error-container/40 transition-colors tooltip-trigger" title="Hapus Akun">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-5xl mb-2 opacity-50">group_off</span>
                                <p>Belum ada pengurus aktif. Silakan tambahkan akun pengurus.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengurus->hasPages())
            <div class="p-4 border-t border-outline-variant/30 bg-surface-container-lowest">
                {{ $pengurus->links() }}
            </div>
        @endif
    </div>
</main>

{{-- Add Modal --}}
<div id="add-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="hideAddModal()"></div>
    <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-2xl w-full max-w-lg relative z-10 transform scale-95 transition-transform duration-300 mx-4">
        <h2 class="text-2xl font-headline font-extrabold text-on-surface mb-6">Tambah Akun Pengurus</h2>
        
        <form action="{{ route('admin.pengurus.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-on-surface-variant mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" required class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-on-surface-variant mb-1">Alamat Email</label>
                <input type="email" name="email" id="email" required class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div>
                <label for="department" class="block text-sm font-medium text-on-surface-variant mb-1">Asal Departemen/Badan/Komisi</label>
                <input type="text" name="department" id="department" required placeholder="Contoh: Departemen Media & Komunikasi" class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="password" class="block text-sm font-medium text-on-surface-variant mb-1">Password</label>
                    <input type="password" name="password" id="password" required minlength="8" class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-on-surface-variant mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8" class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>
            <div class="flex gap-3 mt-8">
                <button type="button" onclick="hideAddModal()" class="flex-1 py-3 px-4 rounded-xl border border-outline-variant/30 text-on-surface-variant font-bold text-sm hover:bg-surface-container transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-primary text-on-primary font-bold py-3 px-4 rounded-xl shadow-md hover:bg-primary/90 hover:shadow-lg transition-all flex items-center justify-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Simpan Akun
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Logout Modal --}}
<div id="logout-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="hideLogoutModal()"></div>
    <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-2xl w-full max-w-sm relative z-10 transform scale-95 transition-transform duration-300">
        <div class="w-16 h-16 bg-error-container border-4 border-white shadow-sm rounded-full flex items-center justify-center text-error mb-4 mx-auto -mt-12">
            <span class="material-symbols-outlined text-3xl">logout</span>
        </div>
        <h2 class="text-2xl font-headline font-extrabold text-center text-on-surface mb-2">Keluar?</h2>
        <p class="text-center text-on-surface-variant text-sm mb-8">Anda harus login kembali untuk mengakses dashboard.</p>
        <div class="flex gap-3">
            <button onclick="hideLogoutModal()" class="flex-1 py-3 px-4 rounded-xl border border-outline-variant/30 text-on-surface-variant font-bold text-sm hover:bg-surface-container transition-colors">
                Batal
            </button>
            <button onclick="document.getElementById('logout-form').submit()" class="flex-1 py-3 px-4 rounded-xl bg-error text-white font-bold text-sm hover:bg-error/90 shadow-lg shadow-error/20 transition-all">
                Ya, Keluar
            </button>
        </div>
    </div>
</div>

<script>
    const logoutModal = document.getElementById('logout-modal');
    const logoutModalContent = logoutModal.querySelector('div.bg-surface-container-lowest');

    function showLogoutModal() {
        logoutModal.classList.remove('hidden');
        setTimeout(() => {
            logoutModal.classList.remove('opacity-0');
            logoutModalContent.classList.remove('scale-95');
            logoutModalContent.classList.add('scale-100');
        }, 10);
    }

    function hideLogoutModal() {
        logoutModal.classList.add('opacity-0');
        logoutModalContent.classList.remove('scale-100');
        logoutModalContent.classList.add('scale-95');
        setTimeout(() => {
            logoutModal.classList.add('hidden');
        }, 300);
    }

    const addModal = document.getElementById('add-modal');
    const addModalContent = addModal.querySelector('div.bg-surface-container-lowest');

    function showAddModal() {
        addModal.classList.remove('hidden');
        setTimeout(() => {
            addModal.classList.remove('opacity-0');
            addModalContent.classList.remove('scale-95');
            addModalContent.classList.add('scale-100');
        }, 10);
    }

    function hideAddModal() {
        addModal.classList.add('opacity-0');
        addModalContent.classList.remove('scale-100');
        addModalContent.classList.add('scale-95');
        setTimeout(() => {
            addModal.classList.add('hidden');
        }, 300);
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#003d9b',
            confirmButtonText: 'Tutup'
        });
    @endif

    function confirmDelete(formId) {
        Swal.fire({
            title: 'Hapus Akun?',
            text: "Tindakan ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ba1a1a',
            cancelButtonColor: '#737685',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>

@include('components.loading')
</body>
</html>
