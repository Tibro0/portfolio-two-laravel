<?php

use App\Http\Controllers\Api\Admin\AboutController;
use App\Http\Controllers\Api\Admin\AcademicExcellenceController;
use App\Http\Controllers\Api\Admin\AnimationTextController;
use App\Http\Controllers\Api\Admin\BackendSkillController;
use App\Http\Controllers\Api\Admin\CertificationController;
use App\Http\Controllers\Api\Admin\CloudSkillController;
use App\Http\Controllers\Api\Admin\CounterController;
use App\Http\Controllers\Api\Admin\DesignSkillController;
use App\Http\Controllers\Api\Admin\FrontendSkillController;
use App\Http\Controllers\Api\Admin\ProfessionalJourneyController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\SocialIconController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Frontend All Route
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
    });

    Route::prefix('admin')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'index');
            Route::post('profile', 'updateProfile');
            Route::post('profile/password', 'updatePassword');
        });

        /** Animation Text All Route */
        Route::controller(AnimationTextController::class)->group(function () {
            Route::get('animation-text', 'index');
            Route::post('animation-text/store', 'store');
            Route::get('animation-text/{id}', 'show');
            Route::put('animation-text/{id}', 'update');
            Route::delete('animation-text/{id}', 'destroy');
        });

        /** Tag All Route */
        Route::controller(TagController::class)->group(function () {
            Route::get('tag', 'index');
            Route::get('tag/{id}', 'show');
            Route::put('tag/{id}', 'update');
        });

        /** Social Icon All Route */
        Route::controller(SocialIconController::class)->group(function () {
            Route::get('social-icon', 'index');
            Route::post('social-icon/store', 'store');
            Route::get('social-icon/{id}', 'show');
            Route::put('social-icon/{id}', 'update');
            Route::delete('social-icon/{id}', 'destroy');
        });

        // Counter All Route
        Route::controller(CounterController::class)->group(function () {
            Route::get('counter', 'index');
            Route::get('counter/{id}', 'show');
            Route::put('counter/{id}', 'update');
        });

        // About All Route
        Route::controller(AboutController::class)->group(function () {
            Route::get('about', 'index');
            Route::post('about/update', 'update');
            Route::put('about/main-title/update', 'aboutMainTitleUpdate');
        });

        /** Frontend Skill All Route */
        Route::controller(FrontendSkillController::class)->group(function () {
            Route::get('frontend-skill', 'index');
            Route::post('frontend-skill/store', 'store');
            Route::get('frontend-skill/{id}', 'show');
            Route::put('frontend-skill/{id}', 'update');
            Route::delete('frontend-skill/{id}', 'destroy');
            Route::put('frontend-skill-card-title-update', 'frontendSkillCardTitleUpdate');
        });

        /** Backend Skill All Route */
        Route::controller(BackendSkillController::class)->group(function () {
            Route::get('backend-skill', 'index');
            Route::post('backend-skill/store', 'store');
            Route::get('backend-skill/{id}', 'show');
            Route::put('backend-skill/{id}', 'update');
            Route::delete('backend-skill/{id}', 'destroy');
            Route::put('backend-skill-card-title-update', 'backendSkillCardTitleUpdate');
        });

        /** Design Skill All Route */
        Route::controller(DesignSkillController::class)->group(function () {
            Route::get('design-skill', 'index');
            Route::post('design-skill/store', 'store');
            Route::get('design-skill/{id}', 'show');
            Route::put('design-skill/{id}', 'update');
            Route::delete('design-skill/{id}', 'destroy');
            Route::put('design-skill-card-title-update', 'designSkillCardTitleUpdate');
        });

        /** Cloud Skill All Route */
        Route::controller(CloudSkillController::class)->group(function () {
            Route::get('cloud-skill', 'index');
            Route::post('cloud-skill/store', 'store');
            Route::get('cloud-skill/{id}', 'show');
            Route::put('cloud-skill/{id}', 'update');
            Route::delete('cloud-skill/{id}', 'destroy');
            Route::put('cloud-skill-card-title-update', 'cloudSkillCardTitleUpdate');
        });

        /** Certification All Route */
        Route::controller(CertificationController::class)->group(function () {
            Route::get('certification', 'index');
            Route::post('certification/store', 'store');
            Route::get('certification/{id}', 'show');
            Route::put('certification/{id}', 'update');
            Route::delete('certification/{id}', 'destroy');
            Route::put('professional-expertise-title-update', 'professionalExpertiseTitleUpdate');
        });

        /** Professional Journey All Route */
        Route::controller(ProfessionalJourneyController::class)->group(function () {
            Route::get('professional-journey', 'index');
            Route::post('professional-journey/store', 'store');
            Route::get('professional-journey/{id}', 'show');
            Route::put('professional-journey/{id}', 'update');
            Route::delete('professional-journey/{id}', 'destroy');
            Route::put('professional-journey-title-update', 'professionalJourneyTitleUpdate');
            Route::put('resume/main-title/update', 'resumeMainTitleUpdate');
        });

        /** Academic Excellence All Route */
        Route::controller(AcademicExcellenceController::class)->group(function () {
            Route::get('academic-excellence', 'index');
            Route::post('academic-excellence/store', 'store');
            Route::get('academic-excellence/{id}', 'show');
            Route::put('academic-excellence/{id}', 'update');
            Route::delete('academic-excellence/{id}', 'destroy');
            Route::put('academic-excellence-title-update', 'academicExcellenceTitleUpdate');
        });

        /** Service All Route */
        Route::controller(ServiceController::class)->group(function () {
            Route::get('service', 'index');
            Route::post('service/store', 'store');
            Route::get('service/{id}', 'show');
            Route::put('service/{id}', 'update');
            Route::delete('service/{id}', 'destroy');
            Route::put('service-main-title-update', 'servicesMainTitleUpdate');
        });

    });
});
