<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Pengaturan Web - Admin - {{ app_setting('app_name', 'MONET') }}</title>
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
            <h1 class="text-4xl font-headline font-extrabold tracking-tight text-on-surface">Pengaturan Web</h1>
            <p class="text-on-surface-variant font-body mt-1">Atur website sesuai kebutuhan.</p>
        </div>
    </header>

    @if (session('error'))
        <div class="mb-6 p-4 bg-error-container rounded-xl border border-error/20 flex items-center gap-2">
            <span class="material-symbols-outlined text-error">error</span>
            <p class="text-on-error-container text-sm">{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="max-w-6xl space-y-6">
        @csrf
        
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant/30 overflow-hidden">
            <div class="p-6 border-b border-outline-variant/30 bg-surface-container-low/50">
                <h2 class="text-lg font-bold text-on-surface">Nama dan Logo Website</h2>
            </div>
            <div class="p-4 sm:p-8 space-y-6">
                {{-- Nama Aplikasi --}}
                <div>
                    <label for="app_name" class="block text-sm font-semibold text-on-surface mb-2">Nama Aplikasi</label>
                    <input type="text" name="app_name" id="app_name" required value="{{ app_setting('app_name', 'MONET') }}" class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    <p class="text-xs text-on-surface-variant mt-1">Nama ini akan digunakan pada judul halaman, email, dan teks lainnya.</p>
                </div>

                {{-- Favicon --}}
                <div>
                    <label for="favicon" class="block text-sm font-semibold text-on-surface mb-2">URL Favicon</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <img src="{{ app_setting('favicon', 'https://cdn-1.yourmonet.web.id/images/monet.png') }}" alt="Favicon" class="w-10 h-10 object-contain rounded border border-outline-variant/50 p-1 bg-surface-container-lowest shrink-0">
                        <input type="url" name="favicon" id="favicon" required value="{{ app_setting('favicon', 'https://cdn-1.yourmonet.web.id/images/monet.png') }}" class="w-full flex-1 rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                    <p class="text-xs text-on-surface-variant mt-1">Digunakan untuk ikon tab browser.</p>
                </div>

                {{-- Logo Light --}}
                <div>
                    <label for="logo_light" class="block text-sm font-semibold text-on-surface mb-2">URL Logo Light</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <img src="{{ app_setting('logo_light', 'https://cdn-1.yourmonet.web.id/images/monet2.png') }}" alt="Logo Light" class="h-10 w-auto object-contain rounded border border-outline-variant/50 p-1 bg-surface-container-lowest shrink-0">
                        <input type="url" name="logo_light" id="logo_light" required value="{{ app_setting('logo_light', 'https://cdn-1.yourmonet.web.id/images/monet2.png') }}" class="w-full flex-1 rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                    <p class="text-xs text-on-surface-variant mt-1">Digunakan pada latar belakang terang (navbar, halaman login, dll).</p>
                </div>

                {{-- Logo Dark --}}
                <div>
                    <label for="logo_dark" class="block text-sm font-semibold text-on-surface mb-2">URL Logo Dark</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <div class="bg-on-surface p-1 rounded border border-outline-variant/50 shrink-0">
                            <img src="{{ app_setting('logo_dark', 'https://cdn-1.yourmonet.web.id/images/monet-2.png') }}" alt="Logo Dark" class="h-8 w-auto object-contain">
                        </div>
                        <input type="url" name="logo_dark" id="logo_dark" required value="{{ app_setting('logo_dark', 'https://cdn-1.yourmonet.web.id/images/monet-2.png') }}" class="w-full flex-1 rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                    <p class="text-xs text-on-surface-variant mt-1">Digunakan pada latar belakang gelap (sidebar admin, banner, dll).</p>
                </div>

                {{-- Logo Grey --}}
                <div>
                    <label for="logo_grey" class="block text-sm font-semibold text-on-surface mb-2">URL Logo Abu-abu (Grey)</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <img src="{{ app_setting('logo_grey', 'https://cdn-1.yourmonet.web.id/images/monet-greycolor.png') }}" alt="Logo Grey" class="h-10 w-auto object-contain rounded border border-outline-variant/50 p-1 bg-surface-container-lowest shrink-0">
                        <input type="url" name="logo_grey" id="logo_grey" required value="{{ app_setting('logo_grey', 'https://cdn-1.yourmonet.web.id/images/monet-greycolor.png') }}" class="w-full flex-1 rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                    <p class="text-xs text-on-surface-variant mt-1">Digunakan untuk email dan keperluan lainnya.</p>
                </div>

            </div>
        </div>

        {{-- Card 2: Akses Halaman Publik --}}
        <div class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant/30 overflow-hidden">
            <div class="p-6 border-b border-outline-variant/30 bg-surface-container-low/50">
                <h2 class="text-lg font-bold text-on-surface">Akses Halaman Publik</h2>
            </div>
            <div class="p-4 sm:p-8 space-y-6">
                <div>
                    <label for="public_pages_enabled" class="block text-sm font-semibold text-on-surface mb-2">Status Halaman Publik</label>
                    <select name="public_pages_enabled" id="public_pages_enabled" required class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="1" {{ app_setting('public_pages_enabled', '1') == '1' ? 'selected' : '' }}>Nyala (Dapat Diakses)</option>
                        <option value="0" {{ app_setting('public_pages_enabled', '1') == '0' ? 'selected' : '' }}>Mati (Ditutup)</option>
                    </select>
                    <p class="text-xs text-on-surface-variant mt-1">Jika dimatikan, halaman Homepage, Tentang Kami, dan Kontak tidak akan bisa diakses.</p>
                </div>

                <div>
                    <label for="public_pages_redirect_url" class="block text-sm font-semibold text-on-surface mb-2">URL Redirect (Opsional)</label>
                    <input type="url" name="public_pages_redirect_url" id="public_pages_redirect_url" value="{{ app_setting('public_pages_redirect_url') }}" placeholder="https://..." class="w-full rounded-xl border border-outline-variant bg-surface-container-low px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    <p class="text-xs text-on-surface-variant mt-1">Jika halaman publik dimatikan, pengunjung akan otomatis diarahkan (redirect) ke URL ini. Jika dikosongkan, pengunjung akan melihat error 404 Not Found.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="w-full sm:w-auto bg-primary text-on-primary font-bold py-3 px-6 rounded-xl shadow-md hover:bg-primary/90 hover:shadow-lg transition-all flex items-center justify-center gap-2 text-sm">
                <span class="material-symbols-outlined text-lg">save</span>
                Simpan Pengaturan
            </button>
        </div>
    </form>
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

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#003d9b',
            confirmButtonText: 'Tutup'
        });
    @endif
</script>

@include('components.loading')
</body>
</html>
