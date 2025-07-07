@extends('layouts.app')

@section('content')
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <article class="card shadow-sm p-4">
                    <header class="mb-4">
                        <h1 class="h3 fw-bold text-center pb-5">Privacy Policy</h1>
                        <p class="text-muted">Effective Date: June 19, 2025</p>
                        <p>Future Taikun is committed to protecting your personal information. This Privacy Policy explains
                            how we collect, use, disclose, and safeguard your information when you visit our website or use
                            our services.</p>
                    </header>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">1. Information We Collect</h2>
                        <ul>
                            <li><strong>Personal Information:</strong> Name, email address, phone number, business details,
                                and other identifying information provided during registration or through forms.</li>
                            <li><strong>Usage Data:</strong> IP address, browser type, access times, pages visited,
                                referring URLs, and interactions with our platform.</li>
                            <li><strong>Cookies & Tracking:</strong> We use cookies and similar technologies to enhance your
                                experience and analyze usage trends.</li>
                        </ul>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">2. How We Use Your Information</h2>
                        <ul>
                            <li>To provide and improve our services.</li>
                            <li>To communicate with you regarding your account, support, or promotional updates.</li>
                            <li>To connect entrepreneurs and investors based on platform preferences.</li>
                            <li>To detect and prevent fraudulent or unauthorized activity.</li>
                            <li>To comply with legal obligations.</li>
                        </ul>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">3. Information Sharing</h2>
                        <ul>
                            <li>We do not sell your personal information.</li>
                            <li>We may share data with trusted service providers who assist in operating our platform.</li>
                            <li>We may disclose information if required by law or to protect the rights and safety of Future
                                Taikun and its users.</li>
                        </ul>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">4. Data Security</h2>
                        <p>We use industry-standard security measures to protect your data. However, no method of
                            transmission over the internet is 100% secure. You are responsible for maintaining the
                            confidentiality of your account credentials.</p>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">5. Your Rights</h2>
                        <p>You may request to access, correct, or delete your personal information at any time by contacting
                            us at <a href="{{ route('contact') }}">Contact Us</a>. Depending on your region, you may have
                            additional rights under data protection laws.</p>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">6. Third-Party Links</h2>
                        <p>Our platform may contain links to third-party websites. We are not responsible for the privacy
                            practices of such websites. Please review their privacy policies before sharing personal
                            information.</p>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">7. Children's Privacy</h2>
                        <p>Future Taikun is not intended for users under the age of 18. We do not knowingly collect data
                            from children. If you believe a child has submitted personal data to us, please contact us for
                            removal.</p>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">8. Changes to This Policy</h2>
                        <p>We may update this Privacy Policy from time to time. We will notify users of significant changes
                            by updating the date and posting the revised version on our website.</p>
                    </section>

                    <footer class="mt-4">
                        <p>If you have any questions or concerns about this Privacy Policy, please <a
                                href="{{ route('contact') }}">contact our support team</a>.</p>
                        <p class="fw-semibold mt-3">Thank you for trusting Future Taikun.</p>
                    </footer>
                </article>
            </div>
        </div>
    </section>
@endsection
