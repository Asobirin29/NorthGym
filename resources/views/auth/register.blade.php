<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NorthGym // APEX LAB — New Athlete Registration Protocol</title>

    <!-- Google Fonts: Plus Jakarta Sans, Inter, Geist -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Tailwind Theme Configuration Verbatim from Stitch -->
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                "on-tertiary": "#243240",
                "background": "#131313",
                "tertiary": "#ffffff",
                "primary-fixed-dim": "#a1d800",
                "error-container": "#93000a",
                "on-primary-fixed": "#141f00",
                "text-muted": "rgba(255, 255, 255, 0.40)",
                "primary-fixed": "#b8f600",
                "primary": "#ffffff",
                "secondary-fixed-dim": "#c8c6c5",
                "surface-container-high": "#2a2a2a",
                "on-background": "#e5e2e1",
                "tertiary-fixed-dim": "#bac8da",
                "surface-bright": "#3a3939",
                "primary-container": "#b8f600",
                "inverse-surface": "#e5e2e1",
                "surface-vault": "rgba(10, 10, 10, 0.85)",
                "text-tertiary": "rgba(255, 255, 255, 0.25)",
                "status-warning-container": "rgba(255, 184, 0, 0.15)",
                "surface-container-low": "#1c1b1b",
                "text-primary": "#FFFFFF",
                "status-warning": "#FFB800",
                "on-error-container": "#ffdad6",
                "status-error": "#FF2A54",
                "secondary-fixed": "#e5e2e1",
                "surface-container-highest": "#353534",
                "error": "#ffb4ab",
                "status-error-container": "rgba(255, 42, 84, 0.15)",
                "on-surface": "#e5e2e1",
                "text-secondary": "rgba(255, 255, 255, 0.75)",
                "surface": "#131313",
                "surface-variant": "#353534",
                "surface-card": "rgba(20, 20, 20, 0.75)",
                "tertiary-fixed": "#d6e4f7",
                "primary-glow": "rgba(191, 255, 0, 0.35)",
                "on-primary": "#263500",
                "outline": "#8d9479",
                "surface-glass": "rgba(15, 15, 15, 0.65)",
                "on-tertiary-container": "#586676",
                "on-surface-variant": "#c3caac",
                "on-secondary-container": "#bab8b7",
                "border-subtle": "rgba(255, 255, 255, 0.12)",
                "secondary-container": "#4a4949",
                "on-tertiary-fixed": "#0f1d2a",
                "on-primary-fixed-variant": "#384e00",
                "on-secondary-fixed-variant": "#474646",
                "surface-dim": "#131313",
                "inverse-on-surface": "#313030",
                "on-secondary": "#313030",
                "on-secondary-fixed": "#1c1b1b",
                "secondary": "#c8c6c5",
                "outline-variant": "#434933",
                "on-primary-container": "#506e00",
                "inverse-primary": "#4b6700",
                "surface-container": "#201f1f",
                "surface-container-lowest": "#0e0e0e",
                "primary-glow-diffuse": "rgba(191, 255, 0, 0.15)",
                "border-default": "rgba(255, 255, 255, 0.08)",
                "surface-tint": "#a1d800",
                "primary-hover-subtle": "rgba(191, 255, 0, 0.05)",
                "tertiary-container": "#d6e4f7",
                "on-error": "#690005",
                "on-tertiary-fixed-variant": "#3b4857"
              },
              "borderRadius": {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
              },
              "spacing": {
                "margin": "1rem",
                "space-lg": "1.5rem",
                "space-xl": "2rem",
                "margin-desktop": "2rem",
                "space-xs": "0.25rem",
                "space-sm": "0.5rem",
                "gutter": "1rem",
                "space-md": "1rem",
                "gutter-desktop": "2rem"
              },
              "fontFamily": {
                "display-hero": ["Plus Jakarta Sans", "sans-serif"],
                "body-base": ["Inter", "sans-serif"],
                "label-tag": ["Geist", "monospace"],
                "label-code": ["Geist", "monospace"],
                "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                "body-sm": ["Inter", "sans-serif"],
                "display-hero-mobile": ["Plus Jakarta Sans", "sans-serif"],
                "headline-sm": ["Plus Jakarta Sans", "sans-serif"],
                "body-light": ["Inter", "sans-serif"],
                "display-section": ["Plus Jakarta Sans", "sans-serif"],
                "display-section-mobile": ["Plus Jakarta Sans", "sans-serif"],
                "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                "label-meta": ["Geist", "monospace"]
              },
              "fontSize": {
                "display-hero": ["88px", { "lineHeight": "82px", "letterSpacing": "-0.05em", "fontWeight": "800" }],
                "body-base": ["16px", { "lineHeight": "26px", "letterSpacing": "0em", "fontWeight": "400" }],
                "label-tag": ["11px", { "lineHeight": "16px", "letterSpacing": "0.25em", "fontWeight": "600" }],
                "label-code": ["13px", { "lineHeight": "18px", "letterSpacing": "0.08em", "fontWeight": "500" }],
                "headline-lg": ["44px", { "lineHeight": "48px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                "body-sm": ["13px", { "lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "400" }],
                "display-hero-mobile": ["42px", { "lineHeight": "40px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                "headline-sm": ["24px", { "lineHeight": "30px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                "body-light": ["15px", { "lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "300" }],
                "display-section": ["56px", { "lineHeight": "56px", "letterSpacing": "-0.05em", "fontWeight": "800" }],
                "display-section-mobile": ["32px", { "lineHeight": "34px", "letterSpacing": "-0.04em", "fontWeight": "800" }],
                "headline-md": ["36px", { "lineHeight": "40px", "letterSpacing": "-0.03em", "fontWeight": "800" }],
                "label-meta": ["10px", { "lineHeight": "14px", "letterSpacing": "0.2em", "fontWeight": "500" }]
              }
            }
          }
        }
    </script>
    <style>
        /* Kinetic Brutalist scanline & grid texture */
        .bg-grid-telemetry {
          background-size: 32px 32px;
          background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                            linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
        
        .glow-volt-primary {
          box-shadow: 0 0 25px rgba(191, 255, 0, 0.45);
        }

        .glow-volt-subtle {
          box-shadow: 0 0 16px rgba(191, 255, 0, 0.2);
        }

        .focus-glow:focus-within {
          box-shadow: 0 4px 14px -2px rgba(191, 255, 0, 0.35);
          border-color: #b8f600;
        }

        /* Industrial corner bracket accents */
        .corner-brackets {
          position: relative;
        }
        .corner-brackets::before,
        .corner-brackets::after {
          content: '';
          position: absolute;
          width: 8px;
          height: 8px;
          border-color: #b8f600;
          pointer-events: none;
        }
        .corner-brackets::before {
          top: -1px;
          left: -1px;
          border-top: 2px solid;
          border-left: 2px solid;
        }
        .corner-brackets::after {
          bottom: -1px;
          right: -1px;
          border-bottom: 2px solid;
          border-right: 2px solid;
        }

        /* Ambient pulse dot */
        @keyframes pulse-volt {
          0%, 100% { opacity: 1; transform: scale(1); filter: drop-shadow(0 0 4px #b8f600); }
          50% { opacity: 0.4; transform: scale(0.85); filter: drop-shadow(0 0 1px #b8f600); }
        }
        .status-pulse {
          animation: pulse-volt 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-surface-container-lowest text-text-primary antialiased selection:bg-primary-container selection:text-surface-container-lowest min-h-screen flex flex-col justify-between overflow-x-hidden relative font-body-base bg-grid-telemetry">

    <!-- Atmospheric Background Glows -->
    <div class="fixed top-1/4 right-1/4 w-[500px] h-[500px] bg-primary-glow-diffuse rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-10 left-1/4 w-[420px] h-[420px] bg-primary-hover-subtle rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <!-- TOP NAV BAR -->
    <header class="docked full-width top-0 sticky z-50 bg-surface-glass backdrop-blur-md border-b border-border-default shadow-none">
        <div class="flex justify-between items-center w-full px-margin-desktop max-w-7xl mx-auto h-20">
            <!-- Brand Logo Anchor -->
            <div class="flex items-center gap-space-md">
                <a class="text-headline-sm font-headline-sm font-extrabold uppercase tracking-tight text-text-primary flex items-center gap-2 group" href="{{ url('/') }}">
                    <span class="w-2.5 h-2.5 bg-primary-container rounded-full status-pulse"></span>
                    <span>NORTHGYM<span class="text-primary-container">//</span>APEX</span>
                </a>
                <span class="hidden lg:inline-flex items-center gap-1.5 px-2 py-0.5 rounded border border-border-subtle bg-surface-vault text-label-tag font-label-tag text-text-muted">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-container status-pulse"></span>
                    ENROLLMENT NODE ACTIVE
                </span>
            </div>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="{{ url('/#programs') }}">01. PROGRAMS</a>
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="{{ url('/#biometrics') }}">02. BIOMETRICS</a>
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="{{ url('/#membership') }}">03. MEMBERSHIP</a>
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-text-primary transition-colors duration-200" href="{{ url('/#locations') }}">04. LOCATIONS</a>
            </nav>

            <!-- Trailing Action Cluster with Active REGISTER State -->
            <div class="flex items-center gap-space-md">
                <a class="text-text-muted font-label-code text-label-code tracking-widest hover:text-primary-container transition-colors py-2 px-3" href="{{ route('login') }}">
                    MEMBER LOGIN
                </a>
                <a class="text-primary-container font-label-code text-label-code tracking-widest border-b-2 border-primary-container pb-1 transition-all uppercase font-semibold" href="{{ route('register') }}">
                    JOIN THE CULT
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CANVAS: 50/50 SPLIT SCREEN ARCHITECTURE -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 md:px-margin-desktop py-space-md md:py-space-xl grid grid-cols-1 lg:grid-cols-12 gap-gutter-desktop items-center">
        
        <!-- LEFT PANEL: Visual, Protocol Directives & Live Telemetry Preview (Col 1 to 5) -->
        <section class="lg:col-span-5 relative flex flex-col justify-between h-full min-h-[580px] lg:min-h-[760px] rounded-lg border border-border-default bg-surface-vault overflow-hidden p-6 md:p-10">
            <!-- High Contrast Gym Photography Background Layer -->
            <div class="absolute inset-0 z-0">
                <div class="w-full h-full bg-cover bg-center brightness-[0.38] contrast-[1.25]" 
                     style="background-image: url('{{ asset('images/landing/metabolic-conditioning.jpg') }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest via-surface-container-lowest/60 to-transparent"></div>
                <div class="absolute inset-0 bg-grid-telemetry pointer-events-none"></div>
            </div>

            <!-- Top Overlay: Telemetry Coordinate Label -->
            <div class="relative z-10 flex items-center justify-between">
                <span class="font-label-code text-label-meta text-primary-container tracking-widest uppercase bg-surface-vault/90 px-3 py-1 border border-border-subtle rounded">
                    [ ONBOARDING PROTOCOL // JKT-NODE-01 ]
                </span>
                <div class="flex items-center gap-1.5 text-text-muted font-label-code text-label-meta">
                    <span class="w-2 h-2 rounded-full bg-primary-container status-pulse"></span>
                    SECURE ENROLL
                </div>
            </div>

            <!-- Mid Overlay: Giant Kinetic Typography -->
            <div class="relative z-10 my-auto py-8">
                <p class="font-label-tag text-label-tag text-text-muted tracking-[0.3em] uppercase mb-3">BIOLOGICAL HARDWARE ACCESS</p>
                <h1 class="font-headline-lg text-headline-lg font-extrabold uppercase tracking-tight text-text-primary leading-none">
                    ENGINEER YOUR <br/>
                    <span class="text-primary-container underline decoration-primary-container/40 underline-offset-8">EVOLUTION.</span>
                </h1>
                <p class="mt-4 font-body-light text-body-light text-text-secondary max-w-md">
                    Daftarkan profil atlet Anda untuk membuka akses instan ke Eleiko calibrated weight rooms, sensor bar-speed telemetry, dan cold recovery pods.
                </p>
            </div>

            <!-- Bottom Overlay: Dual Bento Telemetry Badges -->
            <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- WIDGET 1: PROTOCOL TIERS -->
                <div class="p-4 rounded bg-surface-glass/90 backdrop-blur-md border border-border-subtle corner-brackets flex flex-col justify-between gap-2">
                    <div class="flex items-center justify-between border-b border-border-default pb-2">
                        <span class="font-label-tag text-label-tag text-text-primary tracking-wider flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm text-primary-container">verified</span>
                            PASS COMMISSION
                        </span>
                        <span class="font-label-meta text-label-meta text-primary-container uppercase px-1.5 py-0.5 bg-primary-container/10 border border-primary-container/30 rounded">
                            ACTIVE
                        </span>
                    </div>
                    <div>
                        <span class="font-label-meta text-label-meta text-text-muted block">ACCESS PRIVILEGE</span>
                        <span class="font-label-code text-label-code text-text-primary font-bold">ALL TIERS INTEROPERABLE</span>
                        <span class="font-label-meta text-label-meta text-primary-container flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">bolt</span> 24/7 BIOMETRIC NFC
                        </span>
                    </div>
                </div>

                <!-- WIDGET 2: COMPATIBLE HARDWARE -->
                <div class="p-4 rounded bg-surface-glass/90 backdrop-blur-md border border-border-subtle corner-brackets flex flex-col justify-between gap-2">
                    <div class="flex items-center justify-between border-b border-border-default pb-2">
                        <span class="font-label-tag text-label-tag text-text-primary tracking-wider flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm text-primary-container">sync_alt</span>
                            BIO-SYNC
                        </span>
                        <span class="font-label-meta text-label-meta text-text-muted uppercase">120HZ</span>
                    </div>
                    <div>
                        <span class="font-label-meta text-label-meta text-text-muted block">HARDWARE ECOSYSTEM</span>
                        <span class="font-label-code text-label-code text-text-primary font-bold">FORCE PLATES // LPT</span>
                        <span class="font-label-meta text-label-meta text-text-secondary block mt-1">
                            ANT+ & Bluetooth Smart Ready
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- RIGHT PANEL: Registration Terminal Vault (Col 6 to 12) -->
        <section class="lg:col-span-7 flex justify-center items-center py-6">
            <!-- Vault Container with radial back-glow & corner brackets -->
            <div class="relative w-full max-w-[540px] bg-surface-glass backdrop-blur-xl border border-border-subtle rounded-lg p-6 sm:p-9 corner-brackets">
                <!-- Back-glow reflection behind vault -->
                <div class="absolute -inset-1 bg-primary-glow-diffuse rounded-lg blur-xl opacity-30 -z-10 pointer-events-none"></div>

                <!-- Terminal Header Pill -->
                <div class="flex items-center justify-between mb-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-primary-container/10 border border-primary-container/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-container status-pulse"></span>
                        <span class="font-label-tag text-label-tag text-primary-container tracking-widest uppercase">
                            NEW ATHLETE // INITIAL PROTOCOL
                        </span>
                    </div>
                    <span class="font-label-meta text-label-meta text-text-muted">SEC.LVL 01</span>
                </div>

                <!-- Headline & Subtext -->
                <h2 class="font-headline-md text-headline-md font-extrabold uppercase tracking-tight text-text-primary">
                    ENROLL OPERATIVE
                </h2>
                <p class="font-body-base text-body-sm text-text-muted mt-1 mb-6">
                    Lengkapi parameter akun Anda untuk aktivasi akun member dan pass latihan biometrik.
                </p>

                <!-- Validation Alerts (Error Display) -->
                @if($errors->any())
                    <div class="mb-5 p-3.5 bg-status-error-container border border-status-error/40 rounded flex items-start gap-2.5 text-status-error">
                        <span class="material-symbols-outlined text-lg mt-0.5">warning</span>
                        <div class="font-label-code text-xs">
                            <span class="font-bold uppercase tracking-wider block mb-1">[ SYS.REGISTRATION_ALERT ]</span>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- REGISTRATION FORM -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- INPUT: FULL NAME -->
                    <div class="space-y-1.5">
                        <label class="block font-label-tag text-label-tag text-text-secondary uppercase tracking-[0.25em]" for="name">
                            FULL ATHLETE NAME
                        </label>
                        <div class="relative rounded border @error('name') border-status-error @else border-border-subtle @enderror bg-surface-vault focus-glow transition-all duration-200">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-text-muted">
                                <span class="material-symbols-outlined text-lg">person</span>
                            </div>
                            <input class="w-full h-[50px] bg-transparent pl-11 pr-4 text-text-primary font-label-code text-label-code placeholder:text-text-tertiary focus:outline-none border-none" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Marcus Vance // Operative" 
                                   required 
                                   autofocus 
                                   type="text"/>
                        </div>
                    </div>

                    <!-- INPUT: EMAIL & PHONE IN A 2-COLUMN GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- EMAIL -->
                        <div class="space-y-1.5">
                            <label class="block font-label-tag text-label-tag text-text-secondary uppercase tracking-[0.25em]" for="email">
                                EMAIL FREQUENCY
                            </label>
                            <div class="relative rounded border @error('email') border-status-error @else border-border-subtle @enderror bg-surface-vault focus-glow transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-text-muted">
                                    <span class="material-symbols-outlined text-lg">alternate_email</span>
                                </div>
                                <input class="w-full h-[50px] bg-transparent pl-11 pr-4 text-text-primary font-label-code text-label-code placeholder:text-text-tertiary focus:outline-none border-none" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="athlete@apexlab.io" 
                                       required 
                                       type="email"/>
                            </div>
                        </div>

                        <!-- PHONE -->
                        <div class="space-y-1.5">
                            <label class="block font-label-tag text-label-tag text-text-secondary uppercase tracking-[0.25em]" for="phone">
                                COMMS PHONE (OPTIONAL)
                            </label>
                            <div class="relative rounded border @error('phone') border-status-error @else border-border-subtle @enderror bg-surface-vault focus-glow transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-text-muted">
                                    <span class="material-symbols-outlined text-lg">call</span>
                                </div>
                                <input class="w-full h-[50px] bg-transparent pl-11 pr-4 text-text-primary font-label-code text-label-code placeholder:text-text-tertiary focus:outline-none border-none" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="0812-XXXX-XXXX" 
                                       type="tel"/>
                            </div>
                        </div>
                    </div>

                    <!-- INPUT: PASSWORD & PASSWORD CONFIRMATION IN A 2-COLUMN GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- PASSWORD -->
                        <div class="space-y-1.5">
                            <label class="block font-label-tag text-label-tag text-text-secondary uppercase tracking-[0.25em]" for="password">
                                PASSPHRASE
                            </label>
                            <div class="relative rounded border @error('password') border-status-error @else border-border-subtle @enderror bg-surface-vault focus-glow transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-text-muted">
                                    <span class="material-symbols-outlined text-lg">lock</span>
                                </div>
                                <input class="w-full h-[50px] bg-transparent pl-11 pr-10 text-text-primary font-label-code text-label-code placeholder:text-text-tertiary focus:outline-none border-none" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Min. 8 chars" 
                                       required 
                                       type="password"/>
                                <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-text-muted hover:text-primary-container transition-colors" 
                                        type="button" 
                                        onclick="togglePass('password', 'pw-icon')">
                                    <span class="material-symbols-outlined text-lg" id="pw-icon">visibility</span>
                                </button>
                            </div>
                        </div>

                        <!-- PASSWORD CONFIRMATION -->
                        <div class="space-y-1.5">
                            <label class="block font-label-tag text-label-tag text-text-secondary uppercase tracking-[0.25em]" for="password_confirmation">
                                CONFIRM PASSPHRASE
                            </label>
                            <div class="relative rounded border border-border-subtle bg-surface-vault focus-glow transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-text-muted">
                                    <span class="material-symbols-outlined text-lg">verified_user</span>
                                </div>
                                <input class="w-full h-[50px] bg-transparent pl-11 pr-10 text-text-primary font-label-code text-label-code placeholder:text-text-tertiary focus:outline-none border-none" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Repeat passcode" 
                                       required 
                                       type="password"/>
                                <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-text-muted hover:text-primary-container transition-colors" 
                                        type="button" 
                                        onclick="togglePass('password_confirmation', 'pw-conf-icon')">
                                    <span class="material-symbols-outlined text-lg" id="pw-conf-icon">visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- TERMS NOTICE -->
                    <div class="p-3 bg-surface-vault/60 border border-border-subtle text-[11px] font-label-code text-text-muted leading-relaxed">
                        <span class="text-primary-container font-semibold uppercase">[ DISCLOSURE ]</span>
                        Dengan mendaftar, Anda menyetujui sinkronisasi data biometrik telemetri & kepatuhan terhadap aturan fasilitas NorthGym // APEX LAB.
                    </div>

                    <!-- PRIMARY CTA BUTTON -->
                    <button class="w-full h-[52px] bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-headline-sm text-label-code uppercase tracking-wider font-extrabold flex items-center justify-center gap-2 glow-volt-primary hover:scale-[1.01] active:scale-95 transition-all duration-200 mt-2" 
                            type="submit">
                        <span>COMMISSION ATHLETE PASS</span>
                        <span class="material-symbols-outlined font-bold text-lg">arrow_forward</span>
                    </button>
                </form>

                <!-- Vault Footer Login Link -->
                <div class="mt-6 pt-5 border-t border-border-default text-center">
                    <p class="font-body-sm text-body-sm text-text-muted">
                        Already registered as an operative? 
                        <a class="text-primary-container font-label-code text-label-code font-semibold tracking-wider hover:underline ml-1 uppercase" href="{{ route('login') }}">
                            [ SYNC EXISTING PASS / LOGIN ]
                        </a>
                    </p>
                </div>

                <!-- Security & Latency Footnote -->
                <div class="mt-4 text-center">
                    <p class="font-label-meta text-label-meta text-text-tertiary tracking-widest uppercase">
                        [ TLS-256 ENCRYPTED // NODE LATENCY: 0.02S // APEX OS V2.4 ]
                    </p>
                </div>
            </div>
        </section>
    </main>

    <!-- BRUTALIST TECHNICAL FOOTER -->
    <footer class="docked full-width bottom bg-surface-vault border-t border-border-default mt-8">
        <div class="w-full px-margin-desktop py-space-xl max-w-7xl mx-auto flex flex-col gap-space-lg">
            <!-- Upper Footer Grid -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-border-default pb-6">
                <div class="flex items-center gap-2">
                    <span class="text-headline-sm font-headline-sm font-extrabold tracking-wider text-text-primary">
                        NORTHGYM<span class="text-primary-container">//</span>APEX LAB
                    </span>
                    <span class="font-label-meta text-label-meta text-text-muted">NORTHGYM HIGH-PERFORMANCE DIVISION</span>
                </div>
                <!-- Status Tag -->
                <div class="flex items-center gap-2 px-2.5 py-1 bg-surface-container-low border border-border-subtle rounded font-label-code text-label-meta text-primary-container">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-container status-pulse"></span>
                    TERMINAL STATUS: ACTIVE
                </div>
            </div>

            <!-- Links & Protocols -->
            <div class="flex flex-wrap gap-y-2 gap-x-6 text-text-muted font-label-code text-label-code">
                <a class="hover:text-primary-container transition-colors duration-200" href="{{ url('/') }}">PUBLIC PORTAL</a>
                <a class="hover:text-primary-container transition-colors duration-200" href="#">PRIVACY PROTOCOL</a>
                <a class="hover:text-primary-container transition-colors duration-200" href="#">SECURITY TLS-256</a>
                <a class="hover:text-primary-container transition-colors duration-200" href="#">BIOMETRIC COMPLIANCE</a>
                <a class="hover:text-primary-container transition-colors duration-200" href="#">TERMS OF EXECUTION</a>
            </div>

            <!-- Telemetry Coordinates & Copyright -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 text-text-tertiary font-label-meta text-label-meta">
                <p>© {{ date('Y') }} NORTHGYM CORP. TELEMETRY COORD: [45.4215° N, 75.6972° W] // ALL RIGHTS RESERVED.</p>
                <p class="font-label-code">ENROLL_NODE_V2.4</p>
            </div>
        </div>
    </footer>

    <!-- Password visibility toggle script -->
    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
