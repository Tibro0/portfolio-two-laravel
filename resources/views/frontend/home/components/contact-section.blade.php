<section id="contact" class="contact section light-background">
    <!-- Section Title -->
    <div class="container section-title">
        <h2>{{ $sectionTitle['contact_main_title'] }}</h2>
        <p>{{ $sectionTitle['contact_sub_title'] }}</p>
    </div>
    <!-- End Section Title -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                    <h3>Contact Info</h3>
                    <p>Your link to innovative tech leadership and transformative growth. Let's connect.</p>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="content">
                            <h4>Our Location</h4>
                            <p>{{ $user->address_line_one }}</p>
                            @if ($user->address_line_two)
                                <p>{{ $user->address_line_two }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="content">
                            <h4>Phone Number</h4>
                            <p><a href="tel:{{ $user->phone_one }}">{{ $user->phone_one }}</a></p>
                            @if ($user->phone_two)
                                <p><a href="tel:{{ $user->phone_two }}"></a>{{ $user->phone_two }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="content">
                            <h4>Email Address</h4>
                            <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                    <h3>Get In Touch</h3>
                    <p>Ready to connect? Send a message and let's start a conversation.</p>
                    <form action="{{ route('contact-form') }}" id="contact-form" method="POST" data-aos="fade-up"
                        data-aos-delay="200">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="Your name" />
                                <div class="invalid-feedback name"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="Your Email" />
                                <div class="invalid-feedback email"></div>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"
                                    placeholder="Subject" />
                                <div class="invalid-feedback subject"></div>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message">{{ old('message') }}</textarea>
                                <div class="invalid-feedback message"></div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js-link')
    <script>
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            $('.invalid-feedback').text('');
            $('input, textarea').removeClass('is-invalid border border-danger');
            // Button Disabled
            let submitBtn = $(this).find('button[type="submit"]');
            let originalText = submitBtn.text();
            submitBtn.prop('disabled', true).text('Sending...');

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend: function() {

                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr, status, error) {
                    // Check if errors exist
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        // name error
                        if (errors.name && errors.name[0]) {
                            $("input[name='name']").addClass('is-invalid border border-danger');
                            $('.name').text(errors.name[0]);
                        }

                        // email error
                        if (errors.email && errors.email[0]) {
                            $("input[name='email']").addClass('is-invalid border border-danger');
                            $('.email').text(errors.email[0]);
                        }

                        // email error
                        if (errors.subject && errors.subject[0]) {
                            $("input[name='subject']").addClass('is-invalid border border-danger');
                            $('.subject').text(errors.subject[0]);
                        }

                        // email error
                        if (errors.message && errors.message[0]) {
                            $("textarea[name='message']").addClass('is-invalid border border-danger');
                            $('.message').text(errors.message[0]);
                        }
                    }
                    // If no validation errors but general error
                    else if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    }
                    // Unknown error
                    else {
                        toastr.error('Something Went Wrong. Please Try Again Later.');
                    }
                },
                complete: function() {
                    // Button Disabled
                    submitBtn.prop('disabled', false).text(originalText);
                    // Reset all input value
                    $("input[name='name']").val('');
                    $("input[name='email']").val('');
                    $("input[name='subject']").val('');
                    $("textarea[name='message']").val('');
                }
            });
        })
    </script>
@endpush
