<section id="hero" class="hero section">
    <div class="container">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-delay="100">
                <div class="content-wrapper">
                    <h1 class="hero-title">
                        I'm a
                        <span class="typed"
                            data-typed-items="@foreach ($animationTexts as $animationText) {{ $animationText->title }}@if (!$loop->last), @endif @endforeach"></span>
                    </h1>
                    <p class="lead">{{ @$user->short_description }}</p>
                    <div class="hero-stats" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($counters as $counter)
                            @if ($loop->index == 0)
                                <div class="stat-item">
                                    <span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="{{ $counter->number }}"
                                        data-purecounter-duration="2">0</span>
                                    <span class="stat-label">{{ $counter->title }}</span>
                                </div>
                            @elseif ($loop->index == 1)
                                <div class="stat-item">
                                    <span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="{{ $counter->number }}"
                                        data-purecounter-duration="2">0</span>
                                    <span class="stat-label">{{ $counter->title }}</< /span>
                                </div>
                            @elseif ($loop->index == 2)
                                <div class="stat-item">
                                    <span class="purecounter" data-purecounter-start="0"
                                        data-purecounter-end="{{ $counter->number }}"
                                        data-purecounter-duration="2">0</span>
                                    <span class="stat-label">{{ $counter->title }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="300">
                        <a href="#portfolio" class="btn btn-primary">View My Work</a>
                        <a href="#contact" class="btn btn-outline">Get In Touch</a>
                    </div>

                    <div class="social-links" data-aos="fade-up" data-aos-delay="400">
                        @foreach ($socialIcons as $socialIcon)
                            <a target="_blank" href="{{ $socialIcon->url }}"><i class="{{ $socialIcon->icon }}"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-6 hero-image" data-aos="fade-left" data-aos-delay="200">
                <div class="image-container">
                    <div class="floating-elements">
                        @foreach ($tags as $tag)
                            @if ($loop->index == 0)
                                <div class="floating-card card-1" data-aos="zoom-in" data-aos-delay="300">
                                    <i class="{{ $tag->icon }}"></i>
                                    <span>{{ $tag->name }}</span>
                                </div>
                            @elseif ($loop->index == 1)
                                <div class="floating-card card-2" data-aos="zoom-in" data-aos-delay="400">
                                    <i class="{{ $tag->icon }}"></i>
                                    <span>{{ $tag->name }}</span>
                                </div>
                            @elseif ($loop->index == 2)
                                <div class="floating-card card-3" data-aos="zoom-in" data-aos-delay="500">
                                    <i class="{{ $tag->icon }}"></i>
                                    <span>{{ $tag->name }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <img src="{{ asset(@$user->avatar) }}" alt="Portfolio Hero" class="img-fluid hero-main-image" />
                    <div class="image-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section>
