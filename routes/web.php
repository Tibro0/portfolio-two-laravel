<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AcademicExcellenceController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AnimationTextController;
use App\Http\Controllers\Admin\BackendSkillController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\CloudSkillController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesignSkillController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FrontendSkillController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProfessionalJourneyController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Frontend All Route
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/contact-form', 'contactForm')->name('contact-form');
    Route::get('/download-cv', 'downloadCv')->name('download.cv');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile all Route
    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.index');
        Route::post('profile/update', 'profileUpdate')->name('profile.update');
        Route::post('profile/password/update', 'updatePassword')->name('profile.password.update');
    });

    // Animation Text
    Route::resource('animation-text', AnimationTextController::class);

    // Tag
    Route::resource('tag', TagController::class);

    // Social Icon
    Route::resource('social-icon', SocialIconController::class);
    
    // Counter
    Route::resource('counter', CounterController::class);

    // About All Route
    Route::controller(AboutController::class)->group(function () {
        Route::get('about', 'index')->name('about.index');
        Route::post('about/update', 'aboutUpdate')->name('about.update');
        Route::put('about/main-title/update', 'aboutMainTitleUpdate')->name('about.main-title.update');
    });

    // Frontend Skill
    Route::controller(FrontendSkillController::class)->group(function () {
        Route::put('/skill-card-title-update/{id}', 'skillCardTitleUpdate')->name('skill-card-title-update');
    });
    Route::resource('frontend-skill', FrontendSkillController::class);

    // Backend Skill
    Route::controller(BackendSkillController::class)->group(function () {
        Route::put('/backend-skill-card-title-one-update/{id}', 'backendSkillCardTitleUpdate')->name('backend-skill-card-title-one-update');
    });
    Route::resource('backend-skill', BackendSkillController::class);

    // Design Skill
    Route::controller(DesignSkillController::class)->group(function () {
        Route::put('/design-skill-card-title-update/{id}', 'designSkillCardTitleUpdate')->name('design-skill-card-title-update');
    });
    Route::resource('design-skill', DesignSkillController::class);

    // Cloud Skill
    Route::controller(CloudSkillController::class)->group(function () {
        Route::put('/cloud-skill-card-title-update/{id}', 'cloudSkillCardTitleUpdate')->name('cloud-skill-card-title-update');
    });
    Route::resource('cloud-skill', CloudSkillController::class);

    // Certification
    Route::controller(CertificationController::class)->group(function () {
        Route::put('/professional-expertise-title-update', 'professionalExpertiseTitleUpdate')->name('professional-expertise-title-update');
    });
    Route::resource('certification', CertificationController::class);

    // Professional Journey
    Route::controller(ProfessionalJourneyController::class)->group(function () {
        Route::put('/professional-journey-title-update', 'professionalJourneyTitleUpdate')->name('professional-journey-title-update');
        Route::put('resume/main-title/update', 'resumeMainTitleUpdate')->name('resume.main-title.update');
    });
    Route::resource('professional-journey', ProfessionalJourneyController::class);

    // Academic Excellence
    Route::controller(AcademicExcellenceController::class)->group(function () {
        Route::put('/academic-excellences-title-update', 'academicExcellencesTitleUpdate')->name('academic-excellences-title-update');
    });
    Route::resource('academic-excellence', AcademicExcellenceController::class);

    // Service
    Route::controller(ServiceController::class)->group(function () {
        Route::put('services/main-title/update', 'servicesMainTitleUpdate')->name('services.main-title.update');
    });
    Route::resource('service', ServiceController::class);

    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::put('portfolio/main-title/update', 'portfolioMainTitleUpdate')->name('portfolio.main-title.update');
    });
    Route::resource('category', CategoryController::class);

    // Portfolio
    Route::resource('portfolio', PortfolioController::class);

    // Testimonial
    Route::controller(TestimonialController::class)->group(function () {
        Route::put('testimonial/main-title/update', 'testimonialMainTitleUpdate')->name('testimonial.main-title.update');
    });
    Route::resource('testimonial', TestimonialController::class);

    // Faq
    Route::controller(FaqController::class)->group(function () {
        Route::put('faq/main-title/update', 'faqMainTitleUpdate')->name('faq.main-title.update');
    });
    Route::resource('faq', FaqController::class);

    // Subscriber
    Route::controller(SubscriberController::class)->group(function () {
        Route::put('contact/main-title/update', 'contactMainTitleUpdate')->name('contact.main-title.update');
        Route::get('/subscriber-block', 'subscriberBlock')->name('subscriber.block');
        Route::post('/subscriber-sent', 'subscriberSent')->name('subscriber.sent');
    });
    Route::resource('subscriber', SubscriberController::class);
});

require __DIR__ . '/auth.php';
