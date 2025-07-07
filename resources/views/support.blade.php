@extends('layouts.app')

@section('content')
    <!-- Support Card -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card support-card p-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4 fw-bold">Frequently <span class="company-span">Asked</span>
                            Questions</h2>
                        <div class="accordion" id="faqAccordion">
                            <h5 class="fw-bold mt-2">ENTREPRENEURS – FAQs </h5>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        What is FutureTaikun?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        FutureTaikun is a global platform that connects startups with genuine investors
                                        through video-based pitches, helping founders raise capital and gain visibility.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Who can pitch on FutureTaikun?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Any individual, team, or registered company with an innovative idea or a running
                                        business can pitch — from early-stage concepts to revenue-generating ventures.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How do I upload my pitch?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Create an account, complete your proﬁle, record your pitch video (preferably 8–10
                                        minutes),
                                        and upload it on your dashboard. Our team will review and publish it.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        What language should the pitch be in?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You can pitch in English, Hindi, or your local language. Just ensure it’s clear,
                                        conﬁdent, and
                                        convincing. Subtitles are recommended for wider reach.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        What type of startups are best suited for FutureTaikun?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Any startup that solves a real problem, has a market opportunity, and is ready to
                                        raise funds — from tech and healthcare to consumer goods and agriculture.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        How will I know if an investor is interested?
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Interested investors can message or schedule a meeting with you via the platform.
                                        You’ll get
                                        email and dashboard notiﬁcations.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSevan">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSevan" aria-expanded="false"
                                        aria-controls="collapseSevan">
                                        Can I submit more than one startup?
                                    </button>
                                </h2>
                                <div id="collapseSevan" class="accordion-collapse collapse"
                                    aria-labelledby="headingSevan" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, if you have multiple ventures, you can submit each one separately, with dierent
                                        pitch
                                        videos and proﬁles.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEight" aria-expanded="false"
                                        aria-controls="collapseEight">
                                        Will FutureTaikun help improve my pitch?
                                    </button>
                                </h2>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, we oer optional pitch review and improvement services, including feedback,
                                        editing, and scriptwriting, for an extra fee.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingNine">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseNine" aria-expanded="false"
                                        aria-controls="collapseNine">
                                        What happens after I get funded?
                                    </button>
                                </h2>
                                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You can update your proﬁle with funding status. There’s no obligation to leave the
                                        platform —
                                        continue using it for visibility, partnerships, or future rounds.
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-bold mt-2">INVESTORS – FAQs </h5>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                        Who can register as an investor on FutureTaikun?
                                    </button>
                                </h2>
                                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You can update your proﬁle with funding status. There’s no obligation to leave the
                                        platform —
                                        continue using it for visibility, partnerships, or future rounds.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEleven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEleven" aria-expanded="false"
                                        aria-controls="collapseEleven">
                                        Is there a veriﬁcation process for investors?
                                    </button>
                                </h2>
                                <div id="collapseEleven" class="accordion-collapse collapse"
                                    aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. To ensure serious participation, investors are asked to verify their identity
                                        and intent before accessing full startup details.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwelve">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwelve" aria-expanded="false"
                                        aria-controls="collapseTwelve">
                                        What kind of startups are listed on FutureTaikun?
                                    </button>
                                </h2>
                                <div id="collapseTwelve" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Startups from diverse sectors — including technology, healthcare, consumer goods,
                                        education, agri-tech, and manufacturing.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThirteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThirteen" aria-expanded="false"
                                        aria-controls="collapseThirteen">
                                        Can I directly invest through the platform?
                                    </button>
                                </h2>
                                <div id="collapseThirteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        No, FutureTaikun facilitates connection and communication. Actual investment
                                        discussions
                                        and agreements happen outside the platform.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingForteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseForteen" aria-expanded="false"
                                        aria-controls="collapseForteen">
                                        Is it safe to share my details on the platform?
                                    </button>
                                </h2>
                                <div id="collapseForteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingForteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. We follow strict data privacy and conﬁdentiality policies. Your personal and
                                        business
                                        details are protected.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFifteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFifteen" aria-expanded="false"
                                        aria-controls="collapseFifteen">
                                        How do I connect with a startup?
                                    </button>
                                </h2>
                                <div id="collapseFifteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingFifteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Once veriﬁed, you can message startups directly, request meetings, or express
                                        interest to learn more about their pitch.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSixteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSixteen" aria-expanded="false"
                                        aria-controls="collapseSixteen">
                                        Can I ﬁlter startups by sector or funding stage?
                                    </button>
                                </h2>
                                <div id="collapseSixteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingSixteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. You can explore startups using ﬁlters such as industry, location, funding
                                        required, and
                                        business stage.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSevanteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSevanteen" aria-expanded="false"
                                        aria-controls="collapseSevanteen">
                                        Can I track startups I’m interested in?
                                    </button>
                                </h2>
                                <div id="collapseSevanteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingSevanteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, you can bookmark startups, follow their updates, and receive notiﬁcations on
                                        key changes or progress.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinEghitteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEghitteen" aria-expanded="false"
                                        aria-controls="collapseEghitteen">
                                        Can I refer other investors to join?
                                    </button>
                                </h2>
                                <div id="collapseEghitteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingEghitteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Absolutely. You can invite others from your network to explore the platform and
                                        invest in
                                        promising startups.
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-bold mt-2"> GENERAL – FAQs</h5>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinNighnteen">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseNighnteen" aria-expanded="false"
                                        aria-controls="collapseNighnteen">
                                        Is FutureTaikun available globally?
                                    </button>
                                </h2>
                                <div id="collapseNighnteen" class="accordion-collapse collapse"
                                    aria-labelledby="headingNighnteen" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. Startups and investors from any country can use FutureTaikun. We support
                                        cross-border
                                        connections and funding opportunities.
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiy">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiy" aria-expanded="false"
                                        aria-controls="collapseTwentiy">
                                        What makes FutureTaikun dierent?
                                    </button>
                                </h2>
                                <div id="collapseTwentiy" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiy" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We are video-ﬁrst, founder-focused, and built to connect real startups with real
                                        investors in a
                                        transparent, simple, and global format.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiy">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiy" aria-expanded="false"
                                        aria-controls="collapseTwentiy">
                                        Is my data secure on FutureTaikun?
                                    </button>
                                </h2>
                                <div id="collapseTwentiy" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiy" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. We use secure systems and encrypted data handling to protect all user
                                        information and
                                        pitch materials.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiyone">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiyone" aria-expanded="false"
                                        aria-controls="collapseTwentiyone">
                                        Can I delete my account later?
                                    </button>
                                </h2>
                                <div id="collapseTwentiyone" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiyone" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, you can deactivate or permanently delete your account anytime through your
                                        dashboard or by emailing support.
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiytwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiytwo" aria-expanded="false"
                                        aria-controls="collapseTwentiytwo">
                                        Do you oer promotional services for startups?
                                    </button>
                                </h2>
                                <div id="collapseTwentiytwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiytwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. You can opt for add-on marketing services such as featured listing, social
                                        media
                                        promotion, and investor targeting.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiythree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiythree" aria-expanded="false"
                                        aria-controls="collapseTwentiythree">
                                        How long does it take to publish a pitch?
                                    </button>
                                </h2>
                                <div id="collapseTwentiythree" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiythree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Generally within 7 working days after submission, depending on review and approval.
                                        You’ll be
                                        notiﬁed once it’s live.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiyfor">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiyfor" aria-expanded="false"
                                        aria-controls="collapseTwentiyfor">
                                        Can I access FutureTaikun on mobile?
                                    </button>
                                </h2>
                                <div id="collapseTwentiyfor" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiyfor" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. The platform is mobile-friendly and works smoothly on all browsers. A mobile
                                        app is also
                                        under development
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiyfive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiyfive" aria-expanded="false"
                                        aria-controls="collapseTwentiyfive">
                                        Can I raise funds multiple times?
                                    </button>
                                </h2>
                                <div id="collapseTwentiyfive" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiyfive" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes. Once your initial round is complete, you can relist or update your proﬁle for
                                        future funding
                                        rounds.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headinTwentiysix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwentiysix" aria-expanded="false"
                                        aria-controls="collapseTwentiysix">
                                        How do I get help if I face issues?
                                    </button>
                                </h2>
                                <div id="collapseTwentiysix" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwentiysix" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Use our live chat support or email us at info@futuretaikun.com for any help related
                                        to accounts, uploads, or connections.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
