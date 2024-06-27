@extends('layouts.mainlayout')

@section('content')
    <section id="hero_section" style="background-image: url('{{ asset('Images/badminton_field.png') }}')">
        <div class="container text-center container-hero ">
            <h1 class="display-4 text-white title-hero">Book Your Badminton Court with Ease</h1>
            <p class="lead text-white px-md-3">
                Join the fastest and easiest way to book badminton courts in your area. Whether you're a seasoned player or
                just starting out, our app helps you find, reserve, and enjoy your game without the hassle. Get started now
                and elevate your badminton experience!
            </p>
            <a class="btn btn-primary btn-lg mt-3" href="#field_section" role="button">Book Now!</a>
        </div>
    </section>

    <section class="py-5 py-xl-8" id="services">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <h3 class="fs-6 mb-2 text-secondary text-center text-uppercase">What We offer?</h3>
                    <h2 class="display-6 mb-5 text-center">We are giving you perfect solutions with our proficient services.
                    </h2>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container overflow-hidden">
            <div class="row gy-3 gy-xl-0 justify-content-center">
                <div class="col-12 col-sm-6 col-xl-3 d-flex justify-content-center">
                    <div class="card border-0 border-bottom border-primary shadow-sm">
                        <div class="card-body text-center p-4 p-xxl-5">
                            @include('icons/userfriendly')

                            <h4 class="mb-4">User Friendly</h4>
                            <p class="mb-4 text-secondary">Enjoy the convenience of booking badminton courts through our
                                platform. With just a few clicks, you can reserve a court at your preferred time.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 border-bottom border-primary shadow-sm">
                        <div class="card-body text-center p-4 p-xxl-5">
                            @include('icons/quality')
                            <h4 class="mb-4">High-Quality Courts</h4>
                            <p class="mb-4 text-secondary">We offer a variety of high-quality badminton courts that meet
                                international standards. All our courts are well-maintained to ensure the best playing
                                experience.</p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 border-bottom border-primary shadow-sm">
                        <div class="card-body text-center p-4 p-xxl-5">
                            @include('icons/wallet')
                            <h4 class="mb-4">Competitive Pricing</h4>
                            <p class="mb-4 text-secondary">Experience exceptional value with our competitive pricing for
                                badminton court bookings. We ensure that you get the best rates without compromising on
                                quality.

                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials-section">
        <div class="gtco-testimonials">
            <h2>Reviews</h2>
            <div class="owl-carousel owl-carousel1 owl-theme">
                @forelse($reviews as $review)
                    <div class="card text-center">
                        <div class="card-body">
                            <p class="card-text">“ {{ $review->comment }} ”</p>
                            <h5>{{ $review->name }}</h5>
                        </div>
                    </div>
                @empty
                    <div class="card text-center">
                        <div class="card-body">
                            <p class="card-text">No reviews found.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact-us">

        <h2 class="text-center pb-5">Contact Us</h2>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center p-4 bg-white contact-us-container">
                <div class="col-md-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15867.978479079586!2d106.843154!3d-6.131424!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f50ad818a3f9%3A0xcd61fbccea50d391!2sGor%20Cahaya!5e0!3m2!1sen!2sid!4v1718010559847!5m2!1sen!2sid"
                        width="100%" height="400" class="pt-2 " allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <!-- Contact Form -->
                    <form id="contactForm" action="{{ route('contact.us.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <!-- Name Input with Icon -->
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- Email Input with Icon -->
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" placeholder="Email"
                                    name="email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- Message Textarea with Icon -->
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                                <textarea class="form-control" id="message" rows="3" placeholder="Message" name="message"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
