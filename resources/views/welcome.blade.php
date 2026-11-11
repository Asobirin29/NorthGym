<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NorthGym // APEX LAB — Kinetic Volt Brutalism Training Complex</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS with Design System Tokens -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                "on-secondary-fixed-variant": "#474646",
                "primary-glow-diffuse": "rgba(191, 255, 0, 0.15)",
                "tertiary-fixed-dim": "#bac8da",
                "secondary": "#c8c6c5",
                "error": "#ffb4ab",
                "status-error-container": "rgba(255, 42, 84, 0.15)",
                "on-surface": "#e5e2e1",
                "surface-container-lowest": "#0e0e0e",
                "border-default": "rgba(255, 255, 255, 0.08)",
                "surface-container-highest": "#353534",
                "primary-container": "#b8f600",
                "tertiary": "#ffffff",
                "surface-vault": "rgba(10, 10, 10, 0.85)",
                "text-muted": "rgba(255, 255, 255, 0.40)",
                "surface-dim": "#131313",
                "surface-tint": "#a1d800",
                "on-primary-container": "#506e00",
                "status-warning-container": "rgba(255, 184, 0, 0.15)",
                "primary": "#ffffff",
                "on-error-container": "#ffdad6",
                "on-tertiary-fixed-variant": "#3b4857",
                "inverse-surface": "#e5e2e1",
                "error-container": "#93000a",
                "on-tertiary-fixed": "#0f1d2a",
                "secondary-fixed": "#e5e2e1",
                "background": "#131313",
                "primary-hover-subtle": "rgba(191, 255, 0, 0.05)",
                "surface-container-low": "#1c1b1b",
                "surface-variant": "#353534",
                "on-tertiary": "#243240",
                "surface-card": "rgba(20, 20, 20, 0.75)",
                "surface-bright": "#3a3939",
                "secondary-fixed-dim": "#c8c6c5",
                "secondary-container": "#4a4949",
                "surface-container-high": "#2a2a2a",
                "primary-glow": "rgba(191, 255, 0, 0.35)",
                "on-surface-variant": "#c3caac",
                "outline": "#8d9479",
                "surface-container": "#201f1f",
                "on-secondary": "#313030",
                "primary-fixed-dim": "#a1d800",
                "on-primary-fixed": "#141f00",
                "on-primary": "#263500",
                "tertiary-container": "#d6e4f7",
                "on-tertiary-container": "#586676",
                "status-warning": "#FFB800",
                "inverse-primary": "#4b6700",
                "surface": "#131313",
                "on-primary-fixed-variant": "#384e00",
                "inverse-on-surface": "#313030",
                "on-secondary-container": "#bab8b7",
                "text-primary": "#FFFFFF",
                "primary-fixed": "#b8f600",
                "tertiary-fixed": "#d6e4f7",
                "text-tertiary": "rgba(255, 255, 255, 0.25)",
                "text-secondary": "rgba(255, 255, 255, 0.75)",
                "surface-glass": "rgba(15, 15, 15, 0.65)",
                "on-background": "#e5e2e1",
                "border-subtle": "rgba(255, 255, 255, 0.12)",
                "on-error": "#690005",
                "outline-variant": "#434933",
                "on-secondary-fixed": "#1c1b1b",
                "status-error": "#FF2A54"
              },
              "borderRadius": {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
              },
              "spacing": {
                "space-xs": "0.25rem",
                "space-xl": "2rem",
                "space-lg": "1.5rem",
                "space-sm": "0.5rem",
                "margin": "1rem",
                "margin-desktop": "2rem",
                "space-md": "1rem",
                "gutter-desktop": "2rem",
                "gutter": "1rem"
              },
              "fontFamily": {
                "body-base": ["Inter", "sans-serif"],
                "display-hero": ["Plus Jakarta Sans", "sans-serif"],
                "label-code": ["Geist", "monospace"],
                "label-tag": ["Geist", "monospace"],
                "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                "headline-sm": ["Plus Jakarta Sans", "sans-serif"],
                "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                "display-section-mobile": ["Plus Jakarta Sans", "sans-serif"],
                "display-hero-mobile": ["Plus Jakarta Sans", "sans-serif"],
                "display-section": ["Plus Jakarta Sans", "sans-serif"],
                "body-sm": ["Inter", "sans-serif"],
                "body-light": ["Inter", "sans-serif"],
                "label-meta": ["Geist", "monospace"]
              },
              "fontSize": {
                "body-base": ["16px", { "lineHeight": "26px", "letterSpacing": "0em", "fontWeight": "400" }],
                "display-hero": ["88px", { "lineHeight": "82px", "letterSpacing": "-0.05em", "fontWeight": "800" }],
                "label-code": ["13px", { "lineHeight": "18px", "letterSpacing": "0.08em", "fontWeight": "500" }],
                "label-tag": ["11px", { "lineHeight": "16px", "letterSpacing": "0.25em", "fontWeight": "600" }],
                "headline-md": ["36px", { "lineHeight": "40px", "letterSpacing": "-0.03em", "fontWeight": "800" }],
                "headline-sm": ["24px", { "lineHeight": "30px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                "headline-lg": ["44px", { "lineHeight": "48px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                "display-section-mobile": ["32px", { "lineHeight": "34px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                "display-hero-mobile": ["42px", { "lineHeight": "40px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                "display-section": ["56px", { "lineHeight": "56px", "letterSpacing": "-0.05em", "fontWeight": "800" }],
                "body-sm": ["13px", { "lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "400" }],
                "body-light": ["15px", { "lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "300" }],
                "label-meta": ["10px", { "lineHeight": "14px", "letterSpacing": "0.2em", "fontWeight": "500" }]
              }
            }
          }
        }
    </script>
    <style>
        /* Technical Grid Sub-Pixel Overlay */
        .bg-grid-telemetry {
          background-size: 40px 40px;
          background-image: 
            linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
        .neon-glow-btn {
          box-shadow: 0 0 25px rgba(184, 246, 0, 0.4);
        }
        .neon-glow-btn:hover {
          box-shadow: 0 0 35px rgba(184, 246, 0, 0.65);
        }
        .neon-glow-card {
          box-shadow: 0 0 30px rgba(184, 246, 0, 0.15);
        }
        /* Subtle pulsing volt dot */
        @keyframes voltPulse {
          0%, 100% { opacity: 1; transform: scale(1); filter: drop-shadow(0 0 6px #b8f600); }
          50% { opacity: 0.4; transform: scale(0.85); filter: drop-shadow(0 0 2px #b8f600); }
        }
        .pulse-volt {
          animation: voltPulse 2s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-surface-container-lowest text-text-primary antialiased selection:bg-primary-container selection:text-surface-container-lowest overflow-x-hidden min-h-screen flex flex-col relative bg-grid-telemetry">

    <!-- Tactical Radial Refraction Ambient Glows -->
    <div class="pointer-events-none fixed top-0 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-primary-container opacity-[0.07] blur-[160px] rounded-full z-0"></div>
    <div class="pointer-events-none fixed top-1/3 -left-48 w-[500px] h-[500px] bg-primary-container opacity-[0.05] blur-[140px] rounded-full z-0"></div>

    <!-- ==================== HEADER (TOPNAVBAR) ==================== -->
    <header class="docked full-width top-0 sticky z-50 bg-surface-glass backdrop-blur-md border-b border-border-default">
        <div class="flex justify-between items-center w-full px-margin-desktop max-w-7xl mx-auto h-20">
            <!-- Brand & Telemetry Dot -->
            <a class="flex items-center gap-space-sm group" href="{{ url('/') }}">
                <span class="w-2.5 h-2.5 bg-primary-container rounded-full pulse-volt"></span>
                <span class="text-headline-sm font-headline-sm font-extrabold uppercase tracking-tight text-text-primary">
                    NORTHGYM<span class="text-primary-container">//</span>APEX
                </span>
                <span class="text-label-meta font-label-meta text-primary-container border border-primary-container/30 px-1 py-0.5 ml-1 hidden sm:inline-block">
                    SYS.V2.4
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-primary-container font-label-code text-label-code tracking-widest border-b-2 border-primary-container pb-1" href="#programs">
                    01. PROGRAMS
                </a>
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="#biometrics">
                    02. BIOMETRICS
                </a>
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="#membership">
                    03. MEMBERSHIP
                </a>
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="#locations">
                    04. LOCATIONS
                </a>
            </nav>

            <!-- Trailing CTAs -->
            <div class="flex items-center gap-space-md">
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a class="bg-primary-container text-surface-container-lowest font-headline-sm font-extrabold text-[12px] tracking-widest uppercase px-5 py-3 rounded-DEFAULT hover:scale-105 transition-all duration-300 neon-glow-btn flex items-center gap-1.5" href="{{ url('/admin') }}">
                                <span>COMMAND DASHBOARD</span>
                                <span class="material-symbols-outlined text-[16px] font-bold">terminal</span>
                            </a>
                        @else
                            <a class="bg-primary-container text-surface-container-lowest font-headline-sm font-extrabold text-[12px] tracking-widest uppercase px-5 py-3 rounded-DEFAULT hover:scale-105 transition-all duration-300 neon-glow-btn flex items-center gap-1.5" href="{{ route('member.dashboard') }}">
                                <span>MEMBER PORTAL</span>
                                <span class="material-symbols-outlined text-[16px] font-bold">space_dashboard</span>
                            </a>
                        @endif
                    @else
                        <a class="hidden sm:inline-block text-label-code font-label-code tracking-widest text-text-muted hover:text-primary-container transition-colors py-2 px-3" href="{{ route('login') }}">
                            MEMBER LOGIN
                        </a>
                        @if (Route::has('register'))
                            <a class="bg-primary-container text-surface-container-lowest font-headline-sm font-extrabold text-[12px] tracking-widest uppercase px-5 py-3 rounded-DEFAULT hover:scale-105 transition-all duration-300 neon-glow-btn flex items-center gap-1.5" href="{{ route('register') }}">
                                <span>JOIN THE CULT</span>
                                <span class="material-symbols-outlined text-[16px] font-bold">arrow_forward</span>
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- ==================== HERO SECTION ==================== -->
    <section class="relative pt-space-xl pb-24 md:pt-28 md:pb-36 z-10 px-margin-desktop max-w-7xl mx-auto w-full">
        <!-- Top Telemetry Status Pill -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-surface-glass border border-border-default mb-8 backdrop-blur-md rounded-DEFAULT">
            <span class="w-1.5 h-1.5 bg-primary-container rounded-full pulse-volt"></span>
            <span class="text-label-tag font-label-tag text-text-secondary uppercase">
                [ SYS.STATUS: 24/7 ACCESS ACTIVE // LOC: JAKARTA // 64% CAPACITY ]
            </span>
        </div>

        <!-- Massive Stacked Kinetic Headline -->
        <div class="max-w-5xl">
            <h1 class="text-display-hero-mobile md:text-display-hero font-display-hero text-text-primary uppercase tracking-tight mb-6">
                ENGINEER YOUR <br class="hidden sm:block"/>
                <span class="text-primary-container drop-shadow-[0_0_25px_rgba(184,246,0,0.4)]">PEAK</span> STATE.
            </h1>
            <p class="text-body-base font-body-base text-text-secondary max-w-2xl text-base md:text-lg mb-10 leading-relaxed font-light">
                NORTHGYM APEX//LAB menggabungkan adaptasi neuromuskular kecepatan tinggi, siklus latihan berpanduan laktat, dan telemetri kinetik real-time. Dirancang eksklusif untuk atlet hibrida dan optimasi performa puncak.
            </p>

            <!-- Dual Actions -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-space-md mb-16">
                <a class="h-[52px] px-8 bg-primary-container text-surface-container-lowest font-headline-sm font-extrabold text-[13px] tracking-widest uppercase flex items-center justify-center rounded-DEFAULT hover:scale-[1.02] transition-all duration-300 neon-glow-btn" href="{{ route('register') }}">
                    INITIALIZE MEMBERSHIP
                </a>
                <a class="h-[52px] px-8 bg-surface-glass border border-border-subtle hover:border-primary-container text-text-primary hover:text-primary-container font-label-code text-label-code uppercase flex items-center justify-center gap-2 rounded-DEFAULT backdrop-blur-md transition-all duration-300" href="#programs">
                    <span>EXPLORE PROTOCOLS</span>
                    <span class="material-symbols-outlined text-[16px]">sensors</span>
                </a>
            </div>
        </div>

        <!-- Live Telemetry Status Ticker -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-5 bg-surface-vault border border-border-default backdrop-blur-md rounded-DEFAULT">
            <div class="border-l-2 border-primary-container pl-3 py-1">
                <div class="text-label-meta font-label-meta text-text-muted uppercase">FACILITY OCCUPANCY</div>
                <div class="text-headline-sm font-headline-sm text-text-primary flex items-baseline gap-2">
                    64% <span class="text-label-meta font-label-meta text-primary-container font-normal">OPTIMAL FLOW</span>
                </div>
            </div>
            <div class="border-l-2 border-border-subtle pl-3 py-1">
                <div class="text-label-meta font-label-meta text-text-muted uppercase">HEART RATE BIO-SYNC</div>
                <div class="text-headline-sm font-headline-sm text-text-primary flex items-baseline gap-2">
                    ACTIVE <span class="text-label-meta font-label-meta text-primary-container font-normal">ANT+ / BLE</span>
                </div>
            </div>
            <div class="border-l-2 border-border-subtle pl-3 py-1">
                <div class="text-label-meta font-label-meta text-text-muted uppercase">CRYO CHAMBER CORE</div>
                <div class="text-headline-sm font-headline-sm text-text-primary flex items-baseline gap-2">
                    -110°C <span class="text-label-meta font-label-meta text-primary-container font-normal">STABILIZED</span>
                </div>
            </div>
            <div class="border-l-2 border-primary-container pl-3 py-1">
                <div class="text-label-meta font-label-meta text-text-muted uppercase">FACILITY POWER OUTPUT</div>
                <div class="text-headline-sm font-headline-sm text-text-primary flex items-baseline gap-2">
                    88.4% <span class="text-label-meta font-label-meta text-primary-container font-normal">HIGH TENSION</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 01 // DISCIPLINES (BENTO GRID) ==================== -->
    <section class="relative py-space-xl border-t border-border-default z-10 px-margin-desktop max-w-7xl mx-auto w-full" id="programs">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <div class="text-label-tag font-label-tag text-primary-container uppercase tracking-widest mb-2">
                    [ 01 // DISCIPLINES ]
                </div>
                <h2 class="text-display-section-mobile md:text-display-section font-display-section text-text-primary uppercase tracking-tight">
                    PROGRAM DIRECTIVES
                </h2>
            </div>
            <p class="text-text-muted font-body-base max-w-md mt-4 md:mt-0 text-sm">
                Jalur latihan mesin presisi dengan sensor kecepatan barbell real-time, force plates, dan hyper-baric biological reset pods.
            </p>
        </div>

        <!-- Asymmetric Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Bento 1: Hypertophy Lab (Span 7 cols) -->
            <div class="md:col-span-7 bg-surface-card border border-border-default p-8 relative overflow-hidden group hover:border-primary-container transition-all duration-300">
                <div class="absolute top-0 right-0 p-4 font-label-code text-label-code text-text-muted tracking-widest">
                    MOD.01 / LOAD
                </div>
                <!-- Corner Brackets -->
                <div class="w-3 h-3 border-t-2 border-l-2 border-primary-container absolute top-3 left-3 opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <div class="inline-block px-2.5 py-1 bg-surface-glass border border-border-subtle text-label-meta font-label-meta text-primary-container uppercase mb-6">
                            FORCE PRODUCTION // BARBELL TELEMETRY
                        </div>
                        <h3 class="text-headline-md font-headline-md text-text-primary uppercase mb-3">
                            HYPERTROPHY LAB
                        </h3>
                        <p class="text-text-secondary font-body-base text-sm max-w-lg mb-8">
                            Progressive overload terkalibrasi dengan linear position transducers. Bar-speed feedback real-time memastikan stimulasi neural maksimal tanpa kelelahan berlebih.
                        </p>
                    </div>
                    <div class="space-y-4">
                        <div class="h-44 w-full relative overflow-hidden border border-border-default">
                            <img class="w-full h-full object-cover object-center grayscale contrast-125 brightness-90 group-hover:scale-105 transition-transform duration-700" 
                                 src="{{ asset('images/landing/hypertrophy-lab.jpg') }}" 
                                 alt="Olympic Barbell Lifter"/>
                            <div class="absolute bottom-2 left-2 bg-surface-vault px-2 py-0.5 border border-border-subtle text-label-meta font-label-meta text-primary-container">
                                TENSION: 420KG / SENSOR PEAK
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-border-default">
                            <div class="flex gap-4 text-label-code font-label-code text-text-muted text-xs">
                                <span>VELOCITY SYNC</span>
                                <span>•</span>
                                <span>RPE AUTOREGULATION</span>
                            </div>
                            <a class="inline-flex items-center gap-1.5 text-primary-container font-label-code text-label-code tracking-wider hover:translate-x-1 transition-transform" href="{{ route('register') }}">
                                ENGAGE <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bento 2: Metabolic Conditioning (Span 5 cols) -->
            <div class="md:col-span-5 bg-surface-card border border-border-default p-8 relative overflow-hidden group hover:border-primary-container transition-all duration-300">
                <div class="absolute top-0 right-0 p-4 font-label-code text-label-code text-text-muted tracking-widest">
                    MOD.02 / VELOCITY
                </div>
                <div class="w-3 h-3 border-t-2 border-l-2 border-primary-container absolute top-3 left-3 opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <div class="inline-block px-2.5 py-1 bg-surface-glass border border-border-subtle text-label-meta font-label-meta text-primary-container uppercase mb-6">
                            VO2 MAX // LACTATE MATRIX
                        </div>
                        <h3 class="text-headline-md font-headline-md text-text-primary uppercase mb-3">
                            METABOLIC CONDITIONING
                        </h3>
                        <p class="text-text-secondary font-body-base text-sm mb-6">
                            Interval ambang batas kecepatan tinggi untuk meningkatkan cadangan anaerobik Anda. Monitoring laktat dan laju pernapasan kontinyu.
                        </p>
                    </div>
                    <div class="space-y-4">
                        <div class="h-44 w-full relative overflow-hidden border border-border-default">
                            <img class="w-full h-full object-cover object-center grayscale contrast-125 brightness-90 group-hover:scale-105 transition-transform duration-700" 
                                 src="{{ asset('images/landing/metabolic-conditioning.jpg') }}" 
                                 alt="Tactical Sled Athlete"/>
                            <div class="absolute bottom-2 left-2 bg-surface-vault px-2 py-0.5 border border-border-subtle text-label-meta font-label-meta text-primary-container">
                                HEART RATE: 184 BPM // ZONE 5
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-border-default">
                            <span class="text-label-code font-label-code text-text-muted text-xs">ANAEROBIC BUFFERING</span>
                            <a class="inline-flex items-center gap-1.5 text-primary-container font-label-code text-label-code tracking-wider hover:translate-x-1 transition-transform" href="{{ route('register') }}">
                                ENGAGE <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bento 3: Recovery & Cryo (Span 12 cols Full Width Banner) -->
            <div class="md:col-span-12 bg-surface-card border border-border-default p-8 relative overflow-hidden group hover:border-primary-container transition-all duration-300">
                <div class="absolute top-0 right-0 p-4 font-label-code text-label-code text-text-muted tracking-widest">
                    MOD.03 / REGEN
                </div>
                <div class="w-3 h-3 border-t-2 border-l-2 border-primary-container absolute top-3 left-3 opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7">
                        <div class="inline-block px-2.5 py-1 bg-surface-glass border border-border-subtle text-label-meta font-label-meta text-primary-container uppercase mb-4">
                            CNS REBOOT // HYPERBARIC & NITROGEN
                        </div>
                        <h3 class="text-headline-md font-headline-md text-text-primary uppercase mb-3">
                            RECOVERY & CRYO LAB
                        </h3>
                        <p class="text-text-secondary font-body-base text-sm max-w-xl mb-6">
                            Chamber nitrogen cryotherapy sub-zero hingga -110°C, dipadukan dengan ranjang photobiomodulation infra-merah 660nm dan sistem pembersihan limfatik pneumatik. Reboot baseline seluler dalam 18 menit.
                        </p>
                        <div class="grid grid-cols-3 gap-4 border-t border-border-default pt-4 mb-6">
                            <div>
                                <span class="text-label-meta font-label-meta text-text-muted block">TEMP FLOOR</span>
                                <span class="text-headline-sm font-headline-sm text-text-primary">-110°C</span>
                            </div>
                            <div>
                                <span class="text-label-meta font-label-meta text-text-muted block">PHOTON SPECTRUM</span>
                                <span class="text-headline-sm font-headline-sm text-text-primary">850 NM</span>
                            </div>
                            <div>
                                <span class="text-label-meta font-label-meta text-text-muted block">CNS FLUSH DURATION</span>
                                <span class="text-headline-sm font-headline-sm text-text-primary">12 MIN</span>
                            </div>
                        </div>
                        <a class="inline-flex items-center gap-2 text-primary-container font-label-code text-label-code tracking-widest uppercase hover:translate-x-1 transition-transform" href="{{ route('register') }}">
                            ACCESS RECOVERY VAULT <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                    <div class="lg:col-span-5 h-56 md:h-64 relative border border-border-default overflow-hidden">
                        <img class="w-full h-full object-cover object-center grayscale contrast-125 brightness-90 group-hover:scale-105 transition-transform duration-700" 
                             src="{{ asset('images/landing/recovery-cryo.jpg') }}" 
                             alt="Cryotherapy Chamber"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-3 left-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-primary-container rounded-full pulse-volt"></span>
                            <span class="text-label-meta font-label-meta text-text-primary tracking-widest uppercase">CHAMBER 04 READY</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 02 // BIOMETRICS (FACILITY TELEMETRY) ==================== -->
    <section class="relative py-space-xl border-t border-border-default z-10 px-margin-desktop max-w-7xl mx-auto w-full" id="biometrics">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
            <div>
                <div class="text-label-tag font-label-tag text-primary-container uppercase tracking-widest mb-2">
                    [ 02 // BIOMETRICS ]
                </div>
                <h2 class="text-display-section-mobile md:text-display-section font-display-section text-text-primary uppercase tracking-tight">
                    PERFORMANCE TELEMETRY
                </h2>
            </div>
            <div class="text-label-code font-label-code text-text-muted mt-4 md:mt-0">
                [ SYSTEM LATENCY: 0.02S // PROTOCOL TLS-256 ]
            </div>
        </div>

        <!-- Stat Telemetry Counter Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <div class="bg-surface-vault p-6 border border-border-default relative">
                <div class="text-label-meta font-label-meta text-primary-container uppercase mb-2">OPERATIONAL FREQUENCY</div>
                <div class="text-display-section-mobile font-headline-lg text-text-primary mb-2">24/7</div>
                <p class="text-text-muted font-body-sm text-xs leading-normal">
                    Akses turnstile biometrik tanpa kompromi dengan pengenalan optik iris instan.
                </p>
            </div>
            <div class="bg-surface-vault p-6 border border-border-default relative">
                <div class="text-label-meta font-label-meta text-primary-container uppercase mb-2">TELEMETRY LATENCY</div>
                <div class="text-display-section-mobile font-headline-lg text-text-primary mb-2">0.02<span class="text-headline-sm font-headline-sm text-primary-container">S</span></div>
                <p class="text-text-muted font-body-sm text-xs leading-normal">
                    Agregasi data zero-delay di seluruh barbell transducer dan monitor metabolik.
                </p>
            </div>
            <div class="bg-surface-vault p-6 border border-border-default relative">
                <div class="text-label-meta font-label-meta text-primary-container uppercase mb-2">BIO-RETENTION RATE</div>
                <div class="text-display-section-mobile font-headline-lg text-text-primary mb-2">99.8<span class="text-headline-sm font-headline-sm text-primary-container">%</span></div>
                <p class="text-text-muted font-body-sm text-xs leading-normal">
                    Kepatuhan protokol atlet dengan peningkatan kekuatan & ketahanan terukur.
                </p>
            </div>
            <div class="bg-surface-vault p-6 border border-border-default relative">
                <div class="text-label-meta font-label-meta text-primary-container uppercase mb-2">CALIBRATED PLATFORMS</div>
                <div class="text-display-section-mobile font-headline-lg text-text-primary mb-2">50<span class="text-primary-container">+</span></div>
                <p class="text-text-muted font-body-sm text-xs leading-normal">
                    Stasiun kompetisi Eleiko IPF/IWF terintegrasi dengan load-cell metrics kontinyu.
                </p>
            </div>
        </div>

        <!-- Live Dark Terminal Telemetry Stream -->
        <div class="bg-surface-container-lowest border border-border-default p-6 font-label-code text-label-code relative overflow-hidden">
            <div class="flex items-center justify-between border-b border-border-default pb-4 mb-4">
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 bg-primary-container rounded-full pulse-volt"></span>
                    <span class="text-text-primary font-bold uppercase tracking-wider text-xs">
                        LIVE BIO-STATION TELEMETRY STREAM // NODE #09
                    </span>
                </div>
                <span class="text-text-muted text-[11px] hidden sm:inline">DATA_RATE: 120Hz STREAMING</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-text-secondary">
                <div class="space-y-2 border-l border-border-subtle pl-4">
                    <div class="text-text-muted text-[10px] tracking-widest">[ RACK_ALPHA_01 ]</div>
                    <div class="flex justify-between"><span>SQUAT LOAD:</span> <span class="text-text-primary font-mono font-bold">220.0 KG</span></div>
                    <div class="flex justify-between"><span>MEAN CONCENTRIC VELOCITY:</span> <span class="text-primary-container font-mono font-bold">0.68 M/S</span></div>
                    <div class="flex justify-between"><span>PEAK GROUND FORCE:</span> <span class="text-text-primary font-mono">2,840 N</span></div>
                </div>
                <div class="space-y-2 border-l border-border-subtle pl-4">
                    <div class="text-text-muted text-[10px] tracking-widest">[ TREAD_BETA_04 ]</div>
                    <div class="flex justify-between"><span>PACE:</span> <span class="text-text-primary font-mono font-bold">2:48 MIN/KM</span></div>
                    <div class="flex justify-between"><span>ESTIMATED VO2:</span> <span class="text-primary-container font-mono font-bold">64.2 ML/KG</span></div>
                    <div class="flex justify-between"><span>BLOOD LACTATE EST:</span> <span class="text-text-primary font-mono">4.1 MMOL/L</span></div>
                </div>
                <div class="space-y-2 border-l border-border-subtle pl-4">
                    <div class="text-text-muted text-[10px] tracking-widest">[ CRYO_CHAMBER_02 ]</div>
                    <div class="flex justify-between"><span>CORE AMBIENT:</span> <span class="text-primary-container font-mono font-bold">-112.4°C</span></div>
                    <div class="flex justify-between"><span>SKIN RECEPTOR DROP:</span> <span class="text-text-primary font-mono font-bold">-8.2°C</span></div>
                    <div class="flex justify-between"><span>POD STATUS:</span> <span class="text-text-primary font-mono">OCCUPIED [2:14 REMAINING]</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== 03 // ACCESS TIERS (MEMBERSHIP) ==================== -->
    <section class="relative py-space-xl border-t border-border-default z-10 px-margin-desktop max-w-7xl mx-auto w-full" id="membership">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="text-label-tag font-label-tag text-primary-container uppercase tracking-widest mb-3">
                [ 03 // ACCESS TIERS ]
            </div>
            <h2 class="text-display-section-mobile md:text-display-section font-display-section text-text-primary uppercase tracking-tight mb-4">
                CHOOSE YOUR PROTOCOL
            </h2>
            <p class="text-text-muted font-body-base text-sm">
                Tentukan komitmen latihan Anda. Seluruh tier dilengkapi tracking telemetri industri dan akses keycard 24/7.
            </p>
        </div>

        <!-- 3-Column Pricing Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            <!-- Plan 1: Base Access -->
            <div class="bg-surface-vault border border-border-default p-8 flex flex-col justify-between rounded-DEFAULT hover:border-border-subtle transition-all">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-label-meta font-label-meta text-text-muted uppercase tracking-widest">TIER 01</span>
                            <h3 class="text-headline-sm font-headline-sm text-text-primary uppercase mt-1">BASE ACCESS</h3>
                        </div>
                    </div>
                    <p class="text-text-muted font-body-sm text-xs mb-6">
                        Akses lantai standar untuk lifter independen dan latihan conditioning terstruktur.
                    </p>
                    <div class="mb-8">
                        <span class="text-headline-lg font-headline-lg text-text-primary">Rp 450K</span>
                        <span class="text-label-code font-label-code text-text-muted">/ BULAN</span>
                    </div>
                    <div class="space-y-3 border-t border-border-default pt-6 mb-8 text-xs font-label-code text-text-secondary">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Akses Fasilitas 24/7 Biometrik Tanpa Batas</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Full Weight Room Eleiko Calibrated</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Aplikasi Member Bio-Logging Standard</span>
                        </div>
                        <div class="flex items-center gap-2 text-text-muted">
                            <span class="material-symbols-outlined text-text-muted text-base">close</span>
                            <span>Cryotherapy & Nitrogen Pods (Pay-per-use)</span>
                        </div>
                        <div class="flex items-center gap-2 text-text-muted">
                            <span class="material-symbols-outlined text-text-muted text-base">close</span>
                            <span>Dedicated Performance Director</span>
                        </div>
                    </div>
                </div>
                <a class="w-full h-[48px] bg-surface-glass border border-border-subtle hover:border-primary-container text-text-primary hover:text-primary-container font-label-code text-label-code uppercase flex items-center justify-center transition-all" href="{{ route('register') }}">
                    SELECT PROTOCOL
                </a>
            </div>

            <!-- Plan 2: Pro Athlete (Featured / Elevated) -->
            <div class="bg-surface-card border-2 border-primary-container p-8 flex flex-col justify-between rounded-DEFAULT relative neon-glow-card transform lg:-translate-y-2">
                <!-- Diffuse Volt Glow behind card -->
                <div class="pointer-events-none absolute -inset-2 bg-primary-container opacity-10 blur-xl -z-10"></div>
                <!-- Header Recommended Badge -->
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-primary-container text-surface-container-lowest px-3 py-0.5 font-label-tag text-[10px] tracking-widest font-extrabold uppercase">
                    [ RECOMMENDED PROTOCOL ]
                </div>
                <div>
                    <div class="flex justify-between items-start mb-4 mt-2">
                        <div>
                            <span class="text-label-meta font-label-meta text-primary-container uppercase tracking-widest">TIER 02 // ELEVATED</span>
                            <h3 class="text-headline-sm font-headline-sm text-text-primary uppercase mt-1">PRO ATHLETE</h3>
                        </div>
                        <span class="px-2 py-0.5 bg-primary-hover-subtle border border-primary-container text-primary-container font-label-meta text-[10px]">
                            POPULAR
                        </span>
                    </div>
                    <p class="text-text-secondary font-body-sm text-xs mb-6">
                        Didesain untuk lifter kompetitif, atlet HYROX, dan target rekomposisi tubuh serius.
                    </p>
                    <div class="mb-8">
                        <span class="text-headline-lg font-headline-lg text-text-primary">Rp 850K</span>
                        <span class="text-label-code font-label-code text-text-muted">/ BULAN</span>
                    </div>
                    <div class="space-y-3 border-t border-border-default pt-6 mb-8 text-xs font-label-code text-text-secondary">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Seluruh Fitur Base Access</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Sinkronisasi Transducer & Biometrik Real-Time</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>4x Sesi Bulanan Cryotherapy & Red-Light</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Program Latihan Neuromuscular Terpersonalisasi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Prioritas Booking Zona Training High-Flux</span>
                        </div>
                    </div>
                </div>
                <a class="w-full h-[52px] bg-primary-container text-surface-container-lowest font-headline-sm font-extrabold text-[12px] tracking-widest uppercase flex items-center justify-center neon-glow-btn transition-all" href="{{ route('register') }}">
                    ACTIVATE PRO →
                </a>
            </div>

            <!-- Plan 3: Black Card / Elite -->
            <div class="bg-surface-vault border border-border-default p-8 flex flex-col justify-between rounded-DEFAULT hover:border-border-subtle transition-all">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-label-meta font-label-meta text-text-muted uppercase tracking-widest">TIER 03</span>
                            <h3 class="text-headline-sm font-headline-sm text-text-primary uppercase mt-1">BLACK CARD / ELITE</h3>
                        </div>
                    </div>
                    <p class="text-text-muted font-body-sm text-xs mb-6">
                        Tingkat komando tertinggi: restorasi biologis tak terbatas & akses langsung ke performance director.
                    </p>
                    <div class="mb-8">
                        <span class="text-headline-lg font-headline-lg text-text-primary">Rp 1.500K</span>
                        <span class="text-label-code font-label-code text-text-muted">/ BULAN</span>
                    </div>
                    <div class="space-y-3 border-t border-border-default pt-6 mb-8 text-xs font-label-code text-text-secondary">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Akses Tanpa Batas Cryo, Hyperbaric & Inframerah</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Dedicated 1-on-1 Performance Director</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Private VIP Biometric Suite & Locker Room</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Hak Roaming Antar Cabang Fasilitas</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-container text-base">check</span>
                            <span>Review Komposisi Tubuh & Biomarker Bulanan</span>
                        </div>
                    </div>
                </div>
                <a class="w-full h-[48px] bg-surface-glass border border-border-subtle hover:border-primary-container text-text-primary hover:text-primary-container font-label-code text-label-code uppercase flex items-center justify-center transition-all" href="{{ route('register') }}">
                    REQUEST INVITATION
                </a>
            </div>
        </div>
    </section>

    <!-- ==================== ATHLETE TELEMETRY / TESTIMONIALS ==================== -->
    <section class="relative py-space-xl border-t border-border-default z-10 px-margin-desktop max-w-7xl mx-auto w-full">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <div class="text-label-tag font-label-tag text-primary-container uppercase tracking-widest mb-2">
                    [ 04 // OPERATIVES ]
                </div>
                <h2 class="text-display-section-mobile md:text-display-section font-display-section text-text-primary uppercase tracking-tight">
                    ATHLETE TELEMETRY
                </h2>
            </div>
            <p class="text-text-muted font-body-base text-xs max-w-xs">
                Bukti empiris nyata: validasi force output terukur, pembersihan asam laktat cepat, dan rekor personal (PR).
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Testimonial 1 -->
            <div class="bg-surface-card border border-border-default p-6 relative flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-border-default pb-3 mb-4">
                        <span class="text-label-code font-label-code text-primary-container text-xs">LOG #8842</span>
                        <span class="text-label-meta font-label-meta text-text-muted">14 DAYS AGO</span>
                    </div>
                    <p class="text-text-secondary font-body-base text-sm mb-6 leading-relaxed">
                        "Linear position transducer pada rack mengubah dinamika lockout deadlift saya sepenuhnya. Dalam 8 minggu, 1RM saya naik dari 265kg ke 287.5kg tanpa kelelahan punggung bawah."
                    </p>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 border border-primary-container/40 flex items-center justify-center bg-surface-vault text-primary-container font-bold font-label-code">
                            MK
                        </div>
                        <div>
                            <div class="text-headline-sm font-headline-sm text-text-primary text-sm uppercase">MARCUS K.</div>
                            <div class="text-label-meta font-label-meta text-text-muted">HYBRID POWERLIFTER // PRO TIER</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-border-default flex justify-between text-label-meta font-label-meta text-primary-container">
                        <span>PR: +22.5KG</span>
                        <span>LACTATE: -1.8 MMOL</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-surface-card border border-border-default p-6 relative flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-border-default pb-3 mb-4">
                        <span class="text-label-code font-label-code text-primary-container text-xs">LOG #9120</span>
                        <span class="text-label-meta font-label-meta text-text-muted">3 DAYS AGO</span>
                    </div>
                    <p class="text-text-secondary font-body-base text-sm mb-6 leading-relaxed">
                        "Protokol cryo lab pasca-interval memangkas inflamasi sistemik secara radikal. Saya bisa latihan double-threshold tanpa rasa lelah saraf berat."
                    </p>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 border border-primary-container/40 flex items-center justify-center bg-surface-vault text-primary-container font-bold font-label-code">
                            SV
                        </div>
                        <div>
                            <div class="text-headline-sm font-headline-sm text-text-primary text-sm uppercase">SARAH V.</div>
                            <div class="text-label-meta font-label-meta text-text-muted">HYROX ELITE // BLACK CARD</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-border-default flex justify-between text-label-meta font-label-meta text-primary-container">
                        <span>VO2 MAX: 68.4</span>
                        <span>RESTING HR: 39 BPM</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-surface-card border border-border-default p-6 relative flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-border-default pb-3 mb-4">
                        <span class="text-label-code font-label-code text-primary-container text-xs">LOG #7731</span>
                        <span class="text-label-meta font-label-meta text-text-muted">YESTERDAY</span>
                    </div>
                    <p class="text-text-secondary font-body-base text-sm mb-6 leading-relaxed">
                        "Ini bukan sekadar gym, ini cockpit biomekanik bervoltase tinggi. Anda tidak bingung memilih latihan, telemetry stream memandu setiap repetisi dan eccentric load."
                    </p>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 border border-primary-container/40 flex items-center justify-center bg-surface-vault text-primary-container font-bold font-label-code">
                            DR
                        </div>
                        <div>
                            <div class="text-headline-sm font-headline-sm text-text-primary text-sm uppercase">DARIUS R.</div>
                            <div class="text-label-meta font-label-meta text-text-muted">TACTICAL OPERATOR // PRO TIER</div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-border-default flex justify-between text-label-meta font-label-meta text-primary-container">
                        <span>PEAK POWER: +340W</span>
                        <span>BODY FAT: -4.2%</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FACILITY LOCATIONS PREVIEW ==================== -->
    <section class="relative py-space-xl border-t border-border-default z-10 px-margin-desktop max-w-7xl mx-auto w-full" id="locations">
        <div class="bg-surface-vault border border-border-default p-8 lg:p-12 relative overflow-hidden">
            <!-- Glow background -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary-container opacity-10 blur-3xl pointer-events-none"></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="text-label-tag font-label-tag text-primary-container uppercase tracking-widest mb-3">
                        [ FACILITY NETWORK // GLOBAL NODES ]
                    </div>
                    <h2 class="text-headline-lg font-headline-lg text-text-primary uppercase mb-4">
                        TEMUKAN APEX VAULT TERDEKAT
                    </h2>
                    <p class="text-text-secondary font-body-base text-sm mb-8 leading-relaxed">
                        Fasilitas modern dengan akses biometrik terenkripsi yang saling terhubung antar cabang pusat di Jakarta dan kota utama lainnya.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3.5 bg-surface-container-lowest border border-border-default">
                            <div>
                                <div class="text-headline-sm font-headline-sm text-text-primary text-base uppercase">JAKARTA ALPHA VAULT</div>
                                <div class="text-label-meta font-label-meta text-text-muted">SCBD LOT 11 // TELEMETRY: ACTIVE</div>
                            </div>
                            <span class="px-2 py-1 bg-primary-hover-subtle text-primary-container border border-primary-container font-label-meta text-[10px]">
                                64% LOAD
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-3.5 bg-surface-container-lowest border border-border-default">
                            <div>
                                <div class="text-headline-sm font-headline-sm text-text-primary text-base uppercase">NORTH GYM HQ DOWNTOWN</div>
                                <div class="text-label-meta font-label-meta text-text-muted">CENTRAL DISTRICT // TELEMETRY: ACTIVE</div>
                            </div>
                            <span class="px-2 py-1 bg-surface-glass text-text-muted border border-border-subtle font-label-meta text-[10px]">
                                48% LOAD
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-3.5 bg-surface-container-lowest border border-border-default">
                            <div>
                                <div class="text-headline-sm font-headline-sm text-text-primary text-base uppercase">SUB-BASE EXPANSION</div>
                                <div class="text-label-meta font-label-meta text-text-muted">NORTH REGION // COMMISSIONING Q4</div>
                            </div>
                            <span class="px-2 py-1 bg-status-warning-container text-status-warning border border-status-warning/40 font-label-meta text-[10px]">
                                PRE-LAUNCH
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative h-72 lg:h-96 border border-border-default overflow-hidden">
                    <img class="w-full h-full object-cover object-center grayscale contrast-150 brightness-75" 
                         src="{{ asset('images/landing/facility-location.jpg') }}" 
                         alt="High-Tech Gym Floor"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest via-transparent to-transparent"></div>
                    <div class="absolute top-4 left-4 font-label-code text-label-code text-primary-container bg-surface-vault px-2.5 py-1 border border-border-default">
                        JAKARTA SECTOR // 45.4215° N, 75.6972° W
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="docked full-width bottom bg-surface-vault border-t border-border-default">
        <div class="w-full px-margin-desktop py-space-xl max-w-7xl mx-auto flex flex-col gap-space-lg">
            <!-- Top Row: Brand & Telemetry Subscription -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start justify-between border-b border-border-default pb-10">
                <div class="md:col-span-5">
                    <div class="flex items-center gap-space-sm mb-3">
                        <span class="w-2.5 h-2.5 bg-primary-container rounded-full pulse-volt"></span>
                        <span class="text-headline-sm font-headline-sm font-extrabold tracking-wider text-text-primary">
                            NORTHGYM<span class="text-primary-container">//</span>APEX LAB
                        </span>
                    </div>
                    <p class="text-text-muted font-body-sm text-xs max-w-sm mb-4">
                        NORTHGYM CORPORATION // KINETIC VOLT BRUTALISM. Engineering peak human biological adaptation via hardware-level bio-telemetry.
                    </p>
                    <div class="text-label-meta font-label-meta text-primary-container">
                        STATUS: ALL FACILITY CORES OPERATIONAL
                    </div>
                </div>

                <!-- Terminal Broadcast Dispatch Input -->
                <div class="md:col-span-7 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-grow">
                        <input class="w-full h-[52px] bg-surface-container-lowest border border-border-default focus:border-primary-container text-text-primary text-xs font-label-code px-4 rounded-DEFAULT outline-none transition-colors" 
                               placeholder="ENTER OPERATIVE FREQUENCY (EMAIL)" 
                               type="email"/>
                    </div>
                    <a href="{{ route('register') }}" class="h-[52px] px-6 bg-primary-container text-surface-container-lowest font-headline-sm font-extrabold text-xs tracking-widest uppercase hover:scale-105 transition-all neon-glow-btn flex items-center justify-center">
                        DISPATCH
                    </a>
                </div>
            </div>

            <!-- Center Links Matrix -->
            <div class="flex flex-wrap gap-x-8 gap-y-3 font-label-code text-label-code">
                <a class="text-primary-container font-label-code text-label-code" href="#">
                    TERMINAL STATUS: ACTIVE
                </a>
                <a class="text-text-muted font-label-code text-label-code hover:text-primary-container transition-colors duration-200" href="#">
                    PRIVACY PROTOCOL
                </a>
                <a class="text-text-muted font-label-code text-label-code hover:text-primary-container transition-colors duration-200" href="#">
                    SECURITY TLS-256
                </a>
                <a class="text-text-muted font-label-code text-label-code hover:text-primary-container transition-colors duration-200" href="#">
                    BIOMETRIC COMPLIANCE
                </a>
                <a class="text-text-muted font-label-code text-label-code hover:text-primary-container transition-colors duration-200" href="{{ route('login') }}">
                    PORTAL LOGIN
                </a>
            </div>

            <!-- Bottom Copyright & Coordinates -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center text-label-meta font-label-meta text-text-muted pt-4 border-t border-border-default/50 gap-2">
                <div>
                    © {{ date('Y') }} NORTHGYM CORP. TELEMETRY COORD: [45.4215° N, 75.6972° W] // ALL RIGHTS RESERVED. HIGH-VOLTAGE KINETIC BRUTALISM.
                </div>
                <div class="text-primary-container">
                    SECURE PROTOCOL ESTABLISHED
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
