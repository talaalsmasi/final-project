@extends('layouts.index')
@section('from', 'Home')
@section('title', 'Contact Us')
@section('content')
<style>
    body {
        background-image: url('http://localhost:8000/images/bg-paw.png'); /* ضع هنا رابط الصورة المباشر */
        background-color: rgb(249, 246, 246);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<section class="pet_service">
    <div class="custom-container">
        <div class="mian_heading text-center"><h2>Contact Us</h2></div>

        <div class="pet_service_row contact_serviec">

           <div class="pet_service_column">
                <figure>
                    <img src="images/service_bg.png" alt="image">
                    <img class="hover_img" src="images/service_bg_hover.png" alt="image">
                    <a class="icon_img" href="#"><img src="images/Contact-US-icon-01.png" alt="image"></a>
                </figure>
                <h6>Opening Time </h6>
                <p><a href="#">Sun - Sun  : 9:00 am - 9 : 00 pm</a> </p>
            </div>
            <div class="pet_service_column">
                <figure>
                    <img src="images/service_bg.png" alt="image">
                    <img class="hover_img" src="images/service_bg_hover.png" alt="image">
                    <a class="icon_img" href="#"><img src="images/Contact-US-icon-02.png" alt="image"></a>
                </figure>
                <h6>Contact Number</h6>
                <p><a href="#">+962 791547531</a> <a href="#">
+962 9567006</a></p>
            </div>
            <div class="pet_service_column">
                <figure>
                    <img src="images/service_bg.png" alt="image">
                    <img class="hover_img" src="images/service_bg_hover.png" alt="image">
                    <a class="icon_img" href="#"><img src="images/Contact-US-icon-03.png" alt="image"></a>
                </figure>
                <h6>Email Address</h6>
                <p><a href="#">pet2024pal@gmail.com</a> <a href="#">pet.pal@gmail.com</a></p>
            </div>
            <div class="pet_service_column">
                <figure>
                    <img src="images/service_bg.png" alt="image">
                    <img class="hover_img" src="images/service_bg_hover.png" alt="image">
                    <a class="icon_img" href="#"><img src="images/Contact-US-icon-04.png" alt="image"></a>
                </figure>
                <h6>Our Location </h6>
                <p><a href="#">Our Location</a> <a href="#">Jordan, Amman, Abu nusayr</a></p>
            </div>
        </div>
   </div>
</section>
<section class="contact_wrapper">
    <div class="container">
        <div class="mian_heading">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h2>Send Us a Message</h2>
            <h3>Feel free to contact</h3>
        </div>

        <div class="contact_row">
            <div class="contact_form_column">
                <!-- تم إضافة action ليشير إلى المسار الصحيح -->
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf <!-- حماية ضد الهجمات -->

                    <div class="contact_filed">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="contact_filed full_width">
                        <input type="text" name="subject" placeholder="Subject" required>
                    </div>

                    <div class="contact_filed">
                        <textarea name="message" placeholder="Message or suggestion" required></textarea>
                    </div>

                    <button type="submit" class="main_button btn2 bdr-clr hover-affect">Send Message</button>
                </form>
            </div>

            <div class="contact_form_column">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.672199665079!2d35.88018207547328!3d32.05106307397553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c9ffebb2ce2b1%3A0x4891153ea7e06faa!2sPETLY!5e0!3m2!1sen!2sjo!4v1730282118231!5m2!1sen!2sjo"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>


@endsection
