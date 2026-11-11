<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Athlete Command Vault' }} — NorthGym // APEX LAB</title>
    
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS with Unified Design System Tokens -->
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
                "surface-vault": "rgba(10, 10, 10, 0.92)",
                "text-muted": "rgba(255, 255, 255, 0.45)",
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
                "primary-hover-subtle": "rgba(191, 255, 0, 0.06)",
                "surface-container-low": "#1c1b1b",
                "surface-variant": "#353534",
                "on-tertiary": "#243240",
                "surface-card": "rgba(20, 20, 20, 0.85)",
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
                "surface-glass": "rgba(15, 15, 15, 0.75)",
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
              "fontFamily": {
                "body-base": ["Inter", "sans-serif"],
                "display-hero": ["Plus Jakarta Sans", "sans-serif"],
                "label-code": ["Geist", "monospace"],
                "label-tag": ["Geist", "monospace"],
                "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                "headline-sm": ["Plus Jakarta Sans", "sans-serif"],
                "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                "display-section": ["Plus Jakarta Sans", "sans-serif"],
                "label-meta": ["Geist", "monospace"]
              }
            }
          }
        }
    </script>
    <style>
        .bg-grid-telemetry {
          background-size: 32px 32px;
          background-image: 
            linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
        .neon-glow-btn {
          box-shadow: 0 0 25px rgba(184, 246, 0, 0.4);
        }
        .neon-glow-card {
          box-shadow: 0 0 30px rgba(184, 246, 0, 0.12);
        }
        @keyframes voltPulse {
          0%, 100% { opacity: 1; transform: scale(1); filter: drop-shadow(0 0 6px #b8f600); }
          50% { opacity: 0.4; transform: scale(0.85); filter: drop-shadow(0 0 2px #b8f600); }
        }
        .pulse-volt {
          animation: voltPulse 2s infinite ease-in-out;
        }
        /* Custom Terminal Scrollbar */
        ::-webkit-scrollbar {
          width: 5px;
          height: 5px;
        }
        ::-webkit-scrollbar-track {
          background: #0e0e0e;
        }
        ::-webkit-scrollbar-thumb {
          background: #262626;
        }
        ::-webkit-scrollbar-thumb:hover {
          background: #b8f600;
        }
    </style>
</head>
<body class="bg-surface-container-lowest text-text-primary antialiased selection:bg-primary-container selection:text-surface-container-lowest min-h-screen bg-grid-telemetry font-body-base flex">

    <!-- Ambient Glow Refractions -->
    <div class="pointer-events-none fixed top-0 right-1/4 w-[600px] h-[400px] bg-primary-container opacity-[0.05] blur-[150px] rounded-full z-0"></div>
    <div class="pointer-events-none fixed bottom-1/3 left-72 w-[450px] h-[450px] bg-primary-container opacity-[0.03] blur-[140px] rounded-full z-0"></div>

    <!-- ========================================== -->
    <!-- DESKTOP LEFT SIDEBAR (STICKY/FIXED W-72)   -->
    <!-- ========================================== -->
    <aside class="hidden lg:flex flex-col fixed inset-y-0 left-0 z-40 w-72 bg-surface-vault border-r border-border-default backdrop-blur-xl justify-between">
        <div class="flex flex-col flex-1 min-h-0">
            <!-- Brand / Header Area -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-border-default bg-surface-container-lowest/50">
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2.5 group">
                    <span class="w-2.5 h-2.5 bg-primary-container rounded-none pulse-volt"></span>
                    <span class="text-headline-sm font-headline-sm font-extrabold uppercase tracking-tight text-text-primary">
                        NORTHGYM<span class="text-primary-container">//</span>APEX
                    </span>
                </a>
            </div>

            <!-- Athlete Profile Pill & Membership Badge -->
            <div class="p-4 mx-4 my-4 bg-surface-card border border-border-default rounded">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-surface-container border border-primary-container/40 flex items-center justify-center text-primary-container font-headline-sm font-bold text-sm tracking-wider">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary truncate">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="font-label-meta text-[10px] text-primary-container tracking-widest uppercase">
                            ATHLETE #{{ str_pad(auth()->id(), 4, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>

                <!-- Membership Status Indicator -->
                <div class="mt-3 pt-2.5 border-t border-border-default flex items-center justify-between font-label-meta text-[10px]">
                    <span class="text-text-muted">ACCESS STATUS</span>
                    @if(auth()->user()->isMembershipExpired())
                        <a href="{{ route('member.payment.create') }}" class="text-status-error font-bold px-1.5 py-0.5 bg-status-error-container border border-status-error/30 rounded flex items-center gap-1 hover:border-status-error transition-all">
                            <span class="material-symbols-outlined text-[12px]">gpp_bad</span>
                            <span>EXPIRED (RENEW)</span>
                        </a>
                    @else
                        <span class="text-primary-container font-bold px-1.5 py-0.5 bg-primary-hover-subtle border border-primary-container/30 rounded flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-container pulse-volt"></span>
                            <span>ACTIVE PROTOCOL</span>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Navigation Matrix (Vertical Links) -->
            <div class="px-3 py-2 space-y-1.5 font-label-code text-xs uppercase tracking-wider flex-1 overflow-y-auto">
                <div class="px-3 py-1.5 text-[10px] text-text-tertiary tracking-widest font-label-meta">
                    // ATHLETE COMMAND MATRIX
                </div>
                
                <!-- 01. DASHBOARD -->
                <a href="{{ route('member.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-3 rounded transition-all {{ request()->routeIs('member.dashboard') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container shadow-[inset_4px_0_12px_rgba(184,246,0,0.12)]' : 'text-text-muted hover:text-text-primary hover:bg-surface-container' }}">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('member.dashboard') ? 'text-primary-container' : 'text-text-muted' }}">dashboard</span>
                    <span class="flex-1">01. DASHBOARD</span>
                </a>

                <!-- 02. WORKOUT PLANS -->
                <a href="{{ route('member.workout-plans') }}" 
                   class="flex items-center gap-3 px-3.5 py-3 rounded transition-all {{ request()->routeIs('member.workout-plans*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container shadow-[inset_4px_0_12px_rgba(184,246,0,0.12)]' : 'text-text-muted hover:text-text-primary hover:bg-surface-container' }}">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('member.workout-plans*') ? 'text-primary-container' : 'text-text-muted' }}">fitness_center</span>
                    <span class="flex-1">02. WORKOUT PLANS</span>
                </a>

                <!-- 03. PROGRESS TRACKER -->
                <a href="{{ route('member.progress.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-3 rounded transition-all {{ request()->routeIs('member.progress*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container shadow-[inset_4px_0_12px_rgba(184,246,0,0.12)]' : 'text-text-muted hover:text-text-primary hover:bg-surface-container' }}">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('member.progress*') ? 'text-primary-container' : 'text-text-muted' }}">monitoring</span>
                    <span class="flex-1">03. PROGRESS</span>
                </a>

                <!-- 04. BODY METRICS -->
                <a href="{{ route('member.body-metrics.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-3 rounded transition-all {{ request()->routeIs('member.body-metrics*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container shadow-[inset_4px_0_12px_rgba(184,246,0,0.12)]' : 'text-text-muted hover:text-text-primary hover:bg-surface-container' }}">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('member.body-metrics*') ? 'text-primary-container' : 'text-text-muted' }}">straighten</span>
                    <span class="flex-1">04. BODY METRICS</span>
                </a>

                <!-- 05. TRANSACTIONS & BILLING -->
                <a href="{{ route('member.transactions') }}" 
                   class="flex items-center gap-3 px-3.5 py-3 rounded transition-all {{ request()->routeIs('member.transactions') || request()->routeIs('member.payment.*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container shadow-[inset_4px_0_12px_rgba(184,246,0,0.12)]' : 'text-text-muted hover:text-text-primary hover:bg-surface-container' }}">
                    <span class="material-symbols-outlined text-[20px] {{ (request()->routeIs('member.transactions') || request()->routeIs('member.payment.*')) ? 'text-primary-container' : 'text-text-muted' }}">receipt_long</span>
                    <span class="flex-1">05. TRANSACTIONS</span>
                </a>

                <!-- Quick Action Trigger -->
                <div class="pt-4 px-2">
                    <a href="{{ route('member.payment.create') }}" 
                       class="w-full py-2.5 px-3 bg-surface-container hover:bg-primary-hover-subtle border border-primary-container/30 hover:border-primary-container text-primary-container font-label-code text-[11px] uppercase tracking-wider rounded transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">add_card</span>
                        <span>PERPANJANG PAKET</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Bottom Footer Area -->
        <div class="p-4 border-t border-border-default bg-surface-container-lowest/80 space-y-3">
            <div class="flex items-center justify-between text-label-meta font-label-meta text-text-muted text-[10px]">
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-container pulse-volt"></span>
                    <span>JKT-NODE-01</span>
                </div>
                <span>TLS-256 ENCRYPT</span>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" 
                        class="w-full py-2.5 px-3 bg-surface-container hover:bg-status-error/15 border border-border-subtle hover:border-status-error text-text-muted hover:text-status-error font-label-code text-xs uppercase tracking-wider rounded transition-all flex items-center justify-center gap-2 group">
                    <span class="material-symbols-outlined text-[18px] group-hover:rotate-90 transition-transform">power_settings_new</span>
                    <span>DISCONNECT SESSION</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ========================================== -->
    <!-- MOBILE DRAWER & TOP HEADER                -->
    <!-- ========================================== -->
    <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-black/80 z-50 backdrop-blur-sm hidden lg:hidden" onclick="toggleMobileSidebar()"></div>

    <div id="mobile-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-surface-vault border-r border-border-default flex flex-col justify-between transform -translate-x-full transition-transform duration-300 lg:hidden">
        <div class="flex flex-col flex-1 min-h-0">
            <!-- Mobile Brand Header -->
            <div class="h-16 flex items-center justify-between px-5 border-b border-border-default">
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-primary-container rounded-none pulse-volt"></span>
                    <span class="text-headline-sm font-headline-sm font-extrabold uppercase tracking-tight text-text-primary text-base">
                        NORTHGYM<span class="text-primary-container">//</span>APEX
                    </span>
                </a>
                <button onclick="toggleMobileSidebar()" class="p-1.5 text-text-muted hover:text-text-primary">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Mobile User Profile -->
            <div class="p-4 mx-3 my-3 bg-surface-card border border-border-default rounded">
                <div class="font-headline-sm font-bold text-xs uppercase tracking-wider text-text-primary">
                    {{ auth()->user()->name }}
                </div>
                <div class="font-label-meta text-[10px] text-primary-container tracking-widest uppercase mt-0.5">
                    ATHLETE #{{ str_pad(auth()->id(), 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            <!-- Mobile Nav Links -->
            <div class="px-3 py-2 space-y-1 font-label-code text-xs uppercase tracking-wider flex-1 overflow-y-auto">
                <a href="{{ route('member.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded transition-all {{ request()->routeIs('member.dashboard') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container' : 'text-text-muted hover:text-text-primary' }}">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    <span>01. DASHBOARD</span>
                </a>
                <a href="{{ route('member.workout-plans') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded transition-all {{ request()->routeIs('member.workout-plans*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container' : 'text-text-muted hover:text-text-primary' }}">
                    <span class="material-symbols-outlined text-[18px]">fitness_center</span>
                    <span>02. WORKOUT PLANS</span>
                </a>
                <a href="{{ route('member.progress.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded transition-all {{ request()->routeIs('member.progress*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container' : 'text-text-muted hover:text-text-primary' }}">
                    <span class="material-symbols-outlined text-[18px]">monitoring</span>
                    <span>03. PROGRESS</span>
                </a>
                <a href="{{ route('member.body-metrics.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded transition-all {{ request()->routeIs('member.body-metrics*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container' : 'text-text-muted hover:text-text-primary' }}">
                    <span class="material-symbols-outlined text-[18px]">straighten</span>
                    <span>04. BODY METRICS</span>
                </a>
                <a href="{{ route('member.transactions') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded transition-all {{ request()->routeIs('member.transactions') || request()->routeIs('member.payment.*') ? 'bg-primary-hover-subtle text-primary-container font-bold border-l-4 border-primary-container' : 'text-text-muted hover:text-text-primary' }}">
                    <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                    <span>05. TRANSACTIONS</span>
                </a>
            </div>
        </div>

        <div class="p-4 border-t border-border-default">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" 
                        class="w-full py-2.5 px-3 bg-surface-container hover:bg-status-error/15 border border-border-subtle hover:border-status-error text-text-muted hover:text-status-error font-label-code text-xs uppercase tracking-wider rounded transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">power_settings_new</span>
                    <span>DISCONNECT</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MAIN WRAPPER (OFFSET BY W-72 ON DESKTOP)   -->
    <!-- ========================================== -->
    <div class="flex-1 flex flex-col min-h-screen lg:pl-72 w-full min-w-0">

        <!-- Mobile Top Nav Strip -->
        <header class="lg:hidden sticky top-0 z-30 flex items-center justify-between h-16 px-4 bg-surface-vault border-b border-border-default backdrop-blur-md">
            <div class="flex items-center gap-3">
                <button onclick="toggleMobileSidebar()" class="p-2 text-text-muted hover:text-primary-container">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-primary-container rounded-none pulse-volt"></span>
                    <span class="text-headline-sm font-headline-sm font-extrabold uppercase tracking-tight text-text-primary text-sm">
                        NORTHGYM<span class="text-primary-container">//</span>APEX
                    </span>
                </a>
            </div>

            <div class="flex items-center gap-2">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-text-muted hover:text-status-error" title="Logout">
                        <span class="material-symbols-outlined text-sm">power_settings_new</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Desktop Command Telemetry Header Strip -->
        <header class="hidden lg:flex items-center justify-between h-16 px-8 border-b border-border-default bg-surface-glass backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center gap-4 text-label-code font-label-code text-xs text-text-muted">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary-container pulse-volt"></span>
                    <span class="text-text-secondary font-medium">SYS.STATUS: OPERATIONAL</span>
                </div>
                <span>//</span>
                <span>CLUSTER: JKT-01</span>
                <span>//</span>
                <span class="text-primary-container">STREAM: 1000Hz TELEMETRY</span>
            </div>

            <div class="flex items-center gap-6">
                <!-- Clock -->
                <div class="text-right font-label-code text-xs">
                    <span id="live-telemetry-clock" class="text-text-primary font-bold">--:--:-- UTC</span>
                </div>

                <div class="h-4 w-[1px] bg-border-default"></div>

                <!-- Fast Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('member.body-metrics.create') }}" 
                       class="px-3 py-1.5 bg-surface-container hover:bg-surface-container-high border border-border-subtle hover:border-primary-container text-text-primary font-label-code text-xs uppercase tracking-wider rounded transition-all flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px] text-primary-container">add</span>
                        <span>INPUT METRICS</span>
                    </a>

                    <a href="{{ route('member.progress.create') }}" 
                       class="px-3 py-1.5 bg-primary-container hover:bg-primary-fixed text-surface-container-lowest font-label-code text-xs uppercase tracking-wider font-extrabold rounded transition-all flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px]">speed</span>
                        <span>LOG PROGRESS</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8 z-10 relative">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto mb-6">
                    <div class="p-4 bg-surface-vault border-l-4 border-primary-container border-y border-r border-border-default rounded flex items-center gap-3 text-primary-container font-label-code text-xs tracking-wide">
                        <span class="material-symbols-outlined text-lg">check_circle</span>
                        <div>
                            <span class="font-bold uppercase tracking-wider mr-2">[ SYS.SUCCESS ]</span>
                            <span class="text-text-primary">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto mb-6">
                    <div class="p-4 bg-surface-vault border-l-4 border-status-error border-y border-r border-border-default rounded flex items-center gap-3 text-status-error font-label-code text-xs tracking-wide">
                        <span class="material-symbols-outlined text-lg">warning</span>
                        <div>
                            <span class="font-bold uppercase tracking-wider mr-2">[ SYS.ALERT ]</span>
                            <span class="text-text-primary">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>

        <!-- Unified Technical Footer -->
        <footer class="border-t border-border-default bg-surface-vault py-5 px-4 sm:px-6 lg:px-8 z-10 relative">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-3 text-label-meta font-label-meta text-text-muted text-[11px]">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-container pulse-volt"></span>
                    <span>NORTHGYM // APEX LAB ATHLETE PORTAL CORE</span>
                </div>
                <div class="tracking-widest">
                    TELEMETRY COORD: [45.4215° N, 75.6972° W] // LATENCY: 0.14MS // TLS-256
                </div>
            </div>
        </footer>

    </div>

    <!-- Mobile Sidebar JavaScript Toggle -->
    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        // Live Telemetry UTC Clock
        function updateTelemetryClock() {
            const clockEl = document.getElementById('live-telemetry-clock');
            if (clockEl) {
                const now = new Date();
                const hours = String(now.getUTCHours()).padStart(2, '0');
                const minutes = String(now.getUTCMinutes()).padStart(2, '0');
                const seconds = String(now.getUTCSeconds()).padStart(2, '0');
                clockEl.textContent = `${hours}:${minutes}:${seconds} UTC`;
            }
        }
        setInterval(updateTelemetryClock, 1000);
        updateTelemetryClock();
    </script>

    @stack('scripts')
</body>
</html>
