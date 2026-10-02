<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Settings (Seluruh Isian Halaman Utama, Statistik, Quotes, Background, GitHub, Kontak)
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Muhammad Syarief');
            $table->string('headline')->default('IT Support | Network & Cyber Security Enthusiast');
            $table->text('hero_bio');
            $table->text('about_bio');
            $table->string('avatar_url')->nullable();
            $table->string('theme_bg')->default('dark-navy'); // dark-navy, light, midnight-cyber, emerald-matrix
            $table->string('quote_bg_url')->nullable();

            // Statistik Hero Halaman Utama (4 Kartu)
            $table->string('stat_years')->default('4+');
            $table->string('stat_years_label')->default('Years of Study');
            $table->string('stat_projects')->default('3+');
            $table->string('stat_projects_label')->default('Projects Completed');
            $table->string('stat_tools')->default('10+');
            $table->string('stat_tools_label')->default('Tools Mastered');
            $table->string('stat_learning')->default('100%');
            $table->string('stat_learning_label')->default('Always Learning');

            // Pendidikan & Biodata
            $table->string('education_university')->default('Universitas Bumigora');
            $table->string('education_degree')->default('Universitas Bumigora (S1 Informatika)');
            $table->string('education_concentration')->default('Konsentrasi Cyber Security');
            $table->string('education_period')->default('2021 – 2024');
            $table->string('gpa')->default('3.86 (Cumlaude)');
            $table->string('graduation_year')->default('2024 (3.5 Tahun)');
            $table->string('location')->default('Mataram, NTB');

            // Kutipan (Quotes) di Halaman Utama
            $table->text('quote_about')->nullable();
            $table->text('quote_education')->nullable();
            $table->text('quote_footer')->nullable();

            // Kontak
            $table->string('email')->default('syariefmuhammad@gmail.com');
            $table->string('whatsapp')->default('+62 819 0788 4512');
            $table->string('linkedin')->default('linkedin.com/in/muhammadsyarief');
            $table->string('cv_url')->nullable();

            // GitHub Section
            $table->string('github_username')->default('muhammadsyarief');
            $table->string('github_bio')->default('Full Stack Developer | Security Enthusiast');
            $table->unsignedInteger('github_repos_count')->default(12);
            $table->unsignedInteger('github_followers')->default(3);
            $table->unsignedInteger('github_following')->default(2);
            $table->json('github_repos')->nullable();

            $table->timestamps();
        });

        // 2. Tabel Projects & Case Studies
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('category', ['Cyber Security', 'Networking', 'IT Support', 'Development']);
            $table->enum('status', ['Published', 'Draft'])->default('Published');
            $table->string('date');
            $table->text('summary');
            $table->text('problem');
            $table->text('objective');
            $table->json('tools');
            $table->json('methodology');
            $table->json('findings');
            $table->text('solution');
            $table->text('result');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });

        // 3. Tabel Skills (Keahlian)
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('shield');
            $table->json('items');
            $table->unsignedInteger('order')->default(1);
            $table->timestamps();
        });

        // 4. Tabel Experiences (Pengalaman Kerja & Organisasi)
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('period');
            $table->string('role');
            $table->string('organization');
            $table->text('description');
            $table->unsignedInteger('order')->default(1);
            $table->timestamps();
        });

        // 5. Tabel Certificates (Sertifikasi & Pelatihan)
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->string('year');
            $table->string('issuer');
            $table->string('credential_id');
            $table->string('file_path')->nullable();
            $table->unsignedInteger('order')->default(1);
            $table->timestamps();
        });

        // 6. Tabel Posts (Blog / Catatan Teknis)
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('date');
            $table->text('excerpt');
            $table->longText('content');
            $table->enum('status', ['Published', 'Draft'])->default('Published');
            $table->timestamps();
        });

        // 7. Tabel Messages (Kotak Masuk Hubungi Saya)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->enum('status', ['Unread', 'Read', 'Archived'])->default('Unread');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('settings');
    }
};
