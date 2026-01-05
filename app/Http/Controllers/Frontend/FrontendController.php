<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
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
use Illuminate\Support\Facades\Mail;

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
        return view('frontend.home.index', compact('sectionTitle', 'user', 'animationTexts', 'tags', 'socialIcons', 'counters', 'about', 'skillCardTitleOne', 'skillCardTitleTwo', 'skillCardTitleThree', 'skillCardTitleFour', 'frontendSkills', 'backendSkills', 'designSkills', 'cloudSkills', 'certifications', 'professionalJourneys', 'academicExcellences', 'services', 'categories', 'testimonials', 'faqs'));
    }

    public function contactForm(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'subject' => ['required', 'max:255'],
            'message' => ['required', 'max:1000'],
        ]);

        $email = User::where('id', 1)->first()->pluck('email')->toArray();
        Mail::to($email)->send(new ContactFormMail($request->name, $request->email, $request->subject, $request->message));
        return response(['message' => 'Your Message Has been Sent!']);


        // $email = User::where('id', 1)->first()->pluck('email')->toArray();
        // Mail::to($email)->send(new ContactFormMail($request->name, $request->email, $request->subject, $request->message));
        // toastr()->success('Your Message Has been Sent!');
        // return redirect()->back();
    }

    public function downloadCv()
    {
        $file =  public_path('frontend/assets/cv/Tibro-resume.pdf');

        return response()->download($file);
    }
}
