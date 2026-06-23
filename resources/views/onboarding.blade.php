<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Selamat Datang - {{ app_setting('app_name', 'MONET') }}</title>
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
                        "primary": "#0ea5e9", "on-primary": "#ffffff",
                        "surface": "#f8fafc", "on-surface": "#0f172a",
                        "surface-variant": "#e2e8f0", "on-surface-variant": "#475569",
                    },
                    fontFamily: {
                        body: ["Inter", "sans-serif"],
                        headline: ["Manrope", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        .slide { 
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); 
            will-change: opacity, transform;
            grid-area: 1 / 1 / 2 / 2;
        }
        .slide-hidden { opacity: 0; transform: translate3d(50px, 0, 0) scale(0.95); pointer-events: none; z-index: 0; }
        .slide-active { opacity: 1; transform: translate3d(0, 0, 0) scale(1); z-index: 10; }
        .slide-exit { opacity: 0; transform: translate3d(-50px, 0, 0) scale(0.95); pointer-events: none; z-index: 0; }
        
        .blob {
            position: absolute; filter: blur(60px); opacity: 0.6; z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, -40px) scale(1.1); }
        }
        /* Button Loading Spinner */
        .btn-loading { position: relative !important; color: transparent !important; pointer-events: none !important; }
        .btn-loading::after {
            content: ''; position: absolute; left: 50%; top: 50%;
            width: 20px; height: 20px; border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%; border-top-color: #fff;
            animation: spin 0.8s linear infinite; transform: translate(-50%, -50%);
        }
        @keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }
    </style>
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden min-h-screen w-full flex flex-col items-center relative">
    
    <!-- Background Blobs -->
    <div class="blob bg-sky-300 w-64 h-64 rounded-full top-10 left-10 hidden md:block"></div>
    <div class="blob bg-blue-300 w-80 h-80 rounded-full bottom-10 right-10 hidden md:block" style="animation-delay: -5s"></div>
    <div class="blob bg-indigo-300 w-72 h-72 rounded-full -bottom-10 -left-10 hidden md:block" style="animation-delay: -2s"></div>

    <div class="relative z-10 w-full max-w-md md:max-w-2xl px-6 py-8 min-h-screen md:min-h-0 my-auto flex flex-col justify-between md:justify-center md:gap-6">
        <!-- Top header / Logo -->
        <div class="flex justify-center md:mb-2">
            <img src="{{ app_setting('logo_light', 'https://cdn-1.yourmonet.web.id/images/monet2.png') }}" alt="Logo" class="h-8 md:h-10 object-contain drop-shadow-md">
        </div>

        <!-- Slides Container -->
        <div id="slider" class="relative flex-1 grid place-items-center w-full mt-4 md:mt-0">
            
            <!-- Slide 1 -->
            <div class="slide slide-active flex flex-col items-center text-center w-full" id="slide-1">
                <div class="w-40 h-40 sm:w-56 sm:h-56 md:w-48 md:h-48 mb-6 md:mb-4 bg-white/50 backdrop-blur-md rounded-full flex items-center justify-center shadow-xl border border-white/40">
                    <span class="material-symbols-outlined text-[70px] sm:text-[90px] md:text-[80px] text-primary">account_balance_wallet</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-headline font-extrabold mb-2 md:mb-3">Selamat Datang di {{ app_setting('app_name', 'MONET') }}</h1>
                <p class="text-on-surface-variant text-sm sm:text-base leading-relaxed px-4">
                    Sistem Informasi Manajemen Keuangan yang dirancang khusus untuk mempermudah keuangan organisasi Anda.
                </p>
            </div>

            <!-- Slide 2 -->
            <div class="slide slide-hidden flex flex-col items-center text-center w-full" id="slide-2">
                <div class="w-40 h-40 sm:w-56 sm:h-56 md:w-48 md:h-48 mb-6 md:mb-4 bg-white/50 backdrop-blur-md rounded-full flex items-center justify-center shadow-xl border border-white/40">
                    <span class="material-symbols-outlined text-[70px] sm:text-[90px] md:text-[80px] text-primary">monitoring</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-headline font-extrabold mb-2 md:mb-3">Transparan & Akurat</h1>
                <p class="text-on-surface-variant text-sm sm:text-base leading-relaxed px-4">
                    Kelola arus kas, persetujuan pendanaan, dan laporan keuangan secara real-time dan terintegrasi.
                </p>
            </div>

            <div class="slide slide-hidden flex flex-col items-center text-center w-full" id="slide-3">
                <div class="w-40 h-40 sm:w-56 sm:h-56 md:w-48 md:h-48 mb-6 md:mb-4 bg-white/50 backdrop-blur-md rounded-full flex items-center justify-center shadow-xl border border-white/40">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" class="w-24 sm:w-36 md:w-28 object-contain">
                </div>
                <h1 class="text-2xl md:text-3xl font-headline font-extrabold mb-2 md:mb-3">Bayar Tagihan dengan Mudah</h1>
                <p class="text-on-surface-variant text-sm sm:text-base leading-relaxed px-4">
                    Bayar tagihan dengan QRIS, E-Wallet, Serta Bank dari perangkat Anda dimanapun dan kapanpun.
                </p>
            </div>

            <!-- Slide 4 -->
            <div class="slide slide-hidden flex flex-col items-center text-center w-full" id="slide-4">
                <div class="w-40 h-40 sm:w-56 sm:h-56 md:w-48 md:h-48 mb-6 md:mb-4 bg-white/50 backdrop-blur-md rounded-full flex items-center justify-center shadow-xl border border-white/40">
                    <span class="material-symbols-outlined text-[70px] sm:text-[90px] md:text-[80px] text-primary">rocket_launch</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-headline font-extrabold mb-2 md:mb-3">Ringan dan Cepat</h1>
                <p class="text-on-surface-variant text-sm sm:text-base leading-relaxed px-4">
                    Akses dan kelola seluruh data secara instan tanpa hambatan performa di perangkat apapun.
                </p>
            </div>

            <!-- Slide 5 -->
            <div class="slide slide-hidden flex flex-col items-center text-center w-full" id="slide-5">
                <div class="w-40 h-40 sm:w-56 sm:h-56 md:w-48 md:h-48 mb-6 md:mb-4 bg-white/50 backdrop-blur-md rounded-full flex items-center justify-center shadow-xl border border-white/40">
                    <span class="material-symbols-outlined text-[70px] sm:text-[90px] md:text-[80px] text-primary">task_alt</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-headline font-extrabold mb-2 md:mb-3">Sudah Siap?</h1>
                <p class="text-on-surface-variant text-sm sm:text-base leading-relaxed px-4">
                    Masuk ke akun Anda untuk mulai eksplorasi, mengelola dana atau melihat status keuangan.
                </p>
            </div>

        </div>

        <!-- Bottom Controls -->
        <div class="flex flex-col items-center gap-6 mt-6 md:mt-2">
            <!-- Dots -->
            <div class="flex gap-2" id="dots">
                <div class="w-8 h-2 rounded-full bg-primary transition-all duration-300" id="dot-1"></div>
                <div class="w-2 h-2 rounded-full bg-outline-variant/50 transition-all duration-300" id="dot-2"></div>
                <div class="w-2 h-2 rounded-full bg-outline-variant/50 transition-all duration-300" id="dot-3"></div>
                <div class="w-2 h-2 rounded-full bg-outline-variant/50 transition-all duration-300" id="dot-4"></div>
                <div class="w-2 h-2 rounded-full bg-outline-variant/50 transition-all duration-300" id="dot-5"></div>
            </div>

            <!-- Buttons -->
            <div class="w-full flex justify-between items-center gap-4">
                <button id="btn-left" onclick="openAboutModal()" class="text-on-surface-variant font-semibold text-sm px-2 sm:px-4 py-3 hover:text-primary transition-colors whitespace-nowrap">
                    Tentang Aplikasi
                </button>
                <button id="btn-next" onclick="nextSlide()" class="bg-primary text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-primary/30 hover:bg-sky-600 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    Lanjut <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
                <form id="form-finish" method="POST" action="{{ route('onboarding.complete') }}" class="hidden w-full" onsubmit="this.querySelector('button[type=submit]').classList.add('btn-loading')">
                    @csrf
                    <button type="submit" class="w-full bg-primary text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-primary/30 hover:bg-sky-600 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        Mulai Sekarang <span class="material-symbols-outlined text-lg">login</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tentang Aplikasi -->
    <div id="about-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
        <div class="bg-surface w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl p-6 sm:p-8 shadow-2xl scale-95 opacity-0 transition-all duration-300 transform scrollbar-hide" id="about-modal-content">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-headline font-bold text-on-surface">Tentang Aplikasi</h2>
                <div class="p-2 bg-primary/10 text-primary rounded-full shrink-0">
                    <span class="material-symbols-outlined">info</span>
                </div>
            </div>
            <p class="text-on-surface-variant leading-relaxed text-sm sm:text-base mb-8">
                <strong>{{ app_setting('app_name', 'MONET') }}</strong> adalah Sistem Informasi Manajemen Keuangan terpadu yang membantu organisasi dalam mengelola arus kas, pengajuan dana, persetujuan, dan pencatatan secara <em>real-time</em>. Dengan platform ini, transparansi dan efisiensi pengelolaan keuangan organisasi Anda dapat terjamin dengan baik.
            </p>
            
            <!-- Tim Pengembang -->
            <div class="mb-8">
                <h3 class="text-lg font-headline font-bold text-on-surface mb-6 border-b border-outline-variant/30 pb-2">Tim Pengembang</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
                    <!-- Member 1 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden mb-3 border-2 border-primary/20 shadow-sm">
                            <img src="https://cdn-1.yourmonet.web.id/images/team/sidiq.jpeg" alt="Achmad Assidiq L" class="w-full h-full object-cover select-none" oncontextmenu="return false;" draggable="false">
                        </div>
                        <h4 class="text-xs sm:text-sm font-bold text-on-surface leading-tight">Achmad Assidiq L</h4>
                        <p class="text-[10px] sm:text-xs text-primary font-medium mt-1">Product Owner</p>
                    </div>
                    <!-- Member 2 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden mb-3 border-2 border-primary/20 shadow-sm">
                            <img src="https://cdn-1.yourmonet.web.id/images/team/aldilah.jpeg" alt="Aldilah Rihadatul'ais" class="w-full h-full object-cover select-none" oncontextmenu="return false;" draggable="false">
                        </div>
                        <h4 class="text-xs sm:text-sm font-bold text-on-surface leading-tight">Aldilah R</h4>
                        <p class="text-[10px] sm:text-xs text-primary font-medium mt-1">Scrum Master</p>
                    </div>
                    <!-- Member 3 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden mb-3 border-2 border-primary/20 shadow-sm">
                            <img src="https://cdn-1.yourmonet.web.id/images/team/aldy.JPG" alt="Aldy Alfiansyah" class="w-full h-full object-cover select-none" oncontextmenu="return false;" draggable="false">
                        </div>
                        <h4 class="text-xs sm:text-sm font-bold text-on-surface leading-tight">Aldy Alfiansyah</h4>
                        <p class="text-[10px] sm:text-xs text-primary font-medium mt-1">Developer</p>
                    </div>
                    <!-- Member 4 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden mb-3 border-2 border-primary/20 shadow-sm">
                            <img src="https://cdn-1.yourmonet.web.id/images/team/fahri.jpeg" alt="Fahri Bintang M" class="w-full h-full object-cover select-none" oncontextmenu="return false;" draggable="false">
                        </div>
                        <h4 class="text-xs sm:text-sm font-bold text-on-surface leading-tight">Fahri Bintang M</h4>
                        <p class="text-[10px] sm:text-xs text-primary font-medium mt-1">Developer</p>
                    </div>
                </div>
            </div>

            <button onclick="closeAboutModal()" class="w-full bg-surface-variant text-on-surface font-bold py-3 rounded-xl hover:bg-slate-300 transition-colors">
                Tutup
            </button>
        </div>
    </div>

    <script>
        let currentSlide = 1;
        const totalSlides = 5;

        function updateDots() {
            for (let i = 1; i <= totalSlides; i++) {
                const dot = document.getElementById(`dot-${i}`);
                if (i === currentSlide) {
                    dot.className = "w-8 h-2 rounded-full bg-primary transition-all duration-300";
                } else {
                    dot.className = "w-2 h-2 rounded-full bg-slate-300 transition-all duration-300";
                }
            }
        }

        function updateUI() {
            updateDots();
            const btnLeft = document.getElementById('btn-left');
            const btnNext = document.getElementById('btn-next');
            const formFinish = document.getElementById('form-finish');

            if (currentSlide === 1) {
                btnLeft.innerHTML = 'Tentang Aplikasi';
                btnLeft.onclick = openAboutModal;
                btnNext.classList.remove('hidden');
                formFinish.classList.add('hidden');
            } else if (currentSlide > 1 && currentSlide < totalSlides) {
                btnLeft.innerHTML = 'Kembali';
                btnLeft.onclick = prevSlide;
                btnNext.classList.remove('hidden');
                formFinish.classList.add('hidden');
            } else if (currentSlide === totalSlides) {
                btnLeft.classList.add('hidden');
                btnNext.classList.add('hidden');
                formFinish.classList.remove('hidden');
            }
        }

        function nextSlide() {
            if (currentSlide < totalSlides) {
                const current = document.getElementById(`slide-${currentSlide}`);
                current.className = "slide slide-exit flex flex-col items-center text-center w-full";
                
                currentSlide++;
                
                const next = document.getElementById(`slide-${currentSlide}`);
                next.className = "slide slide-active flex flex-col items-center text-center w-full";
                
                updateUI();
            }
        }

        function prevSlide() {
            if (currentSlide > 1) {
                const current = document.getElementById(`slide-${currentSlide}`);
                current.className = "slide slide-hidden flex flex-col items-center text-center w-full";
                
                currentSlide--;
                
                const prev = document.getElementById(`slide-${currentSlide}`);
                prev.className = "slide slide-active flex flex-col items-center text-center w-full";
                
                updateUI();
            }
        }

        function openAboutModal() {
            const modal = document.getElementById('about-modal');
            const content = document.getElementById('about-modal-content');
            modal.classList.remove('hidden');
            // Allow display block to apply before animating opacity/transform
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAboutModal() {
            const modal = document.getElementById('about-modal');
            const content = document.getElementById('about-modal-content');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>
