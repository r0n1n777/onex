@extends('layouts/app')

@section('content')
                
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                    <div class="page-header-content">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-5" data-aos="fade-up">
                                    <h1 class="page-header-title mb-3">Start your E-Loading Business with ONEX for only &#8369;299</h1>
                                    <h3 class="text-light mb-5">For a low price, you can have your own e-loading business and earn rewards by inviting. Our platform supports multiple payment outlets nationwide.</h3>
                                    <a class="btn btn-dark font-weight-500 m-2" href="{{ route('register') }}">Create Account<i class="ml-2" data-feather="arrow-right"></i></a>
                                    <a class="btn btn-dark font-weight-500 m-2" href="{{ route('login') }}">Already a member? Log in<i class="ml-2" data-feather="arrow-right"></i></a>
                                </div>
                                <div class="col-lg-7 mt-5" data-aos="fade-up" data-aos-delay="100"><img class="img-fluid rounded" src="assets/img/banners/offers.png" /></div>
                                <div class="col-lg-7 mt-5" data-aos="fade-up" data-aos-delay="100"><img class="img-fluid rounded" src="assets/img/banners/offers2.png" /></div>
                                <div class="col-lg-5 mt-5" data-aos="fade-up">
                                    <h1 class="page-header-title mb-3">Earn more while getting busy earning your income, we have more to offer</h1>
                                    <h3 class="text-light mb-5">We focus on how you can gain more money and incentives once you joined the program and started your own business with us. It's so easy and fun.</h3>
                                </div>
                                <div class="col-lg-5" data-aos="fade-up">
                                    <h1 class="page-header-title mb-3">One Sim to load all platforms</h1>
                                    <h3 class="text-light mb-5">By only using one sim, you can load any networks or platforms that your customers may look for. Starting from loading a prepaid sim to paying bills for water, electricity, internet etc...</h3>
                                    <a class="btn btn-dark font-weight-500 m-2" href="{{ route('register') }}">Create Account<i class="ml-2" data-feather="arrow-right"></i></a>
                                    <a class="btn btn-dark font-weight-500 m-2" href="{{ route('login') }}">Already a member? Log in<i class="ml-2" data-feather="arrow-right"></i></a>
                                </div>
                                <div class="col-lg-7 mt-5" data-aos="fade-up" data-aos-delay="100"><img class="img-fluid rounded" src="assets/img/banners/offers3.png" /></div>
                                <div class="col-lg-7 mt-5" data-aos="fade-up" data-aos-delay="100"><img class="img-fluid rounded" src="assets/img/banners/offers4.png" /></div>
                                <div class="col-lg-5 mt-5" data-aos="fade-up">
                                    <h1 class="page-header-title mb-3">Keeping you safe during the Pandemic and our fight against COVID-19</h1>
                                    <h3 class="text-light mb-5">In these hard times, we care for you as our business partner. Earning while being safe at your home is the best way to earn money in this what we call "New Normal". Join ONEX now and become an Online Entrepreneur.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="bg-gradient-primary-to-secondary py-10">
                    <div class="container text-light">
                        <div class="row text-center">
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><img class="img-fluid rounded" src="assets/img/icons/signup.png" /></div>
                                <h3 class="text-light">Step One - Register</h3>
                                <p class="mb-0">Create your account and provide the information needed to start your business with ONEX!</p>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-0">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><img class="img-fluid rounded" src="assets/img/icons/activation.png" /></div>
                                <h3 class="text-light">Step Two - Activation</h3>
                                <p class="mb-0">After creating your account, request for an activation and pay the corresponding fee of &#8369;299 only.</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><img class="img-fluid rounded" src="assets/img/icons/invite.png" /></div>
                                <h3 class="text-light">Step Three - Earn Money</h3>
                                <p class="mb-0">Once your account has been activated, you're all set! Start making money and invite your friends and family to earn bonuses and incentives!</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="bg-light pt-10">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2>You can pay through these Mode of Payments</h2>
                            <p class="lead">We are open 24/7 to accept payments and activate your account.</p>
                            <p class="lead">
                                You can message us here:<a class="btn btn-dark font-weight-500 m-2" href="http://www.facebook.com/onexph">ONEX Facebook Page<i class="ml-2" data-feather="arrow-right"></i></a>
                            </p>
                        </div>
                        <div class="row z-1">
                            <div class="col-lg-6 mb-5 mb-lg-n10" data-aos="fade-up">
                                <div class="card pricing h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <div class="badge badge-primary-soft badge-pill badge-marketing badge-sm text-primary">Lowest Price</div><br /><br />
                                            <div class="pricing-price"><h1>&#8369;299<span>/lifetime</span></h1></div><br />
                                        </div>
                                        <ul class="fa-ul pricing-list">
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Sim Card Activation</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">NPC Load Wallet</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Unlimited Activation for Retailers</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Personal Dashboard</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Affiliate Link</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Personal Email from ONEX</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Trainings and Webinars</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Marketing Tools</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Online Advertisement</h2>
                                            </li>
                                            <li class="pricing-list-item">
                                                <h2 class="fa-li"><i class="far fa-check-circle text-teal"></i></h2>
                                                <h2 class="text-dark">Business Support</h2>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-lg-n10" data-aos="fade-up" data-aos-delay="100"><img class="img-fluid rounded" src="assets/img/banners/modeofpayments.png" /></div>
                        </div>
                    </div>
                </section>
                <section class="bg-white py-15">
                    <div class="container">
                        <div class="row mb-10">
                            <div class="col-lg-6 mb-5 mb-lg-0 divider-right" data-aos="fade">
                                <div class="testimonial p-lg-5">
                                    <div class="testimonial-brand text-gray-400"><h1>Vision</h1></div>
                                    <p class="testimonial-quote text-primary">"Where you see yourself and our business in the future is where it will take you. Looking forward to everyone's achievement personally, and professional endeavors by providing network. We dream high, We aim high."</p>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade" data-aos-delay="100">
                                <div class="testimonial p-lg-5">
                                    <div class="testimonial-brand text-gray-400"><h1>Mission</h1></div>
                                    <p class="testimonial-quote text-primary">"We strive to offer our subscribers the lowest possible membership fee and the utmost convenience. We will help members develop and achieve their goals for personal, business and professional endeavors by providing network. To become the best and easiest in unleashing the entrepreneurial profit potential of any person towards financial freedom."</p>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <h4>Ready to get started?</h4>
                                <p class="lead mb-2 mb-lg-0 text-gray-500">Get in touch or create an account.</p>
                            </div>
                            <div class="col-lg-6 text-lg-right"><a class="btn btn-dark font-weight-500 mr-3 my-2" href="https://www.facebook.com/onexph">Contact Us</a><a class="btn btn-dark font-weight-500 my-2 shadow" href="/register">Create Account</a></div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
@endsection