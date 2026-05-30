<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Daftar Pengajuan Dana — MONET</title>
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
            <div class="text-[10px] uppercase tracking-widest text-outline font-bold mt-0.5">Pengurus</div>
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

{{-- Sidebar component --}}
@include('components.sidebar-pengurus')

{{-- Main Content --}}
<main class="ml-64 pt-20 p-8 min-h-screen">
    <header class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Daftar Pengajuan Dana</h1>
            <p class="text-on-surface-variant font-body mt-1">Daftar permohonan dana dan bantuan sosial dari anggota organisasi.</p>
        </div>
    </header>

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="mb-8 p-4 bg-green-50 text-green-800 rounded-2xl border border-green-200 flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Filter bar --}}
    <div class="bg-surface-container-lowest rounded-3xl p-6 mb-8 border border-outline-variant/30 shadow-sm flex flex-col md:flex-row md:items-center gap-4 justify-between">
        <form method="GET" action="{{ route('pengurus.pengajuan-dana.index') }}" class="flex flex-col sm:flex-row gap-3 w-full">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-outline-variant pointer-events-none">
                    <span class="material-symbols-outlined text-base">search</span>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama anggota atau jenis..."
                    class="w-full pl-10 pr-4 rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary shadow-sm bg-surface-container-lowest text-sm text-on-surface">
            </div>

            <div class="w-full sm:w-48">
                <select name="status" onchange="this.form.submit()"
                    class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary shadow-sm bg-surface-container-lowest text-sm text-on-surface">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <button type="submit" class="bg-primary text-on-primary px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-primary/95 transition-all shadow-sm">
                Filter
            </button>
            
            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('pengurus.pengajuan-dana.index') }}" class="inline-flex items-center justify-center border border-outline-variant/30 text-on-surface-variant px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-surface-container transition-colors">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Submissions list --}}
    <div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-outline-variant/30 text-outline text-xs uppercase tracking-wider font-bold">
                        <th class="py-4 px-4">Nama Anggota</th>
                        <th class="py-4 px-4">Tanggal Pengajuan</th>
                        <th class="py-4 px-4">Jenis Pengajuan</th>
                        <th class="py-4 px-4 text-right">Jumlah Dana</th>
                        <th class="py-4 px-4 text-center">Status</th>
                        <th class="py-4 px-4">Keterangan</th>
                        <th class="py-4 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @forelse ($pengajuans as $item)
                        <tr class="hover:bg-surface-container/30 transition-colors text-sm">
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="font-bold text-on-surface">{{ $item->user->name }}</div>
                                <div class="text-xs text-outline">{{ $item->user->email }}</div>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }}
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-surface-container rounded-full text-xs font-semibold text-on-surface-variant">
                                    {{ $item->jenis_pengajuan }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right font-extrabold text-on-surface">
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
                                <a href="{{ route('pengurus.pengajuan-dana.show', $item->id) }}" class="inline-flex items-center gap-1 bg-primary-container/20 text-primary hover:bg-primary-container/40 px-4 py-2 rounded-xl text-xs font-bold transition-all">
                                    <span class="material-symbols-outlined text-xs">visibility</span>
                                    Detail / Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-outline">
                                <span class="material-symbols-outlined text-4xl mb-2 text-outline/50 block">volunteer_activism</span>
                                Tidak ada pengajuan dana atau bantuan yang ditemukan.
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
