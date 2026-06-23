<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Verifikasi NIM | Mahasiswa - {{ app_setting('app_name', 'MONET') }}</title>
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
    body { background-color: #f8f9fb; }
</style>
</head>
<body class="font-body text-on-surface flex min-h-screen relative overflow-hidden">
    
    {{-- Decorative Background Elements --}}
    <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-primary rounded-full opacity-20 blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[400px] h-[400px] bg-secondary rounded-full opacity-20 blur-[80px] pointer-events-none"></div>

    <div class="flex flex-1 w-full relative z-10">
        {{-- Left: Illustration/Branding Panel (Hidden on Mobile) --}}
        <div class="hidden lg:flex w-1/2 bg-primary relative overflow-hidden items-center justify-center p-12">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
            <div class="relative z-10 max-w-lg text-center">
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-3xl inline-block mb-8 border border-white/20 shadow-2xl">
                    <img src="{{ app_setting('logo_dark', 'https://cdn-1.yourmonet.web.id/images/monet-2.png') }}" alt="{{ app_setting('app_name', 'MONET') }}" class="h-10 w-auto object-contain"/>
                </div>
                <h2 class="text-5xl font-headline font-bold text-on-primary leading-tight mb-6">
                    Validasi Mahasiswa
                </h2>
                <p class="text-xl text-white/90 leading-relaxed">
                    Silakan masukkan NIM Anda untuk memverifikasi pendaftaran.
                </p>
            </div>
            <div class="absolute bottom-[-10%] right-[-5%] w-[400px] h-[400px] bg-primary-container rounded-full opacity-30 blur-3xl"></div>
            <div class="absolute top-[-5%] left-[-10%] w-[300px] h-[300px] bg-white rounded-full opacity-10 blur-2xl"></div>
        </div>

        {{-- Right: Form Panel --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 md:p-16">
            <div class="w-full max-w-md">
                
                {{-- Mobile Header --}}
                <div class="lg:hidden mb-12 flex items-center gap-3">
                    <img src="{{ app_setting('logo_light', 'https://cdn-1.yourmonet.web.id/images/monet2.png') }}" alt="{{ app_setting('app_name', 'MONET') }}" class="h-8 w-auto object-contain"/>
                </div>

                <div class="mb-8">
                    <h1 class="text-3xl sm:text-4xl font-headline font-extrabold tracking-tight text-on-surface">Validasi <span class="text-primary">NIM</span></h1>
                    <p class="text-on-surface-variant font-body mt-2 text-sm sm:text-base">Silakan masukkan Nomor Induk Mahasiswa (NIM) Anda untuk melakukan pendaftaran.</p>
                </div>

                {{-- Alert Container --}}
                <div id="alert-container">
                    @if ($errors->any())
                        <div class="mb-6 bg-error-container/50 border border-error/30 rounded-2xl p-4 flex items-start gap-3">
                            <span class="material-symbols-outlined text-error shrink-0">error</span>
                            <div class="text-sm flex flex-col justify-center text-on-error-container">
                                <div class="space-y-1 mt-0.5">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <form id="check-nim-form" action="{{ route('user.process-check-nim') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="nim" class="block text-sm font-bold text-on-surface-variant mb-1.5 ml-1">Nomor Induk Mahasiswa (NIM)</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">badge</span>
                            <input type="text" id="nim" name="nim" required value="{{ old('nim') }}" autofocus
                                class="w-full pl-12 pr-4 py-3.5 bg-surface-container-lowest border-2 border-outline-variant/30 rounded-xl text-on-surface font-medium placeholder-outline focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                                placeholder="Contoh : 12345678">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-on-primary font-bold py-3.5 rounded-xl shadow-lg shadow-primary/30 hover:shadow-primary/40 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2 mt-2">
                        Cek NIM <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-outline-variant/20 text-center">
                    <p class="text-on-surface-variant text-sm">Sudah punya akun? 
                        <a href="{{ route('user.login') }}" class="text-primary font-bold hover:underline hover:text-primary-container-highest transition-colors">Login Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('check-nim-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const alertContainer = document.getElementById('alert-container');
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            // Loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="material-symbols-outlined animate-spin text-lg">progress_activity</span> Memeriksa...';
            alertContainer.innerHTML = '';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();

                if (response.ok && data.success) {
                    alertContainer.innerHTML = `
                        <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-start gap-3">
                            <span class="material-symbols-outlined text-emerald-600 shrink-0">check_circle</span>
                            <div class="text-sm flex flex-col justify-center text-emerald-800">
                                <div class="space-y-1 mt-0.5">
                                    <p>${data.message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 3000);
                } else {
                    const errorMessage = data.message || data.errors?.nim?.[0] || 'Terjadi kesalahan.';
                    alertContainer.innerHTML = `
                        <div class="mb-6 bg-error-container/50 border border-error/30 rounded-2xl p-4 flex items-start gap-3">
                            <span class="material-symbols-outlined text-error shrink-0">error</span>
                            <div class="text-sm flex flex-col justify-center text-on-error-container">
                                <div class="space-y-1 mt-0.5">
                                    <p>${errorMessage}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                }
            } catch (error) {
                console.error(error);
                alertContainer.innerHTML = `
                    <div class="mb-6 bg-error-container/50 border border-error/30 rounded-2xl p-4 flex items-start gap-3">
                        <span class="material-symbols-outlined text-error shrink-0">error</span>
                        <div class="text-sm flex flex-col justify-center text-on-error-container">
                            <div class="space-y-1 mt-0.5">
                                <p>Terjadi kesalahan pada server. Silakan coba lagi nanti.</p>
                            </div>
                        </div>
                    </div>
                `;
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
        });
    </script>

@include('components.loading')
</body>
</html>
