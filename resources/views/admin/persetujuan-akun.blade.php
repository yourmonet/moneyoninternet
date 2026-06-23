<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Persetujuan Akun - Admin - {{ app_setting('app_name', 'MONET') }}</title>
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
            <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Persetujuan Akun</h1>
            <p class="text-on-surface-variant font-body mt-1">Kelola permohonan registrasi untuk Pengurus dan Anggota (Mahasiswa).</p>
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

    <div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30 flex flex-col min-h-[500px]">
        <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center bg-surface-container-low/50">
            <h2 class="text-lg font-bold text-on-surface">Daftar Akun Menunggu Persetujuan</h2>
            <span class="bg-secondary-container text-on-secondary-container text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                {{ $waitingAccounts->count() }} Menunggu
            </span>
        </div>
        
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-outline-variant/30 text-on-surface-variant uppercase text-[11px] font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Profil Akun</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Tanggal Daftar</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse($waitingAccounts as $user)
                    <tr class="hover:bg-surface-container/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-lg">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">{{ $user->name }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role === 'pengurus')
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-100 text-purple-800 border border-purple-200">
                                    PENGURUS
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-100 text-blue-800 border border-blue-200">
                                    MAHASISWA
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-on-surface-variant">
                            {{ $user->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.akun.approve', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-xl text-green-600 hover:bg-green-50 transition-colors tooltip-trigger" title="Setujui">
                                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.akun.reject', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-xl text-error hover:bg-error-container/40 transition-colors tooltip-trigger" title="Tolak">
                                        <span class="material-symbols-outlined text-[20px]">cancel</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-5xl mb-2 opacity-50">task</span>
                            <p>Tidak ada permohonan pendaftaran akun saat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
