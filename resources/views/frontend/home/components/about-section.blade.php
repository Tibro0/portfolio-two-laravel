<section id="about" class="about section">
    <!-- Section Title -->
    <div class="container section-title">
        <h2>{{ $sectionTitle['about_main_title'] }}</h2>
        <p>{{ $sectionTitle['about_sub_title'] }}</p>
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
                <div class="profile-image-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset(@$user->avatar) }}" alt="Profile" class="img-fluid" />
                    </div>
                    {{-- <div class="signature-section">
                        <img src="{{ asset($about->signature) }}" alt="Signature" class="signature" />
                        <p class="quote">
                            {{ $about->signature_description }}
                        </p>
                    </div> --}}
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                <div class="about-content">
                    <div class="intro">
                        <h2>Hi, I'm {{ @$user->name }}</h2>
                        <p>
                            {{ $about->description }}
                        </p>
                    </div>

                    <div class="cta-section" data-aos="fade-up" data-aos-delay="400">
                        <div class="action-buttons">
                            <a href="#portfolio" class="btn btn-primary">View My Work</a>
                            <a href="{{ route('download.cv') }}" class="btn btn-outline">Download Resume</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
