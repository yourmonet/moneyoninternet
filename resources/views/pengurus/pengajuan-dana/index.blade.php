<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<<<<<<< HEAD
<title>Daftar Pengajuan Dana — MONET</title>
<link rel="icon" type="image/png" href="https://cdn-1.yourmonet.web.id/images/monet.png">
=======
<title>Pengajuan Dana - Pengurus | MONET</title>
>>>>>>> fitur-status-final
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
<<<<<<< HEAD
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
=======
                    "primary": "#003d9b", "on-surface": "#191c1e", "surface": "#f8f9fb", "outline-variant": "#c3c6d6",
                    "surface-container-lowest": "#ffffff", "surface-container": "#edeef0", "error": "#ba1a1a",
                    "error-container": "#ffdad6", "on-error-container": "#93000a", "surface-container-high": "#e7e8ea",
                    "success": "#198754", "success-container": "#d1e7dd", "on-success-container": "#0f5132",
                },
                fontFamily: { "headline": ["Manrope"], "body": ["Inter"] }
>>>>>>> fitur-status-final
            },
        },
    }
</script>
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="bg-surface font-body text-on-surface">

<<<<<<< HEAD
<nav class="fixed top-0 w-full z-50 bg-gray-50/85 backdrop-blur-md shadow-sm flex justify-between items-center px-8 h-16 font-headline antialiased">
=======
<nav class="fixed top-0 w-full z-50 bg-gray-50/85 backdrop-blur-md shadow-sm flex justify-between items-center px-8 h-16 font-headline antialiased border-b border-outline-variant/30">
>>>>>>> fitur-status-final
    <div class="flex items-center gap-8">
        <img src="https://cdn-1.yourmonet.web.id/images/monet2.png" alt="MONET" class="h-8 w-auto object-contain"/>
    </div>
    <div class="flex items-center gap-3">
<<<<<<< HEAD
        <div class="text-right hidden sm:block">
            <div class="text-sm font-black text-blue-900 leading-tight">{{ Auth::user()->name }}</div>
            <div class="text-[10px] uppercase tracking-widest text-outline font-bold mt-0.5">Pengurus</div>
=======
        <div class="hidden sm:block text-right">
            <div class="text-sm font-black text-primary leading-tight">{{ Auth::user()->name }}</div>
            <div class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold mt-0.5">{{ Auth::user()->role }}</div>
>>>>>>> fitur-status-final
        </div>
        @if(Auth::user()->avatar)
            @php
                $av = Auth::user()->avatar;
                $avatarUrl = (str_starts_with($av, 'http://') || str_starts_with($av, 'https://')) ? $av : '/storage/' . $av;
            @endphp
<<<<<<< HEAD
            <img src="{{ $avatarUrl }}" class="w-10 h-10 rounded-full object-cover shadow-sm" alt="Profile" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="w-10 h-10 rounded-full object-cover shadow-sm bg-surface-container-high border border-outline-variant/30 text-on-surface-variant font-bold" style="display:none; align-items:center; justify-content:center;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
=======
            <img src="{{ $avatarUrl }}" class="w-10 h-10 rounded-full object-cover shadow-sm border border-outline-variant/30" alt="Profile" referrerpolicy="no-referrer">
>>>>>>> fitur-status-final
        @else
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white text-sm font-bold shadow-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
    </div>
</nav>

<<<<<<< HEAD
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
=======
@include('components.sidebar-pengurus')

<main class="ml-64 pt-20 p-8 min-h-screen">
    <header class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-3xl font-headline font-extrabold tracking-tight text-on-surface">Monitoring Pengajuan Dana</h1>
            <p class="text-on-surface-variant font-body mt-1">Pantau dan verifikasi status pengajuan dana organisasi.</p>
        </div>
        <div>
            <a href="{{ route('pengurus.pengajuan-dana.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-2xl text-sm font-bold hover:bg-primary/95 transition shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-lg">add</span>
                Buat Pengajuan Saya
            </a>
        </div>
    </header>

    @if (session('success'))
        <div class="mb-6 p-4 bg-success-container rounded-3xl border border-success/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-success">check_circle</span>
            <p class="text-on-success-container text-sm font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- DASHBOARD APPROVAL --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-surface-container-lowest rounded-2xl p-4 shadow-sm border border-outline-variant/30 flex items-center gap-3">
            <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">description</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant font-medium">Total Pengajuan</p>
                <h4 class="text-lg font-bold text-on-surface">{{ $totalPengajuan }}</h4>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl p-4 shadow-sm border border-outline-variant/30 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff3cd; color: #856404;">
                <span class="material-symbols-outlined text-xl">hourglass_empty</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant font-medium">Pending</p>
                <h4 class="text-lg font-bold" style="color: #856404;">{{ $pendingCount }}</h4>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl p-4 shadow-sm border border-outline-variant/30 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #d1e7dd; color: #0f5132;">
                <span class="material-symbols-outlined text-xl">check_circle</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant font-medium">Disetujui</p>
                <h4 class="text-lg font-bold" style="color: #0f5132;">{{ $approvedCount }}</h4>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl p-4 shadow-sm border border-outline-variant/30 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #ffdad6; color: #93000a;">
                <span class="material-symbols-outlined text-xl">cancel</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant font-medium">Ditolak</p>
                <h4 class="text-lg font-bold" style="color: #93000a;">{{ $rejectedCount }}</h4>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl p-4 shadow-sm border border-outline-variant/30 flex items-center gap-3">
            <div class="w-10 h-10 bg-primary/20 text-primary rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">payments</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant font-medium">Dana Disetujui</p>
                <h4 class="text-lg font-bold text-primary">Rp {{ number_format($totalDanaDisetujui, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="flex border-b border-outline-variant/30 mb-6 gap-6">
        <button onclick="switchTab('all')" id="tab-all-btn" class="py-3 px-1 border-b-2 border-primary text-primary font-bold text-sm transition-all">
            Semua Pengajuan Anggota
        </button>
        <button onclick="switchTab('my')" id="tab-my-btn" class="py-3 px-1 border-b-2 border-transparent text-on-surface-variant hover:text-on-surface font-semibold text-sm transition-all">
            Pengajuan Saya
        </button>
    </div>

    {{-- DAFTAR PENGAJUAN (Tab content 1: Semua Pengajuan) --}}
    <div id="tab-all" class="space-y-6">
        {{-- Filters & Export --}}
        <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 shadow-sm">
            <form action="{{ route('pengurus.pengajuan-dana.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="search" class="block text-xs font-bold text-on-surface-variant mb-2">Pencarian</label>
                    <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Nama pemohon atau jenis..." class="w-full rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary/20 text-sm py-2 px-3">
                </div>
                <div>
                    <label for="status" class="block text-xs font-bold text-on-surface-variant mb-2">Status</label>
                    <select name="status" id="status" class="w-full rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary/20 text-sm py-2 px-3">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ $status === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Disetujui" {{ $status === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ $status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label for="tanggal_mulai" class="block text-xs font-bold text-on-surface-variant mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ $tglMulai }}" class="w-full rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary/20 text-sm py-2 px-3">
                </div>
                <div>
                    <label for="tanggal_selesai" class="block text-xs font-bold text-on-surface-variant mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ $tglSelesai }}" class="w-full rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary/20 text-sm py-2 px-3">
                </div>
                <div class="md:col-span-4 flex justify-between items-center mt-2">
                    <div class="flex gap-2">
                        <button type="submit" class="bg-primary text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-primary/90 transition shadow-sm">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('pengurus.pengajuan-dana.index') }}" class="bg-surface-container text-on-surface px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-surface-container-high transition">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-surface-container border-b border-outline-variant/30 text-on-surface-variant uppercase text-[11px] font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Pemohon</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Tgl Pengajuan</th>
                            <th class="px-6 py-4">Jenis Pengajuan</th>
                            <th class="px-6 py-4 text-right">Nominal</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4">Approval By</th>
                            <th class="px-6 py-4">Approval Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse ($allPengajuan as $item)
                            <tr class="hover:bg-surface/50 transition-colors cursor-pointer" onclick="openDetailModal('{{ $item->id }}')">
                                <td class="px-6 py-4 font-bold text-on-surface">
                                    <div class="flex items-center gap-3">
                                        @if($item->user->avatar)
                                            @php
                                                $av = $item->user->avatar;
                                                $avatarUrl = (str_starts_with($av, 'http://') || str_starts_with($av, 'https://')) ? $av : '/storage/' . $av;
                                            @endphp
                                            <img src="{{ $avatarUrl }}" class="w-8 h-8 rounded-full object-cover" alt="Avatar">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                                {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="leading-none">{{ $item->user->name }}</p>
                                            <span class="text-[10px] text-outline-variant font-medium lowercase">{{ $item->user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-on-surface-variant capitalize">
                                    {{ $item->user->role }}
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant font-medium">
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-on-surface">
                                    {{ $item->jenis_pengajuan }}
                                </td>
                                <td class="px-6 py-4 text-right font-extrabold text-primary">
                                    Rp {{ number_format($item->jumlah_dana, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($item->status === 'Disetujui')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold bg-success-container/70 text-on-success-container border border-success/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-success"></span>
                                            APPROVED
                                        </span>
                                    @elseif ($item->status === 'Ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold bg-error-container/70 text-on-error-container border border-error/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                            REJECTED
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold bg-yellow-100 text-yellow-850 border border-yellow-250" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                                            <span class="w-1.5 h-1.5 rounded-full" style="background-color: #ffc107"></span>
                                            PENDING
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant">
                                    @if($item->status === 'Disetujui')
                                        {{ $item->approvedBy ? $item->approvedBy->name : '-' }}
                                    @elseif($item->status === 'Ditolak')
                                        {{ $item->rejectedBy ? $item->rejectedBy->name : '-' }}
                                    @else
                                        <span class="text-outline-variant">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant">
                                    @if($item->status === 'Disetujui')
                                        {{ $item->approved_at ? \Carbon\Carbon::parse($item->approved_at)->format('d/m/Y H:i') : '-' }}
                                    @elseif($item->status === 'Ditolak')
                                        {{ $item->rejected_at ? \Carbon\Carbon::parse($item->rejected_at)->format('d/m/Y H:i') : '-' }}
                                    @else
                                        <span class="text-outline-variant">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-on-surface-variant">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl mb-3 text-outline-variant">inbox</span>
                                        <p class="font-medium">Belum ada pengajuan dana dari anggota.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-outline-variant/30">
                {{ $allPengajuan->links() }}
            </div>
        </div>
    </div>

    {{-- Tab content 2: Pengajuan Saya --}}
    <div id="tab-my" class="space-y-6 hidden">
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-surface-container border-b border-outline-variant/30 text-on-surface-variant uppercase text-[11px] font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Tgl Pengajuan</th>
                            <th class="px-6 py-4">Jenis Pengajuan</th>
                            <th class="px-6 py-4 text-right">Jumlah Dana</th>
                            <th class="px-6 py-4">Kontak & Rekening</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4">Catatan / Alasan</th>
                            <th class="px-6 py-4 text-center">Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse ($myPengajuan as $item)
                            <tr class="hover:bg-surface/50 transition-colors cursor-pointer" onclick="openDetailModal('{{ $item->id }}')">
                                <td class="px-6 py-4 font-medium text-on-surface-variant">
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 font-bold text-on-surface">
                                    {{ $item->jenis_pengajuan }}
                                </td>
                                <td class="px-6 py-4 text-right font-extrabold text-primary">
                                    Rp {{ number_format($item->jumlah_dana, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    <div class="font-bold text-on-surface">{{ $item->no_telp }}</div>
                                    <div class="text-on-surface-variant mt-0.5">{{ $item->nama_bank }} - {{ $item->no_rekening }}</div>
                                    <div class="text-outline text-[10px] italic">a.n. {{ $item->nama_rekening }}</div>
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant max-w-xs truncate" title="{{ $item->keterangan }}">
                                    {{ $item->keterangan }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($item->status === 'Disetujui')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold bg-success-container/70 text-on-success-container border border-success/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-success"></span>
                                            APPROVED
                                        </span>
                                    @elseif ($item->status === 'Ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold bg-error-container/70 text-on-error-container border border-error/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                            REJECTED
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold bg-yellow-100 text-yellow-850 border border-yellow-250" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                                            <span class="w-1.5 h-1.5 rounded-full" style="background-color: #ffc107"></span>
                                            PENDING
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant italic max-w-xs truncate">
                                    @if($item->status === 'Disetujui')
                                        {{ $item->approval_note ?: 'Disetujui oleh Bendahara' }}
                                    @elseif($item->status === 'Ditolak')
                                        {{ $item->rejection_reason }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center" onclick="event.stopPropagation()">
                                    @if ($item->file_pendukung)
                                        <a href="{{ asset('storage/' . $item->file_pendukung) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-primary font-bold hover:underline">
                                            <span class="material-symbols-outlined text-sm">download</span> Unduh
                                        </a>
                                    @else
                                        <span class="text-xs text-outline">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-on-surface-variant">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl mb-3 text-outline-variant">inbox</span>
                                        <p class="font-medium">Belum ada pengajuan dana dari Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-outline-variant/30">
                {{ $myPengajuan->links() }}
            </div>
>>>>>>> fitur-status-final
        </div>
    </div>
</main>

<<<<<<< HEAD
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
=======
{{-- DETAIL PENGAJUAN MODAL --}}
<div id="detail-modal" class="fixed inset-0 z-50 hidden bg-on-surface/50 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-surface-container-lowest rounded-3xl w-full max-w-2xl mx-4 overflow-hidden shadow-xl transform transition-all flex flex-col max-h-[85vh]">
        <div class="px-6 py-5 border-b border-outline-variant/30 flex justify-between items-center">
            <h3 class="text-xl font-headline font-bold text-on-surface">Detail Pengajuan Dana</h3>
            <button onclick="closeDetailModal()" class="text-on-surface-variant hover:text-error transition">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 space-y-6 overflow-y-auto flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- DATA PEMOHON -->
                <div class="bg-surface-container/30 p-5 rounded-2xl border border-outline-variant/20">
                    <h4 class="text-sm font-bold text-primary mb-3 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">person</span> DATA PEMOHON
                    </h4>
                    <div class="space-y-2 text-xs">
                        <div>
                            <span class="text-on-surface-variant font-medium">Nama Pemohon:</span>
                            <p id="det-nama" class="font-bold text-on-surface mt-0.5">-</p>
                        </div>
                        <div>
                            <span class="text-on-surface-variant font-medium">Email:</span>
                            <p id="det-email" class="font-bold text-on-surface mt-0.5">-</p>
                        </div>
                        <div>
                            <span class="text-on-surface-variant font-medium">Nomor HP / Kontak:</span>
                            <p id="det-telp" class="font-bold text-on-surface mt-0.5">-</p>
                        </div>
                    </div>
                </div>

                <!-- DATA REKENING -->
                <div class="bg-surface-container/30 p-5 rounded-2xl border border-outline-variant/20">
                    <h4 class="text-sm font-bold text-primary mb-3 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">account_balance</span> DATA REKENING
                    </h4>
                    <div class="space-y-2 text-xs">
                        <div>
                            <span class="text-on-surface-variant font-medium">Nama Bank:</span>
                            <p id="det-bank" class="font-bold text-on-surface mt-0.5">-</p>
                        </div>
                        <div>
                            <span class="text-on-surface-variant font-medium">Nomor Rekening:</span>
                            <p id="det-norek" class="font-bold text-on-surface mt-0.5">-</p>
                        </div>
                        <div>
                            <span class="text-on-surface-variant font-medium">Nama Pemilik Rekening:</span>
                            <p id="det-pemilik" class="font-bold text-on-surface mt-0.5">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DATA PENGAJUAN -->
            <div class="bg-surface-container/30 p-5 rounded-2xl border border-outline-variant/20">
                <h4 class="text-sm font-bold text-primary mb-3 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">payments</span> DATA PENGAJUAN
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-on-surface-variant font-medium">Kategori / Jenis Pengajuan:</span>
                        <p id="det-kategori" class="font-bold text-on-surface mt-0.5">-</p>
                    </div>
                    <div>
                        <span class="text-on-surface-variant font-medium">Nominal Pengajuan:</span>
                        <p id="det-nominal" class="text-sm font-black text-primary mt-0.5">Rp -</p>
                    </div>
                    <div class="md:col-span-2">
                        <span class="text-on-surface-variant font-medium">Keterangan:</span>
                        <p id="det-keterangan" class="font-medium text-on-surface mt-0.5 whitespace-pre-line bg-white p-3 rounded-xl border border-outline-variant/10">-</p>
                    </div>
                    <div>
                        <span class="text-on-surface-variant font-medium">Tanggal Pengajuan:</span>
                        <p id="det-tanggal" class="font-bold text-on-surface mt-0.5">-</p>
                    </div>
                    <div>
                        <span class="text-on-surface-variant font-medium">Lampiran / Dokumen Pendukung:</span>
                        <div id="det-lampiran" class="mt-1">
                            <!-- JS will inject link -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIMELINE STATUS -->
            <div class="bg-surface-container/30 p-5 rounded-2xl border border-outline-variant/20">
                <h4 class="text-sm font-bold text-primary mb-4 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">route</span> TIMELINE STATUS
                </h4>
                <div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-outline-variant/30" id="det-timeline">
                    <!-- Dynamic timeline rows injected by JS -->
                </div>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-outline-variant/30 flex justify-end items-center bg-surface-container/20">
            <button type="button" onclick="closeDetailModal()" class="py-2 px-4 rounded-xl border border-outline-variant/30 text-on-surface-variant font-bold text-xs hover:bg-surface-container transition">
                Tutup
>>>>>>> fitur-status-final
            </button>
        </div>
    </div>
</div>

<script>
<<<<<<< HEAD
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
=======
    function switchTab(tab) {
        const tabAll = document.getElementById('tab-all');
        const tabMy = document.getElementById('tab-my');
        const tabAllBtn = document.getElementById('tab-all-btn');
        const tabMyBtn = document.getElementById('tab-my-btn');

        if (tab === 'all') {
            tabAll.classList.remove('hidden');
            tabMy.classList.add('hidden');
            tabAllBtn.className = "py-3 px-1 border-b-2 border-primary text-primary font-bold text-sm transition-all";
            tabMyBtn.className = "py-3 px-1 border-b-2 border-transparent text-on-surface-variant hover:text-on-surface font-semibold text-sm transition-all";
        } else {
            tabAll.classList.add('hidden');
            tabMy.classList.remove('hidden');
            tabAllBtn.className = "py-3 px-1 border-b-2 border-transparent text-on-surface-variant hover:text-on-surface font-semibold text-sm transition-all";
            tabMyBtn.className = "py-3 px-1 border-b-2 border-primary text-primary font-bold text-sm transition-all";
        }
    }

    // Load and Open Detail Modal
    function openDetailModal(id) {
        fetch('/pengurus/pengajuan-dana/' + id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('det-nama').innerText = data.user.name;
                document.getElementById('det-email').innerText = data.user.email;
                document.getElementById('det-telp').innerText = data.no_telp || data.user.phone_number || '—';

                document.getElementById('det-bank').innerText = data.nama_bank || '—';
                document.getElementById('det-norek').innerText = data.no_rekening || '—';
                document.getElementById('det-pemilik').innerText = data.nama_rekening || '—';

                document.getElementById('det-kategori').innerText = data.jenis_pengajuan;
                
                const formattedNominal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(data.jumlah_dana);
                document.getElementById('det-nominal').innerText = formattedNominal;
                document.getElementById('det-keterangan').innerText = data.keterangan;

                const date = new Date(data.created_at);
                const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                document.getElementById('det-tanggal').innerText = date.toLocaleDateString('id-ID', options) + ' WIB';

                // Lampiran Link
                const lampiranContainer = document.getElementById('det-lampiran');
                if (data.file_pendukung) {
                    lampiranContainer.innerHTML = `
                        <a href="/storage/${data.file_pendukung}" target="_blank" class="inline-flex items-center gap-1 text-xs text-primary font-bold hover:underline">
                            <span class="material-symbols-outlined text-sm">download</span> Unduh Dokumen Pendukung
                        </a>
                    `;
                } else {
                    lampiranContainer.innerHTML = '<span class="text-outline-variant">—</span>';
                }

                // Timeline Status rendering
                const timelineContainer = document.getElementById('det-timeline');
                timelineContainer.innerHTML = '';

                // Step 1: Created
                let timelineHtml = `
                    <div class="relative flex gap-3">
                        <div class="absolute -left-6 mt-1 w-4 h-4 rounded-full bg-success flex items-center justify-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-on-surface">Pengajuan Dibuat</h5>
                            <p class="text-[10px] text-on-surface-variant mt-0.5">${date.toLocaleDateString('id-ID', options)} WIB</p>
                            <p class="text-[11px] text-outline-variant mt-1">Pengajuan berhasil dikirimkan ke sistem.</p>
                        </div>
                    </div>
                `;

                // Step 2: Waiting Approval
                let statusClass = data.status === 'Pending' ? 'bg-yellow-400' : 'bg-success';
                timelineHtml += `
                    <div class="relative flex gap-3">
                        <div class="absolute -left-6 mt-1 w-4 h-4 rounded-full ${statusClass} flex items-center justify-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-on-surface">Menunggu Persetujuan</h5>
                            <p class="text-[11px] text-outline-variant mt-1">Menunggu verifikasi dan keputusan dari Bendahara.</p>
                        </div>
                    </div>
                `;

                // Step 3: Approved or Rejected
                if (data.status !== 'Pending') {
                    let finalStatusTitle = data.status === 'Disetujui' ? 'Disetujui' : 'Ditolak';
                    let finalColorClass = data.status === 'Disetujui' ? 'bg-success' : 'bg-error';
                    let finalNote = data.status === 'Disetujui' ? (data.approval_note || 'Disetujui oleh Bendahara.') : (data.rejection_reason || 'Ditolak oleh Bendahara.');
                    let approverName = data.status === 'Disetujui' ? (data.approved_by ? data.approved_by.name : 'Bendahara') : (data.rejected_by ? data.rejected_by.name : 'Bendahara');
                    let approvalDateStr = '';
                    
                    if (data.status === 'Disetujui' && data.approved_at) {
                        approvalDateStr = new Date(data.approved_at).toLocaleDateString('id-ID', options) + ' WIB';
                    } else if (data.status === 'Ditolak' && data.rejected_at) {
                        approvalDateStr = new Date(data.rejected_at).toLocaleDateString('id-ID', options) + ' WIB';
                    }

                    timelineHtml += `
                        <div class="relative flex gap-3">
                            <div class="absolute -left-6 mt-1 w-4 h-4 rounded-full ${finalColorClass} flex items-center justify-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-on-surface">${finalStatusTitle}</h5>
                                <p class="text-[10px] text-on-surface-variant mt-0.5">${approvalDateStr}</p>
                                <p class="text-[11px] text-outline mt-1 font-semibold font-body">Oleh: ${approverName}</p>
                                <p class="text-[11px] text-on-surface italic mt-1 bg-white p-2 rounded-lg border border-outline-variant/20 mt-2 font-medium">"${finalNote}"</p>
                            </div>
                        </div>
                    `;
                }

                timelineContainer.innerHTML = timelineHtml;

                document.getElementById('detail-modal').classList.remove('hidden');
            });
    }

    function closeDetailModal() {
        document.getElementById('detail-modal').classList.add('hidden');
>>>>>>> fitur-status-final
    }
</script>
</body>
</html>
