<!doctype html>
<html lang="id" class="dark scroll-smooth">
@php
    /*
     * AUTO-FALLBACK GUARD:
     * Jika file Blade ini dipanggil langsung dari Route::view('/', 'welcome')
     * tanpa melewati PortfolioController, blok ini otomatis mengambil data
     * dari database (atau menggunakan data default Muhammad Syarief) sehingga
     * TIDAK AKAN PERNAH muncul error "Undefined variable $projects"!
     */
    if (!isset($settings) || !$settings) {
        try {
            $settings = class_exists(\App\Models\Setting::class) ? \App\Models\Setting::first() : null;
        } catch (\Throwable $e) {
            $settings = null;
        }
        if (!$settings) {
            $settings = (object) [
                'name' => 'Muhammad Syarief',
                'headline' => 'IT Support | Network & Cyber Security Enthusiast',
                'hero_bio' => 'Saya tertarik pada dunia jaringan, keamanan informasi, dan teknologi. Berpengalaman dalam IT Support, network infrastructure, serta pengembangan aplikasi. Selalu belajar untuk menjadi lebih baik dan siap berkontribusi di dunia profesional.',
                'about_bio' => 'Saya adalah lulusan Universitas Bumigora dengan program studi Informatika, konsentrasi Cyber Security. Memiliki pengalaman di bidang IT Support, jaringan, dan keamanan siber. Saya senang memecahkan masalah, belajar hal baru, dan berkolaborasi dalam tim.',
                'avatar_url' => null,
                'theme_bg' => 'dark-navy',
                'quote_bg_url' => null,
                'stat_years' => '4+',
                'stat_years_label' => 'Years of Study',
                'stat_projects' => '3+',
                'stat_projects_label' => 'Projects Completed',
                'stat_tools' => '10+',
                'stat_tools_label' => 'Tools Mastered',
                'stat_learning' => '100%',
                'stat_learning_label' => 'Always Learning',
                'education_university' => 'Universitas Bumigora',
                'education_degree' => 'Universitas Bumigora (S1 Informatika)',
                'education_concentration' => 'Konsentrasi Cyber Security',
                'education_period' => '2021 – 2024',
                'gpa' => '3.86 (Cumlaude)',
                'graduation_year' => '2024 (3.5 Tahun)',
                'location' => 'Mataram, NTB',
                'quote_about' => 'Terus belajar, karena teknologi tidak pernah berhenti berkembang.',
                'quote_education' => 'Ilmu yang bermanfaat adalah ilmu yang diamalkan, bukan hanya diingat.',
                'quote_footer' => 'Teknologi adalah alat, yang paling penting adalah bagaimana kita menggunakannya untuk memberi manfaat.',
                'email' => 'syariefmuhammad@gmail.com',
                'whatsapp' => '+62 819 0788 4512',
                'linkedin' => 'linkedin.com/in/muhammadsyarief',
                'github_username' => 'muhammadsyarief',
                'github_bio' => 'Full Stack Developer | Security Enthusiast',
                'github_repos_count' => 12,
                'github_followers' => 3,
                'github_following' => 2,
                'github_repos' => null,
            ];
        }
    }

    if (!isset($projects)) {
        try {
            $projects = class_exists(\App\Models\Project::class)
                ? \App\Models\Project::where('status', 'Published')->latest()->get()
                : collect();
        } catch (\Throwable $e) {
            $projects = collect();
        }
    }
    if ($projects->isEmpty()) {
        $projects = collect([
            (object) [
                'id' => 1,
                'title' => 'Web Security Assessment',
                'category' => 'Cyber Security',
                'status' => 'Published',
                'date' => '12 Sep 2026',
                'summary' => 'Penetration testing aplikasi web berdasarkan OWASP Top 10 menggunakan berbagai tools untuk mengidentifikasi kerentanan dan memberikan rekomendasi mitigasi.',
                'problem' => 'Aplikasi web memiliki beberapa celah keamanan yang berpotensi disalahgunakan oleh attacker.',
                'objective' => 'Menemukan kerentanan berdasarkan OWASP Top 10 dan memberikan rekomendasi mitigasi.',
                'tools' => ['Nmap · Burp Suite', 'Nikto · OWASP ZAP', 'OWASP ZAP · Metasploit', 'Metasploit · Acunetix'],
                'methodology' => ['Scope & Planning', 'Information Gathering', 'Vulnerability Analysis', 'Exploitation / Testing', 'Reporting'],
                'findings' => [
                    'Missing CSP, X-Frame-Options (Medium)',
                    'No Anti-CSRF token (Low)',
                    'Open Ports (Medium)',
                    'SRI missing on Google Maps (Medium)',
                    'Cross-domain JS (Low)',
                ],
                'solution' => 'Implementasi Content-Security-Policy (CSP), X-Frame-Options: SAMEORIGIN, Anti-CSRF token pada seluruh form, penutupan port non-esensial di firewall, dan penerapan Subresource Integrity (SRI).',
                'result' => '100% temuan Medium dan Low berhasil dimitigasi pada siklus re-testing dan postur keamanan HTTP header meningkat dari grade D menjadi grade A.',
            ],
            (object) [
                'id' => 2,
                'title' => 'Network Infrastructure',
                'category' => 'Networking',
                'status' => 'Published',
                'date' => '05 Sep 2026',
                'summary' => 'Konfigurasi MikroTik, dual WAN, VLAN, PPPoE, dan manajemen jaringan.',
                'problem' => 'Jaringan kantor mengalami bottleneck trafik broadcast dan ketiadaan failover saat link ISP utama gangguan.',
                'objective' => 'Membangun arsitektur jaringan tersegmen menggunakan VLAN, Dual WAN Failover pada MikroTik, dan manajemen bandwidth PPPoE.',
                'tools' => ['MikroTik RouterOS · Winbox', 'VLAN 802.1Q · Switch', 'PPPoE · FTTH OLT', 'Firewall · QoS Mangle'],
                'methodology' => ['Network Topology Design', 'VLAN Segmentation', 'Dual WAN Failover', 'Firewall & QoS Shaping', 'Monitoring'],
                'findings' => ['Single Point of Failure pada ISP utama (High)', 'Flat network tanpa isolasi VLAN (Medium)', 'Saturasi bandwidth jam kerja (Medium)'],
                'solution' => 'Pemisahan trafik menjadi 4 VLAN, konfigurasi recursive gateway failover otomatis, dan Queue Tree bandwidth management.',
                'result' => 'Uptime jaringan mencapai 99.8% dengan isolasi keamanan antar divisi yang optimal.',
            ],
            (object) [
                'id' => 3,
                'title' => 'IT Support & Troubleshooting',
                'category' => 'IT Support',
                'status' => 'Published',
                'date' => '15 Agu 2026',
                'summary' => 'Penanganan masalah jaringan, CCTV, PABX, dan perangkat IT.',
                'problem' => 'Gangguan berkala pada IP-CCTV, ekstensi PABX, serta kendala workstation pengguna.',
                'objective' => 'Melakukan preventive maintenance, standarisasi pengkabelan, dan percepatan troubleshooting.',
                'tools' => ['IP CCTV · NVR', 'PABX · VoIP', 'LAN Tester · Crimping', 'OS Diagnostics'],
                'methodology' => ['Initial Diagnostics', 'Cabling Inspection', 'Config Recovery', 'Endpoint Hardening', 'Preventive Checklist'],
                'findings' => ['Degradasi konektor RJ45 outdoor (Medium)', 'Konflik IP statis printer & NVR (Medium)'],
                'solution' => 'Restrukturisasi DHCP Static Lease di MikroTik dan jadwal preventive maintenance bulanan.',
                'result' => 'Seluruh titik CCTV dan PABX beroperasi stabil 24/7 tanpa gangguan.',
            ],
            (object) [
                'id' => 4,
                'title' => 'Web Application',
                'category' => 'Development',
                'status' => 'Published',
                'date' => '28 Agu 2026',
                'summary' => 'Pengembangan aplikasi web dengan Laravel & MySQL.',
                'problem' => 'Pencatatan operasional dan inventaris perangkat masih dilakukan secara manual.',
                'objective' => 'Membangun aplikasi web terpusat berbasis Laravel & MySQL dengan autentikasi multi-role dan REST API.',
                'tools' => ['PHP 8.3 · Laravel 12', 'MySQL · Eloquent', 'REST API · Tailwind CSS', 'Git · GitHub'],
                'methodology' => ['Database Modeling', 'Backend Architecture', 'Frontend Blade UI', 'Security Validation', 'Deployment'],
                'findings' => ['Redundansi data manual (Medium)', 'Kebutuhan audit trail perubahan data (Low)'],
                'solution' => 'Implementasi skema relasional MySQL ternormalisasi dan dashboard analitik real-time.',
                'result' => 'Efisiensi pelaporan operasional meningkat 42% dan seluruh data terintegrasi.',
            ],
        ]);
    }

    if (!isset($skills)) {
        try {
            $skills = class_exists(\App\Models\Skill::class) ? \App\Models\Skill::orderBy('order')->get() : collect();
        } catch (\Throwable $e) {
            $skills = collect();
        }
    }
    if ($skills->isEmpty()) {
        $skills = collect([
            (object) ['name' => 'Cyber Security', 'icon' => 'shield', 'items' => ['OWASP Top 10', 'Penetration Testing', 'Burp Suite', 'OWASP ZAP', 'Nmap, Nikto', 'Metasploit']],
            (object) ['name' => 'Networking', 'icon' => 'network', 'items' => ['MikroTik', 'VLAN & Routing', 'PPPoE', 'FTTH / OLT', 'Firewall', 'CCTV Network']],
            (object) ['name' => 'Development', 'icon' => 'code', 'items' => ['PHP / Laravel', 'Python / Flask', 'MySQL', 'REST API', 'Git & GitHub']],
            (object) ['name' => 'IT Support', 'icon' => 'wrench', 'items' => ['Troubleshooting', 'Hardware & Software', 'Printer / CCTV / PABX', 'Network Deployment', 'User Support']],
        ]);
    }

    if (!isset($experiences)) {
        try {
            $experiences = class_exists(\App\Models\Experience::class) ? \App\Models\Experience::orderBy('order')->get() : collect();
        } catch (\Throwable $e) {
            $experiences = collect();
        }
    }
    if ($experiences->isEmpty()) {
        $experiences = collect([
            (object) ['period' => '2026 – Sekarang', 'role' => 'IT Support', 'organization' => 'Agung Artatek (Lombok)', 'description' => 'Perangkat jaringan, CCTV, PABX, dll'],
            (object) ['period' => '2025', 'role' => 'Cyber Security Project', 'organization' => 'Penetration Testing (Lembaga XYZ)', 'description' => 'Analisis kerentanan web (OWASP Top 10)'],
            (object) ['period' => '2024', 'role' => 'Kampus Merdeka', 'organization' => 'Independent Study Batch 6 / Celerates', 'description' => 'Studi Independen Bersertifikat bidang Cybersecurity & Network Security'],
            (object) ['period' => '2023', 'role' => 'BEM & Organisasi', 'organization' => 'KSR PMI, SASAMBO, OSIS', 'description' => 'Kepemimpinan organisasi mahasiswa, kepanitiaan, dan kegiatan sosial'],
        ]);
    }

    if (!isset($certificates)) {
        try {
            $certificates = class_exists(\App\Models\Certificate::class) ? \App\Models\Certificate::orderBy('order')->get() : collect();
        } catch (\Throwable $e) {
            $certificates = collect();
        }
    }
    if ($certificates->isEmpty()) {
        $certificates = collect([
            (object) ['title' => 'Kampus Merdeka – Celerates', 'subtitle' => 'Cybersecurity Foundations, Governance, Cryptography, Network Security, Web App Security, dll', 'year' => '2024', 'issuer' => 'Kemendikbudristek & Celerates', 'credential_id' => 'MSIB-B6-CELERATES-2024'],
            (object) ['title' => 'OWASP Top 10 & Penetration Testing', 'subtitle' => 'Workshop / Training', 'year' => '2024', 'issuer' => 'Cyber Security Training', 'credential_id' => 'OWASP-PT-2024'],
            (object) ['title' => 'MikroTik MTCNA', 'subtitle' => 'Network Administration', 'year' => '2023', 'issuer' => 'MikroTik Academy', 'credential_id' => 'MTCNA-2023-NTB'],
            (object) ['title' => 'Laravel Developer', 'subtitle' => 'Web Development', 'year' => '2024', 'issuer' => 'Web Dev Bootcamp', 'credential_id' => 'LARAVEL-2024'],
        ]);
    }

    if (!isset($posts)) {
        try {
            $posts = class_exists(\App\Models\Post::class) ? \App\Models\Post::where('status', 'Published')->latest()->get() : collect();
        } catch (\Throwable $e) {
            $posts = collect();
        }
    }
    if ($posts->isEmpty()) {
        $posts = collect([
            (object) ['title' => 'Memahami VLAN pada MikroTik', 'category' => 'Networking', 'date' => '12 Sep 2026', 'excerpt' => 'Konsep dasar, konfigurasi, dan implementasi.', 'content' => "Virtual Local Area Network (VLAN) memungkinkan administrator jaringan membagi satu switch/router fisik menjadi beberapa broadcast domain logis.\n\nLangkah konfigurasi di MikroTik RouterOS v7 meliputi pembuatan Bridge VLAN Filtering, penentuan Access Port (PVID) dan Trunk Port, serta isolasi Firewall antar-VLAN."],
            (object) ['title' => 'Dasar Penetration Testing dengan OWASP Top 10', 'category' => 'Cyber Security', 'date' => '28 Agu 2026', 'excerpt' => 'Langkah-langkah melakukan testing pada aplikasi web.', 'content' => "Tahapan pengujian penetrasi berbasis OWASP Top 10 dimulai dari Scope & Planning, Information Gathering (Nmap), Vulnerability Analysis (Burp Suite & OWASP ZAP), Exploitation/Verification, hingga penyusunan laporan remediasi."],
            (object) ['title' => 'Troubleshooting PPPoE di MikroTik', 'category' => 'Networking', 'date' => '15 Agu 2026', 'excerpt' => 'Solusi umum dan tips yang sering terjadi.', 'content' => "Panduan memeriksa redaman optik FTTH/ONT, konfigurasi Keepalive Timeout pada PPPoE Server, serta penyesuaian TCP MSS Clamping agar koneksi pelanggan tetap stabil."],
            (object) ['title' => 'Konsep Zero Trust dalam Keamanan Jaringan', 'category' => 'Cyber Security', 'date' => '02 Agu 2026', 'excerpt' => 'Pendekatan modern untuk keamanan.', 'content' => "Zero Trust berpegang pada prinsip 'Never Trust, Always Verify' melalui micro-segmentation VLAN, least-privilege access control, dan pemantauan log berkelanjutan."],
        ]);
    }

    if (!isset($githubRepos) || empty($githubRepos)) {
        $githubRepos = (!empty($settings->github_repos) && is_array($settings->github_repos))
            ? $settings->github_repos
            : [
                ['name' => 'web-portfolio', 'tech' => 'Laravel 12 + Tailwind CSS', 'stars' => 12, 'url' => 'https://github.com/muhammadsyarief/web-portfolio'],
                ['name' => 'flask-recommender', 'tech' => 'Python + K-Means + FP-Growth', 'stars' => 8, 'url' => 'https://github.com/muhammadsyarief/flask-recommender'],
                ['name' => 'mikrotik-config', 'tech' => 'Network Configuration', 'stars' => 5, 'url' => 'https://github.com/muhammadsyarief/mikrotik-config'],
            ];
    }
@endphp
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $settings->name }} — {{ $settings->headline }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }
        .tabular-nums { font-variant-numeric: tabular-nums; }
        #ats-cv-print-root,
        #ats-cv-print-root * {
            box-sizing: border-box;
            border-color: #cbd5e1;
        }
        #ats-cv-print-root {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }
        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm 12mm;
            }
            html, body {
                background: #ffffff !important;
                color: #0f172a !important;
                margin: 0 !important;
                padding: 0 !important;
                height: auto !important;
                overflow: visible !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            body > header,
            body > main,
            body > footer,
            .no-print {
                display: none !important;
            }
            .cv-modal-backdrop,
            .cv-modal-dialog,
            .cv-modal-scroll {
                position: static !important;
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                max-height: none !important;
                height: auto !important;
                overflow: visible !important;
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }
            #ats-cv-print-root {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
                color: #0f172a !important;
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
    <script>
        function downloadAtsCvPdf() {
            const element = document.getElementById('ats-cv-print-root');
            if (!element) return;
            if (typeof html2pdf !== 'undefined') {
                const opt = {
                    margin: [10, 12, 10, 12],
                    filename: 'CV-ATS-{{ Str::slug($settings->name ?? "Muhammad-Syarief") }}.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: '#ffffff',
                        logging: false
                    },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                };
                html2pdf().set(opt).from(element).save();
            } else {
                window.print();
            }
        }
    </script>
</head>
<body
    x-data="{
        themeBg: localStorage.getItem('portfolio_theme') || '{{ $settings->theme_bg ?? 'dark-navy' }}',
        showBgMenu: false,
        isLight: false,
        selectedCategory: 'Semua',
        activeCaseStudy: {{ Js::from($projects->first()) }},
        caseTab: 'Overview',
        cvModal: false,
        showCvPhoto: true,
        certModal: null,
        blogModal: null,
        mobileNav: false,
        setTheme(mode) {
            this.themeBg = mode;
            this.isLight = (mode === 'light');
            localStorage.setItem('portfolio_theme', mode);
            this.showBgMenu = false;
        },
        get bgCanvasClass() {
            if (this.themeBg === 'light') return 'bg-[#F8FAFC] text-slate-900';
            if (this.themeBg === 'midnight-cyber') return 'bg-gradient-to-br from-[#030712] via-[#091938] to-[#042438] text-slate-100';
            if (this.themeBg === 'emerald-matrix') return 'bg-gradient-to-br from-[#03120E] via-[#07221C] to-[#060D1A] text-slate-100';
            if (this.themeBg === 'royal-indigo') return 'bg-gradient-to-br from-[#09061A] via-[#130F33] to-[#060D1A] text-slate-100';
            return 'bg-[#060D1A] text-slate-100';
        }
    }"
    x-init="isLight = (themeBg === 'light')"
    :class="bgCanvasClass"
    class="min-h-screen antialiased selection:bg-sky-500/30 selection:text-sky-200 transition-colors duration-200"
>
    <!-- HEADER (Top Bar 3-Zone Contract) -->
    <header
        :class="isLight ? 'bg-white/90 border-slate-200' : 'bg-[#060D1A]/90 border-slate-800/80'"
        class="sticky top-0 z-40 border-b backdrop-blur-md"
    >
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="#home" class="text-xl font-extrabold tracking-tight text-sky-400">MS</a>

            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-400">
                <a href="#home" class="text-sky-400 hover:underline underline-offset-8">Home</a>
                <a href="#about" class="hover:text-sky-400 hover:underline underline-offset-8">About</a>
                <a href="#skills" class="hover:text-sky-400 hover:underline underline-offset-8">Skills</a>
                <a href="#projects" class="hover:text-sky-400 hover:underline underline-offset-8">Projects</a>
                <a href="#case-studies" class="hover:text-sky-400 hover:underline underline-offset-8">Case Studies</a>
                <a href="#blog" class="hidden xl:inline-block hover:text-sky-400 hover:underline underline-offset-8">Blog</a>
                <a href="#contact" class="hidden xl:inline-block hover:text-sky-400 hover:underline underline-offset-8">Contact</a>
            </nav>

            <div class="flex items-center gap-2.5 relative">
                <!-- Fitur Ganti Background Dropdown -->
                <div class="relative">
                    <button
                        type="button"
                        @click="showBgMenu = !showBgMenu"
                        :class="isLight ? 'bg-slate-100 border-slate-300 text-slate-800' : 'bg-[#0B1528] border-slate-700 text-sky-400'"
                        class="px-3 py-2 rounded-lg border text-xs font-semibold flex items-center gap-1.5 cursor-pointer whitespace-nowrap"
                    >
                        <span>🎨 Ganti Background</span>
                    </button>
                    <div
                        x-show="showBgMenu"
                        @click.outside="showBgMenu = false"
                        x-cloak
                        class="absolute right-0 mt-2 w-52 rounded-xl bg-[#0B1528] border border-slate-700 shadow-2xl p-1.5 z-50 text-xs text-slate-200 space-y-1"
                    >
                        <button type="button" @click="setTheme('dark-navy')" :class="themeBg === 'dark-navy' ? 'bg-sky-500 text-white' : 'hover:bg-slate-800'" class="w-full text-left px-3 py-2 rounded-lg block cursor-pointer">🌌 Dark Navy (Default)</button>
                        <button type="button" @click="setTheme('light')" :class="themeBg === 'light' ? 'bg-sky-500 text-white' : 'hover:bg-slate-800'" class="w-full text-left px-3 py-2 rounded-lg block cursor-pointer">☀️ Light Mode (Terang)</button>
                        <button type="button" @click="setTheme('midnight-cyber')" :class="themeBg === 'midnight-cyber' ? 'bg-sky-500 text-white' : 'hover:bg-slate-800'" class="w-full text-left px-3 py-2 rounded-lg block cursor-pointer">🛡️ Midnight Cyber</button>
                        <button type="button" @click="setTheme('emerald-matrix')" :class="themeBg === 'emerald-matrix' ? 'bg-sky-500 text-white' : 'hover:bg-slate-800'" class="w-full text-left px-3 py-2 rounded-lg block cursor-pointer">💻 Emerald Matrix</button>
                        <button type="button" @click="setTheme('royal-indigo')" :class="themeBg === 'royal-indigo' ? 'bg-sky-500 text-white' : 'hover:bg-slate-800'" class="w-full text-left px-3 py-2 rounded-lg block cursor-pointer">✨ Royal Indigo</button>
                    </div>
                </div>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-lg text-xs font-semibold bg-sky-500 text-white hover:bg-sky-400 transition-colors whitespace-nowrap">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-2 rounded-lg text-xs font-semibold bg-[#0F1B33] text-sky-400 border border-sky-500/30 hover:bg-sky-500 hover:text-white transition-colors whitespace-nowrap">
                        Login Admin
                    </a>
                @endauth

                <button @click="mobileNav = !mobileNav" class="md:hidden p-2 rounded-lg border border-slate-800 text-slate-300">
                    ☰
                </button>
            </div>
        </div>

        <div x-show="mobileNav" x-cloak class="md:hidden px-4 pt-2 pb-4 border-t border-slate-800 bg-[#081121] space-y-2 text-sm text-slate-200">
            <a href="#home" @click="mobileNav = false" class="block py-1.5">Home</a>
            <a href="#about" @click="mobileNav = false" class="block py-1.5">About</a>
            <a href="#skills" @click="mobileNav = false" class="block py-1.5">Skills</a>
            <a href="#projects" @click="mobileNav = false" class="block py-1.5">Projects</a>
            <a href="#case-studies" @click="mobileNav = false" class="block py-1.5">Case Studies</a>
            <a href="#experience" @click="mobileNav = false" class="block py-1.5">Experience</a>
            <a href="#certifications" @click="mobileNav = false" class="block py-1.5">Certifications</a>
            <a href="#blog" @click="mobileNav = false" class="block py-1.5">Blog</a>
            <a href="#contact" @click="mobileNav = false" class="block py-1.5">Contact</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 space-y-24 py-10 md:py-16">
        <!-- 1. HERO SECTION (Panel 1) -->
        <section id="home" class="space-y-12 scroll-mt-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <p class="text-base md:text-lg font-semibold text-sky-400">Hello, I'm</p>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight">
                            {{ explode(' ', trim($settings->name))[0] ?? 'Muhammad' }}
                            <span class="text-sky-400">{{ implode(' ', array_slice(explode(' ', trim($settings->name)), 1)) ?: 'Syarief' }}</span>
                        </h1>
                        <p class="text-base sm:text-lg font-medium opacity-90 pt-1">{{ $settings->headline }}</p>
                    </div>
                    <p class="text-sm sm:text-base text-slate-400 leading-relaxed max-w-xl">{{ $settings->hero_bio }}</p>
                    <div class="flex flex-wrap items-center gap-3.5">
                        <button @click="cvModal = true" class="px-5 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-white text-sm font-semibold shadow-lg shadow-sky-500/20 transition-colors cursor-pointer">
                            Download CV ↓
                        </button>
                        <a href="#projects" class="px-5 py-2.5 rounded-xl border border-slate-700 bg-[#0B1528] hover:border-sky-500/50 text-slate-200 text-sm font-semibold transition-colors">
                            View Projects →
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-5 flex justify-center">
                    <div class="w-full max-w-sm rounded-2xl overflow-hidden border border-sky-500/25 bg-[#0B1528] p-6 text-center shadow-2xl">
                        <img
                            src="{{ !empty($settings->avatar_url) ? $settings->avatar_url : asset('images/syarief-portrait.jpg') }}"
                            alt="{{ $settings->name }}"
                            class="w-full h-80 object-cover object-top rounded-xl mb-4"
                            onerror="this.style.display='none'"
                        />
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800">
                            <p class="text-lg font-bold text-white">{{ $settings->name }}</p>
                            <p class="text-xs text-sky-400 mt-1">{{ $settings->headline }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Stats Bar (Dapat diubah dari Admin Dashboard) -->
            <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-5 rounded-2xl border">
                <div class="px-2">
                    <div class="text-2xl font-extrabold tabular-nums text-sky-400">{{ $settings->stat_years ?? '4+' }}</div>
                    <div class="text-xs text-slate-400">{{ $settings->stat_years_label ?? 'Years of Study' }}</div>
                </div>
                <div class="px-2">
                    <div class="text-2xl font-extrabold tabular-nums text-sky-400">{{ $settings->stat_projects ?? ($projects->count() . '+') }}</div>
                    <div class="text-xs text-slate-400">{{ $settings->stat_projects_label ?? 'Projects Completed' }}</div>
                </div>
                <div class="px-2">
                    <div class="text-2xl font-extrabold tabular-nums text-sky-400">{{ $settings->stat_tools ?? '10+' }}</div>
                    <div class="text-xs text-slate-400">{{ $settings->stat_tools_label ?? 'Tools Mastered' }}</div>
                </div>
                <div class="px-2">
                    <div class="text-2xl font-extrabold tabular-nums text-sky-400">{{ $settings->stat_learning ?? '100%' }}</div>
                    <div class="text-xs text-slate-400">{{ $settings->stat_learning_label ?? 'Always Learning' }}</div>
                </div>
            </div>
        </section>

        <!-- 2. ABOUT ME (Panel 2) -->
        <section id="about" class="scroll-mt-24">
            <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="rounded-2xl border p-6 sm:p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <p class="text-xs font-semibold text-sky-400 mb-1">Tentang Saya</p>
                        <h2 class="text-2xl sm:text-3xl font-bold">About Me</h2>
                    </div>
                    <p class="text-sm sm:text-base text-slate-400 leading-relaxed">{{ $settings->about_bio }}</p>
                    <div class="divide-y divide-slate-800/60 text-xs sm:text-sm">
                        <div class="py-3 flex justify-between gap-4"><span class="text-slate-400">Nama</span><span class="font-semibold text-right">{{ $settings->name }}</span></div>
                        <div class="py-3 flex justify-between gap-4">
                            <span class="text-slate-400">Pendidikan</span>
                            <div class="text-right">
                                <p class="font-semibold">{{ $settings->education_degree }}</p>
                                <p class="text-xs text-slate-400">{{ $settings->education_concentration }}</p>
                            </div>
                        </div>
                        <div class="py-3 flex justify-between gap-4"><span class="text-slate-400">IPK</span><span class="font-semibold font-mono">{{ $settings->gpa }}</span></div>
                        <div class="py-3 flex justify-between gap-4"><span class="text-slate-400">Tahun Lulus</span><span class="font-semibold font-mono">{{ $settings->graduation_year }}</span></div>
                        <div class="py-3 flex justify-between gap-4"><span class="text-slate-400">Lokasi</span><span class="font-semibold">{{ $settings->location }}</span></div>
                    </div>
                    <button @click="cvModal = true" class="px-5 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-white text-xs sm:text-sm font-semibold cursor-pointer">
                        Lihat CV Lengkap
                    </button>
                </div>

                <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                    <div>
                        <h3 class="text-base font-bold mb-5">Pengalaman Singkat</h3>
                        <div class="relative pl-6 border-l border-sky-500/30 space-y-6">
                            @foreach($experiences as $exp)
                                <div class="relative">
                                    <span class="absolute -left-[29px] top-1.5 w-2.5 h-2.5 rounded-full bg-sky-400 ring-4 ring-sky-400/15"></span>
                                    <h4 class="text-sm font-semibold">{{ $exp->role }} <span class="text-sky-400 font-mono text-xs">({{ $exp->period }})</span></h4>
                                    <p class="text-xs text-slate-400 mt-1">{{ $exp->organization }} · {{ $exp->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-5 rounded-xl border border-slate-800 bg-[#0F1B33] text-slate-100">
                        <p class="text-sm italic">“{{ $settings->quote_about ?? 'Terus belajar, karena teknologi tidak pernah berhenti berkembang.' }}”</p>
                        <p class="text-xs text-slate-400 mt-2">— {{ $settings->name }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. SKILLS / KEAHLIAN (Panel 3) -->
        <section id="skills" class="space-y-6 scroll-mt-24">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold">Keahlian</h2>
                <p class="text-sm text-slate-400 mt-1">Kombinasi kemampuan teknis dan soft skill yang saya kuasai.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($skills as $category)
                    <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-6 rounded-2xl border">
                        <h3 class="text-lg font-bold pb-4 mb-4 border-b border-slate-800/60 text-sky-400">{{ $category->name }}</h3>
                        <ul class="space-y-2.5 text-sm">
                            @foreach((is_array($category->items) ? $category->items : json_decode($category->items, true) ?? []) as $item)
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 4. PROJECTS OVERVIEW / PROYEK SAYA (Panel 4) -->
        <section id="projects" class="space-y-6 scroll-mt-24">
            <div class="space-y-4">
                <h2 class="text-2xl sm:text-3xl font-bold">Proyek Saya</h2>
                <p class="text-sm text-slate-400">Beberapa proyek yang pernah saya kerjakan, baik untuk kebutuhan akademik maupun pengalaman profesional.</p>
                <div class="flex items-center gap-2 overflow-x-auto pb-1">
                    @foreach(['Semua', 'Cyber Security', 'Networking', 'IT Support', 'Development'] as $cat)
                        <button
                            @click="selectedCategory = '{{ $cat }}'"
                            :class="selectedCategory === '{{ $cat }}' ? 'bg-sky-500 text-white' : 'bg-[#0B1528] border border-slate-800 text-slate-400'"
                            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-medium whitespace-nowrap cursor-pointer"
                        >
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($projects as $proj)
                    <div
                        x-show="selectedCategory === 'Semua' || selectedCategory === '{{ $proj->category }}'"
                        :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'"
                        class="p-6 rounded-2xl border flex flex-col justify-between gap-4 hover:border-sky-500/40 transition-colors"
                    >
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold">{{ $proj->title }}</h3>
                            <p class="text-xs text-sky-400 font-medium">{{ $proj->category }} · {{ $proj->date }}</p>
                            <p class="text-sm text-slate-400 leading-relaxed">{{ $proj->summary }}</p>
                        </div>
                        <div class="pt-3 border-t border-slate-800/60 flex justify-end">
                            <a
                                href="#case-studies"
                                @click="activeCaseStudy = {{ Js::from($proj) }}; caseTab = 'Overview'"
                                class="text-xs sm:text-sm font-semibold text-sky-400 hover:text-sky-300"
                            >
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 5. CASE STUDY DETAIL (Panel 5) -->
        <section id="case-studies" class="scroll-mt-24" x-show="activeCaseStudy">
            <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="rounded-2xl border p-6 md:p-8 space-y-6">
                <!-- Project Switcher Bar -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-slate-800/60">
                    <div class="text-xs md:text-sm">
                        <span class="text-slate-400">Projects / </span>
                        <span class="text-sky-400 font-semibold" x-text="activeCaseStudy.title"></span>
                    </div>
                    <div class="flex items-center gap-1.5 overflow-x-auto">
                        @foreach($projects as $p)
                            <button
                                @click="activeCaseStudy = {{ Js::from($p) }}; caseTab = 'Overview'"
                                :class="activeCaseStudy.title === '{{ $p->title }}' ? 'bg-sky-500 text-white' : 'bg-[#111E36] text-slate-400'"
                                class="px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap cursor-pointer"
                            >
                                {{ $p->title }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Header -->
                <div>
                    <p class="text-xs text-sky-400 font-medium" x-text="activeCaseStudy.category + ' · ' + activeCaseStudy.date"></p>
                    <h3 class="text-2xl md:text-3xl font-bold mt-1" x-text="activeCaseStudy.title"></h3>
                    <p class="text-sm text-slate-400 mt-1 max-w-3xl" x-text="activeCaseStudy.summary"></p>
                </div>

                <!-- Interactive Case Study Sub-Tabs -->
                <div class="flex items-center gap-1 overflow-x-auto border-b border-slate-800/60">
                    <template x-for="tab in ['Overview', 'Methodology', 'Findings', 'Solution', 'Result']" :key="tab">
                        <button
                            @click="caseTab = tab"
                            :class="caseTab === tab ? 'border-sky-400 text-sky-400' : 'border-transparent text-slate-400'"
                            class="px-4 py-2.5 text-xs md:text-sm font-medium border-b-2 whitespace-nowrap cursor-pointer"
                            x-text="tab"
                        ></button>
                    </template>
                </div>

                <!-- Overview Tab -->
                <div x-show="caseTab === 'Overview'" class="grid grid-cols-1 lg:grid-cols-2 gap-8 pt-2">
                    <div class="space-y-5">
                        <div>
                            <h4 class="text-sm font-semibold text-sky-400 mb-1">1. Problem</h4>
                            <p class="text-sm text-slate-400 leading-relaxed" x-text="activeCaseStudy.problem"></p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-sky-400 mb-1">2. Objective</h4>
                            <p class="text-sm text-slate-400 leading-relaxed" x-text="activeCaseStudy.objective"></p>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-sky-400 mb-2">3. Tools</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <template x-for="tool in activeCaseStudy.tools" :key="tool">
                                    <div class="p-3 rounded-xl bg-[#0F1B33] border border-slate-800 text-xs font-medium text-slate-200" x-text="tool"></div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <h4 class="text-sm font-semibold text-sky-400 mb-2">4. Methodology</h4>
                            <template x-for="(step, idx) in activeCaseStudy.methodology" :key="idx">
                                <div class="text-sm py-1.5 border-b border-slate-800/40" x-text="(idx + 1) + '. ' + step"></div>
                            </template>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-sky-400 mb-2">5. Key Findings</h4>
                            <template x-for="finding in activeCaseStudy.findings" :key="finding">
                                <div class="text-sm py-1 text-slate-300" x-text="'• ' + finding"></div>
                            </template>
                        </div>
                        <div class="pt-2 flex justify-end">
                            <button @click="caseTab = 'Solution'" class="px-4 py-2.5 rounded-lg bg-sky-500 hover:bg-sky-400 text-white text-xs font-semibold cursor-pointer">
                                Lihat Solusi & Hasil →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Other Tabs -->
                <div x-show="caseTab !== 'Overview'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div class="p-5 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-2 text-slate-100">
                        <h4 class="text-sm font-semibold text-sky-400">Rekomendasi & Implementasi Solusi</h4>
                        <p class="text-sm text-slate-300 leading-relaxed" x-text="activeCaseStudy.solution"></p>
                    </div>
                    <div class="p-5 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-2 text-slate-100">
                        <h4 class="text-sm font-semibold text-emerald-400">Hasil Akhir & Dampak Terukur</h4>
                        <p class="text-sm text-slate-300 leading-relaxed" x-text="activeCaseStudy.result"></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. PENGALAMAN & PENDIDIKAN (Panel 6) -->
        <section id="experience" class="space-y-6 scroll-mt-24">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold">Pengalaman & Pendidikan</h2>
                <p class="text-sm text-slate-400 mt-1">Perjalanan saya dalam belajar, bekerja, dan berkontribusi.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="lg:col-span-7 p-6 sm:p-8 rounded-2xl border">
                    <h3 class="text-lg font-bold mb-6">Pengalaman Kerja</h3>
                    <div class="relative pl-6 border-l border-sky-500/30 space-y-7">
                        @foreach($experiences as $exp)
                            <div class="relative">
                                <span class="absolute -left-[29px] top-1.5 w-2.5 h-2.5 rounded-full bg-sky-400 ring-4 ring-sky-400/15"></span>
                                <p class="text-xs font-mono text-sky-400">{{ $exp->period }}</p>
                                <h4 class="text-base font-bold mt-0.5">{{ $exp->role }}</h4>
                                <p class="text-xs font-medium text-slate-300 mt-0.5">{{ $exp->organization }}</p>
                                <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">{{ $exp->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-5 flex flex-col justify-between gap-6">
                    <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-6 sm:p-8 rounded-2xl border">
                        <h3 class="text-lg font-bold mb-4">Pendidikan</h3>
                        <h4 class="text-base font-bold">{{ $settings->education_university ?? 'Universitas Bumigora' }}</h4>
                        <p class="text-sm text-sky-400 font-medium mt-1">{{ $settings->education_concentration ?? 'Informatika – Cyber Security' }}</p>
                        <p class="text-xs font-mono text-slate-400 mt-1">{{ $settings->education_period ?? '2021 – 2024' }}</p>
                        <p class="text-xs font-semibold text-emerald-400 mt-2">IPK {{ $settings->gpa }}</p>
                    </div>

                    <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-6 sm:p-8 rounded-2xl border flex-1 flex flex-col justify-center">
                        <p class="text-base italic leading-relaxed">“{{ $settings->quote_education ?? 'Ilmu yang bermanfaat adalah ilmu yang diamalkan, bukan hanya diingat.' }}”</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7 & 8. CERTIFICATIONS & BLOG (Panels 7 & 8) -->
        <section id="certifications" class="grid grid-cols-1 lg:grid-cols-12 gap-8 scroll-mt-24">
            <div class="lg:col-span-6 space-y-4">
                <div>
                    <h2 class="text-2xl font-bold">Sertifikasi & Pelatihan</h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Beberapa sertifikasi dan pelatihan yang telah saya ikuti.</p>
                </div>
                @foreach($certificates as $cert)
                    <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-4 sm:p-5 rounded-2xl border flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-sm font-bold">{{ $cert->title }}</h3>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $cert->subtitle }}</p>
                            <p class="text-xs font-mono text-sky-400 mt-1">{{ $cert->year }}</p>
                        </div>
                        <button
                            @click="certModal = {{ Js::from($cert) }}"
                            class="px-3 py-1.5 rounded-lg bg-[#0F1B33] border border-slate-700 text-xs text-slate-200 hover:border-sky-500/50 whitespace-nowrap cursor-pointer"
                        >
                            Lihat Sertifikat
                        </button>
                    </div>
                @endforeach
            </div>

            <div id="blog" class="lg:col-span-6 space-y-4 scroll-mt-24">
                <div>
                    <h2 class="text-2xl font-bold">Blog / Catatan Teknis</h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Berbagi pengetahuan dan pengalaman seputar teknologi.</p>
                </div>
                @foreach($posts as $post)
                    <div
                        @click="blogModal = {{ Js::from($post) }}"
                        :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'"
                        class="p-4 sm:p-5 rounded-2xl border space-y-1 hover:border-sky-500/40 transition-colors cursor-pointer"
                    >
                        <div class="text-xs text-sky-400">{{ $post->category }} · {{ $post->date }}</div>
                        <h3 class="text-sm font-bold">{{ $post->title }}</h3>
                        <p class="text-xs text-slate-400">{{ $post->excerpt }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 9 & 10. GITHUB & CONTACT (Panels 9 & 10) -->
        <section id="contact" class="grid grid-cols-1 lg:grid-cols-12 gap-8 scroll-mt-24">
            <div class="lg:col-span-5 space-y-4">
                <div>
                    <h2 class="text-2xl font-bold">GitHub</h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Beberapa project yang saya kerjakan di GitHub.</p>
                </div>
                <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-6 rounded-2xl border space-y-5">
                    <div>
                        <h3 class="text-base font-bold">{{ $settings->github_username }}</h3>
                        <p class="text-xs text-slate-400">{{ $settings->github_bio }}</p>
                    </div>
                    <div class="grid grid-cols-3 divide-x divide-slate-800 border-y border-slate-800 py-3 text-center">
                        <div><div class="text-base font-bold tabular-nums">{{ $settings->github_repos_count ?? 12 }}</div><div class="text-xs text-slate-400">Repositories</div></div>
                        <div><div class="text-base font-bold tabular-nums">{{ $settings->github_followers ?? 3 }}</div><div class="text-xs text-slate-400">Followers</div></div>
                        <div><div class="text-base font-bold tabular-nums">{{ $settings->github_following ?? 2 }}</div><div class="text-xs text-slate-400">Following</div></div>
                    </div>
                    <div class="space-y-2.5">
                        @foreach($githubRepos as $repo)
                            <a href="{{ $repo['url'] ?? '#' }}" target="_blank" class="block p-3.5 rounded-xl border border-slate-800 bg-[#0F1B33] text-slate-100 hover:border-sky-500/40 transition-colors">
                                <div class="flex justify-between text-xs font-semibold">
                                    <span>{{ $repo['name'] ?? '' }}</span>
                                    <span class="text-amber-400">★ {{ $repo['stars'] ?? 0 }}</span>
                                </div>
                                <p class="text-xs text-sky-400 mt-1">{{ $repo['tech'] ?? '' }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 space-y-4">
                <div>
                    <h2 class="text-2xl font-bold">Hubungi Saya</h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">Jika ada pertanyaan, proyek, atau sekadar ingin berdiskusi, silakan hubungi saya melalui kontak di bawah ini.</p>
                </div>

                @if(session('success'))
                    <div class="p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                    <div class="md:col-span-5 space-y-3">
                        <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-4 rounded-xl border">
                            <p class="text-xs font-semibold">Email</p>
                            <p class="text-xs text-slate-400 truncate">{{ $settings->email }}</p>
                        </div>
                        <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-4 rounded-xl border">
                            <p class="text-xs font-semibold">WhatsApp</p>
                            <p class="text-xs text-slate-400 font-mono">{{ $settings->whatsapp }}</p>
                        </div>
                        <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-4 rounded-xl border">
                            <p class="text-xs font-semibold">LinkedIn</p>
                            <p class="text-xs text-slate-400 truncate">{{ $settings->linkedin }}</p>
                        </div>
                        <div :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="p-4 rounded-xl border">
                            <p class="text-xs font-semibold">Lokasi</p>
                            <p class="text-xs text-sky-400">{{ $settings->location }}</p>
                        </div>
                    </div>

                    <form action="{{ url('/contact') }}" method="POST" :class="isLight ? 'bg-white border-slate-200' : 'bg-[#0B1528] border-slate-800/80'" class="md:col-span-7 p-5 rounded-2xl border space-y-3.5">
                        @csrf
                        <input type="text" name="name" required placeholder="Nama" class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                        <input type="email" name="email" required placeholder="Email" class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                        <textarea name="message" rows="4" required placeholder="Pesan" class="w-full px-3.5 py-2.5 rounded-xl bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-sky-500 hover:bg-sky-400 text-white text-sm font-semibold cursor-pointer">
                            Kirim Pesan →
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- INSPIRATIONAL QUOTE BANNER -->
        <section
            class="relative rounded-2xl border border-slate-800/80 overflow-hidden bg-gradient-to-b from-[#0B1528] to-[#060D1A] p-8 md:p-12 text-center space-y-3"
        >
            @if(!empty($settings->quote_bg_url))
                <img src="{{ $settings->quote_bg_url }}" alt="Quote Background" class="absolute inset-0 w-full h-full object-cover opacity-35" />
            @endif
            <div class="relative z-10 space-y-3">
                <p class="text-lg sm:text-2xl font-semibold text-white max-w-2xl mx-auto leading-relaxed">
                    “{{ $settings->quote_footer ?? 'Teknologi adalah alat, yang paling penting adalah bagaimana kita menggunakannya untuk memberi manfaat.' }}”
                </p>
                <p class="text-sm font-medium text-sky-400">— {{ $settings->name }}</p>
            </div>
        </section>
    </main>

    <!-- MODAL CV PROFESIONAL STANDAR ATS + FOTO PROFIL -->
    <div x-show="cvModal" x-cloak class="cv-modal-backdrop fixed inset-0 z-50 flex items-start justify-center bg-black/85 backdrop-blur-sm p-3 sm:p-6 overflow-y-auto">
        <div class="cv-modal-dialog relative w-full max-w-4xl rounded-2xl bg-[#0B1528] border border-slate-800 text-slate-100 shadow-2xl overflow-hidden my-4">
            <!-- Top Action Bar (Disembunyikan saat cetak PDF) -->
            <div class="no-print flex flex-wrap items-center justify-between gap-3 px-5 py-4 bg-[#071020] border-b border-slate-800 sticky top-0 z-20">
                <div>
                    <h3 class="text-sm font-bold text-white">CV Profesional Standar ATS — {{ $settings->name }}</h3>
                    <p class="text-[11px] text-slate-400">Otomatis tersinkronisasi dengan foto & seluruh isi portofolio Anda</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <button
                        type="button"
                        @click="showCvPhoto = !showCvPhoto"
                        class="px-3 py-1.5 rounded-lg bg-[#0F1B33] hover:bg-slate-800 border border-slate-700 text-slate-200 text-xs font-medium cursor-pointer"
                        x-text="showCvPhoto ? 'Sembunyikan Foto' : 'Tampilkan Foto'"
                    ></button>
                    <button
                        type="button"
                        onclick="downloadAtsCvPdf()"
                        class="px-4 py-1.5 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-white text-xs font-semibold shadow-lg shadow-emerald-500/20 cursor-pointer"
                    >
                        ⬇ Download File .PDF Langsung
                    </button>
                    <button
                        type="button"
                        onclick="window.print()"
                        class="px-3.5 py-1.5 rounded-lg bg-sky-500 hover:bg-sky-400 text-white text-xs font-semibold cursor-pointer"
                    >
                        🖨️ Cetak / Save PDF
                    </button>
                    <button
                        type="button"
                        @click="cvModal = false"
                        class="px-2.5 py-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 cursor-pointer"
                    >
                        ✕
                    </button>
                </div>
            </div>

            <!-- Lembar Kertas A4 Putih Standar ATS -->
            <div class="cv-modal-scroll p-4 sm:p-8 bg-slate-900/90 overflow-y-auto max-h-[84vh]">
                <div id="ats-cv-print-root" class="mx-auto bg-white text-slate-900 rounded-xl shadow-2xl p-6 sm:p-10 max-w-[210mm] leading-relaxed">
                    <!-- 1. HEADER CV ATS + FOTO PROFIL -->
                    <header class="border-b-2 border-slate-900 pb-5 mb-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                        <div class="space-y-1.5 flex-1">
                            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight uppercase text-slate-900">
                                {{ $settings->name }}
                            </h1>
                            <p class="text-sm sm:text-base font-bold text-sky-700">
                                {{ $settings->headline }}
                            </p>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-700 pt-1">
                                <span>📍 {{ $settings->location }}</span>
                                <span>📞 {{ $settings->whatsapp }}</span>
                                <span>✉️ {{ $settings->email }}</span>
                                <span>🔗 {{ $settings->linkedin }}</span>
                                <span class="font-mono">github.com/{{ $settings->github_username }}</span>
                            </div>
                        </div>

                        <div x-show="showCvPhoto" class="w-24 h-28 sm:w-28 sm:h-32 rounded-lg overflow-hidden border-2 border-slate-300 shadow-xs shrink-0 bg-slate-100">
                            <img
                                src="{{ !empty($settings->avatar_url) ? $settings->avatar_url : asset('images/syarief-portrait.jpg') }}"
                                alt="{{ $settings->name }}"
                                class="w-full h-full object-cover object-top"
                                onerror="this.parentElement.style.display='none'"
                            />
                        </div>
                    </header>

                    <!-- 2. RINGKASAN PROFESIONAL (PROFESSIONAL SUMMARY) -->
                    <section class="mb-5">
                        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1 mb-2">
                            Ringkasan Profesional (Professional Summary)
                        </h2>
                        <p class="text-xs sm:text-[13px] text-slate-800 leading-relaxed text-justify">
                            {{ $settings->hero_bio }} {{ $settings->about_bio }}
                        </p>
                    </section>

                    <!-- 3. PENDIDIKAN (EDUCATION) -->
                    <section class="mb-5">
                        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1 mb-2.5">
                            Pendidikan (Education)
                        </h2>
                        <div class="flex flex-wrap items-baseline justify-between gap-2">
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">
                                    {{ $settings->education_university ?? 'Universitas Bumigora' }}
                                </h3>
                                <p class="text-xs sm:text-[13px] font-semibold text-slate-800">
                                    {{ $settings->education_degree }} — {{ $settings->education_concentration }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-slate-800 block">
                                    {{ $settings->education_period ?? ('Lulus: ' . $settings->graduation_year) }}
                                </span>
                                <span class="text-xs font-semibold text-sky-800">
                                    IPK: {{ $settings->gpa }}
                                </span>
                            </div>
                        </div>
                    </section>

                    <!-- 4. PENGALAMAN KERJA & PRAKTIK (WORK EXPERIENCE) -->
                    <section class="mb-5">
                        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1 mb-2.5">
                            Pengalaman Kerja & Praktik (Work & Technical Experience)
                        </h2>
                        <div class="space-y-3">
                            @foreach($experiences as $exp)
                                <div>
                                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                                        <h3 class="text-xs sm:text-[13px] font-bold text-slate-900">
                                            {{ $exp->role }} <span class="font-semibold text-slate-700">| {{ $exp->organization }}</span>
                                        </h3>
                                        <span class="text-xs font-semibold text-slate-700 tabular-nums">{{ $exp->period }}</span>
                                    </div>
                                    <p class="text-xs text-slate-800 mt-0.5 leading-relaxed">• {{ $exp->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- 5. PROYEK TEKNIS & STUDI KASUS (KEY PROJECTS) -->
                    <section class="mb-5">
                        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1 mb-2.5">
                            Proyek Teknis & Studi Kasus (Key Projects & Case Studies)
                        </h2>
                        <div class="space-y-3">
                            @foreach($projects as $proj)
                                <div>
                                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                                        <h3 class="text-xs sm:text-[13px] font-bold text-slate-900">
                                            {{ $proj->title }} <span class="text-xs font-semibold text-sky-800">({{ $proj->category }})</span>
                                        </h3>
                                        <span class="text-xs font-semibold text-slate-700 tabular-nums">{{ $proj->date }}</span>
                                    </div>
                                    <p class="text-xs text-slate-800 mt-0.5 leading-relaxed">• <strong>Ringkasan:</strong> {{ $proj->summary }}</p>
                                    @if(!empty($proj->result))
                                        <p class="text-xs text-slate-800 leading-relaxed">• <strong>Hasil & Solusi:</strong> {{ $proj->result }}</p>
                                    @endif
                                    @if(!empty($proj->tools) && is_array($proj->tools))
                                        <p class="text-[11px] text-slate-700 mt-0.5">
                                            <strong>Tools & Teknologi:</strong> {{ implode(', ', $proj->tools) }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- 6. KEAHLIAN TEKNIS & KOMPETENSI (SKILLS) -->
                    <section class="mb-5">
                        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1 mb-2.5">
                            Keahlian Teknis & Kompetensi (Skills)
                        </h2>
                        <div class="space-y-1.5">
                            @foreach($skills as $sk)
                                <div class="text-xs leading-relaxed">
                                    <span class="font-bold text-slate-900">{{ $sk->name }}: </span>
                                    <span class="text-slate-800">{{ is_array($sk->items) ? implode(', ', $sk->items) : $sk->items }}</span>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- 7. SERTIFIKASI & PELATIHAN (CERTIFICATIONS) -->
                    <section>
                        <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-300 pb-1 mb-2.5">
                            Sertifikasi & Pelatihan (Certifications)
                        </h2>
                        <div class="space-y-2">
                            @foreach($certificates as $cert)
                                <div class="flex flex-wrap items-baseline justify-between gap-2 text-xs">
                                    <div>
                                        <span class="font-bold text-slate-900">{{ $cert->title }}</span>
                                        <span class="text-slate-700"> — {{ $cert->issuer }}</span>
                                        <p class="text-[11px] text-slate-700">{{ $cert->subtitle }}</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span class="font-bold text-slate-800">{{ $cert->year }}</span>
                                        @if(!empty($cert->credential_id))
                                            <span class="block text-[10px] font-mono text-slate-600">ID: {{ $cert->credential_id }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CERTIFICATE -->
    <div x-show="certModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <div class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 text-slate-100 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <h3 class="text-sm font-bold text-sky-400">Detail Sertifikat</h3>
                <button @click="certModal = null" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <div x-show="certModal" class="space-y-2">
                <h4 class="text-lg font-bold" x-text="certModal?.title"></h4>
                <p class="text-xs text-sky-400" x-text="certModal?.issuer + ' (' + certModal?.year + ')'"></p>
                <p class="text-xs text-slate-300" x-text="certModal?.subtitle"></p>
                <p class="text-xs font-mono text-slate-400 pt-2" x-text="'Credential ID: ' + certModal?.credential_id"></p>
            </div>
        </div>
    </div>

    <!-- MODAL BLOG -->
    <div x-show="blogModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <div class="w-full max-w-xl rounded-2xl bg-[#0B1528] border border-slate-800 p-6 text-slate-100 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <span class="text-xs text-sky-400" x-text="blogModal?.category + ' · ' + blogModal?.date"></span>
                <button @click="blogModal = null" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <h3 class="text-xl font-bold" x-text="blogModal?.title"></h3>
            <p class="text-sm text-slate-300 whitespace-pre-line leading-relaxed" x-text="blogModal?.content"></p>
        </div>
    </div>
</body>
</html>