<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AcademicExcellence;
use App\Models\AnimationText;
use App\Models\BackendSkill;
use App\Models\Category;
use App\Models\Certification;
use App\Models\CloudSkill;
use App\Models\Counter;
use App\Models\DesignSkill;
use App\Models\Faq;
use App\Models\FrontendSkill;
use App\Models\ProfessionalJourney;
use App\Models\SectionTitle;
use App\Models\Service;
use App\Models\SkillCardTitle;
use App\Models\SocialIcon;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sectionTitle = SectionTitle::pluck('value', 'key');
        $user = User::where('id', 1)->first();
        $animationTexts = AnimationText::all();
        $tags = Tag::all();
        $socialIcons = SocialIcon::all();
        $counters = Counter::all();
        $about = About::first();
        $skillCardTitleOne = SkillCardTitle::where('id', 1)->first();
        $skillCardTitleTwo = SkillCardTitle::where('id', 2)->first();
        $skillCardTitleThree = SkillCardTitle::where('id', 3)->first();
        $skillCardTitleFour = SkillCardTitle::where('id', 4)->first();
        $frontendSkills = FrontendSkill::all();
        $backendSkills = BackendSkill::all();
        $designSkills = DesignSkill::all();
        $cloudSkills = CloudSkill::all();
        $certifications = Certification::all();
        $professionalJourneys = ProfessionalJourney::all();
        $academicExcellences = AcademicExcellence::all();
        $services = Service::all();
        $categories = Category::all();
        $testimonials = Testimonial::all();
        $faqs = Faq::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'sectionTitle' => $sectionTitle,
                'user' => $user,
                'animationTexts' => $animationTexts,
                'tags' => $tags,
                'socialIcons' => $socialIcons,
                'counters' => $counters,
                'about' => $about,
                'skillCardTitleOne' => $skillCardTitleOne,
                'skillCardTitleTwo' => $skillCardTitleTwo,
                'skillCardTitleThree' => $skillCardTitleThree,
                'skillCardTitleFour' => $skillCardTitleFour,
                'frontendSkills' => $frontendSkills,
                'backendSkills' => $backendSkills,
                'designSkills' => $designSkills,
                'cloudSkills' => $cloudSkills,
                'certifications' => $certifications,
                'professionalJourneys' => $professionalJourneys,
                'academicExcellences' => $academicExcellences,
                'services' => $services,
                'categories' => $categories,
                'testimonials' => $testimonials,
                'faqs' => $faqs
            ]
        ]);
    }
}
