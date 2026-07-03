<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Industry;
use App\Models\JobListing;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\View\View;

class PublicSiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'services' => Service::query()->orderBy('order')->take(6)->get(),
            'industries' => Industry::query()->withCount('projects')->orderBy('name')->get(),
            'featuredProjects' => Project::query()
                ->with(['industry', 'customer'])
                ->where('featured', true)
                ->latest('updated_at')
                ->take(4)
                ->get(),
            'recentPosts' => BlogPost::query()
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->take(3)
                ->get(),
            'approvedTestimonials' => Testimonial::query()
                ->where('approved', true)
                ->where('featured', true)
                ->with(['customer', 'project'])
                ->orderByDesc('featured')
                ->orderByDesc('id')
                ->take(8)
                ->get(),
            'projectCount' => Project::query()->count(),
            'industryCount' => Industry::query()->count(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about.index');
    }

    public function story(): View
    {
        return view('pages.about.story');
    }

    public function mission(): View
    {
        return view('pages.about.mission');
    }

    public function team(): View
    {
        return view('pages.about.team');
    }

    public function servicesIndex(): View
    {
        return view('pages.services.index', [
            'services' => Service::query()->orderBy('order')->get(),
            'featuredProjects' => Project::query()->with('industry')->where('featured', true)->latest()->take(3)->get(),
        ]);
    }

    public function serviceShow(Service $service): View
    {
        return view('pages.services.show', [
            'service' => $service,
            'services' => Service::query()->whereKeyNot($service->id)->orderBy('order')->take(3)->get(),
            'featuredProjects' => Project::query()->with('industry')->where('featured', true)->latest()->take(3)->get(),
        ]);
    }

    public function industriesIndex(): View
    {
        return view('pages.industries.index', [
            'industries' => Industry::query()->withCount('projects')->orderBy('name')->get(),
            'featuredProjects' => Project::query()->with('industry')->where('featured', true)->latest()->take(4)->get(),
        ]);
    }

    public function industryShow(Industry $industry): View
    {
        return view('pages.industries.show', [
            'industry' => $industry->loadCount('projects'),
            'projects' => Project::query()
                ->with('industry')
                ->where('industry_id', $industry->id)
                ->latest('updated_at')
                ->get(),
            'featuredProjects' => Project::query()->with('industry')->where('featured', true)->latest()->take(3)->get(),
        ]);
    }

    public function projectsIndex(?Industry $industry = null): View
    {
        return view('pages.projects.index', [
            'selectedIndustrySlug' => $industry?->slug ?? '',
            'industries' => Industry::query()->orderBy('name')->get(),
            'featuredProjects' => Project::query()->with('industry')->where('featured', true)->latest()->take(4)->get(),
        ]);
    }

    public function projectsByIndustry(Industry $industry): View
    {
        return $this->projectsIndex($industry);
    }

    public function projectShow(Project $project): View
    {
        return view('pages.projects.show', [
            'project' => $project->load(['industry', 'customer', 'testimonials.customer']),
            'relatedProjects' => Project::query()
                ->with('industry')
                ->where('industry_id', $project->industry_id)
                ->whereKeyNot($project->id)
                ->latest('updated_at')
                ->take(3)
                ->get(),
        ]);
    }

    public function testimonialsIndex(): View
    {
        return view('pages.testimonials.index', [
            'testimonials' => Testimonial::query()
                ->where('approved', true)
                ->with(['customer', 'project'])
                ->orderByDesc('featured')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function blogIndex(): View
    {
        return view('pages.blog.index', [
            'posts' => BlogPost::query()
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->get(),
        ]);
    }

    public function blogShow(BlogPost $post): View
    {
        abort_unless($post->status === 'published', 404);

        return view('pages.blog.show', [
            'post' => $post,
            'relatedPosts' => BlogPost::query()
                ->where('status', 'published')
                ->where('category', $post->category)
                ->whereKeyNot($post->id)
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }

    public function careersIndex(): View
    {
        return view('pages.careers.index', [
            'jobs' => JobListing::query()
                ->where('status', 'open')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function careerShow(JobListing $job): View
    {
        abort_unless($job->status === 'open', 404);

        return view('pages.careers.show', [
            'job' => $job,
            'openJobs' => JobListing::query()
                ->where('status', 'open')
                ->whereKeyNot($job->id)
                ->orderByDesc('id')
                ->take(4)
                ->get(),
        ]);
    }

    public function faqs(): View
    {
        return view('pages.faqs.index', [
            'faqs' => Faq::query()->orderBy('category')->orderBy('order')->get(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
