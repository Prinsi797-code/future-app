@extends('layouts.app')

@section('content')
    <!-- Support Card -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <article class="card shadow-sm p-4">
                    <header class="mb-4">
                        <h1 class="h3 fw-bold">Future Taikun Guidelines</h1>
                        <p class="text-muted">Welcome to Future Taikun, a platform designed to empower entrepreneurs and
                            connect them with visionary investors. To ensure a safe, innovative, and productive environment,
                            please adhere to the following guidelines. These rules help us maintain the integrity of our
                            community and support the growth of meaningful ventures.</p>
                    </header>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">Acceptable Use</h2>
                        <ul>
                            <li><strong>Entrepreneurial Ventures:</strong> Showcase startups, business ideas, or scalable
                                projects that align with Future Taikun’s vision of fostering innovation and investment
                                opportunities.</li>
                            <li><strong>Investor Engagement:</strong> Share insights, funding opportunities, or mentorship
                                offers that benefit emerging businesses.</li>
                        </ul>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">Restricted Activities</h2>
                        <ul>
                            <li><strong>No Unauthorized Solicitations:</strong> Avoid unsolicited requests for funds or
                                services outside of approved investment channels. This includes personal appeals or
                                unverified crowdfunding campaigns.</li>
                            <li><strong>No Inappropriate Content:</strong> Refrain from posting content that includes
                                offensive language, unethical practices, or material that contradicts our community values.
                            </li>
                        </ul>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">Prohibited Projects</h2>
                        <ul>
                            <li><strong>High-Risk Financial Schemes:</strong> No projects involving uncollectible debt,
                                risky receivable financing, or speculative investment traps.</li>
                            <li><strong>Restricted Products:</strong> Avoid promoting weapons, illegal substances, or items
                                that violate local regulations or ethical standards.</li>
                            <li><strong>Misleading Offers:</strong> Prohibit ventures promising guaranteed success, pyramid
                                schemes, or exaggerated business claims without evidence.</li>
                            <li><strong>Harmful Services:</strong> Exclude businesses offering credit repair scams, identity
                                theft services, or exploitative practices.</li>
                            <li><strong>Disruptive Activities:</strong> Ban contests, lotteries, or activities that could
                                destabilize the platform’s focus on legitimate entrepreneurship.</li>
                        </ul>
                    </section>

                    <section class="mb-4">
                        <h2 class="h5 fw-bold">Community Standards</h2>
                        <ul>
                            <li><strong>Respect and Collaboration:</strong> Engage with others respectfully, fostering a
                                culture of mutual growth and support.</li>
                            <li><strong>Transparency:</strong> Provide clear, honest details about your projects or
                                investment interests to build trust within the Future Taikun network.</li>
                            <li><strong>Compliance:</strong> Ensure all activities comply with local laws and regulations
                                applicable to your region.</li>
                        </ul>
                    </section>

                    <footer class="mt-4">
                        <p>By following these guidelines, you contribute to a thriving ecosystem where entrepreneurs and
                            investors can connect and succeed. Violations may result in restricted access or removal from
                            the platform. For more details or to report issues, <a href="{{ route('support') }}">contact our
                                support team</a>.</p>
                        <p class="fw-semibold mt-3">Thank you for being part of the Future Taikun community!</p>
                    </footer>
                </article>
            </div>
        </div>
    </section>
@endsection
