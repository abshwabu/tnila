<?php

use App\Http\Controllers\PublicSiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicSiteController::class, 'home'])->name('home');

Route::prefix('about')->name('about.')->group(function (): void {
    Route::get('/', [PublicSiteController::class, 'about'])->name('index');
    Route::get('/our-story', [PublicSiteController::class, 'story'])->name('story');
    Route::get('/mission', [PublicSiteController::class, 'mission'])->name('mission');
    Route::get('/team', [PublicSiteController::class, 'team'])->name('team');
});

Route::prefix('services')->name('services.')->group(function (): void {
    Route::get('/', [PublicSiteController::class, 'servicesIndex'])->name('index');
    Route::get('/{service:slug}', [PublicSiteController::class, 'serviceShow'])->name('show');
});

Route::prefix('industries')->name('industries.')->group(function (): void {
    Route::get('/', [PublicSiteController::class, 'industriesIndex'])->name('index');
    Route::get('/{industry:slug}', [PublicSiteController::class, 'industryShow'])->name('show');
});

Route::prefix('projects')->name('projects.')->group(function (): void {
    Route::get('/', [PublicSiteController::class, 'projectsIndex'])->name('index');
    Route::get('/{industry:slug}', [PublicSiteController::class, 'projectsByIndustry'])
        ->whereIn('industry', ['residential', 'commercial', 'industrial', 'infrastructure'])
        ->name('by-industry');
    Route::get('/{project:slug}', [PublicSiteController::class, 'projectShow'])
        ->where('project', '^(?!(residential|commercial|industrial|infrastructure)$)[A-Za-z0-9\-]+$')
        ->name('show');
});

Route::get('/testimonials', [PublicSiteController::class, 'testimonialsIndex'])->name('testimonials.index');

Route::prefix('blog')->name('blog.')->group(function (): void {
    Route::get('/', [PublicSiteController::class, 'blogIndex'])->name('index');
    Route::get('/{post:slug}', [PublicSiteController::class, 'blogShow'])->name('show');
});

Route::prefix('careers')->name('careers.')->group(function (): void {
    Route::get('/', [PublicSiteController::class, 'careersIndex'])->name('index');
    Route::get('/{job:slug}', [PublicSiteController::class, 'careerShow'])->name('show');
});

Route::get('/faqs', [PublicSiteController::class, 'faqs'])->name('faqs.index');
Route::get('/contact', [PublicSiteController::class, 'contact'])->name('contact');
