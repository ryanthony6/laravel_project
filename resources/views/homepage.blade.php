@extends('layouts.mainlayout')

@section('content')
<section id="hero_section" style="background-image: url('{{ asset('Images/badminton_field.png') }}')">
    <div class="container text-center container-hero ">
        <h1 class="display-4 text-white title-hero">Introduce Your Product Quickly & Effectively</h1>
        <p class="lead text-white px-md-3"> 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
        </p>
        <a class="btn btn-primary btn-lg mt-3" href="#field_section" role="button">Book Now!</a>
    </div>
</section>

<section id="field_section">
    <div class="container">
        <h2 class="text-center pt-5 pb-4">Available Schedule</h2>
            <div class="row">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="col-md-4 mb-5 mb-md-4">
                        <div class="card">
                            <img src="{{ asset('/Images/badminton_field.png') }}" class="card-img-top" alt="Lapangan">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Lapangan {{ $i }}</h5>
                                    <h5 class="card-title">Rp. 100.000 / jam</h5>
                                        <a href="#" class="btn btn-primary">Details</a>
                                </div>
                        </div>
                    </div>
                @endfor
            </div>
    </div>
</section>

<section id="testimonials-section">
    <div class="gtco-testimonials">
        <h2>Reviews</h2>
        <div class="owl-carousel owl-carousel1 owl-theme">
            <div class="card text-center">
              <div class="card-body">
                <p class="card-text">“ Tempatnya bagus, sangat nyaman. Pelayanan sangat ramah, harga terjangkau” </p>
                <h5>Marvel Juan
                </h5>
              </div>
            </div>
            <div class="card text-center">
              <div class="card-body">
                <p class="card-text">“ Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia illo quod ipsa cupiditate dolorum laboriosam et ex veniam quis? Nemo. ” </p>
                <h5>Aristo Yongka
                </h5>
              </div>
            </div>
            <div class="card text-center">
              <div class="card-body">
                <p class="card-text">“ Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia illo quod ipsa cupiditate dolorum laboriosam et ex veniam quis? Nemo. ” </p>
                <h5>Edward Djohan
                </h5>
              </div>
            </div>
        </div>
    </div>
</section>

<section id="contact-us">
    
    <h2 class="text-center pt-5 pb-5">Contact Us</h2>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center p-4 bg-white contact-us-container">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15867.978479079586!2d106.843154!3d-6.131424!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f50ad818a3f9%3A0xcd61fbccea50d391!2sGor%20Cahaya!5e0!3m2!1sen!2sid!4v1718010559847!5m2!1sen!2sid" width="100%" height="400" class="pt-2 "  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <!-- Contact Form -->
                <form>
                    <div class="mb-3">
                        <!-- Name Input with Icon -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <!-- Email Input with Icon -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <!-- Message Textarea with Icon -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                            <textarea class="form-control" id="message" rows="3" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
</section>


@endsection

