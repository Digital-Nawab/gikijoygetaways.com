 <!-- home1 Footer Section Start-->
 @php
 $states = \App\Models\State::where('status', 1)->latest()->take(5)->get();
 @endphp
 <footer class="footer-section two">
     <div class="container">
         <div class="footer-menu-wrap">
             <div class="row gy-md-4 gy-3">
                 <div class="col-lg-3 col-md-4 col-sm-6">
                     <div class="footer-logo-and-addition-info">
                         <a href="{{ url('/') }}" class="footer-logo">
                             <img src="{{ asset('assets/img/logo.png') }}"
                                 alt="Logo"
                                 style="max-width:150px; height:auto; filter: brightness(0) invert(1);">
                         </a>
                         <div class="address-area">
                             <p>
                                 Discover GikiJoy – Your destination for premium experiences, products, and stays. | 1/523 JiaMau, Hazratganj Lucknow, 226001 Uttar Pradesh
                             </p>
                         </div>
                         <ul class="social-list">
                             <li><a href="https://www.facebook.com/gikijoy"><i class="bx bxl-facebook"></i></a></li>
                             <li><a href="https://www.youtube.com/"><i class="bx bxl-youtube"></i></a></li>
                             <li><a href="https://www.instagram.com/gikijoy/"><i class="bx bxl-instagram-alt"></i></a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-3 col-md-4 col-6 d-flex justify-content-md-end">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h5>Quick Links</h5>
                        </div>
                        <ul class="widget-list">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('about') }}">About </a></li>
                            <li><a href="{{url('/travel-package')}}">Travel Package</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>
                            <li><a href="{{url('/blog-list')}}">Blog</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6 d-flex justify-content-md-end">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h5>Our States</h5>
                        </div>
                        <ul class="widget-list">
                            @foreach($states as $state)
                            <li>
                                <a href="{{ url('/travel-package/' . $state->slug) }}">
                                    {{ $state->state_name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-3 col-sm-6 d-flex justify-content-lg-end">
                     <div class="footer-widget">
                         <div class="widget-title">
                             <h5>Contact Info</h5>
                         </div>
                         <ul class="contact-list">
                             <li class="single-contact">
                                 <div class="icon">
                                     <img src="assets/img/home3/icon/whatsapp-icon.svg" alt="">
                                 </div>
                                 <div class="content">
                                     <span>WhatsApp</span>
                                     <a href="https://wa.me/919194021976">+91 91940 21976</a>
                                 </div>
                             </li>
                             <li class="single-contact">
                                 <div class="icon">
                                     <img src="assets/img/home3/icon/mail-icon.svg" alt="">
                                 </div>
                                 <div class="content">
                                     <span>Mail Us</span>
                                     <a href="mailto:contact@GikiJoy.com">contact@GikiJoy.com</a>
                                 </div>
                             </li>
                             <li class="single-contact">
                                 <div class="icon">
                                     <img src="assets/img/home1/icon/call-icon.svg" alt="">
                                 </div>
                                 <div class="content">
                                     <span>More Inquiry</span>
                                     <a href="tel:+919194021976">+91 91940 21976</a>
                                 </div>
                             </li>
                             <li class="single-contact">
                                <div class="icon">
                                    <img src="assets/img/home1/icon/call-icon.svg" alt="">
                                </div>
                                <div class="content">
                                    <span>Support Number</span>
                                    <a href="tel:+919194021976">+91 91940 21976</a>
                                </div>
                            </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="footer-bottom">
         <div class="container">
             <div class="copyright-and-payment-method-area">
                 <p>Copyright 2026 <a href="https://www.egenslab.com/">GikiJoy</a> | All Right Reserved.</p>
                 <div class="payment-method-area">
                     <span>Accepted Payment Methods :</span>
                     <ul>
                         <li><img src="assets/img/home1/icon/mastar-card-icon.svg" alt=""></li>
                         <li><img src="assets/img/home1/icon/visa-icon.svg" alt=""></li>
                         <li><img src="assets/img/home1/icon/paypal-icon.svg" alt=""></li>
                         <li><img src="assets/img/home1/icon/gpay-icon.svg" alt=""></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- home1 Footer Section End-->