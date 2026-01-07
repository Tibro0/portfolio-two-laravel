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
use App\Http\Controllers\Admin\SettingController;
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

    // Profile All Route
    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.index');
        Route::post('profile/update', 'profileUpdate')->name('profile.update');
        Route::post('profile/password/update', 'updatePassword')->name('profile.password.update');
    });

    /** Animation Text All Route */
    Route::controller(AnimationTextController::class)->group(function () {
        Route::get('animation-text', 'index')->name('animation-text.index');
        Route::get('animation-text/create', 'create')->name('animation-text.create');
        Route::post('animation-text/store', 'store')->name('animation-text.store');
        Route::get('animation-text/edit/{id}', 'edit')->name('animation-text.edit');
        Route::put('animation-text/{id}', 'update')->name('animation-text.update');
        Route::delete('animation-text/{id}', 'destroy')->name('animation-text.destroy');
    });

    /** Tag All Route */
    Route::controller(TagController::class)->group(function () {
        Route::get('tag', 'index')->name('tag.index');
        Route::get('tag/edit/{id}', 'edit')->name('tag.edit');
        Route::put('tag/{id}', 'update')->name('tag.update');
    });

    /** Social Icon All Route */
    Route::controller(SocialIconController::class)->group(function () {
        Route::get('social-icon', 'index')->name('social-icon.index');
        Route::get('social-icon/create', 'create')->name('social-icon.create');
        Route::post('social-icon/store', 'store')->name('social-icon.store');
        Route::get('social-icon/edit/{id}', 'edit')->name('social-icon.edit');
        Route::put('social-icon/{id}', 'update')->name('social-icon.update');
        Route::delete('social-icon/{id}', 'destroy')->name('social-icon.destroy');
    });

    /** Counter All Route */
    Route::controller(CounterController::class)->group(function () {
        Route::get('counter', 'index')->name('counter.index');
        Route::get('counter/edit/{id}', 'edit')->name('counter.edit');
        Route::put('counter/{id}', 'update')->name('counter.update');
    });

    // About All Route
    Route::controller(AboutController::class)->group(function () {
        Route::get('about', 'index')->name('about.index');
        Route::post('about/update', 'aboutUpdate')->name('about.update');
        Route::put('about/main-title/update', 'aboutMainTitleUpdate')->name('about.main-title.update');
    });

    // Frontend Skill
    Route::controller(FrontendSkillController::class)->group(function () {
        Route::get('frontend-skill', 'index')->name('frontend-skill.index');
        Route::get('frontend-skill/create', 'create')->name('frontend-skill.create');
        Route::post('frontend-skill/store', 'store')->name('frontend-skill.store');
        Route::get('frontend-skill/edit/{id}', 'edit')->name('frontend-skill.edit');
        Route::put('frontend-skill/{id}', 'update')->name('frontend-skill.update');
        Route::delete('frontend-skill/{id}', 'destroy')->name('frontend-skill.destroy');
        Route::put('/skill-card-title-update/{id}', 'skillCardTitleUpdate')->name('skill-card-title-update');
    });

    // Backend Skill
    Route::controller(BackendSkillController::class)->group(function () {
        Route::get('backend-skill', 'index')->name('backend-skill.index');
        Route::get('backend-skill/create', 'create')->name('backend-skill.create');
        Route::post('backend-skill/store', 'store')->name('backend-skill.store');
        Route::get('backend-skill/edit/{id}', 'edit')->name('backend-skill.edit');
        Route::put('backend-skill/{id}', 'update')->name('backend-skill.update');
        Route::delete('backend-skill/{id}', 'destroy')->name('backend-skill.destroy');
        Route::put('/backend-skill-card-title-one-update/{id}', 'backendSkillCardTitleUpdate')->name('backend-skill-card-title-one-update');
    });

    // Design Skill
    Route::controller(DesignSkillController::class)->group(function () {
        Route::get('design-skill', 'index')->name('design-skill.index');
        Route::get('design-skill/create', 'create')->name('design-skill.create');
        Route::post('design-skill/store', 'store')->name('design-skill.store');
        Route::get('design-skill/edit/{id}', 'edit')->name('design-skill.edit');
        Route::put('design-skill/{id}', 'update')->name('design-skill.update');
        Route::delete('design-skill/{id}', 'destroy')->name('design-skill.destroy');
        Route::put('/design-skill-card-title-update/{id}', 'designSkillCardTitleUpdate')->name('design-skill-card-title-update');
    });

    // Cloud Skill
    Route::controller(CloudSkillController::class)->group(function () {
        Route::get('cloud-skill', 'index')->name('cloud-skill.index');
        Route::get('cloud-skill/create', 'create')->name('cloud-skill.create');
        Route::post('cloud-skill/store', 'store')->name('cloud-skill.store');
        Route::get('cloud-skill/edit/{id}', 'edit')->name('cloud-skill.edit');
        Route::put('cloud-skill/{id}', 'update')->name('cloud-skill.update');
        Route::delete('cloud-skill/{id}', 'destroy')->name('cloud-skill.destroy');
        Route::put('/cloud-skill-card-title-update/{id}', 'cloudSkillCardTitleUpdate')->name('cloud-skill-card-title-update');
    });

    // Certification
    Route::controller(CertificationController::class)->group(function () {
        Route::get('certification', 'index')->name('certification.index');
        Route::get('certification/create', 'create')->name('certification.create');
        Route::post('certification/store', 'store')->name('certification.store');
        Route::get('certification/edit/{id}', 'edit')->name('certification.edit');
        Route::put('certification/{id}', 'update')->name('certification.update');
        Route::delete('certification/{id}', 'destroy')->name('certification.destroy');
        Route::put('/professional-expertise-title-update', 'professionalExpertiseTitleUpdate')->name('professional-expertise-title-update');
    });

    // Professional Journey
    Route::controller(ProfessionalJourneyController::class)->group(function () {
        Route::get('professional-journey', 'index')->name('professional-journey.index');
        Route::get('professional-journey/create', 'create')->name('professional-journey.create');
        Route::post('professional-journey/store', 'store')->name('professional-journey.store');
        Route::get('professional-journey/edit/{id}', 'edit')->name('professional-journey.edit');
        Route::put('professional-journey/{id}', 'update')->name('professional-journey.update');
        Route::delete('professional-journey/{id}', 'destroy')->name('professional-journey.destroy');
        Route::put('/professional-journey-title-update', 'professionalJourneyTitleUpdate')->name('professional-journey-title-update');
        Route::put('resume/main-title/update', 'resumeMainTitleUpdate')->name('resume.main-title.update');
    });

    // Academic Excellence
    Route::controller(AcademicExcellenceController::class)->group(function () {
        Route::get('academic-excellence', 'index')->name('academic-excellence.index');
        Route::get('academic-excellence/create', 'create')->name('academic-excellence.create');
        Route::post('academic-excellence/store', 'store')->name('academic-excellence.store');
        Route::get('academic-excellence/edit/{id}', 'edit')->name('academic-excellence.edit');
        Route::put('academic-excellence/{id}', 'update')->name('academic-excellence.update');
        Route::delete('academic-excellence/{id}', 'destroy')->name('academic-excellence.destroy');
        Route::put('/academic-excellences-title-update', 'academicExcellencesTitleUpdate')->name('academic-excellences-title-update');
    });

    // Service
    Route::controller(ServiceController::class)->group(function () {
        Route::get('service', 'index')->name('service.index');
        Route::get('service/create', 'create')->name('service.create');
        Route::post('service/store', 'store')->name('service.store');
        Route::get('service/edit/{id}', 'edit')->name('service.edit');
        Route::put('service/{id}', 'update')->name('service.update');
        Route::delete('service/{id}', 'destroy')->name('service.destroy');
        Route::put('services/main-title/update', 'servicesMainTitleUpdate')->name('services.main-title.update');
    });

    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/edit/{id}', 'edit')->name('category.edit');
        Route::put('category/{id}', 'update')->name('category.update');
        Route::delete('category/{id}', 'destroy')->name('category.destroy');
        Route::put('portfolio/main-title/update', 'portfolioMainTitleUpdate')->name('portfolio.main-title.update');
    });

    // Portfolio
    Route::controller(PortfolioController::class)->group(function () {
        Route::get('portfolio', 'index')->name('portfolio.index');
        Route::get('portfolio/create', 'create')->name('portfolio.create');
        Route::post('portfolio/store', 'store')->name('portfolio.store');
        Route::get('portfolio/edit/{id}', 'edit')->name('portfolio.edit');
        Route::put('portfolio/{id}', 'update')->name('portfolio.update');
        Route::delete('portfolio/{id}', 'destroy')->name('portfolio.destroy');
    });

    // Testimonial
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('testimonial', 'index')->name('testimonial.index');
        Route::get('testimonial/create', 'create')->name('testimonial.create');
        Route::post('testimonial/store', 'store')->name('testimonial.store');
        Route::get('testimonial/edit/{id}', 'edit')->name('testimonial.edit');
        Route::put('testimonial/{id}', 'update')->name('testimonial.update');
        Route::delete('testimonial/{id}', 'destroy')->name('testimonial.destroy');
        Route::put('testimonial/main-title/update', 'testimonialMainTitleUpdate')->name('testimonial.main-title.update');
    });

    // Faq
    Route::controller(FaqController::class)->group(function () {
        Route::get('faq', 'index')->name('faq.index');
        Route::get('faq/create', 'create')->name('faq.create');
        Route::post('faq/store', 'store')->name('faq.store');
        Route::get('faq/edit/{id}', 'edit')->name('faq.edit');
        Route::put('faq/{id}', 'update')->name('faq.update');
        Route::delete('faq/{id}', 'destroy')->name('faq.destroy');
        Route::put('faq/main-title/update', 'faqMainTitleUpdate')->name('faq.main-title.update');
    });

    // Subscriber
    Route::controller(SubscriberController::class)->group(function () {
        Route::get('subscriber', 'index')->name('subscriber.index');
        Route::get('subscriber/create', 'create')->name('subscriber.create');
        Route::post('subscriber/store', 'store')->name('subscriber.store');
        Route::get('subscriber/edit/{id}', 'edit')->name('subscriber.edit');
        Route::put('subscriber/{id}', 'update')->name('subscriber.update');
        Route::delete('subscriber/{id}', 'destroy')->name('subscriber.destroy');
        Route::put('contact/main-title/update', 'contactMainTitleUpdate')->name('contact.main-title.update');
        Route::get('/subscriber-block', 'subscriberBlock')->name('subscriber.block');
        Route::post('/subscriber-sent', 'subscriberSent')->name('subscriber.sent');
    });

    /** Setting Routes */
    Route::controller(SettingController::class)->group(function () {
        Route::get('setting', 'index')->name('setting.index');
        Route::put('setting/general-setting', 'updateGeneralSetting')->name('general-setting.update');
        Route::put('setting/mail-setting', 'updateMailSetting')->name('mail-setting.update');
        Route::get('admin-general-setting-list-style', 'adminGeneralSettingListStyle')->name('admin-general-setting-list-style');
    });
});

require __DIR__ . '/auth.php';
