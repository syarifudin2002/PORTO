<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin Default untuk Login Dashboard
        User::updateOrCreate(
            ['email' => 'syariefmuhammad@gmail.com'],
            [
                'name' => 'Muhammad Syarief',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Seed Settings (Seluruh Isian Halaman Utama, Statistik, Quotes, Background, GitHub)
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Muhammad Syarief',
                'headline' => 'IT Support | Network & Cyber Security Enthusiast',
                'hero_bio' => 'Saya tertarik pada dunia jaringan, keamanan informasi, dan teknologi. Berpengalaman dalam IT Support, network infrastructure, serta pengembangan aplikasi. Selalu belajar untuk menjadi lebih baik dan siap berkontribusi di dunia profesional.',
                'about_bio' => 'Saya adalah lulusan Universitas Bumigora dengan program studi Informatika, konsentrasi Cyber Security. Memiliki pengalaman di bidang IT Support, jaringan, dan keamanan siber. Saya senang memecahkan masalah, belajar hal baru, dan berkolaborasi dalam tim.',
                'theme_bg' => 'dark-navy',
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
                    [
                        'name' => 'web-portfolio',
                        'tech' => 'Laravel 12 + Tailwind CSS',
                        'stars' => 12,
                        'url' => 'https://github.com/muhammadsyarief/web-portfolio',
                    ],
                    [
                        'name' => 'flask-recommender',
                        'tech' => 'Python + K-Means + FP-Growth',
                        'stars' => 8,
                        'url' => 'https://github.com/muhammadsyarief/flask-recommender',
                    ],
                    [
                        'name' => 'mikrotik-config',
                        'tech' => 'Network Configuration',
                        'stars' => 5,
                        'url' => 'https://github.com/muhammadsyarief/mikrotik-config',
                    ],
                ],
            ]
        );

        // 3. Seed Skills (4 Kategori)
        $skills = [
            [
                'name' => 'Cyber Security',
                'icon' => 'shield',
                'order' => 1,
                'items' => ['OWASP Top 10', 'Penetration Testing', 'Burp Suite', 'OWASP ZAP', 'Nmap, Nikto', 'Metasploit'],
            ],
            [
                'name' => 'Networking',
                'icon' => 'network',
                'order' => 2,
                'items' => ['MikroTik', 'VLAN & Routing', 'PPPoE', 'FTTH / OLT', 'Firewall', 'CCTV Network'],
            ],
            [
                'name' => 'Development',
                'icon' => 'code',
                'order' => 3,
                'items' => ['PHP / Laravel', 'Python / Flask', 'MySQL', 'REST API', 'Git & GitHub'],
            ],
            [
                'name' => 'IT Support',
                'icon' => 'wrench',
                'order' => 4,
                'items' => ['Troubleshooting', 'Hardware & Software', 'Printer / CCTV / PABX', 'Network Deployment', 'User Support'],
            ],
        ];
        foreach ($skills as $sk) {
            Skill::updateOrCreate(['name' => $sk['name']], $sk);
        }

        // 4. Seed Projects & Case Studies
        $projects = [
            [
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
                'result' => '100% temuan Medium dan Low berhasil dimitigasi pada siklus re-testing dan postur keamanan HTTP header meningkat signifikan.',
            ],
            [
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
            [
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
            [
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
        ];
        foreach ($projects as $proj) {
            Project::updateOrCreate(['title' => $proj['title']], $proj);
        }

        // 5. Seed Experiences
        $experiences = [
            [
                'period' => '2026 – Sekarang',
                'role' => 'IT Support',
                'organization' => 'Agung Artatek (Lombok)',
                'description' => 'Perangkat jaringan, CCTV, PABX, dll',
                'order' => 1,
            ],
            [
                'period' => '2025',
                'role' => 'Cyber Security Project',
                'organization' => 'Penetration Testing (Lembaga XYZ)',
                'description' => 'Analisis kerentanan web (OWASP Top 10)',
                'order' => 2,
            ],
            [
                'period' => '2024',
                'role' => 'Kampus Merdeka',
                'organization' => 'Independent Study Batch 6 / Celerates',
                'description' => 'Studi Independen Bersertifikat bidang Cybersecurity & Network Security',
                'order' => 3,
            ],
            [
                'period' => '2023',
                'role' => 'BEM & Organisasi',
                'organization' => 'KSR PMI, SASAMBO, OSIS',
                'description' => 'Kepemimpinan organisasi mahasiswa, kepanitiaan, dan kegiatan sosial',
                'order' => 4,
            ],
        ];
        foreach ($experiences as $exp) {
            Experience::updateOrCreate(['role' => $exp['role']], $exp);
        }

        // 6. Seed Certificates
        $certificates = [
            [
                'title' => 'Kampus Merdeka – Celerates',
                'subtitle' => 'Cybersecurity Foundations, Governance, Cryptography, Network Security, Web App Security, dll',
                'year' => '2024',
                'issuer' => 'Kemendikbudristek & Celerates',
                'credential_id' => 'MSIB-B6-CELERATES-2024',
                'order' => 1,
            ],
            [
                'title' => 'OWASP Top 10 & Penetration Testing',
                'subtitle' => 'Workshop / Training',
                'year' => '2024',
                'issuer' => 'Cyber Security Training',
                'credential_id' => 'OWASP-PT-2024',
                'order' => 2,
            ],
            [
                'title' => 'MikroTik MTCNA',
                'subtitle' => 'Network Administration',
                'year' => '2023',
                'issuer' => 'MikroTik Academy',
                'credential_id' => 'MTCNA-2023-NTB',
                'order' => 3,
            ],
            [
                'title' => 'Laravel Developer',
                'subtitle' => 'Web Development',
                'year' => '2024',
                'issuer' => 'Web Dev Bootcamp',
                'credential_id' => 'LARAVEL-2024',
                'order' => 4,
            ],
        ];
        foreach ($certificates as $cert) {
            Certificate::updateOrCreate(['title' => $cert['title']], $cert);
        }

        // 7. Seed Blog Posts
        $posts = [
            [
                'title' => 'Memahami VLAN pada MikroTik',
                'slug' => Str::slug('Memahami VLAN pada MikroTik'),
                'category' => 'Networking',
                'date' => '12 Sep 2026',
                'excerpt' => 'Konsep dasar, konfigurasi, dan implementasi.',
                'content' => "Virtual Local Area Network (VLAN) memungkinkan administrator jaringan membagi satu switch/router fisik menjadi beberapa broadcast domain logis.\n\nLangkah konfigurasi di MikroTik RouterOS v7 meliputi pembuatan Bridge VLAN Filtering, penentuan Access Port (PVID) dan Trunk Port, serta isolasi Firewall antar-VLAN.",
                'status' => 'Published',
            ],
            [
                'title' => 'Dasar Penetration Testing dengan OWASP Top 10',
                'slug' => Str::slug('Dasar Penetration Testing dengan OWASP Top 10'),
                'category' => 'Cyber Security',
                'date' => '28 Agu 2026',
                'excerpt' => 'Langkah-langkah melakukan testing pada aplikasi web.',
                'content' => "Tahapan pengujian penetrasi berbasis OWASP Top 10 dimulai dari Scope & Planning, Information Gathering (Nmap), Vulnerability Analysis (Burp Suite & OWASP ZAP), Exploitation/Verification, hingga penyusunan laporan remediasi.",
                'status' => 'Published',
            ],
            [
                'title' => 'Troubleshooting PPPoE di MikroTik',
                'slug' => Str::slug('Troubleshooting PPPoE di MikroTik'),
                'category' => 'Networking',
                'date' => '15 Agu 2026',
                'excerpt' => 'Solusi umum dan tips yang sering terjadi.',
                'content' => "Panduan memeriksa redaman optik FTTH/ONT, konfigurasi Keepalive Timeout pada PPPoE Server, serta penyesuaian TCP MSS Clamping agar koneksi pelanggan tetap stabil.",
                'status' => 'Published',
            ],
            [
                'title' => 'Konsep Zero Trust dalam Keamanan Jaringan',
                'slug' => Str::slug('Konsep Zero Trust dalam Keamanan Jaringan'),
                'category' => 'Cyber Security',
                'date' => '02 Agu 2026',
                'excerpt' => 'Pendekatan modern untuk keamanan.',
                'content' => "Zero Trust berpegang pada prinsip 'Never Trust, Always Verify' melalui micro-segmentation VLAN, least-privilege access control, dan pemantauan log berkelanjutan.",
                'status' => 'Published',
            ],
        ];
        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
