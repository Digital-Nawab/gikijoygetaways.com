@extends('frontend.layout.master')
@section('css')
<style>
.about-section .section-top-title {
    text-align: center;
    margin-bottom: 40px;
}
.about-section .section-top-title h2 {
    color: var(--title-color);
    font-family: var(--font-roboto);
    font-weight: 700;
    font-size: 38px;
    margin-bottom: 14px;
}
.about-section .section-top-title h4 {
    color: var(--title-color);
    font-family: var(--font-roboto);
    font-weight: 500;
    font-size: 18px;
    line-height: 30px;
    max-width: 750px;
    margin: 0 auto;
    opacity: 0.85;
}
.about-section .about-content .section-title p {
    max-width: unset;
    font-weight: 400;
    margin-bottom: 18px;
    padding-top: 0px;
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-color);
}
.about-section .about-content .section-title h5 {
    font-size: 19px;
    font-weight: 600;
    color: var(--title-color);
    margin: 24px 0 12px;
    font-family: var(--font-roboto);
}
.about-section .about-content .section-title ul {
    padding-left: 0;
    list-style: none;
    margin-bottom: 18px;
}
.about-section .about-content .section-title ul li {
    position: relative;
    padding-left: 18px;
    margin-bottom: 8px;
    font-size: 14.5px;
    color: var(--text-color);
    line-height: 1.6;
}
.about-section .about-content .section-title ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 8px;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--primary-color, #e65100);
}
.about-img img {
    width: 100%;
    border-radius: 16px;
    object-fit: cover;
}
</style>
@endsection

@section('content')
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('assets/img/innerpages/breadcrumb-bg2.jpg');">
        <div class="container">
            <div class="banner-content">
                <h1>About GikiJoy</h1>
                <ul class="breadcrumb-list">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>About GokiJoy</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="about-section pt-30 mb-30">
        <div class="container">
            <div class="about-wrapper">

                {{-- TOP: Heading + subtitle full width --}}
                <div class="section-top-title wow animate fadeInUp" data-wow-delay="100ms" data-wow-duration="1200ms">
                    <h2>About Us</h2>
                    <h4>
                        Welcome to GikiJoy Getaways — your trusted travel partner for discovering
                        and booking beautiful private stays, luxury homes, villas, resorts,
                        and peaceful getaways across India.
                    </h4>
                </div>

                {{-- BOTTOM: Left text | Right image --}}
                <div class="row align-items-center justify-content-between">

                    <div class="col-xl-6 col-lg-7 wow animate fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="about-content">
                            <div class="section-title">
                                <p>
                                    At GikiJoy Getaways, we believe travel is not just about visiting a
                                    destination — it's about creating memorable experiences with comfort,
                                    privacy, and convenience. Our platform is designed for modern travelers
                                    who want more than just a hotel room. Whether you are planning a romantic
                                    escape, family vacation, weekend retreat, workcation, or group trip,
                                    we help you find the perfect property that feels like home.
                                </p>
                                <p>
                                    We offer a carefully selected collection of private properties, holiday
                                    homes, luxury resorts, cottages, and unique stays in multiple destinations
                                    across India. From the mountains of Uttarakhand and Himachal to the beaches
                                    of Goa and Kerala, and from peaceful nature retreats to premium city stays —
                                    Gikijoy Getaways brings India's best travel experiences together on one platform.
                                </p>
                                <p>
                                    Our mission is to make travel booking simple, reliable, and enjoyable by
                                    connecting travelers with quality stays that match their comfort, style,
                                    and budget. We focus on providing seamless booking experiences, verified
                                    properties, personalized support, and unforgettable hospitality.
                                </p>

                                <h5>Why Choose Gikijoy Getaways?</h5>
                                <ul>
                                    <li>Wide range of private properties, homes, villas &amp; resorts</li>
                                    <li>Getaways available across multiple states in India</li>
                                    <li>Easy online booking experience</li>
                                    <li>Comfortable stays for couples, families &amp; groups</li>
                                    <li>Premium hospitality with trusted properties</li>
                                    <li>Perfect options for vacations, staycations &amp; weekend escapes</li>
                                </ul>

                                <p>
                                    At Gikijoy Getaways, we are passionate about helping travelers discover
                                    hidden gems, luxury escapes, and relaxing destinations where every stay
                                    becomes a beautiful memory.
                                </p>
                                <p><strong>Your perfect getaway starts here.</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 d-lg-block d-none wow animate fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="about-img">
                            <img src="{{ asset('assets/img/about/about2.webp') }}" alt="About Gikijoy Getaways">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Service section, counter section etc. — unchanged below --}}
    <div class="home1-service-section mb-100">
        <div class="container">
            <div class="service-wrapper">
                <ul class="service-list wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <li class="single-service">
                        <div class="icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0C21.4662 0 26.7081 5.24194 26.7081 11.7081C26.7081 18.1743 21.4662 23.4163 15 23.4163C8.53375 23.4163 3.29187 18.1743 3.29187 11.7081C3.29187 5.24194 8.53375 0 15 0ZM23.7899 20.886C22.1639 22.4438 20.1246 23.5736 17.8531 24.0947L19.8539 28.7401L22.0141 25.2591L26.0274 26.081L23.7899 20.886ZM12.758 24.2191C10.4637 23.8108 8.38243 22.7867 6.69112 21.324L3.97262 27.1631L8.00831 26.4579L10.0666 30L12.758 24.2191ZM15.1981 7.58544C15.1294 7.40431 14.8707 7.40431 14.8019 7.58544L13.7848 10.2644C13.7706 10.3033 13.7451 10.337 13.7117 10.3613C13.6782 10.3856 13.6383 10.3994 13.597 10.4009L10.7348 10.5404C10.5401 10.5498 10.4604 10.7951 10.6124 10.9172L12.8459 12.7124C12.8785 12.7379 12.9027 12.7726 12.9154 12.8119C12.9282 12.8512 12.929 12.8934 12.9177 12.9332L12.1659 15.6984C12.1147 15.8865 12.3233 16.0381 12.4864 15.9313L14.8839 14.3618C14.9182 14.3387 14.9586 14.3264 15 14.3264C15.0413 14.3264 15.0817 14.3387 15.116 14.3618L17.5136 15.9313C17.6767 16.0381 17.8853 15.8865 17.8341 15.6984L17.0823 12.9333C17.071 12.8935 17.0717 12.8513 17.0845 12.8119C17.0973 12.7726 17.1215 12.738 17.154 12.7125L19.3876 10.9172C19.5395 10.7951 19.4598 10.5499 19.2652 10.5404L16.403 10.4009C16.3617 10.3994 16.3218 10.3856 16.2883 10.3613C16.2549 10.337 16.2294 10.3033 16.2152 10.2645L15.1981 7.58544ZM16.1065 3.43C15.4404 2.93137 14.5596 2.93137 13.8935 3.43C12.1593 4.72812 12.5526 4.58494 10.3897 4.70525C9.55893 4.75144 8.88418 5.31763 8.69443 6.12775C8.20037 8.23687 8.40962 7.87438 6.83012 9.35688C6.22343 9.92631 6.0705 10.7937 6.44587 11.5363C7.42312 13.4695 7.35043 13.0574 7.09337 15.2083C6.99462 16.0344 7.43506 16.7972 8.19987 17.1248C10.1912 17.9776 9.87056 17.7085 11.0562 19.5215C11.5116 20.2179 12.3392 20.5191 13.1357 20.2784C15.2093 19.6517 14.7908 19.6517 16.8644 20.2784C17.6609 20.5191 18.4886 20.2178 18.9439 19.5215C20.1296 17.7086 19.809 17.9776 21.8002 17.1248C22.5651 16.7972 23.0055 16.0344 22.9067 15.2083C22.6497 13.0573 22.577 13.4695 23.5542 11.5363C23.9296 10.7937 23.7766 9.92631 23.17 9.35688C21.5904 7.87444 21.7997 8.23687 21.3057 6.12775C21.1159 5.31763 20.4412 4.7515 19.6104 4.70525C17.4474 4.58494 17.8407 4.72806 16.1065 3.43Z"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Local Guidance</h4>
                            <p>Travel agencies have experienced professionals guidance.</p>
                        </div>
                    </li>
                    <li class="single-service">
                        <div class="icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.4896 4.14404C19.8384 3.81275 19.0419 4.07233 18.7107 4.72379L8.87091 24.0772C8.53971 24.7285 8.79929 25.5249 9.45066 25.8561C9.63601 25.9507 9.84112 26 10.0492 26C10.5313 26 10.996 25.7356 11.2296 25.2763L21.0694 5.92297C21.4006 5.27161 21.141 4.47523 20.4896 4.14404ZM13.4243 10.5172C13.4243 7.75042 11.1733 5.49943 8.40653 5.49943C5.63991 5.49943 3.38892 7.75042 3.38892 10.5172C3.38892 13.2839 5.63991 15.5349 8.40662 15.5349C11.1734 15.5349 13.4243 13.2839 13.4243 10.5172ZM8.40662 12.8889C7.09894 12.8889 6.03496 11.8249 6.03496 10.5172C6.03496 9.20945 7.09894 8.14548 8.40662 8.14548C9.71438 8.14548 10.7784 9.20937 10.7784 10.5172C10.7783 11.8249 9.71438 12.8889 8.40662 12.8889ZM21.5934 14.4653C18.8266 14.4653 16.5756 16.7163 16.5756 19.483C16.5756 22.2497 18.8265 24.5007 21.5934 24.5007C24.3601 24.5007 26.6111 22.2498 26.6111 19.483C26.6111 16.7162 24.3602 14.4653 21.5934 14.4653ZM21.5934 21.8546C20.2856 21.8546 19.2216 20.7906 19.2216 19.4829C19.2216 18.1752 20.2856 17.1113 21.5934 17.1113C22.901 17.1113 23.965 18.1752 23.965 19.4829C23.965 20.7906 22.9011 21.8546 21.5934 21.8546Z"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Deals &amp; Discounts</h4>
                            <p>Agencies have special discounts on flights, hotels, &amp; packages.</p>
                        </div>
                    </li>
                    <li class="single-service">
                        <div class="icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M27.6977 12.3954C27.6977 11.446 27.32 10.5343 26.6493 9.86234C25.9771 9.19137 25.0661 8.81436 24.1163 8.81396H5.88376C4.93437 8.81396 4.02274 9.19164 3.35074 9.86234C2.67978 10.5346 2.30277 11.4455 2.30237 12.3954V25.4186C2.30237 26.368 2.68004 27.2796 3.35074 27.9516C4.02303 28.6226 4.93394 28.9996 5.88376 29H24.1163C25.0657 29 25.9773 28.6223 26.6493 27.9516C27.3203 27.2794 27.6973 26.3684 27.6977 25.4186V12.3954ZM25.7442 12.3954V25.4186C25.7435 25.8502 25.5718 26.2638 25.2667 26.569C24.9615 26.8741 24.5479 27.0458 24.1163 27.0465H5.88376C5.45223 27.0458 5.03856 26.8741 4.73342 26.569C4.42828 26.2638 4.25655 25.8502 4.25586 25.4186V12.3954C4.25655 11.9638 4.42828 11.5502 4.73342 11.245C5.03856 10.9399 5.45223 10.7681 5.88376 10.7675H24.1163C24.5479 10.7681 24.9615 10.9399 25.2667 11.245C25.5718 11.5502 25.7435 11.9638 25.7442 12.3954Z"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5497 5.9527L16.7986 3.27511L23.2907 6.30172L21.8555 9.37781C21.746 9.61268 21.7343 9.88143 21.823 10.1249C21.9116 10.3684 22.0934 10.5667 22.3283 10.6762C22.5631 10.7857 22.8319 10.7974 23.0754 10.7088C23.3189 10.6201 23.5172 10.4384 23.6267 10.2035L25.4734 6.24181C25.5826 6.00725 25.5944 5.73893 25.506 5.49573C25.4176 5.25254 25.2363 5.05436 25.0019 4.94469L16.7387 1.09111C16.504 0.98194 16.2355 0.970407 15.9923 1.05905C15.7491 1.14769 15.551 1.32926 15.4416 1.56386L13.7798 5.12832C13.6206 5.45897 13.7291 5.85709 14.0386 6.05869C14.348 6.26029 14.7564 6.18658 14.9804 5.9046L15.5497 5.9527Z"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.66406 10.2035L10.2869 4.57748L16.779 7.60409L15.9521 9.37785C15.7219 9.86395 15.9266 10.4432 16.4127 10.6734C16.8988 10.9036 17.478 10.699 17.7082 10.2129L18.9617 7.54418C19.071 7.30962 19.0827 7.04129 18.9943 6.7981C18.9059 6.55491 18.7247 6.35673 18.4903 6.24706L10.227 2.39348C9.99231 2.28431 9.72386 2.27278 9.48064 2.36142C9.23742 2.45006 9.03934 2.63163 8.92992 2.86623L5.89289 9.37785C5.7834 9.61273 5.7717 9.88147 5.86035 10.125C5.94901 10.3685 6.13077 10.5668 6.36564 10.6763C6.60051 10.7858 6.86925 10.7975 7.11275 10.7088C7.35626 10.6202 7.55456 10.4384 7.66406 10.2035ZM27.6977 15C27.6977 14.7409 27.5948 14.4925 27.4116 14.3093C27.2285 14.1262 26.98 14.0232 26.721 14.0232H21.5104C20.5605 14.0232 19.6496 14.4006 18.978 15.0722C18.3063 15.7439 17.929 16.6548 17.929 17.6046V20.2093C17.929 21.1591 18.3063 22.0701 18.978 22.7417C19.6496 23.4134 20.5605 23.7907 21.5104 23.7907H26.721C26.98 23.7907 27.2285 23.6878 27.4116 23.5046C27.5948 23.3214 27.6977 23.073 27.6977 22.8139V15ZM25.7442 15.9767V21.8372H21.5104C20.6118 21.8372 19.8825 21.1079 19.8825 20.2093V17.6046C19.8825 16.706 20.6118 15.9767 21.5104 15.9767H25.7442Z"/>
                                <path d="M22.1628 20.2094C22.8821 20.2094 23.4651 19.6263 23.4651 18.9071C23.4651 18.1878 22.8821 17.6047 22.1628 17.6047C21.4435 17.6047 20.8605 18.1878 20.8605 18.9071C20.8605 19.6263 21.4435 20.2094 22.1628 20.2094Z"/>
                            </svg>
                        </div>
                        <div class="content">
                            <h4>Saves Money</h4>
                            <p>Avoids hidden fees &amp; tourist traps, Multi-destination &amp; budget-friendly options.</p>
                        </div>
                    </li>
                </ul>
                <div class="bottom-area d-flex justify-content-center wow animate fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="batch">
                        <span>Flat 30% Discount on All Packages</span>
                        <a href="{{ url('/travel-package') }}">
                            Check Offers
                            <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9L9 1M9 1C7.22222 1.33333 3.33333 2 1 1M9 1C8.66667 2.66667 8 6.33333 9 9" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="counter-section">
        <div class="container">
            <div class="row gy-md-5 gy-4">
                <div class="col-lg-3 col-sm-6 divider">
                    <div class="single-counter">
                        <div class="icon">
                            <svg width="45" height="45" viewBox="0 0 45 45" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M39.5961 15.81C38.1214 17.2519 40.2368 20.3608 36.9514 22.3862C35.0583 23.5533 38.0077 25.8843 36.9514 28.6109C36.7987 29.0049 36.7675 29.4023 36.987 29.8303C34.3992 31.822 31.1578 33.0065 27.6398 33.0065C26.7047 33.0065 25.7892 32.9228 24.9003 32.7625L24.5591 33.9508C25.5749 34.1416 26.6063 34.2374 27.6398 34.237C36.7906 34.237 44.209 26.8186 44.209 17.6679C44.209 8.51713 36.7906 1.09863 27.6398 1.09863C24.0648 1.09863 20.6088 2.24297 17.7454 4.37818C19.8919 7.68524 19.849 12.0313 17.6364 15.2956C18.4686 16.7537 19.665 16.797 20.1282 16.9774C21.8931 17.6654 23.2203 21.7429 24.3251 23.0528C25.9039 22.1413 27.6183 21.8503 29.3902 22.4059C29.0978 20.9689 27.4158 19.3471 26.9044 18.8961C25.0823 17.2898 25.8475 16.5076 27.2823 16.1104C28.9332 15.6532 31.4705 15.7057 31.9733 15.5987C33.1508 15.3482 33.4901 14.5201 32.5894 13.7393C31.5322 12.823 29.6808 11.8148 29.2499 10.9945C28.6541 9.8601 29.0869 9.52163 29.8556 9.28389C31.4176 8.80084 34.3657 8.73281 32.891 3.25178C38.0294 5.12385 41.8141 9.62587 42.7515 15.026C41.0332 15.0163 40.1027 15.3148 39.5961 15.81ZM6.48202 37.3493L1.40625 33.2101L3.25916 31.9816L8.22243 33.7703L25.2854 23.919C28.1145 22.2856 33.7222 24.5118 28.3539 27.6113L24.4524 29.8638L20.8244 42.4993L18.3959 43.9014L18.5658 33.213C18.5658 33.213 8.38195 38.8263 6.48202 37.3493ZM9.44719 1.09863C14.2276 1.09863 18.1034 4.97426 18.1034 9.7548C18.1034 14.5354 14.2277 18.411 9.44719 18.411C4.66673 18.411 0.791016 14.5353 0.791016 9.7548C0.791016 4.97435 4.66673 1.09863 9.44719 1.09863ZM4.16821 14.9772C4.53076 12.3859 6.75615 10.3914 9.44728 10.3914C12.1385 10.3914 14.3635 12.3858 14.7261 14.9772C16.0532 13.6358 16.8728 11.7911 16.8728 9.7548C16.8728 5.65356 13.5483 2.3291 9.4471 2.3291C5.34595 2.3291 2.02148 5.65356 2.02148 9.7548C2.02148 11.7911 2.84115 13.6357 4.16821 14.9772ZM6.98344 6.5076C6.98344 7.86841 8.08655 8.97152 9.44736 8.97152C10.8082 8.97152 11.9113 7.86841 11.9113 6.5076C11.9113 5.14714 10.8082 4.04402 9.44736 4.04402C8.08655 4.04411 6.98344 5.14714 6.98344 6.5076ZM8.08436 26.0411L10.5127 24.6391L18.2438 26.5637L13.7191 29.176L8.08436 26.0411ZM13.7464 24.1761C13.0102 22.6071 12.547 20.924 12.3768 19.1992C11.9812 19.3217 11.5781 19.4192 11.1702 19.4911C11.3316 20.9699 11.6927 22.4201 12.2436 23.8019L13.7464 24.1761Z"/></svg>
                        </div>
                        <div class="content">
                            <div class="number">
                                <h2 class="counter">26</h2>
                                <span>K+</span>
                            </div>
                            <span>Tour Completed</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 divider d-flex justify-content-lg-center">
                    <div class="single-counter">
                        <div class="icon">
                            <svg width="45" height="45" viewBox="0 0 45 45" xmlns="http://www.w3.org/2000/svg"><path d="M35.1512 26.1785V22.8616H35.6609C37.2742 22.8616 38.5842 21.5516 38.5842 19.9449C38.5842 18.3317 37.2742 17.0216 35.6609 17.0216H30.3436V11.9947H37.0613C37.4227 11.9947 37.7066 11.7108 37.7066 11.3495C37.7069 11.2646 37.6904 11.1806 37.6581 11.1022C37.6257 11.0237 37.5782 10.9525 37.5182 10.8925C37.4583 10.8325 37.387 10.785 37.3086 10.7527C37.2302 10.7204 37.1461 10.7039 37.0613 10.7042H31.957C31.6214 5.76761 27.5108 1.85059 22.4839 1.85059C18.296 1.85059 14.6436 4.53503 13.4045 8.5359C13.0367 9.7233 13.5464 10.9945 14.6435 11.6269V17.0216H9.32619C8.94205 17.0208 8.56153 17.0958 8.20647 17.2424C7.85141 17.389 7.5288 17.6043 7.25718 17.8759C6.98555 18.1475 6.77026 18.4701 6.62367 18.8252C6.47707 19.1802 6.40206 19.5608 6.40294 19.9449C6.40294 21.5517 7.71287 22.8616 9.32619 22.8616H9.83604V26.1785C6.40303 27.8885 4.20251 31.4055 4.20251 35.2708V39.6008C4.20251 41.5561 5.79641 43.15 7.75171 43.15H37.2485C39.2038 43.15 40.7977 41.5561 40.7977 39.6008V35.2708C40.7976 31.4055 38.5907 27.8885 35.1512 26.1785Z"/></svg>
                        </div>
                        <div class="content">
                            <div class="number">
                                <h2 class="counter">12</h2>
                                <span>+</span>
                            </div>
                            <span>Travel Experience</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 divider d-flex justify-content-lg-center">
                    <div class="single-counter">
                        <div class="icon">
                            <svg width="45" height="45" viewBox="0 0 45 45" xmlns="http://www.w3.org/2000/svg"><path d="M38.0333 16.4395C38.3412 16.4394 38.6319 16.2974 38.8214 16.0547C39.0107 15.8121 39.0776 15.4959 39.003 15.1973L37.5909 9.54883C37.4796 9.10368 37.08 8.79105 36.6212 8.79102H8.37899C7.92011 8.79102 7.52055 9.10366 7.40926 9.54883L5.99715 15.1973C5.92256 15.4959 5.98936 15.812 6.17879 16.0547C6.3683 16.2974 6.65894 16.4395 6.96688 16.4395H38.0333Z"/></svg>
                        </div>
                        <div class="content">
                            <div class="number">
                                <h2 class="counter">20</h2>
                                <span>+</span>
                            </div>
                            <span>Happy Traveler</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 d-flex justify-content-lg-end">
                    <div class="single-counter">
                        <div class="icon">
                            <svg width="45" height="45" viewBox="0 0 45 45" xmlns="http://www.w3.org/2000/svg"><path d="M22.1628 20.2094C22.8821 20.2094 23.4651 19.6263 23.4651 18.9071C23.4651 18.1878 22.8821 17.6047 22.1628 17.6047C21.4435 17.6047 20.8605 18.1878 20.8605 18.9071C20.8605 19.6263 21.4435 20.2094 22.1628 20.2094Z"/></svg>
                        </div>
                        <div class="content">
                            <div class="number">
                                <h2 class="counter">98</h2>
                                <span>%</span>
                            </div>
                            <span>Retention Rate</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection