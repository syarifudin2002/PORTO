<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Post;
use App\Models\Message;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $projects = Project::where('status', 'Published')->latest()->get();
        $skills = Skill::orderBy('order')->get();
        $experiences = Experience::orderBy('order')->get();
        $certificates = Certificate::orderBy('order')->get();
        $posts = Post::where('status', 'Published')->latest()->get();

        $githubRepos = ($settings && !empty($settings->github_repos))
            ? $settings->github_repos
            : [
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
            ];

        return view('portfolio.index', compact(
            'settings',
            'projects',
            'skills',
            'experiences',
            'certificates',
            'posts',
            'githubRepos'
        ));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'Unread',
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi saya.');
    }
}
