<footer class="footer">

    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-about">
                        <div class="footer-logo">
                            <img src="{{ asset('uploads/setting/' . logo()) }}" width="50" alt="logo">
                        </div>
                        <div class="footer-about-content">
                            <p>Provide comfortable and happiness to our customers </p>
                        </div>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Patients</h2>
                        <ul>
                            <li><a href="{{ route('login') }}"><i class="fas fa-angle-double-right"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fas fa-angle-double-right"></i> Register</a>
                            </li>
                            <li><a href="{{ route('user.appointments.create') }}"><i
                                        class="fas fa-angle-double-right"></i> Booking</a>
                            </li>
                            <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-angle-double-right"></i>
                                    Patient Dashboard</a></li>
                        </ul>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">Contact Us</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address">
                            </div>
                            <p>
                                <i class="fas fa-phone-alt"></i>
                                {{ contact() }}
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-envelope"></i>
                                {{ email() }}
                            </p>
                        </div>
                    </div>
                    <!-- /Footer Widget -->

                </div>

            </div>
        </div>
    </div>
    <!-- /Footer Top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container-fluid">

            <!-- Copyright -->
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                    </div>
                </div>
            </div>
            <!-- /Copyright -->

        </div>
    </div>
    <!-- /Footer Bottom -->

</footer>
