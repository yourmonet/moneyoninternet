<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dashboard Admin - {{ app_setting('app_name', 'MONET') }}</title>
<link rel="icon" type="image/png" href="{{ app_setting('favicon', 'https://cdn-1.yourmonet.web.id/images/monet.png') }}">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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

<main class="md:ml-64 pt-20 p-4 md:p-8 md:pt-20 min-h-screen">

    <header class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Dashboard Admin</h1>
            <p class="text-on-surface-variant font-body mt-1">Selamat datang, <span class="font-semibold text-primary">{{ Auth::user()->name }}</span> 👋</p>
        </div>
    </header>

    @if (session('error'))
        <div class="mb-6 p-4 bg-error-container rounded-xl border border-error/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-error">error</span>
            <p class="text-on-error-container text-sm">{{ session('error') }}</p>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 rounded-xl border border-green-200 flex items-center gap-2">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <p class="text-green-700 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Users Card --}}
        <div class="bg-primary text-on-primary rounded-3xl p-6 shadow-lg shadow-primary/30 relative overflow-hidden group hover:scale-[1.02] transition-transform duration-300">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-colors duration-500"></div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div>
                    <p class="text-on-primary/80 text-sm font-semibold uppercase tracking-wider mb-1">Total Akun Terdaftar</p>
                    <h3 class="text-4xl font-headline font-bold">{{ $totalUsers }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm shadow-inner">
                    <span class="material-symbols-outlined text-white">group</span>
                </div>
            </div>
        </div>

        {{-- Total Anggota Card --}}
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/30 hover:border-primary/30 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-on-surface-variant text-sm font-semibold uppercase tracking-wider mb-1">Akun Mahasiswa</p>
                    <h3 class="text-4xl font-headline font-bold text-on-surface">{{ $totalAnggota }}</h3>
                </div>
                <div class="w-12 h-12 bg-primary-container/40 text-primary rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined">school</span>
                </div>
            </div>
        </div>

        {{-- Total Pengurus Card --}}
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/30 hover:border-primary/30 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-on-surface-variant text-sm font-semibold uppercase tracking-wider mb-1">Akun Pengurus Organisasi</p>
                    <h3 class="text-4xl font-headline font-bold text-on-surface">{{ $totalPengurus }}</h3>
                </div>
                <div class="w-12 h-12 bg-secondary-container/60 text-on-secondary-container rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined">manage_accounts</span>
                </div>
            </div>
        </div>

        {{-- Total Bendahara Card --}}
        <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-outline-variant/30 hover:border-primary/30 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-on-surface-variant text-sm font-semibold uppercase tracking-wider mb-1">Akun Bendahara</p>
                    <h3 class="text-4xl font-headline font-bold text-on-surface">{{ $totalBendahara }}</h3>
                </div>
                <div class="w-12 h-12 bg-tertiary-container/40 text-tertiary rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Riwayat Pendaftaran List --}}
        <div class="lg:col-span-2 bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-headline font-bold text-on-surface">Riwayat Pendaftaran Akun</h3>
                <!-- <a href="{{ route('admin.akun.persetujuan') }}" class="text-primary font-bold text-sm hover:text-primary/80 transition-colors flex items-center gap-1 group">
                    Lihat Semua
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a> -->
            </div>
            <div class="space-y-3">
                @forelse ($riwayatPendaftaran as $riwayat)
                    <div class="flex items-center justify-between p-4 hover:bg-surface-container rounded-2xl transition-all duration-200 cursor-pointer border border-transparent hover:border-outline-variant/30">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-secondary-container/40 text-on-secondary-container flex items-center justify-center font-bold text-lg">
                                {{ strtoupper(substr($riwayat->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-on-surface text-base">{{ $riwayat->name }}</p>
                                <p class="text-sm text-on-surface-variant mt-0.5">{{ $riwayat->created_at->translatedFormat('d F Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-right flex flex-col items-end">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-surface-container-high text-on-surface-variant mb-1">
                                {{ strtoupper($riwayat->role) }}
                            </span>
                            @if ($riwayat->account_status === 'active')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">Aktif</span>
                            @elseif ($riwayat->account_status === 'waiting')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-800">Waiting</span>
                            @elseif ($riwayat->account_status === 'rejected')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-red-100 text-red-800">Ditolak</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-on-surface-variant">
                        <p>Belum ada riwayat pendaftaran.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="flex flex-col gap-6">
            <div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30">
                <h3 class="text-xl font-headline font-bold text-on-surface mb-6">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.bendahara.index') }}" class="flex flex-col items-center justify-center p-4 bg-primary text-white rounded-2xl hover:bg-primary/90 transition-all shadow-sm shadow-primary/20 group hover:-translate-y-1">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">manage_accounts</span>
                        </div>
                        <span class="font-bold text-xs text-center">Tambah<br>Bendahara</span>
                    </a>
                    <a href="{{ route('admin.pengurus.index') }}" class="flex flex-col items-center justify-center p-4 bg-secondary-fixed text-on-secondary-fixed-variant rounded-2xl hover:bg-secondary-fixed-dim transition-all shadow-sm group hover:-translate-y-1">
                        <div class="w-10 h-10 bg-black/5 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">supervisor_account</span>
                        </div>
                        <span class="font-bold text-xs text-center">Tambah<br>Pengurus</span>
                    </a>
                    <a href="{{ route('admin.anggota.index') }}" class="flex flex-col items-center justify-center p-4 bg-emerald-600 text-white rounded-2xl hover:bg-emerald-700 transition-all shadow-sm shadow-emerald-600/20 group hover:-translate-y-1">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">group</span>
                        </div>
                        <span class="font-bold text-xs text-center">Tambah<br>Mahasiswa</span>
                    </a>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="flex flex-col items-center justify-center p-4 bg-amber-500 text-white rounded-2xl hover:bg-amber-600 transition-all shadow-sm shadow-amber-500/20 group hover:-translate-y-1">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">school</span>
                        </div>
                        <span class="font-bold text-xs text-center">Edit Data<br>Mahasiswa</span>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-secondary-container to-secondary-fixed rounded-3xl p-8 shadow-sm border border-secondary-fixed/50 relative overflow-hidden flex-1 group">
                <div class="absolute -bottom-8 -right-8 w-40 h-40 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-colors duration-500"></div>
                <div class="relative z-10">
                    <h3 class="text-lg font-headline font-extrabold text-on-secondary-container mb-2">Butuh Bantuan?</h3>
                    <p class="text-sm text-on-secondary-container/80 mb-6 font-medium leading-relaxed">Pelajari cara mengelola sistem dan pengguna dengan lebih efektif menggunakan sistem {{ app_setting('app_name', 'MONET') }}.</p>
                    <a href="https://cdn-1.yourmonet.web.id/files/manual-book-monet.pdf" class="inline-flex items-center gap-2 bg-on-secondary-container text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-on-secondary-container/90 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-lg">menu_book</span>
                        Baca Panduan
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Logout Modal --}}
<div id="logout-modal" class="fixed inset-0 z-[100] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="hideLogoutModal()"></div>
    <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-2xl w-full max-w-sm relative z-10 transform scale-95 transition-transform duration-300">
        <div class="w-16 h-16 bg-error-container border-4 border-white shadow-sm rounded-full flex items-center justify-center text-error mb-4 mx-auto -mt-12">
            <span class="material-symbols-outlined text-3xl">logout</span>
        </div>
        <h2 class="text-2xl font-headline font-extrabold text-center text-on-surface mb-2">Keluar?</h2>
        <p class="text-center text-on-surface-variant text-sm mb-8">Anda harus login kembali untuk mengakses dashboard admin.</p>
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
    const modal = document.getElementById('logout-modal');
    const modalContent = modal.querySelector('div.bg-surface-container-lowest');

    function showLogoutModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function hideLogoutModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>

@include('components.loading')
</body>
</html>
