<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Post;
use App\Models\Message;

class AdminController extends Controller
{
    public function dashboard()
    {
        $settings = Setting::first();
        $projects = Project::latest()->get();
        $skills = Skill::orderBy('order')->get();
        $experiences = Experience::orderBy('order')->get();
        $certificates = Certificate::orderBy('order')->get();
        $posts = Post::latest()->get();
        $messages = Message::latest()->get();

        return view('admin.dashboard', compact(
            'settings',
            'projects',
            'skills',
            'experiences',
            'certificates',
            'posts',
            'messages'
        ));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'headline' => 'required|string|max:200',
            'hero_bio' => 'required|string|max:1000',
            'about_bio' => 'required|string|max:1500',
            'avatar_url' => 'nullable|string|max:500',
            'theme_bg' => 'required|string|max:50',
            'quote_bg_url' => 'nullable|string|max:500',
            'stat_years' => 'required|string|max:30',
            'stat_years_label' => 'required|string|max:60',
            'stat_projects' => 'required|string|max:30',
            'stat_projects_label' => 'required|string|max:60',
            'stat_tools' => 'required|string|max:30',
            'stat_tools_label' => 'required|string|max:60',
            'stat_learning' => 'required|string|max:30',
            'stat_learning_label' => 'required|string|max:60',
            'education_university' => 'required|string|max:150',
            'education_degree' => 'required|string|max:200',
            'education_concentration' => 'required|string|max:200',
            'education_period' => 'required|string|max:60',
            'gpa' => 'required|string|max:60',
            'graduation_year' => 'required|string|max:60',
            'location' => 'required|string|max:120',
            'quote_about' => 'nullable|string|max:500',
            'quote_education' => 'nullable|string|max:500',
            'quote_footer' => 'nullable|string|max:500',
            'email' => 'required|email|max:150',
            'whatsapp' => 'required|string|max:60',
            'linkedin' => 'required|string|max:200',
            'github_username' => 'required|string|max:100',
            'github_bio' => 'required|string|max:200',
            'github_repos_count' => 'required|integer|min:0',
            'github_followers' => 'required|integer|min:0',
            'github_following' => 'required|integer|min:0',
        ]);

        Setting::updateOrCreate(['id' => 1], $validated);
        return back()->with('status', 'Seluruh pengaturan halaman utama, statistik, background, dan profil berhasil disimpan.');
    }

    public function storeGithubRepo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'tech' => 'required|string|max:150',
            'stars' => 'required|integer|min:0',
            'url' => 'required|string|max:300',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);
        $repos = is_array($setting->github_repos) ? $setting->github_repos : [];
        $repos[] = $validated;
        $setting->update(['github_repos' => array_values($repos)]);

        return back()->with('status', 'Repository GitHub berhasil ditambahkan ke halaman utama.');
    }

    public function destroyGithubRepo(int $index)
    {
        $setting = Setting::first();
        if ($setting && is_array($setting->github_repos)) {
            $repos = $setting->github_repos;
            unset($repos[$index]);
            $setting->update(['github_repos' => array_values($repos)]);
        }
        return back()->with('status', 'Repository GitHub berhasil dihapus.');
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:160',
            'category' => 'required|in:Cyber Security,Networking,IT Support,Development',
            'status' => 'required|in:Published,Draft',
            'date' => 'required|string|max:50',
            'summary' => 'required|string|max:600',
            'problem' => 'required|string|max:1500',
            'objective' => 'required|string|max:1500',
            'tools_text' => 'required|string',
            'methodology_text' => 'nullable|string',
            'findings_text' => 'required|string',
            'solution' => 'required|string|max:2500',
            'result' => 'required|string|max:2500',
        ]);

        $methodology = !empty($validated['methodology_text'])
            ? array_values(array_filter(array_map('trim', explode("\n", $validated['methodology_text']))))
            : ['Scope & Planning', 'Information Gathering', 'Vulnerability Analysis', 'Exploitation / Testing', 'Reporting'];

        Project::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'status' => $validated['status'],
            'date' => $validated['date'],
            'summary' => $validated['summary'],
            'problem' => $validated['problem'],
            'objective' => $validated['objective'],
            'tools' => array_values(array_filter(array_map('trim', explode("\n", $validated['tools_text'])))),
            'methodology' => $methodology,
            'findings' => array_values(array_filter(array_map('trim', explode("\n", $validated['findings_text'])))),
            'solution' => $validated['solution'],
            'result' => $validated['result'],
        ]);

        return back()->with('status', 'Proyek baru berhasil ditambahkan.');
    }

    public function updateProject(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:160',
            'category' => 'required|in:Cyber Security,Networking,IT Support,Development',
            'status' => 'required|in:Published,Draft',
            'date' => 'required|string|max:50',
            'summary' => 'required|string|max:600',
            'problem' => 'required|string|max:1500',
            'objective' => 'required|string|max:1500',
            'tools_text' => 'required|string',
            'methodology_text' => 'nullable|string',
            'findings_text' => 'required|string',
            'solution' => 'required|string|max:2500',
            'result' => 'required|string|max:2500',
        ]);

        $methodology = !empty($validated['methodology_text'])
            ? array_values(array_filter(array_map('trim', explode("\n", $validated['methodology_text']))))
            : $project->methodology;

        $project->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'status' => $validated['status'],
            'date' => $validated['date'],
            'summary' => $validated['summary'],
            'problem' => $validated['problem'],
            'objective' => $validated['objective'],
            'tools' => array_values(array_filter(array_map('trim', explode("\n", $validated['tools_text'])))),
            'methodology' => $methodology,
            'findings' => array_values(array_filter(array_map('trim', explode("\n", $validated['findings_text'])))),
            'solution' => $validated['solution'],
            'result' => $validated['result'],
        ]);

        return back()->with('status', 'Proyek berhasil diperbarui.');
    }

    public function destroyProject(Project $project)
    {
        $project->delete();
        return back()->with('status', 'Proyek berhasil dihapus.');
    }

    public function storeSkill(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'items_text' => 'required|string',
            'order' => 'required|integer|min:1',
        ]);

        Skill::create([
            'name' => $validated['name'],
            'icon' => $validated['icon'],
            'order' => $validated['order'],
            'items' => array_values(array_filter(array_map('trim', explode("\n", $validated['items_text'])))),
        ]);

        return back()->with('status', 'Kategori keahlian berhasil ditambahkan.');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'items_text' => 'required|string',
            'order' => 'required|integer|min:1',
        ]);

        $skill->update([
            'name' => $validated['name'],
            'icon' => $validated['icon'],
            'order' => $validated['order'],
            'items' => array_values(array_filter(array_map('trim', explode("\n", $validated['items_text'])))),
        ]);

        return back()->with('status', 'Kategori keahlian berhasil diperbarui.');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return back()->with('status', 'Kategori keahlian berhasil dihapus.');
    }

    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:80',
            'role' => 'required|string|max:160',
            'organization' => 'required|string|max:200',
            'description' => 'required|string|max:800',
            'order' => 'required|integer|min:1',
        ]);

        Experience::create($validated);
        return back()->with('status', 'Pengalaman berhasil ditambahkan.');
    }

    public function updateExperience(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'period' => 'required|string|max:80',
            'role' => 'required|string|max:160',
            'organization' => 'required|string|max:200',
            'description' => 'required|string|max:800',
            'order' => 'required|integer|min:1',
        ]);

        $experience->update($validated);
        return back()->with('status', 'Pengalaman berhasil diperbarui.');
    }

    public function destroyExperience(Experience $experience)
    {
        $experience->delete();
        return back()->with('status', 'Pengalaman berhasil dihapus.');
    }

    public function storeCertificate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'subtitle' => 'required|string|max:300',
            'year' => 'required|string|max:30',
            'issuer' => 'required|string|max:150',
            'credential_id' => 'required|string|max:120',
            'order' => 'required|integer|min:1',
        ]);

        Certificate::create($validated);
        return back()->with('status', 'Sertifikat berhasil ditambahkan.');
    }

    public function updateCertificate(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'subtitle' => 'required|string|max:300',
            'year' => 'required|string|max:30',
            'issuer' => 'required|string|max:150',
            'credential_id' => 'required|string|max:120',
            'order' => 'required|integer|min:1',
        ]);

        $certificate->update($validated);
        return back()->with('status', 'Sertifikat berhasil diperbarui.');
    }

    public function destroyCertificate(Certificate $certificate)
    {
        $certificate->delete();
        return back()->with('status', 'Sertifikat berhasil dihapus.');
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:80',
            'date' => 'required|string|max:50',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:Published,Draft',
        ]);

        Post::create([
            ...$validated,
            'slug' => Str::slug($validated['title']) . '-' . Str::random(4),
        ]);

        return back()->with('status', 'Artikel blog berhasil diterbitkan.');
    }

    public function updatePost(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:80',
            'date' => 'required|string|max:50',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:Published,Draft',
        ]);

        $post->update($validated);
        return back()->with('status', 'Artikel blog berhasil diperbarui.');
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return back()->with('status', 'Artikel blog berhasil dihapus.');
    }

    public function markMessageRead(Message $message)
    {
        $message->update(['status' => 'Read']);
        return back()->with('status', 'Pesan ditandai sudah dibaca.');
    }

    public function destroyMessage(Message $message)
    {
        $message->delete();
        return back()->with('status', 'Pesan berhasil dihapus.');
    }
}
