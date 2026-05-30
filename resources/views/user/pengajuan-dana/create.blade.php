<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Buat Pengajuan Dana — MONET</title>
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
    <header class="mb-10">
        <a href="{{ route('user.pengajuan-dana.index') }}" class="inline-flex items-center gap-1 text-sm font-bold text-outline hover:text-primary transition-colors mb-3 group">
            <span class="material-symbols-outlined text-base group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Kembali ke Riwayat
        </a>
        <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Buat Pengajuan Dana</h1>
        <p class="text-on-surface-variant font-body mt-1">Lengkapi informasi di bawah ini untuk mengajukan permohonan dana baru.</p>
    </header>

    <div class="max-w-2xl bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30">
        <form action="{{ route('user.pengajuan-dana.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Jenis Pengajuan --}}
            <div>
                <label for="jenis_pengajuan" class="block text-sm font-bold text-on-surface mb-2">Jenis Pengajuan <span class="text-error">*</span></label>
                <select id="jenis_pengajuan" name="jenis_pengajuan" required
                    class="w-full rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary shadow-sm bg-surface-container-lowest text-sm text-on-surface transition-all">
                    <option value="" disabled selected>-- Pilih Jenis Pengajuan --</option>
                    <option value="Kebutuhan Mendesak" {{ old('jenis_pengajuan') == 'Kebutuhan Mendesak' ? 'selected' : '' }}>Kebutuhan Mendesak</option>
                    <option value="Bantuan Sosial" {{ old('jenis_pengajuan') == 'Bantuan Sosial' ? 'selected' : '' }}>Bantuan Sosial</option>
                    <option value="Kegiatan Anggota" {{ old('jenis_pengajuan') == 'Kegiatan Anggota' ? 'selected' : '' }}>Kegiatan Anggota</option>
                    <option value="Lainnya" {{ old('jenis_pengajuan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_pengajuan')
                    <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Jumlah Dana --}}
            <div>
                <label for="jumlah_dana" class="block text-sm font-bold text-on-surface mb-2">Jumlah Dana yang Diajukan (Rupiah) <span class="text-error">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-outline-variant text-sm font-bold select-none pointer-events-none">Rp</span>
                    <input type="number" id="jumlah_dana" name="jumlah_dana" required min="1" value="{{ old('jumlah_dana') }}" placeholder="Contoh: 500000"
                        class="w-full pl-11 rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary shadow-sm bg-surface-container-lowest text-sm text-on-surface transition-all">
                </div>
                @error('jumlah_dana')
                    <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label for="keterangan" class="block text-sm font-bold text-on-surface mb-2">Keterangan / Alasan Pengajuan <span class="text-error">*</span></label>
                <textarea id="keterangan" name="keterangan" required rows="5" placeholder="Tuliskan secara lengkap alasan pengajuan, detail kegunaan dana, dll."
                    class="w-full rounded-2xl border-outline-variant/50 focus:border-primary focus:ring-primary shadow-sm bg-surface-container-lowest text-sm text-on-surface transition-all">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- File Pendukung --}}
            <div>
                <label for="file_pendukung" class="block text-sm font-bold text-on-surface mb-2">File Pendukung (Opsional)</label>
                <input type="file" id="file_pendukung" name="file_pendukung" accept=".pdf,.jpg,.jpeg,.png"
                    class="w-full file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-primary-container/30 file:text-primary hover:file:bg-primary-container/50 border border-outline-variant/40 rounded-2xl text-sm bg-surface-container-lowest cursor-pointer">
                <p class="text-[11px] text-outline mt-1.5">Format yang diterima: PDF, JPG, JPEG, PNG (Maksimal 5MB).</p>
                @error('file_pendukung')
                    <p class="text-error text-xs font-bold mt-1.5 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-4 border-t border-outline-variant/10 pt-6">
                <button type="submit" class="flex-1 inline-flex justify-center items-center gap-2 bg-primary text-on-primary py-3 rounded-2xl text-sm font-bold hover:bg-primary/95 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <span class="material-symbols-outlined text-lg">send</span>
                    Kirim Pengajuan
                </button>
                <a href="{{ route('user.pengajuan-dana.index') }}" class="flex-1 inline-flex justify-center items-center border border-outline-variant/30 text-on-surface-variant py-3 rounded-2xl text-sm font-bold hover:bg-surface-container transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
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
