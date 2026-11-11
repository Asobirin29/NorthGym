# Project Overview: Cyber-Athletic Gym & Fitness Platform
**Project Type:** Web Application UI (Landing Page, Member Portal Auth, Admin Control Auth)  
**Design Paradigm:** High-Contrast Kinetic Brutalism / Industrial Neon  
**Target Generator:** Google Stitch / AI UI Systems  

---

## 1. Visual Direction & Style Guide

The aesthetic is built on an ultra-high-contrast foundation of deep void blacks (`#050505`) and high-voltage neon lime (`#BFFF00`). It merges raw athletic energy with technical telemetry aesthetics. It employs heavy, tightly-tracked grotesque headlines paired with wide-tracked monospace technical metadata. Key visual techniques include 3D perspective card transforms, film grain/noise overlays for tactile grit, and luminosity-based hover states that make UI components feel light-emitting.

### 1.1 Color Tokens
* **Background Primary (Void Black):** `#050505`
* **Background Elevated / Glass Surface:** `rgba(15, 15, 15, 0.65)`
* **Accent Primary (Volt / Neon Lime):** `#BFFF00`
* **Accent Secondary (Muted Volt Glow):** `rgba(191, 255, 0, 0.15)`
* **Text Primary:** `#FFFFFF`
* **Text Secondary (Muted):** `rgba(255, 255, 255, 0.40)`
* **Border Default:** `rgba(255, 255, 255, 0.08)`
* **Border Active / Hover:** `#BFFF00` (with `0 0 15px rgba(191, 255, 0, 0.35)` glow)
* **Status Error (System Alert):** `#FF2A54`

### 1.2 Typography System
* **Display / Headlines (`Plus Jakarta Sans`):**
  * Weight: `800` (ExtraBold)
  * Transform: `UPPERCASE`
  * Letter-spacing (Tracking): `-0.05em`
  * Line-height: `0.92`
  * Hero Fluid Sizing: `clamp(2.6rem, 10vw, 8.75rem)`
  * Section Header Sizing: `clamp(2rem, 5vw, 4.5rem)`
* **Technical Meta / Telemetry Labels (`Geist Mono`):**
  * Weight: `400` to `600`
  * Transform: `UPPERCASE`
  * Letter-spacing (Tracking): `0.2em` to `0.5em`
  * Font-size: `10px` – `12px`
  * Usage: Section indices (`[01 // TRAINING]`), coordinates, timestamps, input labels, badge tags.
* **Body Copy (`Inter`):**
  * Weight: `300` (Light) to `400` (Regular)
  * Line-height: `1.625` (`leading-relaxed`)
  * Color: `rgba(255, 255, 255, 0.75)` or `rgba(255, 255, 255, 0.4)`

### 1.3 Surface Effects & Motion
* **Noise Overlay:** Fixed viewport SVG fractal noise overlay at `3%` opacity (`pointer-events: none; z-index: 9999`).
* **Refraction Glow:** Large, heavily blurred (`blur(140px)`) radial gradients of `#BFFF00` at `15%` opacity positioned behind focal points (hero imagery, active pricing cards, login containers).
* **Glassmorphism:** `backdrop-filter: blur(12px)` with `1px solid rgba(255, 255, 255, 0.08)` borders.
* **Motion & Transitions:** All interactive states use `cubic-bezier(0.16, 1, 0.3, 1)` over `400ms`. Scroll-reveal animations translate elements `40px` on the Y-axis while fading from `0` to `1` opacity.

---

## 2. Shared Component Library

1. **Primary CTA Button (Light-Emitting):**
   * Solid `#BFFF00` background, `#050505` text in `Plus Jakarta Sans` (800 weight, uppercase) or `Geist Mono` (600 weight).
   * Hover state: Scales `1.02`, emits `box-shadow: 0 0 25px rgba(191, 255, 0, 0.5)`, subtle internal scanline or sheen effect.
2. **Ghost / Technical Button:**
   * Transparent background, `1px solid rgba(255, 255, 255, 0.15)`, `#FFFFFF` text.
   * Hover state: Border turns `#BFFF00`, text turns `#BFFF00`, background shifts to `rgba(191, 255, 0, 0.05)`.
3. **Glass Input Field:**
   * Height `52px`, background `rgba(255, 255, 255, 0.03)`, border `1px solid rgba(255, 255, 255, 0.1)`, border-radius `4px` (sharp, industrial corners).
   * Label above in `Geist Mono` (`11px`, tracking `0.25em`, `rgba(255,255,255,0.4)`).
   * Focus state: Border becomes `#BFFF00`, subtle bottom glow `0 4px 12px -2px rgba(191, 255, 0, 0.25)`.

---

## 3. Screen-by-Screen Specifications

### Screen 1: Gym Landing Page (`/`)
**Objective:** High-energy conversion page showcasing facilities, training programs, and membership tiers with an elite performance vibe.

* **Top Navigation Bar:**
  * Fixed glassmorphic header (`backdrop-filter: blur(12px)`, bottom border `rgba(255,255,255,0.08)`).
  * **Left:** Bold typographic brand logo (e.g., `APEX//LAB` or `VORTEX GYM`) with a glowing `#BFFF00` dot indicator.
  * **Center:** `Geist Mono` links (`01. PROGRAMS`, `02. BIOMETRICS`, `03. MEMBERSHIP`, `04. LOCATIONS`).
  * **Right:** Dual action buttons: Ghost button `MEMBER LOGIN` and solid neon button `JOIN THE CULT →`.
* **Hero Section:**
  * **Background:** High-contrast monochrome photo/video of an athlete in mid-lift, darkened into `#050505` shadows, backlit by a `#BFFF00` radial refraction glow.
  * **Telemetry Top Tag:** `[ SYS.STATUS: 24/7 ACCESS ACTIVE // LOC: JAKARTA ]` in `Geist Mono`.
  * **Main Headline:** Giant stacked `Plus Jakarta Sans` 800 text: `ENGINEER YOUR PEAK STATE.` with the word `PEAK` highlighted in `#BFFF00` or outlined in stroke.
  * **Subheadline:** `Inter` body text (`max-width: 520px`, `rgba(255,255,255,0.4)`) explaining high-performance strength and conditioning.
  * **Bottom Hero Bar:** Live telemetry ticker showing gym capacity (`CAPACITY: 64%`), active zones, and scroll down indicator.
* **3D Program Bento Grid (`01 // DISCIPLINES`):**
  * 3-column asymmetric grid featuring glassmorphic cards with 3D perspective tilt on hover (`transform: perspective(1000px) rotateX(...)`).
  * Cards: `HYPERTROPHY LAB`, `METABOLIC CONDITIONING`, `RECOVERY & CRYO`.
  * Each card displays a `Geist Mono` index tag in the top-left, high-contrast imagery, and a neon corner bracket that lights up on hover.
* **Membership Pricing Matrix (`02 // ACCESS TIERS`):**
  * 3 columns (`BASE ACCESS`, `PRO ATHLETE [POPULAR]`, `BLACK CARD`).
  * The center `PRO ATHLETE` card is elevated with a permanent `#BFFF00` border (`1px solid #BFFF00`), subtle radial lime glow behind it, and a solid `#BFFF00` badge reading `RECOMMENDED PROTOCOL`.

---

### Screen 2: Member Login View (`/login/member`)
**Objective:** An inspiring, futuristic athlete portal login where members access their workout logs, QR gate pass, and class bookings.

* **Layout Architecture:** Split-screen 50/50 desktop layout (collapses to single column on mobile).
* **Left Panel (Visual & Motivation):**
  * Full-height dark architectural gym photography with a 3D perspective grid overlay at the bottom.
  * Large kinetic typography overlay: `UNLOCK YOUR METRICS.`
  * Floating glassmorphic widget preview showing a sample "Member QR Pass" and "Daily Calorie / PR Telemetry" with `#BFFF00` accents.
* **Right Panel (Authentication Terminal):**
  * Centered glassmorphic container (`max-width: 440px`) over `#050505` background with a soft `#BFFF00` refraction glow in the top-right corner.
  * **Header Meta:** `Geist Mono` tag `[ PORTAL // ATHLETE AUTHENTICATION ]`.
  * **Title:** `WELCOME BACK` (`Plus Jakarta Sans`, 800, uppercase, `2.75rem`).
  * **Subtitle:** `Enter your credentials to sync your training pass.` (`Inter`, `rgba(255,255,255,0.4)`).
  * **Form Elements:**
    * Input 1: `MEMBER ID OR EMAIL` (`Geist Mono` label, glass input).
    * Input 2: `PASSCODE` (with `FORGOT?` link in `Geist Mono` aligned right).
    * Checkbox: Custom square checkbox (`1px solid rgba(255,255,255,0.2)`, fills `#BFFF00` when checked) — `Keep session active for 30 days`.
    * Primary CTA: Full-width `#BFFF00` button: `INITIALIZE SESSION →`.
  * **Alternative Auth:** Divider with `Geist Mono` text `OR SYNC VIA`, followed by sleek dark glass buttons for `APPLE PASSKEY` and `GOOGLE AUTH`.
  * **Footer Link:** `Not a member yet? [ APPLY FOR MEMBERSHIP ]` (highlighted in `#BFFF00`).

---

### Screen 3: Admin Login View (`/login/admin`)
**Objective:** A strict, high-security, command-center authentication screen for gym staff, trainers, and system administrators. Distinctly more technical and utilitarian than the Member Login.

* **Layout Architecture:** Centered single-column "Command Vault" layout over a `#050505` canvas with a subtle background technical grid (`1px` lines at `3%` white opacity) and a focused `#BFFF00` radial glow directly behind the card.
* **Top System Bar:**
  * Minimalist top bar showing `[ SYSTEM: CORE_ADMIN_V2.4 ]` on the left and a live clock + `[ CONNECTION: ENCRYPTED_TLS ]` with a pulsing `#BFFF00` dot on the right.
* **Central Auth Card (3D Glass Module):**
  * Width: `480px`, `backdrop-filter: blur(16px)`, background `rgba(10, 10, 10, 0.8)`, `1px solid rgba(255, 255, 255, 0.1)`, with accented corner ticks in `#BFFF00`.
  * **Security Badge:** Top pill badge with `rgba(191, 255, 0, 0.1)` background and `#BFFF00` text in `Geist Mono`: `RESTRICTED ACCESS // STAFF ONLY`.
  * **Title:** `SYSTEM CONTROL` (`Plus Jakarta Sans`, 800, `-0.05em` tracking, `2.25rem`).
  * **Subtitle:** `Authorized personnel only. All login attempts and IP telemetry are logged.` (`Inter`, `13px`, `rgba(255,255,255,0.4)`).
  * **Form Elements:**
    * **Role Selector Tabs (Segmented Control):** Glassmorphic toggle bar at the top of the form in `Geist Mono`: `[ OPERATOR / FRONT DESK ]` | `[ HEAD COACH ]` | `[ SUPER ADMIN ]`. Active tab gets a `#BFFF00` bottom border and text glow.
    * **Input 1:** `OPERATOR ID / BADGE NUMBER` (Monospace input text for a technical feel, placeholder `OP-XXXX-XX`).
    * **Input 2:** `SECURITY PASSPHRASE` (Password field with show/hide toggle icon).
    * **Input 3 (2FA):** `AUTHENTICATOR TOKEN (6-DIGIT)` — 6 individual square glass input boxes (`48px x 54px`) that glow `#BFFF00` as digits are typed.
    * **Submit Button:** Full-width `#BFFF00` button with dark text: `AUTHORIZE & MOUNT DASHBOARD`.
* **Bottom Telemetry Footer:**
  * Below the card, `Geist Mono` (`10px`, `rgba(255,255,255,0.3)`) displaying terminal metadata: `SERVER: JKT-NODE-01 // LATENCY: 12MS // [ RETURN TO PUBLIC SITE ]`.

---

## 4. Prompting Directives for Google Stitch
When generating these screens in Google Stitch, enforce the following constraints:
* **Never use pure white backgrounds or soft pastel grays.** Keep 90% of the viewport in `#050505` to `#0F0F0F` dark tones so the `#BFFF00` neon lime pops aggressively.
* **Enforce typographic contrast:** Pair massive, tightly-spaced `Plus Jakarta Sans` headers directly next to tiny, wide-spaced `Geist Mono` labels (`[01]`, `SYS.READY`, etc.).
* **Sharp / Industrial Geometry:** Use minimal border radii (`0px` to `6px` max) with thin `1px` translucent borders (`rgba(255,255,255,0.1)`) to maintain an engineered, high-tech gym aesthetic rather than a bubbly consumer app look.