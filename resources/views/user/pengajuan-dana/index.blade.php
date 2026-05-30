<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Pengajuan Dana — MONET</title>
<link rel="icon" type="image/png" href="https://cdn-1.yourmonet.web.id/images/monet.png">
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

<nav class="fixed top-0 w-full z-50 bg-gray-50/85 backdrop-blur-md shadow-sm flex justify-between items-center px-8 h-16 font-headline antialiased">
    <div class="flex items-center gap-8">
        <img src="https://cdn-1.yourmonet.web.id/images/monet2.png" alt="MONET" class="h-8 w-auto object-contain"/>
    </div>
    <div class="flex items-center gap-3">
        <div class="text-right hidden sm:block">
            <div class="text-sm font-black text-blue-900 leading-tight">{{ Auth::user()->name }}</div>
            <div class="text-[10px] uppercase tracking-widest text-outline font-bold mt-0.5">Anggota</div>
        </div>
        @if(Auth::user()->avatar)
            @php
                $av = Auth::user()->avatar;
                $avatarUrl = (str_starts_with($av, 'http://') || str_starts_with($av, 'https://')) ? $av : '/storage/' . $av;
            @endphp
            <img src="{{ $avatarUrl }}" class="w-10 h-10 rounded-full object-cover shadow-sm" alt="Profile" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="w-10 h-10 rounded-full object-cover shadow-sm bg-surface-container-high border border-outline-variant/30 text-on-surface-variant font-bold" style="display:none; align-items:center; justify-content:center;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @else
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-bold shadow-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
    </div>
</nav>

{{-- Sidebar --}}
<aside class="h-screen w-64 fixed left-0 top-0 bg-gray-100 flex flex-col p-4 pt-20 z-40">
    <nav class="flex flex-col gap-1 flex-1">
        <a class="flex items-center gap-3 px-4 py-3 {{ Request::routeIs('user.dashboard') ? 'bg-white text-blue-700' : 'text-on-surface hover:bg-surface-container' }} rounded-lg scale-95 transition-all font-headline font-medium text-sm" href="{{ route('user.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span> Dashboard
        </a>
        <a class="flex items-center gap-3 px-4 py-3 {{ Request::routeIs('user.pengajuan-dana.*') ? 'bg-white text-blue-700 rounded-lg scale-95 shadow-sm' : 'text-on-surface hover:bg-surface-container' }} transition-all font-headline font-medium text-sm" href="{{ route('user.pengajuan-dana.index') }}">
            <span class="material-symbols-outlined">volunteer_activism</span> Pengajuan Dana
        </a>
    </nav>

    <div class="mt-auto flex flex-col gap-1 border-t border-outline-variant/10 pt-4">
        <form id="logout-form" method="POST" action="/user/logout">
            @csrf
            <button type="button" onclick="showLogoutModal()" id="btn-logout-anggota"
                class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container/20 transition-all font-headline font-medium text-sm">
                <span class="material-symbols-outlined">logout</span> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- Main Content --}}
<main class="ml-64 pt-20 p-8 min-h-screen">
    <header class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-10">
        <div>
            <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Pengajuan Dana & Bantuan</h1>
            <p class="text-on-surface-variant font-body mt-1">Ajukan permohonan dana sosial atau kebutuhan mendesak Anda secara transparan.</p>
        </div>
        <div>
            <a href="{{ route('user.pengajuan-dana.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-2xl text-sm font-bold hover:bg-primary/95 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                Ajukan Permohonan Baru
            </a>
        </div>
    </header>

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="mb-8 p-4 bg-green-50 text-green-800 rounded-2xl border border-green-200 flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- History list --}}
    <div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-headline font-bold text-on-surface">Riwayat Pengajuan Anda</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-outline-variant/30 text-outline text-xs uppercase tracking-wider font-bold">
                        <th class="py-4 px-4">Tanggal Pengajuan</th>
                        <th class="py-4 px-4">Jenis Pengajuan</th>
                        <th class="py-4 px-4 text-right">Jumlah Dana</th>
                        <th class="py-4 px-4 text-center">Status</th>
                        <th class="py-4 px-4">Keterangan</th>
                        <th class="py-4 px-4 text-center">Dokumen</th>
                        <th class="py-4 px-4">Catatan Pengurus</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse ($pengajuans as $item)
                        <tr class="hover:bg-surface-container/30 transition-colors text-sm">
                            <td class="py-4 px-4 font-medium whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-surface-container rounded-full text-xs font-semibold text-on-surface-variant">
                                    {{ $item->jenis_pengajuan }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right font-bold text-on-surface">
                                Rp {{ number_format($item->jumlah_dana, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if ($item->status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                @elseif ($item->status === 'disetujui')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                        Disetujui
                                    </span>
                                @elseif ($item->status === 'ditolak')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 max-w-xs truncate" title="{{ $item->keterangan }}">
                                {{ $item->keterangan }}
                            </td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                @if ($item->file_pendukung)
                                    <a href="{{ asset('storage/' . $item->file_pendukung) }}" target="_blank" class="inline-flex items-center gap-1 text-primary hover:underline font-bold text-xs">
                                        <span class="material-symbols-outlined text-sm">download</span> Lihat
                                    </a>
                                @else
                                    <span class="text-outline text-xs">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-on-surface-variant italic">
                                {{ $item->catatan_pengurus ?: 'Belum ada catatan.' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-outline">
                                <span class="material-symbols-outlined text-4xl mb-2 text-outline/50 block">volunteer_activism</span>
                                Belum ada riwayat pengajuan dana atau bantuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $pengajuans->links() }}
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
</body>
</html>
