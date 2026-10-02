<!doctype html>
<html lang="id" class="dark">
@php
    /*
     * AUTO-FALLBACK GUARD UNTUK DASHBOARD ADMIN:
     * Mencegah error "Undefined variable $projects" apabila view ini dipanggil
     * langsung tanpa AdminController.
     */
    if (!isset($settings) || !$settings) {
        try {
            $settings = class_exists(\App\Models\Setting::class) ? \App\Models\Setting::first() : null;
        } catch (\Throwable $e) {
            $settings = null;
        }
        if (!$settings) {
            $settings = (object) [
                'name' => 'Muhammad Syarifudin',
                'headline' => 'IT Support | Network & Cyber Security Enthusiast',
                'hero_bio' => 'Saya tertarik pada dunia jaringan, keamanan informasi, dan teknologi.',
                'about_bio' => 'Saya adalah lulusan Universitas Bumigora dengan program studi Informatika, konsentrasi Cyber Security.',
                'avatar_url' => '',
                'theme_bg' => 'dark-navy',
                'quote_bg_url' => '',
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
                'github_repos' => [
                    ['name' => 'web-portfolio', 'tech' => 'Laravel 12 + Tailwind CSS', 'stars' => 12, 'url' => 'https://github.com/muhammadsyarief/web-portfolio'],
                    ['name' => 'flask-recommender', 'tech' => 'Python + K-Means + FP-Growth', 'stars' => 8, 'url' => 'https://github.com/muhammadsyarief/flask-recommender'],
                    ['name' => 'mikrotik-config', 'tech' => 'Network Configuration', 'stars' => 5, 'url' => 'https://github.com/muhammadsyarief/mikrotik-config'],
                ],
            ];
        }
    }
    if (!isset($projects)) {
        try {
            $projects = class_exists(\App\Models\Project::class) ? \App\Models\Project::latest()->get() : collect();
        } catch (\Throwable $e) {
            $projects = collect();
        }
    }
    if (!isset($skills)) {
        try {
            $skills = class_exists(\App\Models\Skill::class) ? \App\Models\Skill::orderBy('order')->get() : collect();
        } catch (\Throwable $e) {
            $skills = collect();
        }
    }
    if (!isset($experiences)) {
        try {
            $experiences = class_exists(\App\Models\Experience::class) ? \App\Models\Experience::orderBy('order')->get() : collect();
        } catch (\Throwable $e) {
            $experiences = collect();
        }
    }
    if (!isset($certificates)) {
        try {
            $certificates = class_exists(\App\Models\Certificate::class) ? \App\Models\Certificate::orderBy('order')->get() : collect();
        } catch (\Throwable $e) {
            $certificates = collect();
        }
    }
    if (!isset($posts)) {
        try {
            $posts = class_exists(\App\Models\Post::class) ? \App\Models\Post::latest()->get() : collect();
        } catch (\Throwable $e) {
            $posts = collect();
        }
    }
    if (!isset($messages)) {
        try {
            $messages = class_exists(\App\Models\Message::class) ? \App\Models\Message::latest()->get() : collect();
        } catch (\Throwable $e) {
            $messages = collect();
        }
    }
    $githubReposList = (!empty($settings->github_repos) && is_array($settings->github_repos))
        ? $settings->github_repos
        : [
            ['name' => 'web-portfolio', 'tech' => 'Laravel 12 + Tailwind CSS', 'stars' => 12, 'url' => 'https://github.com/muhammadsyarief/web-portfolio'],
            ['name' => 'flask-recommender', 'tech' => 'Python + K-Means + FP-Growth', 'stars' => 8, 'url' => 'https://github.com/muhammadsyarief/flask-recommender'],
            ['name' => 'mikrotik-config', 'tech' => 'Network Configuration', 'stars' => 5, 'url' => 'https://github.com/muhammadsyarief/mikrotik-config'],
        ];
@endphp
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard — {{ $settings->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body
    x-data="{
        tab: 'Dashboard',
        showAddProject: false,
        editProject: null,
        showAddSkill: false,
        editSkill: null,
        showAddExp: false,
        editExp: null,
        showAddCert: false,
        editCert: null,
        showAddBlog: false,
        editBlog: null,
        showAddGithub: false
    }"
    class="min-h-screen bg-[#060D1A] text-slate-100 flex flex-col md:flex-row"
>
    <!-- Sidebar (Panel 11) -->
    <aside class="w-full md:w-64 bg-[#091326] border-r border-slate-800/80 flex flex-col justify-between shrink-0">
        <div>
            <div class="h-16 px-6 flex items-center justify-between border-b border-slate-800/80">
                <a href="{{ url('/') }}" class="text-xl font-extrabold text-sky-400">MS <span class="text-xs font-mono text-slate-400 font-normal">CMS</span></a>
                <a href="{{ url('/') }}" class="text-xs text-sky-400 hover:underline">← Lihat Web</a>
            </div>

            <nav class="p-3 space-y-1 flex md:flex-col overflow-x-auto">
                @foreach([
                    ['id' => 'Dashboard', 'label' => '📊 Dashboard'],
                    ['id' => 'Projects', 'label' => '📁 Projects & Case Study'],
                    ['id' => 'Skills', 'label' => '🛠️ Skills / Keahlian'],
                    ['id' => 'Experience', 'label' => '💼 Experience'],
                    ['id' => 'Certificates', 'label' => '🏆 Certificates'],
                    ['id' => 'Blog', 'label' => '📝 Blog Posts'],
                    ['id' => 'Github', 'label' => '🐙 GitHub Repos'],
                    ['id' => 'Messages', 'label' => '✉️ Messages (' . $messages->where('status', 'Unread')->count() . ')'],
                    ['id' => 'Settings', 'label' => '🎨 Background & Halaman Utama'],
                ] as $item)
                    <button
                        @click="tab = '{{ $item['id'] }}'"
                        :class="tab === '{{ $item['id'] }}' ? 'bg-sky-500/15 text-sky-400 border-sky-500/30' : 'text-slate-400 border-transparent hover:text-white'"
                        class="w-full text-left px-3.5 py-2.5 rounded-xl text-xs md:text-sm font-medium border transition-colors whitespace-nowrap cursor-pointer"
                    >
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Info Login & Tombol Logout -->
        <div class="p-4 border-t border-slate-800/80 space-y-3">
            <div class="px-3 py-2 rounded-xl bg-[#0B1528] border border-slate-800 text-xs">
                <p class="text-slate-400">Login sebagai:</p>
                <p class="font-semibold text-white truncate">{{ auth()->user()->email ?? $settings->email }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2 px-3 rounded-xl bg-rose-500/15 hover:bg-rose-500/25 border border-rose-500/30 text-rose-300 text-xs font-semibold cursor-pointer">
                    Keluar (Logout)
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="px-6 md:px-8 py-5 border-b border-slate-800/80 flex flex-wrap items-center justify-between gap-4 bg-[#081121]">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-white">Welcome, {{ auth()->user()->name ?? 'Syarief' }} 👋</h1>
                <p class="text-xs md:text-sm text-slate-400">Kelola seluruh isian halaman utama, background, proyek, keahlian, pengalaman, hingga sertifikat.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button @click="tab = 'Settings'" class="px-3.5 py-2 rounded-lg bg-[#0F1B33] border border-sky-500/30 text-sky-400 text-xs font-semibold cursor-pointer">
                    🎨 Ganti Background & Statistik
                </button>
                <button @click="showAddProject = true" class="px-4 py-2 rounded-lg bg-sky-500 hover:bg-sky-400 text-white text-xs font-semibold cursor-pointer">
                    + Tambah Project
                </button>
            </div>
        </header>

        @if(session('status'))
            <div class="mx-6 md:mx-8 mt-4 px-4 py-3 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs font-medium">
                ✓ {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mx-6 md:mx-8 mt-4 px-4 py-3 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="p-6 md:p-8 space-y-6 flex-1 overflow-y-auto">
            <!-- 1. DASHBOARD OVERVIEW TAB -->
            <div x-show="tab === 'Dashboard'" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="p-5 rounded-2xl bg-[#0B1528] border border-slate-800/80">
                        <div class="text-2xl font-bold text-sky-400">{{ $projects->count() }}</div>
                        <div class="text-xs text-slate-400">Projects</div>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#0B1528] border border-slate-800/80">
                        <div class="text-2xl font-bold text-indigo-400">{{ $skills->count() }}</div>
                        <div class="text-xs text-slate-400">Skills Categories</div>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#0B1528] border border-slate-800/80">
                        <div class="text-2xl font-bold text-purple-400">{{ $certificates->count() }}</div>
                        <div class="text-xs text-slate-400">Certificates</div>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#0B1528] border border-slate-800/80">
                        <div class="text-2xl font-bold text-pink-400">{{ $posts->count() }}</div>
                        <div class="text-xs text-slate-400">Blog Posts</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-base font-bold">Recent Projects</h2>
                            <button @click="showAddProject = true" class="text-xs text-sky-400 hover:underline cursor-pointer">+ Tambah Baru</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs md:text-sm">
                                <thead>
                                    <tr class="border-b border-slate-800 text-slate-400">
                                        <th class="py-3">Judul</th>
                                        <th class="py-3">Kategori</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Tanggal</th>
                                        <th class="py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/60">
                                    @foreach($projects as $proj)
                                        <tr>
                                            <td class="py-3.5 font-semibold">{{ $proj->title }}</td>
                                            <td class="py-3.5 text-sky-400">{{ $proj->category }}</td>
                                            <td class="py-3.5 text-emerald-400">{{ $proj->status }}</td>
                                            <td class="py-3.5 text-slate-400">{{ $proj->date }}</td>
                                            <td class="py-3.5 text-right space-x-2">
                                                <button
                                                    type="button"
                                                    @click="editProject = {{ Js::from($proj) }}"
                                                    class="text-sky-400 hover:underline text-xs cursor-pointer"
                                                >
                                                    Edit
                                                </button>
                                                <form action="{{ url('/admin/projects/' . $proj->id) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-rose-400 hover:underline text-xs cursor-pointer">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="lg:col-span-4 rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-2.5">
                        <h2 class="text-base font-bold mb-2">Tambah Isian Halaman Utama</h2>
                        <button @click="showAddProject = true" class="w-full py-2.5 px-4 rounded-xl bg-sky-500 hover:bg-sky-400 text-white text-xs font-semibold text-left cursor-pointer">+ Tambah Project & Case Study</button>
                        <button @click="showAddSkill = true" class="w-full py-2.5 px-4 rounded-xl bg-[#111E36] hover:bg-slate-800 border border-slate-700 text-xs font-medium text-left cursor-pointer">+ Tambah Kategori Skill / Keahlian</button>
                        <button @click="showAddExp = true" class="w-full py-2.5 px-4 rounded-xl bg-[#111E36] hover:bg-slate-800 border border-slate-700 text-xs font-medium text-left cursor-pointer">+ Tambah Pengalaman Kerja / Organisasi</button>
                        <button @click="showAddCert = true" class="w-full py-2.5 px-4 rounded-xl bg-[#111E36] hover:bg-slate-800 border border-slate-700 text-xs font-medium text-left cursor-pointer">+ Tambah Sertifikat & Pelatihan</button>
                        <button @click="showAddBlog = true" class="w-full py-2.5 px-4 rounded-xl bg-[#111E36] hover:bg-slate-800 border border-slate-700 text-xs font-medium text-left cursor-pointer">+ Tambah Artikel Blog</button>
                        <button @click="showAddGithub = true" class="w-full py-2.5 px-4 rounded-xl bg-[#111E36] hover:bg-slate-800 border border-slate-700 text-xs font-medium text-left cursor-pointer">+ Tambah Repository GitHub</button>
                        <button @click="tab = 'Settings'" class="w-full py-2.5 px-4 rounded-xl bg-[#111E36] hover:bg-slate-800 border border-sky-500/30 text-sky-400 text-xs font-medium text-left cursor-pointer">🎨 Edit Statistik, Kutipan & Background</button>
                    </div>
                </div>
            </div>

            <!-- 2. PROJECTS TAB -->
            <div x-show="tab === 'Projects'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">Daftar Proyek & Case Studies</h2>
                        <p class="text-xs text-slate-400">Muncul pada bagian "Proyek Saya" dan "Case Studies" di halaman utama.</p>
                    </div>
                    <button @click="showAddProject = true" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold cursor-pointer">+ Project Baru</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($projects as $proj)
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-start gap-4">
                            <div>
                                <p class="text-xs text-sky-400">{{ $proj->category }} · {{ $proj->date }} · <span class="text-emerald-400">{{ $proj->status }}</span></p>
                                <h3 class="text-sm font-bold mt-1">{{ $proj->title }}</h3>
                                <p class="text-xs text-slate-400 mt-1">{{ $proj->summary }}</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" @click="editProject = {{ Js::from($proj) }}" class="text-xs text-sky-400 hover:underline cursor-pointer">Edit</button>
                                <form action="{{ url('/admin/projects/' . $proj->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 3. SKILLS TAB -->
            <div x-show="tab === 'Skills'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">Kategori Keahlian (Skills)</h2>
                        <p class="text-xs text-slate-400">Muncul pada bagian "Keahlian" di halaman utama.</p>
                    </div>
                    <button @click="showAddSkill = true" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold cursor-pointer">+ Kategori Skill</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($skills as $sk)
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-start gap-4">
                            <div>
                                <h3 class="text-sm font-bold text-sky-400">{{ $sk->name }} <span class="text-xs text-slate-500 font-mono">(#{{ $sk->order }})</span></h3>
                                <p class="text-xs text-slate-300 mt-1">{{ implode(' · ', is_array($sk->items) ? $sk->items : []) }}</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" @click="editSkill = {{ Js::from($sk) }}" class="text-xs text-sky-400 hover:underline cursor-pointer">Edit</button>
                                <form action="{{ url('/admin/skills/' . $sk->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. EXPERIENCE TAB -->
            <div x-show="tab === 'Experience'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">Pengalaman Kerja & Organisasi</h2>
                        <p class="text-xs text-slate-400">Muncul pada timeline "About Me" dan "Pengalaman & Pendidikan" di halaman utama.</p>
                    </div>
                    <button @click="showAddExp = true" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold cursor-pointer">+ Tambah Pengalaman</button>
                </div>
                <div class="space-y-3">
                    @foreach($experiences as $exp)
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-center gap-4">
                            <div>
                                <p class="text-xs text-sky-400 font-mono">{{ $exp->period }} (Urutan #{{ $exp->order }})</p>
                                <h3 class="text-sm font-bold">{{ $exp->role }} — {{ $exp->organization }}</h3>
                                <p class="text-xs text-slate-400">{{ $exp->description }}</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" @click="editExp = {{ Js::from($exp) }}" class="text-xs text-sky-400 hover:underline cursor-pointer">Edit</button>
                                <form action="{{ url('/admin/experiences/' . $exp->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 5. CERTIFICATES TAB -->
            <div x-show="tab === 'Certificates'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">Sertifikasi & Pelatihan</h2>
                        <p class="text-xs text-slate-400">Muncul pada bagian "Sertifikasi & Pelatihan" di halaman utama.</p>
                    </div>
                    <button @click="showAddCert = true" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold cursor-pointer">+ Tambah Sertifikat</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($certificates as $cert)
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-start gap-4">
                            <div>
                                <p class="text-xs text-sky-400">{{ $cert->issuer }} ({{ $cert->year }})</p>
                                <h3 class="text-sm font-bold">{{ $cert->title }}</h3>
                                <p class="text-xs text-slate-400">{{ $cert->subtitle }}</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" @click="editCert = {{ Js::from($cert) }}" class="text-xs text-sky-400 hover:underline cursor-pointer">Edit</button>
                                <form action="{{ url('/admin/certificates/' . $cert->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 6. BLOG TAB -->
            <div x-show="tab === 'Blog'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">Artikel Blog / Catatan Teknis</h2>
                        <p class="text-xs text-slate-400">Muncul pada bagian "Blog / Catatan Teknis" di halaman utama.</p>
                    </div>
                    <button @click="showAddBlog = true" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold cursor-pointer">+ Tulis Artikel</button>
                </div>
                <div class="space-y-3">
                    @foreach($posts as $post)
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-center gap-4">
                            <div>
                                <p class="text-xs text-sky-400">{{ $post->category }} · {{ $post->date }} · <span class="text-emerald-400">{{ $post->status }}</span></p>
                                <h3 class="text-sm font-bold">{{ $post->title }}</h3>
                                <p class="text-xs text-slate-400">{{ $post->excerpt }}</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" @click="editBlog = {{ Js::from($post) }}" class="text-xs text-sky-400 hover:underline cursor-pointer">Edit</button>
                                <form action="{{ url('/admin/posts/' . $post->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 7. GITHUB REPOS TAB -->
            <div x-show="tab === 'Github'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">Daftar Repository GitHub di Halaman Utama</h2>
                        <p class="text-xs text-slate-400">Tambah atau hapus kartu repository yang tampil pada bagian GitHub.</p>
                    </div>
                    <button @click="showAddGithub = true" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold cursor-pointer">+ Tambah Repository</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($githubReposList as $idx => $repo)
                        <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-start gap-4">
                            <div>
                                <h3 class="text-sm font-bold text-white">{{ $repo['name'] ?? '' }} <span class="text-amber-400 text-xs">★ {{ $repo['stars'] ?? 0 }}</span></h3>
                                <p class="text-xs text-sky-400 mt-0.5">{{ $repo['tech'] ?? '' }}</p>
                                <p class="text-xs text-slate-500 font-mono mt-1 truncate">{{ $repo['url'] ?? '' }}</p>
                            </div>
                            <form action="{{ url('/admin/github-repos/' . $idx) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 8. MESSAGES TAB -->
            <div x-show="tab === 'Messages'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6 space-y-4">
                <h2 class="text-lg font-bold">Pesan Masuk (Contact Form)</h2>
                @forelse($messages as $msg)
                    <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 flex justify-between items-start gap-4">
                        <div>
                            <p class="text-xs font-semibold text-white">
                                {{ $msg->name }} <span class="text-sky-400">({{ $msg->email }})</span>
                                <span class="ml-2 px-2 py-0.5 rounded bg-slate-800 text-[10px] text-slate-300">{{ $msg->status }}</span>
                            </p>
                            <p class="text-sm text-slate-300 mt-1">{{ $msg->message }}</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            @if($msg->status === 'Unread')
                                <form action="{{ url('/admin/messages/' . $msg->id . '/read') }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-xs text-sky-400 hover:underline cursor-pointer">Tandai Dibaca</button>
                                </form>
                            @endif
                            <form action="{{ url('/admin/messages/' . $msg->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-rose-400 hover:underline cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400">Belum ada pesan masuk.</p>
                @endforelse
            </div>

            <!-- 9. SETTINGS, BACKGROUND & HALAMAN UTAMA TAB -->
            <div x-show="tab === 'Settings'" x-cloak class="rounded-2xl bg-[#0B1528] border border-slate-800/80 p-6">
                <h2 class="text-lg font-bold mb-1">Pengaturan Halaman Utama, Background, Statistik, Kutipan & Profil</h2>
                <p class="text-xs text-slate-400 mb-6">Seluruh perubahan di bawah ini akan langsung memperbarui tampilan halaman utama portofolio.</p>

                <form action="{{ url('/admin/settings') }}" method="POST" class="space-y-6">
                    @csrf @method('PUT')

                    <!-- Bagian A: Tema Background & Visual -->
                    <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-4">
                        <h3 class="text-sm font-bold text-sky-400">1. Tema Background Halaman Utama & Foto Profil</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Default Tema Background</label>
                                <select name="theme_bg" class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white">
                                    <option value="dark-navy" @selected(($settings->theme_bg ?? 'dark-navy') === 'dark-navy')>🌌 Dark Navy (Default)</option>
                                    <option value="light" @selected(($settings->theme_bg ?? '') === 'light')>☀️ Light Mode (Terang)</option>
                                    <option value="midnight-cyber" @selected(($settings->theme_bg ?? '') === 'midnight-cyber')>🛡️ Midnight Cyber</option>
                                    <option value="emerald-matrix" @selected(($settings->theme_bg ?? '') === 'emerald-matrix')>💻 Emerald Matrix</option>
                                    <option value="royal-indigo" @selected(($settings->theme_bg ?? '') === 'royal-indigo')>✨ Royal Indigo</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">URL Foto Profil Hero (Opsional)</label>
                                <input type="text" name="avatar_url" value="{{ $settings->avatar_url ?? '' }}" placeholder="https://... atau kosongkan untuk default" class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">URL Background Banner Kutipan Bawah (Opsional)</label>
                                <input type="text" name="quote_bg_url" value="{{ $settings->quote_bg_url ?? '' }}" placeholder="https://..." class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                        </div>
                    </div>

                    <!-- Bagian B: 4 Kartu Statistik Hero -->
                    <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-4">
                        <h3 class="text-sm font-bold text-sky-400">2. Empat Kartu Statistik Hero (Halaman Utama)</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <label class="block text-xs text-slate-400">Kartu 1 (Nilai & Label)</label>
                                <input type="text" name="stat_years" value="{{ $settings->stat_years ?? '4+' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm font-bold text-sky-400" />
                                <input type="text" name="stat_years_label" value="{{ $settings->stat_years_label ?? 'Years of Study' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-xs text-white" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs text-slate-400">Kartu 2 (Nilai & Label)</label>
                                <input type="text" name="stat_projects" value="{{ $settings->stat_projects ?? '3+' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm font-bold text-sky-400" />
                                <input type="text" name="stat_projects_label" value="{{ $settings->stat_projects_label ?? 'Projects Completed' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-xs text-white" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs text-slate-400">Kartu 3 (Nilai & Label)</label>
                                <input type="text" name="stat_tools" value="{{ $settings->stat_tools ?? '10+' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm font-bold text-sky-400" />
                                <input type="text" name="stat_tools_label" value="{{ $settings->stat_tools_label ?? 'Tools Mastered' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-xs text-white" />
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs text-slate-400">Kartu 4 (Nilai & Label)</label>
                                <input type="text" name="stat_learning" value="{{ $settings->stat_learning ?? '100%' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm font-bold text-sky-400" />
                                <input type="text" name="stat_learning_label" value="{{ $settings->stat_learning_label ?? 'Always Learning' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-xs text-white" />
                            </div>
                        </div>
                    </div>

                    <!-- Bagian C: Profil, Biodata & Pendidikan -->
                    <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-4">
                        <h3 class="text-sm font-bold text-sky-400">3. Biodata Hero, About Me & Pendidikan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $settings->name }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Headline</label>
                                <input type="text" name="headline" value="{{ $settings->headline }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs text-slate-400 mb-1">Hero Bio</label>
                                <textarea name="hero_bio" rows="2" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white">{{ $settings->hero_bio }}</textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs text-slate-400 mb-1">About Bio</label>
                                <textarea name="about_bio" rows="2" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white">{{ $settings->about_bio }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Nama Universitas (Kartu Pendidikan)</label>
                                <input type="text" name="education_university" value="{{ $settings->education_university ?? 'Universitas Bumigora' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Periode Kuliah</label>
                                <input type="text" name="education_period" value="{{ $settings->education_period ?? '2021 – 2024' }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Program Studi (Tabel About Me)</label>
                                <input type="text" name="education_degree" value="{{ $settings->education_degree }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Konsentrasi</label>
                                <input type="text" name="education_concentration" value="{{ $settings->education_concentration }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">IPK</label>
                                <input type="text" name="gpa" value="{{ $settings->gpa }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Tahun Lulus</label>
                                <input type="text" name="graduation_year" value="{{ $settings->graduation_year }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                        </div>
                    </div>

                    <!-- Bagian D: Kutipan (Quotes) di Halaman Utama -->
                    <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-4">
                        <h3 class="text-sm font-bold text-sky-400">4. Kutipan (Quotes) di Halaman Utama</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Kutipan di Bagian About Me</label>
                                <input type="text" name="quote_about" value="{{ $settings->quote_about ?? 'Terus belajar, karena teknologi tidak pernah berhenti berkembang.' }}" class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Kutipan di Bagian Pendidikan</label>
                                <input type="text" name="quote_education" value="{{ $settings->quote_education ?? 'Ilmu yang bermanfaat adalah ilmu yang diamalkan, bukan hanya diingat.' }}" class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Kutipan Banner Bawah (Footer Quote)</label>
                                <input type="text" name="quote_footer" value="{{ $settings->quote_footer ?? 'Teknologi adalah alat, yang paling penting adalah bagaimana kita menggunakannya untuk memberi manfaat.' }}" class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                        </div>
                    </div>

                    <!-- Bagian E: Kontak & Ringkasan GitHub -->
                    <div class="p-4 rounded-xl bg-[#0F1B33] border border-slate-800 space-y-4">
                        <h3 class="text-sm font-bold text-sky-400">5. Kontak & Statistik Profil GitHub</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Email</label>
                                <input type="email" name="email" value="{{ $settings->email }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ $settings->whatsapp }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">LinkedIn</label>
                                <input type="text" name="linkedin" value="{{ $settings->linkedin }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Lokasi</label>
                                <input type="text" name="location" value="{{ $settings->location }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">GitHub Username</label>
                                <input type="text" name="github_username" value="{{ $settings->github_username }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">GitHub Bio</label>
                                <input type="text" name="github_bio" value="{{ $settings->github_bio }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Jumlah Repositories GitHub</label>
                                <input type="number" name="github_repos_count" value="{{ $settings->github_repos_count ?? 12 }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Jumlah Followers GitHub</label>
                                <input type="number" name="github_followers" value="{{ $settings->github_followers ?? 3 }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 mb-1">Jumlah Following GitHub</label>
                                <input type="number" name="github_following" value="{{ $settings->github_following ?? 2 }}" required class="w-full px-3 py-2 rounded-lg bg-[#0B1528] border border-slate-700 text-sm text-white" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-white text-xs font-semibold cursor-pointer">
                            Simpan Seluruh Pengaturan Halaman Utama
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- MODAL 1: TAMBAH PROJECT -->
    <div x-show="showAddProject" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 overflow-y-auto">
        <form action="{{ url('/admin/projects') }}" method="POST" class="w-full max-w-xl rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3 my-8">
            @csrf
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="text-base font-bold">Tambah Project & Case Study Baru</h3>
                <button type="button" @click="showAddProject = false" class="text-slate-400">✕</button>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="title" required placeholder="Judul Project" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <select name="category" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                    <option value="Cyber Security">Cyber Security</option>
                    <option value="Networking">Networking</option>
                    <option value="IT Support">IT Support</option>
                    <option value="Development">Development</option>
                </select>
                <input type="text" name="date" required value="27 Sep 2026" placeholder="Tanggal" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <select name="status" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                    <option value="Published">Published</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>
            <textarea name="summary" rows="2" required placeholder="Ringkasan Proyek" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <textarea name="problem" rows="2" required placeholder="1. Problem" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <textarea name="objective" rows="2" required placeholder="2. Objective" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <textarea name="tools_text" rows="2" required placeholder="3. Tools (pisahkan per baris)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white">Nmap · Burp Suite</textarea>
            <textarea name="methodology_text" rows="2" placeholder="4. Methodology (pisahkan per baris)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white">Scope & Planning&#10;Information Gathering&#10;Vulnerability Analysis&#10;Exploitation / Testing&#10;Reporting</textarea>
            <textarea name="findings_text" rows="2" required placeholder="5. Key Findings (pisahkan per baris)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white">Missing CSP (Medium)</textarea>
            <textarea name="solution" rows="2" required placeholder="Solusi Mitigasi" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <textarea name="result" rows="2" required placeholder="Hasil Akhir" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showAddProject = false" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Simpan Project</button>
            </div>
        </form>
    </div>

    <!-- MODAL 2: EDIT PROJECT -->
    <div x-show="editProject" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 overflow-y-auto">
        <template x-if="editProject">
            <form :action="'{{ url('/admin/projects') }}/' + editProject.id" method="POST" class="w-full max-w-xl rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3 my-8">
                @csrf @method('PUT')
                <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                    <h3 class="text-base font-bold">Edit Project</h3>
                    <button type="button" @click="editProject = null" class="text-slate-400">✕</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <input type="text" name="title" :value="editProject.title" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <select name="category" :value="editProject.category" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                        <option value="Cyber Security">Cyber Security</option>
                        <option value="Networking">Networking</option>
                        <option value="IT Support">IT Support</option>
                        <option value="Development">Development</option>
                    </select>
                    <input type="text" name="date" :value="editProject.date" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <select name="status" :value="editProject.status" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                        <option value="Published">Published</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>
                <textarea name="summary" rows="2" required x-text="editProject.summary" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <textarea name="problem" rows="2" required x-text="editProject.problem" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <textarea name="objective" rows="2" required x-text="editProject.objective" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <textarea name="tools_text" rows="2" required x-text="(editProject.tools || []).join('\n')" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white"></textarea>
                <textarea name="methodology_text" rows="2" x-text="(editProject.methodology || []).join('\n')" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white"></textarea>
                <textarea name="findings_text" rows="2" required x-text="(editProject.findings || []).join('\n')" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white"></textarea>
                <textarea name="solution" rows="2" required x-text="editProject.solution" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <textarea name="result" rows="2" required x-text="editProject.result" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="editProject = null" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Perbarui Project</button>
                </div>
            </form>
        </template>
    </div>

    <!-- MODAL 3: TAMBAH SKILL KATEGORI -->
    <div x-show="showAddSkill" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <form action="{{ url('/admin/skills') }}" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
            @csrf
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="text-base font-bold">Tambah Kategori Keahlian (Skill)</h3>
                <button type="button" @click="showAddSkill = false" class="text-slate-400">✕</button>
            </div>
            <input type="text" name="name" required placeholder="Nama Kategori (mis. Cloud & DevOps)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <div class="grid grid-cols-2 gap-3">
                <select name="icon" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                    <option value="shield">Shield (Security)</option>
                    <option value="network">Network (Jaringan)</option>
                    <option value="code">Code (Development)</option>
                    <option value="wrench">Wrench (IT Support)</option>
                </select>
                <input type="number" name="order" required value="{{ $skills->count() + 1 }}" placeholder="Urutan" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            </div>
            <textarea name="items_text" rows="4" required placeholder="Daftar Skill (pisahkan satu per baris)&#10;Docker&#10;Linux Server&#10;Nginx" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showAddSkill = false" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Simpan Kategori</button>
            </div>
        </form>
    </div>

    <!-- MODAL 4: EDIT SKILL KATEGORI -->
    <div x-show="editSkill" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <template x-if="editSkill">
            <form :action="'{{ url('/admin/skills') }}/' + editSkill.id" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
                @csrf @method('PUT')
                <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                    <h3 class="text-base font-bold">Edit Kategori Skill</h3>
                    <button type="button" @click="editSkill = null" class="text-slate-400">✕</button>
                </div>
                <input type="text" name="name" :value="editSkill.name" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <div class="grid grid-cols-2 gap-3">
                    <select name="icon" :value="editSkill.icon" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                        <option value="shield">Shield (Security)</option>
                        <option value="network">Network (Jaringan)</option>
                        <option value="code">Code (Development)</option>
                        <option value="wrench">Wrench (IT Support)</option>
                    </select>
                    <input type="number" name="order" :value="editSkill.order" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                </div>
                <textarea name="items_text" rows="4" required x-text="(editSkill.items || []).join('\n')" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-xs font-mono text-white"></textarea>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="editSkill = null" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Perbarui</button>
                </div>
            </form>
        </template>
    </div>

    <!-- MODAL 5: TAMBAH PENGALAMAN (EXPERIENCE) -->
    <div x-show="showAddExp" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <form action="{{ url('/admin/experiences') }}" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
            @csrf
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="text-base font-bold">Tambah Pengalaman Kerja / Organisasi</h3>
                <button type="button" @click="showAddExp = false" class="text-slate-400">✕</button>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="period" required placeholder="Periode (mis. 2026 – Sekarang)" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="number" name="order" required value="{{ $experiences->count() + 1 }}" placeholder="Urutan" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            </div>
            <input type="text" name="role" required placeholder="Posisi / Peran (mis. Network Engineer)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <input type="text" name="organization" required placeholder="Perusahaan / Instansi / Organisasi" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <textarea name="description" rows="3" required placeholder="Deskripsi tugas atau kontribusi" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showAddExp = false" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Simpan Pengalaman</button>
            </div>
        </form>
    </div>

    <!-- MODAL 6: EDIT PENGALAMAN (EXPERIENCE) -->
    <div x-show="editExp" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <template x-if="editExp">
            <form :action="'{{ url('/admin/experiences') }}/' + editExp.id" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
                @csrf @method('PUT')
                <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                    <h3 class="text-base font-bold">Edit Pengalaman</h3>
                    <button type="button" @click="editExp = null" class="text-slate-400">✕</button>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <input type="text" name="period" :value="editExp.period" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <input type="number" name="order" :value="editExp.order" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                </div>
                <input type="text" name="role" :value="editExp.role" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="text" name="organization" :value="editExp.organization" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <textarea name="description" rows="3" required x-text="editExp.description" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="editExp = null" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Perbarui</button>
                </div>
            </form>
        </template>
    </div>

    <!-- MODAL 7: TAMBAH CERTIFICATE -->
    <div x-show="showAddCert" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <form action="{{ url('/admin/certificates') }}" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
            @csrf
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="text-base font-bold">Tambah Sertifikat</h3>
                <button type="button" @click="showAddCert = false" class="text-slate-400">✕</button>
            </div>
            <input type="text" name="title" required placeholder="Nama Sertifikasi" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <input type="text" name="issuer" required placeholder="Penyelenggara" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <div class="grid grid-cols-3 gap-3">
                <input type="text" name="year" required value="2026" placeholder="Tahun" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="text" name="credential_id" required value="CERT-2026" placeholder="Credential ID" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="number" name="order" required value="{{ $certificates->count() + 1 }}" placeholder="Urutan" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            </div>
            <textarea name="subtitle" rows="2" required placeholder="Materi / Subjudul" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showAddCert = false" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Simpan</button>
            </div>
        </form>
    </div>

    <!-- MODAL 8: EDIT CERTIFICATE -->
    <div x-show="editCert" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <template x-if="editCert">
            <form :action="'{{ url('/admin/certificates') }}/' + editCert.id" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
                @csrf @method('PUT')
                <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                    <h3 class="text-base font-bold">Edit Sertifikat</h3>
                    <button type="button" @click="editCert = null" class="text-slate-400">✕</button>
                </div>
                <input type="text" name="title" :value="editCert.title" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="text" name="issuer" :value="editCert.issuer" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <div class="grid grid-cols-3 gap-3">
                    <input type="text" name="year" :value="editCert.year" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <input type="text" name="credential_id" :value="editCert.credential_id" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <input type="number" name="order" :value="editCert.order" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                </div>
                <textarea name="subtitle" rows="2" required x-text="editCert.subtitle" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="editCert = null" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Perbarui</button>
                </div>
            </form>
        </template>
    </div>

    <!-- MODAL 9: TAMBAH BLOG -->
    <div x-show="showAddBlog" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <form action="{{ url('/admin/posts') }}" method="POST" class="w-full max-w-lg rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
            @csrf
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="text-base font-bold">Tambah Artikel Blog</h3>
                <button type="button" @click="showAddBlog = false" class="text-slate-400">✕</button>
            </div>
            <input type="text" name="title" required placeholder="Judul Artikel" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <div class="grid grid-cols-3 gap-3">
                <input type="text" name="category" required value="Networking" placeholder="Kategori" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="text" name="date" required value="27 Sep 2026" placeholder="Tanggal" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <select name="status" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                    <option value="Published">Published</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>
            <input type="text" name="excerpt" required placeholder="Ringkasan Singkat" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <textarea name="content" rows="5" required placeholder="Isi Artikel Lengkap" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showAddBlog = false" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Terbitkan</button>
            </div>
        </form>
    </div>

    <!-- MODAL 10: EDIT BLOG -->
    <div x-show="editBlog" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <template x-if="editBlog">
            <form :action="'{{ url('/admin/posts') }}/' + editBlog.id" method="POST" class="w-full max-w-lg rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
                @csrf @method('PUT')
                <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                    <h3 class="text-base font-bold">Edit Artikel Blog</h3>
                    <button type="button" @click="editBlog = null" class="text-slate-400">✕</button>
                </div>
                <input type="text" name="title" :value="editBlog.title" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <div class="grid grid-cols-3 gap-3">
                    <input type="text" name="category" :value="editBlog.category" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <input type="text" name="date" :value="editBlog.date" required class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                    <select name="status" :value="editBlog.status" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white">
                        <option value="Published">Published</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>
                <input type="text" name="excerpt" :value="editBlog.excerpt" required class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <textarea name="content" rows="5" required x-text="editBlog.content" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white"></textarea>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="editBlog = null" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Perbarui</button>
                </div>
            </form>
        </template>
    </div>

    <!-- MODAL 11: TAMBAH GITHUB REPOSITORY -->
    <div x-show="showAddGithub" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4">
        <form action="{{ url('/admin/github-repos') }}" method="POST" class="w-full max-w-md rounded-2xl bg-[#0B1528] border border-slate-800 p-6 space-y-3">
            @csrf
            <div class="flex justify-between items-center border-b border-slate-800 pb-2">
                <h3 class="text-base font-bold">Tambah Repository GitHub</h3>
                <button type="button" @click="showAddGithub = false" class="text-slate-400">✕</button>
            </div>
            <input type="text" name="name" required placeholder="Nama Repo (mis. siem-log-analyzer)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <input type="text" name="tech" required placeholder="Teknologi (mis. Python + Elastic Stack)" class="w-full px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            <div class="grid grid-cols-2 gap-3">
                <input type="number" name="stars" required value="5" min="0" placeholder="Jumlah Stars" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
                <input type="text" name="url" required value="https://github.com/muhammadsyarief/" placeholder="URL GitHub" class="px-3 py-2 rounded-lg bg-[#0F1B33] border border-slate-800 text-sm text-white" />
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="showAddGithub = false" class="px-4 py-2 rounded-lg bg-slate-800 text-xs">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-sky-500 text-white text-xs font-semibold">Simpan Repository</button>
            </div>
        </form>
    </div>
</body>
</html>
