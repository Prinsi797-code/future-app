<?php

namespace App\Http\Controllers;

use App\Mail\EntrepreneurRejected;
use App\Mail\InterestedNotification;
use App\Mail\NewCompanyNotification;
use App\Mail\RemarkNotification;
use App\Mail\SendUserLoginInfoMail;
use App\Models\DummyEntrepreneur;
use App\Models\EntrepreneurCompany;
use App\Models\Investor;
use App\Models\InvestorRejectEntrepreneur;
use App\Models\RemarkEntrepreneur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\EntrepreneurApprovedMail;
use Illuminate\Support\Facades\Hash;
use App\Models\Entrepreneur;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class EntrepreneurController extends Controller
{
    // public function showForm($user_id)
    // {
    //     $user = User::find($user_id);

    //     if (!$user || $user->role !== 'entrepreneur') {
    //         return redirect()->route('mobile.form');
    //     }

    //     $industries = [
    //         'Technology',
    //         'Healthcare',
    //         'Finance',
    //         'E-commerce',
    //         'Education',
    //         'Food & Beverage',
    //         'Real Estate',
    //         'Manufacturing',
    //         'Energy',
    //         'Other'
    //     ];

    //     $businessStages = [
    //         'Idea',
    //         'Prototype',
    //         'Revenue-Generating',
    //         'Funded'
    //     ];

    //     return view('entrepreneur.form', compact('user', 'industries', 'businessStages'));
    // }
    public function showForm($user_id)
    {
        $countries = [
            ['code' => '+91', 'name' => 'IN'],
            ['code' => '+1', 'name' => 'USA'],
            ['code' => '+44', 'name' => 'UK'],
            ['code' => '+971', 'name' => 'UAE'],
            ['code' => '+65', 'name' => 'SG'],
            ['code' => '+61', 'name' => 'AU'],     // Australia
            ['code' => '+81', 'name' => 'JP'],     // Japan
            ['code' => '+86', 'name' => 'CN'],     // China
            ['code' => '+49', 'name' => 'DE'],     // Germany
            ['code' => '+33', 'name' => 'FR'],     // France
            ['code' => '+39', 'name' => 'IT'],     // Italy
            ['code' => '+7', 'name' => 'RU'],     // Russia
            ['code' => '+34', 'name' => 'ES'],     // Spain
            ['code' => '+82', 'name' => 'KR'],     // South Korea
            ['code' => '+66', 'name' => 'TH'],     // Thailand   ///
            ['code' => '+92', 'name' => 'PK'],     // Pakistan
            ['code' => '+880', 'name' => 'BD'],     // Bangladesh
            ['code' => '+94', 'name' => 'LK'],     // Sri Lanka
            ['code' => '+60', 'name' => 'MY'],     // Malaysia
            ['code' => '+62', 'name' => 'ID'],     // Indonesia
            ['code' => '+63', 'name' => 'PH'],     // Philippines
            ['code' => '+20', 'name' => 'EG'],     // Egypt
            ['code' => '+234', 'name' => 'NG'],     // Nigeria
            ['code' => '+27', 'name' => 'ZA'],     // South Africa
            ['code' => '+974', 'name' => 'QA'],     // Qatar
            // Add more countries as needed
        ];
        $user = User::find($user_id);

        if (!$user || ($user->role !== 'entrepreneur' && $user->role1 !== 'entrepreneur')) {
            return redirect()->route('mobile.form');
        }
        $enterprent = DummyEntrepreneur::where('user_id', $user_id)->first();
        // Get currency symbol based on country
        // $currencySymbol = $this->getCurrencySymbol($autoDetectedCountry);
        $autoDetectedCountry = $this->detectCountryFromPhone($user->phone_number);

        // Set it to $country to use further
        $country = $autoDetectedCountry;

        // Now use it to get the currency symbol
        $currencySymbol = $this->getCurrencySymbol($country);


        $industries = [
            'Technology',
            'Healthcare',
            'Finance',
            'E-commerce',
            'Education',
            'Food & Beverage',
            'Real Estate',
            'Manufacturing',
            'Energy',
            'Other'
        ];

        $qualifications = [
            'Undergraduate',
            'Graduate',
            'Postgraduate',
            'Doctorate'
        ];

        $businessStages = [
            'New Startup Idea',
            'Established Business'
        ];

        $registratioTypes = [
            'Propritorship',
            'Partnership',
            'Limited Liability Partnership',
            'Private Limited Company',
            'Limited Liability Companies',
            'Other'
        ];
        // Investment ranges with country-specific currency
        // $investmentRanges = $this->getInvestmentRanges($currencySymbol);
        $investmentRanges = $this->getInvestmentRanges($currencySymbol, $country);
        $userEmail = $user->email;
        return view('entrepreneur.form-two', compact('user', 'userEmail', 'currencySymbol', 'countries', 'registratioTypes', 'qualifications', 'country', 'autoDetectedCountry', 'industries', 'investmentRanges', 'businessStages', 'enterprent'));
        // return view('entrepreneur.form', compact( 'user', 'userEmail', 'currencySymbol', 'countries', 'registratioTypes', 'qualifications', 'country', 'autoDetectedCountry', 'industries', 'investmentRanges', 'businessStages', 'enterprent'));
    }
    private function detectCountryFromPhone($phoneNumber)
    {
        // Remove any spaces, dashes, or other non-numeric characters except +
        $cleanPhone = preg_replace('/[^\d+]/', '', $phoneNumber);

        // Common country codes mapping
        $countryCodes = [
            '+91' => 'India',
            '+1' => 'USA',
            '+44' => 'UK',
            '+971' => 'UAE',
            '+65' => 'Singapore',
            '+86' => 'China',
            '+81' => 'Japan',
            '+49' => 'Germany',
            '+33' => 'France',
            '+61' => 'Australia',
            '+55' => 'Brazil',
            '+7' => 'Russia',
            '+39' => 'Italy',
            '+34' => 'Spain',
            '+31' => 'Netherlands',
            '+41' => 'Switzerland',
            '+46' => 'Sweden',
            '+47' => 'Norway',
            '+45' => 'Denmark',
            '+358' => 'Finland',
            '+82' => 'South Korea',
        ];

        // Check for country codes
        foreach ($countryCodes as $code => $country) {
            if (strpos($cleanPhone, $code) === 0) {
                return $country;
            }
        }

        // If no country code found, check for common patterns
        if (strlen($cleanPhone) == 10 && !str_starts_with($cleanPhone, '+')) {
            // Assume India for 10-digit numbers without country code
            return 'India';
        }

        // Default fallback
        return 'Other';
    }

    private function getCurrencySymbol($country)
    {
        $currencies = [
            'India' => '₹',
            'USA' => '$',
            'UK' => '£',
            'UAE' => 'AED',
            'Singapore' => 'S$',
            'China' => '¥',
            'Japan' => '¥',
            'Germany' => '€',
            'France' => '€',
            'Italy' => '€',
            'Spain' => '€',
            'Netherlands' => '€',
            'Australia' => 'A$',
            'Brazil' => 'R$',
            'Russia' => '₽',
            'Switzerland' => 'CHF',
            'Sweden' => 'SEK',
            'Norway' => 'NOK',
            'Denmark' => 'DKK',
            'Finland' => '€',
            'South Korea' => '₩',
        ];

        return $currencies[$country] ?? '$';
    }

    private function getInvestmentRanges($currencySymbol, $country)
    {
        $ranges = [];

        if ($country === 'India') {
            $ranges = [
                'Upto 1 Crore',
                '1 Crore to 10 Crore',
                '10 Crore to 100 Crore',
                '100 Crore and above',
            ];
        } else {
            $ranges = [
                'Upto 1 Million',
                '1 Million to 10 Million',
                '10 Million and above',
            ];
        }

        return $ranges;
    }
    // private function getInvestmentRanges($currencySymbol)
    // {
    //     // Base ranges in USD equivalent
    //     $baseRanges = [
    //         ['min' => 10000, 'max' => 50000],
    //         ['min' => 50000, 'max' => 100000],
    //         ['min' => 100000, 'max' => 500000],
    //         ['min' => 500000, 'max' => 1000000],
    //         ['min' => 1000000, 'max' => 5000000],
    //         ['min' => 5000000, 'max' => null], // 5M+
    //     ];

    //     $ranges = [];

    //     // Convert to local currency if needed
    //     $conversionRate = $this->getConversionRate($currencySymbol);

    //     foreach ($baseRanges as $range) {
    //         $min = $range['min'] * $conversionRate;
    //         $max = $range['max'] ? $range['max'] * $conversionRate : null;

    //         // Format numbers based on currency
    //         $minFormatted = $this->formatCurrency($min, $currencySymbol);
    //         $maxFormatted = $max ? $this->formatCurrency($max, $currencySymbol) : null;

    //         if ($maxFormatted) {
    //             $ranges[] = $minFormatted . ' - ' . $maxFormatted;
    //         } else {
    //             $ranges[] = $minFormatted . '+';
    //         }
    //     }

    //     return $ranges;
    // }

    private function getConversionRate($currencySymbol)
    {
        // Approximate conversion rates (you should use a real-time API for production)
        $rates = [
            '₹' => 83,      // 1 USD = 83 INR
            '$' => 1,       // Base currency
            '£' => 0.79,    // 1 USD = 0.79 GBP
            'AED' => 3.67,  // 1 USD = 3.67 AED
            'S$' => 1.35,   // 1 USD = 1.35 SGD
            '¥' => 110,     // 1 USD = 110 JPY (for Japan)
            '€' => 0.85,    // 1 USD = 0.85 EUR
            'A$' => 1.50,   // 1 USD = 1.50 AUD
            'R$' => 5.20,   // 1 USD = 5.20 BRL
            '₽' => 75,      // 1 USD = 75 RUB
            'CHF' => 0.92,  // 1 USD = 0.92 CHF
            'SEK' => 10.50, // 1 USD = 10.50 SEK
            'NOK' => 10.20, // 1 USD = 10.20 NOK
            'DKK' => 6.80,  // 1 USD = 6.80 DKK
            '₩' => 1300,    // 1 USD = 1300 KRW
        ];

        return $rates[$currencySymbol] ?? 1;
    }

    private function formatCurrency($amount, $currencySymbol)
    {
        // Format large numbers appropriately
        if ($amount >= 10000000) { // 10M+
            $formatted = number_format($amount / 1000000, 0) . 'M';
        } elseif ($amount >= 1000000) { // 1M+
            $formatted = number_format($amount / 1000000, 1) . 'M';
        } elseif ($amount >= 100000) { // 100K+
            $formatted = number_format($amount / 1000, 0) . 'K';
        } elseif ($amount >= 10000) { // 10K+
            $formatted = number_format($amount / 1000, 0) . 'K';
        } else {
            $formatted = number_format($amount, 0);
        }

        return $currencySymbol . $formatted;
    }

    public function store(Request $request)
    {
        Log::info('Enter form submission:', $request->all());
        // Log::info('Files received:', $request->allFiles());
        // Add try-catch to capture validation errors
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'full_name' => 'required|string|max:255',
                'country_code' => 'nullable|string|max:10',
                'phone_number' => 'nullable',
                'email' => 'required|email|unique:entrepreneurs,email',
                'country' => 'string',
                'business_name' => 'nullable|string|max:255',
                'industry' => 'nullable|string',
                //'idea_summary' => 'required|string',
                'business_country' => 'nullable|string',
                'business_state' => 'nullable|string',
                'business_city' => 'nullable|string',
                'website_links' => 'nullable|string',
                'dob' => 'nullable|string',
                'age' => 'nullable',
                //'pitch_video' => 'nullable|url',
                'pin_code' => 'nullable|digits_between:5,6',
                'current_address' => 'nullable',
                'qualification' => 'nullable|string',
                'state' => 'nullable',
                'city' => 'nullable',
                'pitch_deck' => 'nullable|file|mimes:pdf|max:10240',
                'agreed_to_terms' => 'required', // Changed from 'accepted' to handle 'on' value
                'register_business' => 'nullable',
                'founder_number' => 'nullable',
                'business_year' => 'nullable',
                'business_year_count' => 'nullable',
                'business_describe' => 'nullable',
                'business_revenue1' => 'nullable',
                'business_revenue2' => 'nullable',
                'business_revenue3' => 'nullable', // Fixed field name
                'invested_amount' => 'nullable|regex:/^\d{1,10}$/',
                'business_address' => 'nullable',
                'market_capital' => 'nullable',
                'your_stake' => 'nullable',
                'stake_funding' => 'nullable',
                'business_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'product_photos' => 'nullable|array|min:0|max:3',
                'product_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                'business_mobile' => 'nullable',
                'business_email' => 'nullable',
                'registration_type_of_entity' => 'nullable|string',
                'tax_registration_number' => 'nullable',
                'own_fund' => 'nullable',
                'loan' => 'nullable',
                'y_business_name' => 'nullable',
                'y_brand_name' => 'nullable',
                'y_describe_business' => 'nullable',
                'y_business_address' => 'nullable',
                'y_business_country' => 'nullable',
                'y_business_state' => 'nullable',
                'y_business_city' => 'nullable',
                'y_zipcode' => 'nullable',
                'y_type_industries' => 'nullable',
                'y_own_fund' => 'nullable',
                'y_loan' => 'nullable',
                'y_invested_amount' => 'nullable',
                'y_market_capital' => 'nullable',
                'y_stake_funding' => 'nullable',
                'y_your_stake' => 'nullable',
                'employee_number' => 'nullable',
                'proposed_business_address' => 'nullable',
                'brand_name' => 'nullable',
                'y_business_logo' => 'nullable|image|mimes:jpg,jpeg,png',
                'y_product_photos' => 'nullable|array|min:1|max:3',
                'y_pitch_deck' => 'nullable',
                'y_product_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                'company_name' => 'nullable|array',
                'more_market_capital' => 'nullable|array',
                'more_your_stake' => 'nullable|array',
                'more_stake_funding' => 'nullable|array',
                'video_upload' => 'nullable|file|mimes:mp4,mov,avi,webm',

            ]);

            Log::info('Validation passed successfully');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $pitchDeckPath = null;
        $logoPath = null;
        $productPhotos = [];
        $pitchDeckPathY = null;

        //Yes register time image 
        $logoPathY = null;
        $productPhotosY = [];
        $videoUploadPath = null;

        // Upload video to BunnyCDN
        if ($request->hasFile('video_upload')) {
            $video = $request->file('video_upload');
            $videoName = time() . '_video_' . $video->getClientOriginalName();
            $videoPath = 'video/' . $videoName;
            try {
                $client = new Client();
                $response = $client->put("https://storage.bunnycdn.com/futuretaikun/{$videoPath}", [
                    'headers' => [
                        'AccessKey' => env('BUNNYCDN_API_KEY'),
                        'Content-Type' => $video->getClientMimeType(),
                    ],
                    'body' => fopen($video->getRealPath(), 'r'),
                ]);

                if ($response->getStatusCode() === 201 || $response->getStatusCode() === 200) {
                    // Use the correct BunnyCDN public URL (b-cdn.net)
                    $videoUploadPath = "https://futuretaikun.b-cdn.net/{$videoPath}";
                    Log::info('Video uploaded to BunnyCDN:', ['url' => $videoUploadPath]);
                } else {
                    Log::error('Failed to upload video to BunnyCDN', ['status' => $response->getStatusCode()]);
                    return redirect()->back()->withErrors(['video_upload' => 'Failed to upload video'])->withInput();
                }
            } catch (\Exception $e) {
                Log::error('BunnyCDN upload error:', ['message' => $e->getMessage()]);
                return redirect()->back()->withErrors(['video_upload' => 'Error uploading video'])->withInput();
            }
        }

        if ($request->hasFile('y_business_logo')) {
            $logoY = $request->file('y_business_logo');
            $logoNameY = time() . '_logo_' . $logoY->getClientOriginalName();
            $logoPathY = $logoY->storeAs('y_business_logos', $logoNameY, 'public');
            // Log::info('Business logo uploaded:', ['path' => $logoPath]);
        }

        // if ($request->hasFile('y_product_photos')) {
        //     foreach ($request->file('y_product_photos') as $index => $photoY) {
        //         if ($photoY && $photoY->isValid()) {
        //             $photoName = time() . '_photo_' . $index . '_' . $photoY->getClientOriginalName();
        //             $photoPathY = $photoY->storeAs('y_product_photos', $photoName, 'public');
        //             $productPhotosY[] = $photoPathY;
        //             Log::info('Product photo uploaded:', ['index' => $index, 'path' => $photoPathY]);
        //         } else {
        //             Log::error('Invalid photo at index:', ['index' => $index]);
        //         }
        //     }
        //     // Log::info('All product photos uploaded:', ['count' => count($productPhotos), 'paths' => $productPhotos]);
        // } else {
        //     Log::error('No product photos found in request');
        // }
        // Handle y_product_photos
        if ($request->hasFile('y_product_photos')) {
            $productPhotosY = [];
            $files = is_array($request->file('y_product_photos')) ? $request->file('y_product_photos') : [$request->file('y_product_photos')];
            foreach ($files as $index => $photoY) {
                if ($photoY && $photoY->isValid()) {
                    $photoName = time() . '_photo_' . $index . '_' . $photoY->getClientOriginalName();
                    $photoPathY = $photoY->storeAs('y_product_photos', $photoName, 'public');
                    $productPhotosY[] = $photoPathY;
                    Log::info('Product photo uploaded:', ['index' => $index, 'path' => $photoPathY]);
                } else {
                    Log::error('Invalid photo at index:', ['index' => $index]);
                }
            }
            Log::info('All y_product_photos uploaded:', ['count' => count($productPhotosY), 'paths' => $productPhotosY]);
        } else {
            Log::warning('No y_product_photos found in request', ['files' => $request->allFiles()]);
            $productPhotosY = [];
        }
        ///end 

        // Upload pitch deck
        if ($request->hasFile('pitch_deck')) {
            $file = $request->file('pitch_deck');
            $filename = time() . '_' . $file->getClientOriginalName();
            $pitchDeckPath = $file->storeAs('pitch_decks', $filename, 'public');
            // Log::info('Pitch deck uploaded:', ['path' => $pitchDeckPath]);
        }
        // Y Upload pitch deck
        if ($request->hasFile('y_pitch_deck')) {
            $file = $request->file('y_pitch_deck');
            $filenamey = time() . '_' . $file->getClientOriginalName();
            $pitchDeckPathY = $file->storeAs('y_pitch_decks', $filenamey, 'public');
            // Log::info('Pitch deck uploaded:', ['path' => $pitchDeckPath]);
        }
        // Upload business logo
        if ($request->hasFile('business_logo')) {
            $logo = $request->file('business_logo');
            $logoName = time() . '_logo_' . $logo->getClientOriginalName();
            $logoPath = $logo->storeAs('business_logos', $logoName, 'public');
            // Log::info('Business logo uploaded:', ['path' => $logoPath]);
        }

        //Try multiple approaches for file detection
        // if ($request->hasFile('product_photos')) {

        //     foreach ($request->file('product_photos') as $index => $photo) {
        //         if ($photo && $photo->isValid()) {
        //             $photoName = time() . '_photo_' . $index . '_' . $photo->getClientOriginalName();
        //             $photoPath = $photo->storeAs('product_photos', $photoName, 'public');
        //             $productPhotos[] = $photoPath;
        //             Log::info('Product photo uploaded:', ['index' => $index, 'path' => $photoPath]);
        //         } else {
        //             Log::error('Invalid photo at index:', ['index' => $index]);
        //         }
        //     }
        //     // Log::info('All product photos uploaded:', ['count' => count($productPhotos), 'paths' => $productPhotos]);
        // } else {
        //     Log::error('No product photos found in request');
        // }
        $productPhotos = [];
        if ($request->hasFile('product_photos')) {
            $files = is_array($request->file('product_photos')) ? $request->file('product_photos') : [$request->file('product_photos')];
            foreach ($files as $index => $photo) {
                if ($photo && $photo->isValid()) {
                    $photoName = time() . '_photo_' . $index . '_' . $photo->getClientOriginalName();
                    $photoPath = $photo->storeAs('product_photos', $photoName, 'public');
                    $productPhotos[] = $photoPath;
                    Log::info('Product photo uploaded:', ['index' => $index, 'path' => $photoPath]);
                } else {
                    Log::error('Invalid photo at index:', ['index' => $index]);
                }
            }
            Log::info('All product_photos uploaded:', ['count' => count($productPhotos), 'paths' => $productPhotos]);
        } else {
            Log::info('No product_photos found in request', ['files' => $request->allFiles()]);
        }
        try {
            $user = User::find($request->user_id);

            if (!$user) {
                // Log::error('User not found:', ['user_id' => $request->user_id]);
                return redirect()->back()->with('error', 'User not found!');
            }

            $entrepreneur = Entrepreneur::create([
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'country_code' => $request->country_code,
                'country' => $request->country,
                'business_name' => $request->business_name,
                'industry' => $request->industry,
                'website_links' => $request->website_links ? 'https://' . parse_url($request->website_links, PHP_URL_HOST) : null,
                'dob' => $request->dob,
                'age' => $request->age,
                'qualification' => $request->qualification,
                'business_country' => $request->business_country,
                //'idea_summary' => $request->idea_summary,
                // 'pitch_video' => $request->pitch_video,
                'video_upload' => $videoUploadPath,
                'pin_code' => $request->pin_code,
                'current_address' => $request->current_address,
                'pitch_deck' => $pitchDeckPath,
                'state' => $request->state,
                'city' => $request->city,
                'register_business' => $request->register_business,
                'business_year' => $request->business_year,
                'business_year_count' => $request->business_year_count,
                'business_describe' => $request->business_describe,
                'business_revenue1' => $request->business_revenue1,
                'business_revenue2' => $request->business_revenue2,
                'business_revenue3' => $request->business_revenue3,
                'founder_number' => $request->founder_number,
                'business_state' => $request->business_state,
                'business_city' => $request->business_city,
                'invested_amount' => $request->invested_amount,
                'business_address' => $request->business_address,
                'market_capital' => $request->market_capital,
                'y_market_capital' => $request->y_market_capital,
                'y_stake_funding' => $request->y_stake_funding,
                'y_your_stake' => $request->y_your_stake,
                'your_stake' => $request->your_stake,
                'stake_funding' => $request->stake_funding,
                'business_logo' => $logoPath,
                'product_photos' => !empty($productPhotos) ? json_encode($productPhotos) : null,
                'business_mobile' => $request->business_mobile,
                'business_email' => $request->business_email,
                'registration_type_of_entity' => $request->registration_type_of_entity,
                'tax_registration_number' => $request->tax_registration_number,
                'own_fund' => $request->own_fund,
                'loan' => $request->loan,
                'employee_number' => $request->employee_number,
                'y_business_name' => $request->y_business_name,
                'y_brand_name' => $request->y_brand_name,
                'y_describe_business' => $request->y_describe_business,
                'y_business_address' => $request->y_business_address,
                'y_business_country' => $request->y_business_country,
                'y_business_state' => $request->y_business_state,
                'y_business_city' => $request->y_business_city,
                'y_pitch_deck' => $pitchDeckPathY,
                'y_zipcode' => $request->y_zipcode,
                'y_type_industries' => $request->y_type_industries,
                'y_own_fund' => $request->y_own_fund,
                'y_loan' => $request->y_loan,
                'y_invested_amount' => $request->y_invested_amount,
                'y_business_logo' => $logoPathY,
                'y_product_photos' => json_encode($productPhotosY),
                'proposed_business_address' => $request->proposed_business_address,
                'brand_name' => $request->brand_name,
                'agreed_to_terms' => true,
                'is_verified' => true,
            ]);

            // Generate password and update user
            // $emailNamePart = strstr($request->email, '@', true);
            // $randomDigits = rand(100, 999);
            // $generatedPassword = $emailNamePart . '@' . $randomDigits;

            // $user->name = $request->full_name;
            // $user->email = $request->email;
            // $user->password = Hash::make($generatedPassword);
            // $user->save();

            $companyNames = $request->company_name ?? [];
            $marketCapitals = $request->more_market_capital ?? []; // Use the form field name
            $stakes = $request->more_your_stake ?? []; // Use the form field name
            $valuations = $request->more_stake_funding ?? []; // Use the form field name

            foreach ($companyNames as $index => $companyName) {
                if (!empty($companyName)) {
                    \App\Models\EntrepreneurCompany::create([
                        'entrepreneurs_id' => $entrepreneur->id,
                        'company_name' => $companyName,
                        'more_market_capital' => isset($marketCapitals[$index]) ? (float) $marketCapitals[$index] : null, // Map to correct column
                        'more_your_stake' => isset($stakes[$index]) ? (float) $stakes[$index] : null, // Map to correct column
                        'more_stake_funding' => isset($valuations[$index]) ? (float) $valuations[$index] : null, // Map to correct column
                    ]);
                }
            }
            // Log::info('User updated successfully:', ['user_id' => $user->id]);
            // Delete the corresponding record from dummyentrepreneurs
            $dummyEntrepreneur = DummyEntrepreneur::where('user_id', $request->user_id)->first();
            if ($dummyEntrepreneur) {
                Log::info('Deleting dummyentrepreneurs record', ['user_id' => $request->user_id]);
                $dummyEntrepreneur->delete();
            }
            // Send email
            // Mail::to($user->email)->send(new SendUserLoginInfoMail($user->name, $user->email, $user->password));

            // Log::info('Email sent successfully to:', ['email' => $user->email]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('mobile.form')->with('success', 'Entrepreneur profile created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating entrepreneur:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return redirect()->back()->with('error', 'An error occurred while creating the profile. Please try again.');
        }
    }

    // public function getEntrepreneur(Request $request)
    // {
    //     if (Auth::user()->role === 'admin') {
    //         $entrepreneur = Entrepreneur::paginate(5);
    //     } elseif (Auth::user()->role === 'investor') {
    //         $entrepreneur = Entrepreneur::where('approved', 1)->paginate(5);
    //     } else {
    //         $entrepreneur = collect();
    //     }

    //     return view('entrepreneur', compact('entrepreneur'));
    // }

    public function getEntrepreneur(Request $request)
    {
        // Get the selected role from session (set during login)
        $selectedRole = session('selected_role');

        // Base query based on selected role
        if ($selectedRole === 'admin') {
            $query = Entrepreneur::query();
        } elseif ($selectedRole === 'investor') {
            $query = Entrepreneur::where('approved', 1);
        } else {
            $query = Entrepreneur::whereRaw('0 = 1'); // No data for other roles
        }

        // Apply filter from tab
        $filter = $request->get('filter');

        if ($filter === 'alreadyfunded') {
            $query->where('interested', 1);
        } elseif ($filter === 'approved') {
            $query->where('approved', 1);
        } elseif ($filter === 'latest' || !$filter) {
            $query->orderByDesc('created_at'); // latest default
        } elseif ($filter === 'trending') {
            // Placeholder: implement trending logic if you want
            $query->orderByDesc('views'); // example, assuming 'views' field
        }

        // Apply search query on full_name, country, or market_capital
        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('business_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('country', 'like', '%' . $searchTerm . '%')
                    ->orWhere('market_capital', 'like', '%' . $searchTerm . '%');
            });
        }

        $entrepreneur = $query->paginate(5)->appends($request->all());
        $allentrepreneur = Entrepreneur::all();

        if ($entrepreneur->currentPage() > $entrepreneur->lastPage()) {
            return redirect()->route('admin.entrepreneurs', array_merge($request->except('page'), ['page' => 1]));
        }

        return view('entrepreneur', compact('entrepreneur', 'allentrepreneur'));
    }

    // public function approvedEntrepreneurs(Request $request)
    // {
    //     $approvedEntrepreneurs = Entrepreneur::where('approved', 1)->get();

    //     return view('entrepreneur.approved', compact('approvedEntrepreneurs'));
    // }
    public function approvedEntrepreneurs(Request $request)
    {
        $query = Entrepreneur::where('approved', 1);

        // Filter: Already Funded and with interested investors having offers
        if ($request->filter === 'alreadyfunded') {
            $query->whereHas('interests', function ($q) {
                $q->whereNotNull('market_capital')
                    ->whereNotNull('your_stake')
                    ->whereNotNull('company_value')
                    ->where('market_capital', '!=', 'N/A')
                    ->where('your_stake', '!=', 'N/A')
                    ->where('company_value', '!=', 'N/A');
            });
        }

        // Search Inputs: name, country, market_capital
        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('full_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('country', 'like', '%' . $searchTerm . '%')
                    ->orWhere('market_capital', 'like', '%' . $searchTerm . '%');
            });
        }

        $query->orderBy('created_at', 'desc');

        $approvedEntrepreneurs = $query->paginate(5)->appends($request->all());

        return view('entrepreneur.approved', compact('approvedEntrepreneurs'));
    }


    public function toggleApproval(Request $request)
    {
        $entrepreneur = Entrepreneur::find($request->id);

        if (!$entrepreneur) {
            return response()->json(['success' => false, 'message' => 'Entrepreneur not found'], 404);
        }
        if (
            !$request->approved &&
            $entrepreneur->interested == 0 &&
            $entrepreneur->created_at->lt(now()->subDays(90))
        ) {
            $entrepreneur->delete();
            Log::info("Entrepreneur deleted due to no interest within 90 days: ID {$entrepreneur->id}");

            return response()->json(['success' => true, 'message' => 'Entrepreneur deleted after 90 days of inactivity.']);
        }

        $entrepreneur->approved = $request->approved;

        // Generate serial number if approved and not already assigned
        if ($request->approved && empty($entrepreneur->serial_number)) {
            do {
                $randomNumber = 'S' . str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            } while (Entrepreneur::where('serial_number', $randomNumber)->exists());

            $entrepreneur->serial_number = $randomNumber;
        }

        $entrepreneur->save();

        if ($request->approved) {
            try {
                Mail::to($entrepreneur->email)->send(new EntrepreneurApprovedMail($entrepreneur));
                Log::info("Approval mail sent successfully to {$entrepreneur->email}");
            } catch (\Exception $e) {
                Log::error("Failed to send approval mail to {$entrepreneur->email}. Error: " . $e->getMessage());
            }
        }

        return response()->json(['success' => true]);
    }
    public function edit()
    {
        $user = Auth::user();
        $entrepreneur = session('entrepreneur') ?: Entrepreneur::where('user_id', $user->id)->first();

        if (!$entrepreneur) {
            Log::warning('No entrepreneur profile found for user', ['user_id' => $user->id]);
            return redirect()->route('login');
        }

        // Fetch countries from API
        $apiKey = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
        $response = Http::withHeaders(['X-CSCAPI-KEY' => $apiKey])
            ->get('https://api.countrystatecity.in/v1/countries');

        // Log API response
        if ($response->successful()) {
            Log::info('Countries API response', ['countries' => $response->json()]);
        } else {
            Log::error('Failed to fetch countries from API', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        // Use API response for dropdowns
        $countries1 = $response->successful() ? $response->json() : [];

        // Hardcoded countries for phone codes
        $countries = [
            ['code' => '+91', 'name' => 'IN'],
            ['code' => '+1', 'name' => 'USA'],
            ['code' => '+44', 'name' => 'UK'],
            ['code' => '+971', 'name' => 'UAE'],
            ['code' => '+65', 'name' => 'SG'],
            ['code' => '+61', 'name' => 'AU'],
            ['code' => '+81', 'name' => 'JP'],
            ['code' => '+86', 'name' => 'CN'],
            ['code' => '+49', 'name' => 'DE'],
            ['code' => '+33', 'name' => 'FR'],
            ['code' => '+39', 'name' => 'IT'],
            ['code' => '+7', 'name' => 'RU'],
            ['code' => '+34', 'name' => 'ES'],
            ['code' => '+82', 'name' => 'KR'],
            ['code' => '+66', 'name' => 'TH'],
            ['code' => '+92', 'name' => 'PK'],
            ['code' => '+880', 'name' => 'BD'],
            ['code' => '+94', 'name' => 'LK'],
            ['code' => '+60', 'name' => 'MY'],
            ['code' => '+62', 'name' => 'ID'],
            ['code' => '+63', 'name' => 'PH'],
            ['code' => '+20', 'name' => 'EG'],
            ['code' => '+234', 'name' => 'NG'],
            ['code' => '+27', 'name' => 'ZA'],
            ['code' => '+974', 'name' => 'QA'],
        ];

        // Log data
        Log::info('Countries1 array passed to view (API)', ['countries1' => $countries1]);
        Log::info('Countries array (hardcoded)', ['countries' => $countries]);
        Log::info('Entrepreneur Data', $entrepreneur->toArray());

        // Log pre-selection values for both sets of fields
        $autoDetectedCountry = $this->detectCountryFromPhone($user->phone_number);
        Log::info('Pre-selection values', [
            'autoDetectedCountry' => $autoDetectedCountry,
            'business_country' => old('business_country', $entrepreneur->business_country ?? $autoDetectedCountry),
            'business_state' => old('business_state', $entrepreneur->business_state ?? ''),
            'business_city' => old('business_city', $entrepreneur->business_city ?? ''),
            'y_business_country' => old('y_business_country', $entrepreneur->y_business_country ?? $autoDetectedCountry),
            'y_business_state' => old('y_business_state', $entrepreneur->y_business_state ?? ''),
            'y_business_city' => old('y_business_city', $entrepreneur->y_business_city ?? '')
        ]);

        $registratioTypes = [
            'Propritorship',
            'Partnership',
            'Limited Liability Partnership',
            'Private Limited Company',
            'Limited Liability Companies',
            'Other'
        ];

        $qualifications = [
            'Undergraduate',
            'Graduate',
            'Postgraduate',
            'Doctorate'
        ];

        $industries = [
            'Technology',
            'Healthcare',
            'Finance',
            'E-commerce',
            'Education',
            'Food & Beverage',
            'Real Estate',
            'Manufacturing',
            'Energy',
            'Other'
        ];

        $businessStages = [
            'New Startup Idea',
            'Established Business'
        ];

        $country = $autoDetectedCountry;
        $currencySymbol = $this->getCurrencySymbol($country);
        $investmentRanges = $this->getInvestmentRanges($currencySymbol, $country);

        return view('Auth.edit-entrepreneur', compact(
            'entrepreneur',
            'registratioTypes',
            'countries1',
            'countries',
            'qualifications',
            'user',
            'industries',
            'businessStages',
            'investmentRanges',
            'autoDetectedCountry'
        ));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $entrepreneur = Entrepreneur::where('user_id', $user->id)->firstOrFail();

        Log::info('Request data:', $request->all());
        Log::info('Before update:', [
            'id' => $entrepreneur->id,
            'pin_code' => $entrepreneur->pin_code,
            'video_upload' => $entrepreneur->video_upload
        ]);

        // Validate request
        $validator = Validator::make($request->all(), [
            'full_name' => 'nullable|string|max:255',
            'country_code' => 'string',
            'phone_number' => 'nullable|string',
            'business_mobile' => 'nullable',
            'email' => 'nullable|email|unique:entrepreneurs,email,' . $entrepreneur->id,
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'pin_code' => 'nullable|digits_between:5,6',
            'dob' => 'nullable|before:today',
            'qualification' => 'nullable|string',
            'age' => 'nullable|integer|min:18',
            'business_name' => 'nullable|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'business_address' => 'nullable|string|max:255',
            'business_describe' => 'nullable|string|max:75',
            'business_country' => 'nullable|string',
            'business_state' => 'nullable|string',
            'business_city' => 'nullable|string',
            'industry' => 'nullable|string',
            'own_fund' => 'nullable|numeric|min:0',
            'loan' => 'nullable|numeric|min:0',
            'founder_number' => 'nullable|numeric',
            'invested_amount' => 'nullable|numeric|min:0',
            'market_capital' => 'nullable|numeric|min:1',
            'your_stake' => 'nullable|numeric|min:1|max:100',
            'stake_funding' => 'nullable|numeric|min:0',
            'y_market_capital' => 'nullable|numeric|min:1',
            'y_your_stake' => 'nullable|numeric|min:1|max:100',
            'y_stake_funding' => 'nullable|numeric|min:0',
            'business_logo' => 'nullable',
            'product_photos' => 'nullable',
            'website_links' => 'nullable|url',
            'video_upload' => 'nullable|file|mimes:mp4,mov,avi,webm',
            'pitch_deck' => 'nullable',
            'agreed_to_terms' => 'nullable|accepted',
            'y_business_logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'y_product_photos' => 'nullable|array|min:1|max:3',
            'y_pitch_deck' => 'nullable|file|mimes:pdf',
            'y_brand_name' => 'nullable|string|max:255',
            'y_describe_business' => 'nullable|string|max:75',
            'y_business_address' => 'nullable|string|max:255',
            'y_business_country' => 'nullable|string',
            'y_business_state' => 'nullable|string',
            'business_revenue1' => 'nullable',
            'business_revenue2' => 'nullable',
            'business_revenue3' => 'nullable',
            'y_business_city' => 'nullable|string',
            'y_zipcode' => 'nullable|string|regex:/^[0-9]{6}$/',
            'y_type_industries' => 'nullable|string',
            'y_own_fund' => 'nullable|numeric|min:0',
            'y_loan' => 'nullable|numeric|min:0',
            'tax_registration_number' => 'nullable|string',
            'y_invested_amount' => 'nullable|numeric|min:0',
            'employee_number' => 'nullable|integer|min:0',
            'business_email' => 'nullable',
            'business_year' => 'nullable|integer|min:' . (date('Y') - 50) . '|max:' . (date('Y') - 1),
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads for non-y_ fields
        $pitchDeckPath = $entrepreneur->pitch_deck;
        if ($request->hasFile('pitch_deck')) {
            $file = $request->file('pitch_deck');
            $filename = time() . '_' . $file->getClientOriginalName();
            $pitchDeckPath = $file->storeAs('pitch_decks', $filename, 'public');
            Log::info('Pitch deck uploaded:', ['path' => $pitchDeckPath]);
        }

        $businessLogoPath = $entrepreneur->business_logo;
        if ($request->hasFile('business_logo')) {
            $file = $request->file('business_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $businessLogoPath = $file->storeAs('business_logos', $filename, 'public');
            Log::info('Business logo uploaded:', ['path' => $businessLogoPath]);
        }

        $productPhotosPaths = $entrepreneur->product_photos ? json_decode($entrepreneur->product_photos, true) : [];
        if ($request->hasFile('product_photos')) {
            $productPhotos = $request->file('product_photos');
            $newPhotos = [];
            foreach ($productPhotos as $photo) {
                if (count($newPhotos) < 3) {
                    $filename = time() . '_photo_' . $photo->getClientOriginalName();
                    $newPhotos[] = $photo->storeAs('product_photos', $filename, 'public');
                }
            }
            $productPhotosPaths = array_merge($productPhotosPaths, $newPhotos);
            $productPhotosPaths = array_slice($productPhotosPaths, -3);
            Log::info('Product photos uploaded:', ['count' => count($newPhotos), 'paths' => $newPhotos]);
        }

        // Handle file uploads for y_ fields
        $businessLogoPathY = $entrepreneur->y_business_logo;
        if ($request->hasFile('y_business_logo')) {
            $logoY = $request->file('y_business_logo');
            $logoNameY = time() . '_logo_' . $logoY->getClientOriginalName();
            $businessLogoPathY = $logoY->storeAs('y_business_logos', $logoNameY, 'public');
            Log::info('Y Business logo uploaded:', ['path' => $businessLogoPathY]);
        }

        $productPhotosPathsY = $entrepreneur->y_product_photos ? json_decode($entrepreneur->y_product_photos, true) : [];
        if ($request->hasFile('y_product_photos')) {
            $productPhotosY = [];
            foreach ($request->file('y_product_photos') as $index => $photoY) {
                if ($photoY && $photoY->isValid()) {
                    $photoName = time() . '_photo_' . $index . '_' . $photoY->getClientOriginalName();
                    $photoPathY = $photoY->storeAs('y_product_photos', $photoName, 'public');
                    $productPhotosY[] = $photoPathY;
                    Log::info('Y Product photo uploaded:', ['index' => $index, 'path' => $photoPathY]);
                } else {
                    Log::error('Invalid Y photo at index:', ['index' => $index]);
                }
            }
            $productPhotosPathsY = array_merge($productPhotosPathsY, $productPhotosY);
            $productPhotosPathsY = array_slice($productPhotosPathsY, -3);
        } else {
            Log::info('No Y product photos uploaded');
        }

        $pitchDeckPathY = $entrepreneur->y_pitch_deck;
        if ($request->hasFile('y_pitch_deck')) {
            $file = $request->file('y_pitch_deck');
            $filenameY = time() . '_' . $file->getClientOriginalName();
            $pitchDeckPathY = $file->storeAs('y_pitch_decks', $filenameY, 'public');
            Log::info('Y Pitch deck uploaded:', ['path' => $pitchDeckPathY]);
        }

        // Handle video upload to BunnyCDN
        $videoUploadPath = $entrepreneur->video_upload; // Preserve existing video
        if ($request->hasFile('video_upload')) {
            $video = $request->file('video_upload');
            $videoName = time() . '_video_' . $video->getClientOriginalName();
            $videoPath = 'video/' . $videoName;

            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->put("https://storage.bunnycdn.com/futuretaikun/{$videoPath}", [
                    'headers' => [
                        'AccessKey' => env('BUNNYCDN_API_KEY'),
                        'Content-Type' => $video->getClientMimeType(),
                    ],
                    'body' => fopen($video->getRealPath(), 'r'),
                ]);

                if ($response->getStatusCode() === 201 || $response->getStatusCode() === 200) {
                    $videoUploadPath = "https://futuretaikun.b-cdn.net/{$videoPath}";
                    Log::info('New video uploaded to BunnyCDN:', ['url' => $videoUploadPath]);

                    // Delete old video from BunnyCDN if it exists
                    if ($entrepreneur->video_upload && $entrepreneur->video_upload != $videoUploadPath) {
                        $this->deleteOldVideo($entrepreneur->video_upload);
                    }
                } else {
                    Log::error('Failed to upload video to BunnyCDN', ['status' => $response->getStatusCode()]);
                    return redirect()->back()->withErrors(['video_upload' => 'Failed to upload video to BunnyCDN'])->withInput();
                }
            } catch (\Exception $e) {
                Log::error('BunnyCDN upload error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                return redirect()->back()->withErrors(['video_upload' => 'Error uploading video'])->withInput();
            }
        } else {
            Log::info('No video uploaded - keeping existing video', ['video_upload' => $videoUploadPath]);
        }

        // Update entrepreneur data
        $updateData = [
            'full_name' => $request->full_name,
            'email' => $entrepreneur->email, // Keep readonly
            'phone_number' => $entrepreneur->phone_number, // Keep readonly
            'business_mobile' => $request->business_mobile,
            'country' => $entrepreneur->country, // Keep readonly
            'country_code' => $entrepreneur->country_code, // Keep readonly
            'state' => $request->state,
            'city' => $request->city,
            'pin_code' => $request->pin_code,
            'dob' => $request->dob,
            'qualification' => $request->qualification,
            'age' => $request->age,
            'business_name' => $request->business_name,
            'brand_name' => $request->brand_name,
            'business_address' => $request->business_address,
            'business_describe' => $request->business_describe,
            'business_country' => $request->business_country,
            'business_state' => $request->business_state,
            'business_city' => $request->business_city,
            'industry' => $request->industry,
            'own_fund' => $request->own_fund,
            'loan' => $request->loan,
            'invested_amount' => $request->invested_amount,
            'market_capital' => $request->market_capital,
            'your_stake' => $request->your_stake,
            'stake_funding' => $request->stake_funding,
            'y_market_capital' => $request->y_market_capital,
            'y_your_stake' => $request->y_your_stake,
            'y_stake_funding' => $request->y_stake_funding,
            'business_logo' => $businessLogoPath,
            'product_photos' => json_encode($productPhotosPaths),
            'website_links' => $request->website_links,
            'video_upload' => $videoUploadPath,
            'pitch_deck' => $pitchDeckPath,
            'agreed_to_terms' => $request->has('agreed_to_terms'),
            'is_verified' => true,
            'employee_number' => $request->employee_number,
            'y_business_name' => $request->y_business_name,
            'y_brand_name' => $request->y_brand_name,
            'y_describe_business' => $request->y_describe_business,
            'y_business_address' => $request->y_business_address,
            'y_business_country' => $request->y_business_country,
            'y_business_state' => $request->y_business_state,
            'y_business_city' => $request->y_business_city,
            'y_pitch_deck' => $pitchDeckPathY,
            'y_zipcode' => $request->y_zipcode,
            'y_type_industries' => $request->y_type_industries,
            'y_own_fund' => $request->y_own_fund,
            'founder_number' => $request->founder_number,
            'y_loan' => $request->y_loan,
            'tax_registration_number' => $request->tax_registration_number,
            'business_revenue1' => $request->business_revenue1,
            'business_revenue2' => $request->business_revenue2,
            'business_revenue3' => $request->business_revenue3,
            'y_invested_amount' => $request->y_invested_amount,
            'y_business_logo' => $businessLogoPathY,
            'business_email' => $request->business_email,
            'y_product_photos' => json_encode($productPhotosPathsY),
            'business_year' => $request->business_year,
        ];

        // Log the update data before filtering
        Log::info('Update data before filtering:', $updateData);

        // Remove null values to avoid overwriting existing data with null
        $updateData = array_filter($updateData, function ($value) {
            return !is_null($value);
        });

        // Log the update data after filtering
        Log::info('Update data after filtering:', $updateData);

        try {
            $result = $entrepreneur->update($updateData);
            Log::info('Entrepreneur update attempt:', [
                'success' => $result,
                'data' => $updateData,
                'video_upload' => $updateData['video_upload'] ?? 'Not set'
            ]);

            if ($result) {
                // Refresh the model to get the latest data from the database
                $entrepreneur->refresh();
                Log::info('Entrepreneur updated successfully:', [
                    'id' => $entrepreneur->id,
                    'pin_code' => $entrepreneur->pin_code,
                    'video_upload' => $entrepreneur->video_upload
                ]);
            } else {
                Log::warning('Entrepreneur update failed:', ['id' => $entrepreneur->id]);
                return redirect()->back()->with('error', 'Failed to update entrepreneur profile.');
            }
        } catch (\Exception $e) {
            Log::error('Update exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An error occurred while updating the profile.');
        }

        // Redirect with fresh data
        $updatedEntrepreneur = Entrepreneur::where('user_id', $user->id)->first();
        return redirect()->route('entrepreneur.edit')->with('success', 'Entrepreneur profile updated successfully!')->with('entrepreneur', $updatedEntrepreneur);
    }

    private function deleteOldVideo($videoUrl)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $path = str_replace('https://futuretaikun.b-cdn.net/', '', $videoUrl);
            $response = $client->delete("https://storage.bunnycdn.com/futuretaikun/{$path}", [
                'headers' => [
                    'AccessKey' => env('BUNNYCDN_API_KEY'),
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                Log::info('Old video deleted from BunnyCDN:', ['url' => $videoUrl]);
            } else {
                Log::warning('Failed to delete old video from BunnyCDN:', ['url' => $videoUrl, 'status' => $response->getStatusCode()]);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting old video from BunnyCDN:', ['url' => $videoUrl, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete old video from BunnyCDN
     */
    // private function deleteOldVideo($videoUrl)
    // {
    //     try {
    //         $client = new \GuzzleHttp\Client();
    //         $path = str_replace('https://futuretaikun.b-cdn.net/', '', $videoUrl);
    //         $response = $client->delete("https://storage.bunnycdn.com/futuretaikun/{$path}", [
    //             'headers' => [
    //                 'AccessKey' => env('BUNNYCDN_API_KEY'),
    //             ],
    //         ]);

    //         if ($response->getStatusCode() === 200) {
    //             Log::info('Old video deleted from BunnyCDN:', ['url' => $videoUrl]);
    //         } else {
    //             Log::warning('Failed to delete old video from BunnyCDN:', ['url' => $videoUrl, 'status' => $response->getStatusCode()]);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error deleting old video from BunnyCDN:', ['url' => $videoUrl, 'message' => $e->getMessage()]);
    //     }
    // }
    public function reject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'entrepreneur_id' => 'required|exists:entrepreneurs,id',
                'reason' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
            }

            $user = Auth::guard('web')->user();
            if (!$user || $user->role !== 'admin') {
                return response()->json(['success' => false, 'message' => 'Only admins can reject entrepreneurs.'], 403);
            }

            // No need to query Investor model for admin
            $entrepreneur = Entrepreneur::findOrFail($request->entrepreneur_id);

            // Check if this admin has already rejected this entrepreneur
            $existingRejection = InvestorRejectEntrepreneur::where('user_id', $user->id) // Changed from investor_id to user_id
                ->where('entrepreneur_id', $request->entrepreneur_id)
                ->first();
            if ($existingRejection) {
                return response()->json(['success' => false, 'message' => 'You have already rejected this entrepreneur.'], 400);
            }

            // Create a new rejection record
            InvestorRejectEntrepreneur::create([
                'user_id' => $user->id, // Changed from investor_id to user_id
                'entrepreneur_id' => $request->entrepreneur_id,
                'reason' => $request->reason,
            ]);

            // Send email to the entrepreneur
            // Mail::to($entrepreneur->email)
            //     ->cc(['info@futuretaikun.com'])
            //     ->send(new InterestedNotification(Auth::user()->name));

            try {
                Mail::to($entrepreneur->user->email)->send(new EntrepreneurRejected($entrepreneur, $request->reason));
            } catch (\Exception $e) {
                Log::error('Failed to send rejection email: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Entrepreneur rejected successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in reject: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An internal error occurred. Please try again later.'], 500);
        }
    }

    // public function markInterested(Request $request)
    // {
    //     $entrepreneur = Entrepreneur::findOrFail($request->id);
    //     $entrepreneur->interested = 1;
    //     $entrepreneur->save();

    //     // Send email
    //     Mail::to($entrepreneur->email)->send(new InterestedNotification(Auth::user()->name));

    //     return response()->json(['success' => true]);
    // }

    public function myCompanies()
    {
        $user = Auth::user();
        $entrepreneur = Entrepreneur::where('user_id', $user->id)->first();

        if (!$entrepreneur) {
            return redirect()->route('entrepreneur.profile')->withErrors(['error' => 'Please complete your entrepreneur profile first.']);
        }

        // Get companies using entrepreneur's ID
        $companies = EntrepreneurCompany::where('entrepreneurs_id', $entrepreneur->id)->get();

        return view('entrepreneur.my-companies', compact('companies'));
    }

    public function storeCompany(Request $request)
    {

        log::info('storecomapny', $request->all());
        $request->validate([
            'company_name' => 'required|string|max:255',
            'more_market_capital' => 'required|numeric|min:0',
            'more_your_stake' => 'required|numeric|between:0,100',
            'more_stake_funding' => 'required|numeric|min:0',
        ]);
        $entrepreneur = Entrepreneur::where('user_id', Auth::id())->first();

        if (!$entrepreneur) {
            return redirect()->back()->withErrors(['error' => 'Entrepreneur profile not found. Please complete your profile first.']);
        }
        $company = EntrepreneurCompany::create([
            'entrepreneurs_id' => $entrepreneur->id,
            'company_name' => $request->company_name,
            'more_market_capital' => $request->more_market_capital,
            'more_your_stake' => $request->more_your_stake,
            'more_stake_funding' => $request->more_stake_funding,
        ]);


        // Send email notification to admin
        Mail::to('info@futuretaikun.com')->send(new NewCompanyNotification($company, $entrepreneur));

        return redirect()->route('my.companies')->with('success', 'Company added successfully!');
    }
    public function updateCompany(Request $request, $id)
    {
        \Log::info('UpdateCompany Request Data:', $request->all());

        $company = EntrepreneurCompany::findOrFail($id);
        if ($company->entrepreneurs_id !== Auth::id()) {
            \Log::warning('Unauthorized attempt to update company', ['company_id' => $id, 'user_id' => Auth::id()]);
            abort(403, 'Unauthorized action.');
        }

        try {
            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'more_market_capital' => 'required|numeric|min:0',
                'more_your_stake' => 'required|numeric|between:0,100',
                'more_stake_funding' => 'required|numeric|min:0',
            ]);

            \Log::info('Validated Data:', $validated);

            // Calculate expected valuation server-side
            $expectedValuation = ($validated['more_your_stake'] > 0)
                ? ($validated['more_market_capital'] / $validated['more_your_stake']) * 100
                : 0;

            \Log::info('Server-side Valuation:', ['expected' => $expectedValuation, 'received' => $validated['more_stake_funding']]);

            // Override client-side valuation with server-side calculation
            $validated['more_stake_funding'] = $expectedValuation;

            $data = [
                'company_name' => $validated['company_name'],
                'more_market_capital' => floatval($validated['more_market_capital']),
                'more_your_stake' => floatval($validated['more_your_stake']),
                'more_stake_funding' => floatval($validated['more_stake_funding']),
            ];

            \Log::info('Data to Update:', $data);

            $updated = $company->update($data);

            \Log::info('Update Status:', ['updated' => $updated, 'company_id' => $company->id]);

            if (!$updated) {
                \Log::error('Failed to update company', ['company_id' => $company->id, 'data' => $data]);
                return redirect()->back()->withErrors(['error' => 'Failed to update company. Please try again.'])->withInput();
            }

            return redirect()->route('my.companies')->with('success', 'Company updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Unexpected error in updateCompany', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.'])->withInput();
        }
    }

    public function destroy($id)
    {
        $entrepreneur = Entrepreneur::findOrFail($id);
        $entrepreneur->delete();

        return response()->json(['message' => 'Entrepreneur deleted successfully'], 200);
    }

    public function getEntrepreneurCompanies($id)
    {
        $companies = EntrepreneurCompany::where('entrepreneurs_id', $id)->get();
        return response()->json($companies);
    }

    public function storeRemark(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'entrepreneur_id' => 'required|exists:entrepreneurs,id',
                'remark_market_capital' => 'required|numeric|min:0',
                'remark_your_stake' => 'required|numeric|min:0|max:100',
                'remark_company_value' => 'required|numeric|min:0',
                'remark_reason' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
            }

            $user = Auth::guard('web')->user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            // Check if the user is an investor and verified
            if ($user->role !== 'investor') {
                return response()->json(['success' => false, 'message' => 'Only investors can submit remarks.'], 403);
            }

            // Get the investor record (assuming user_id links to investors table)
            $investor = Investor::where('user_id', $user->id)->first();
            if (!$investor) {
                return response()->json(['success' => false, 'message' => 'You must be a verified investor to submit remarks.'], 403);
            }

            $entrepreneur = Entrepreneur::findOrFail($request->entrepreneur_id);
            $investorId = $investor->id; // Use the investor's id from the investors table
            Log::info('Investor ID for remark: ' . $investorId);

            // Check if the investor has already submitted a remark
            $existingRemark = RemarkEntrepreneur::where('investor_id', $investorId)
                ->where('entrepreneur_id', $request->entrepreneur_id)
                ->first();
            if ($existingRemark) {
                return response()->json(['success' => false, 'message' => 'You have already submitted a remark for this entrepreneur.'], 422);
            }

            // Create a new remark record
            $remark = RemarkEntrepreneur::create([
                'investor_id' => $investorId,
                'entrepreneur_id' => $request->entrepreneur_id,
                'remark_market_capital' => $request->remark_market_capital,
                'remark_your_stake' => $request->remark_your_stake,
                'remark_company_value' => $request->remark_company_value,
                'remark_reason' => $request->remark_reason,
            ]);

            // Send email to entrepreneur
            Mail::to($entrepreneur->email)->cc('info@futuretaikun.com')->send(new RemarkNotification($entrepreneur, $request->all()));

            return response()->json(['success' => true, 'message' => 'Remark submitted successfully']);
        } catch (\Exception $e) {
            Log::error('Error in storeRemark: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An internal error occurred. Please try again later.'], 500);
        }
    }

    // In your controller
    public function downloadCSV(Request $request)
    {
        $entrepreneurs = Entrepreneur::all(); // your query with ->get()

        $filename = 'entrepreneurs_data_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($entrepreneurs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Serial Number', 'Full Name', 'Phone Number', 'Email', 'Country', 'Business Name']);

            foreach ($entrepreneurs as $index => $entrepreneur) {
                fputcsv($file, [
                    $index + 1,
                    $entrepreneur->full_name,
                    $entrepreneur->phone_number,
                    $entrepreneur->email,
                    $entrepreneur->country,
                    $entrepreneur->register_business == 1 ? $entrepreneur->y_business_name : $entrepreneur->business_name
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function updatePitchVideo(Request $request)
    {
        $request->validate([
            'entrepreneur_id' => 'required|exists:entrepreneurs,id',
            'pitch_video' => 'required|url'
        ]);

        try {
            $entrepreneur = Entrepreneur::find($request->entrepreneur_id);
            $entrepreneur->pitch_video = $request->pitch_video;
            $entrepreneur->save();

            return response()->json(['status' => 'success', 'message' => 'Pitch video URL updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to update pitch video.']);
        }
    }
    // public function saveStepData(Request $request)
    // {
    //     Log::info('Entering saveStepData', [
    //         'method' => $request->method(),
    //         'url' => $request->fullUrl(),
    //         'headers' => $request->headers->all(),
    //     ]);

    //     try {
    //         Log::info('saveStepData request received:', [
    //             'data' => $request->all(),
    //             'files' => $request->file()
    //         ]);
    //         $validated = $request->validate([
    //             'user_id' => 'required|exists:users,id',
    //             'step' => 'required|integer|in:2,3,4',
    //         ]);

    //         $userId = $request->input('user_id');
    //         $step = $request->input('step');
    //         $data = $request->all();

    //         unset($data['user_id'], $data['step'], $data['_token']);

    //         $validationRules = [];
    //         if ($step == 2) {
    //             $validationRules = [
    //                 'full_name' => 'nullable|string|max:255',
    //                 'email' => 'nullable|email|unique:dummyentrepreneurs,email,' . $userId . ',user_id',
    //                 'phone_number' => 'nullable|string',
    //                 'country_code' => 'nullable|string|max:10',
    //                 'country' => 'nullable|string',
    //                 'state' => 'nullable|string',
    //                 'city' => 'nullable|string',
    //                 'qualification' => 'nullable|string',
    //                 'dob' => 'nullable|string',
    //                 'age' => 'nullable|string',
    //                 'current_address' => 'nullable|string',
    //                 'pin_code' => 'nullable',
    //                 'linkedin_profile' => 'nullable|string',
    //             ];
    //         } elseif ($step == 3) {
    //             $validationRules = [
    //                 'register_business' => 'nullable|in:0,1',
    //             ];

    //             if ($request->input('register_business') == '0') {
    //                 $validationRules = array_merge($validationRules, [
    //                     'business_name' => 'nullable|string|max:255',
    //                     'brand_name' => 'nullable|string|max:255',
    //                     'business_address' => 'nullable|string',
    //                     'business_describe' => 'nullable|string',
    //                     'website_links' => 'nullable|string',
    //                     'industry' => 'nullable|string',
    //                     'business_country' => 'nullable|string',
    //                     'business_state' => 'nullable|string',
    //                     'business_city' => 'nullable|string',
    //                     'market_capital' => 'nullable|numeric|min:0',
    //                     'stake_funding' => 'nullable|numeric|min:0',
    //                     'your_stake' => 'nullable|numeric|min:0|max:100',
    //                     'business_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    //                     'product_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
    //                     'own_fund' => 'nullable|numeric|min:0',
    //                     'loan' => 'nullable|numeric|min:0',
    //                     'invested_amount' => 'nullable|numeric|min:0',
    //                     'pitch_deck' => 'nullable|file|mimes:pdf|max:10240',
    //                 ]);
    //             } else {
    //                 $validationRules = array_merge($validationRules, [
    //                     'y_business_name' => 'nullable|string|max:255',
    //                     'y_brand_name' => 'nullable|string|max:255',
    //                     'y_describe_business' => 'nullable|string',
    //                     'y_business_address' => 'nullable|string',
    //                     'y_business_country' => 'nullable|string',
    //                     'y_business_state' => 'nullable|string',
    //                     'y_business_city' => 'nullable|string',
    //                     'y_zipcode' => 'nullable',
    //                     'y_type_industries' => 'nullable|string',
    //                     'y_own_fund' => 'nullable|numeric|min:0',
    //                     'y_loan' => 'nullable|numeric|min:0',
    //                     'y_invested_amount' => 'nullable|numeric|min:0',
    //                     'business_mobile' => 'nullable|string|regex:/^\d{10}$/',
    //                     'business_email' => 'nullable|email',
    //                     'business_year' => 'nullable|string',
    //                     'y_market_capital' => 'nullable',
    //                     'y_stake_funding' => 'nullable',
    //                     'y_your_stake' => 'nullable',
    //                     'business_year_count' => 'nullable',
    //                     'registration_type_of_entity' => 'nullable|string',
    //                     'tax_registration_number' => 'nullable|string',
    //                     'founder_number' => 'nullable|integer|min:1|max:20',
    //                     'employee_number' => 'nullable|integer|min:1|max:2000',
    //                     'business_revenue1' => 'nullable|numeric|min:0',
    //                     'business_revenue2' => 'nullable|numeric|min:0',
    //                     'business_revenue3' => 'nullable|numeric|min:0',
    //                     'y_business_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    //                     'y_product_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
    //                     'y_pitch_deck' => 'nullable|file|mimes:pdf|max:10240',
    //                     'website_links' => 'nullable|string',
    //                 ]);
    //             }
    //         } elseif ($step == 4) {
    //             $validationRules = [
    //                 'video_upload' => 'nullable|file|mimes:mp4,mov,avi,webm|max:102400',
    //                 'agreed_to_terms' => 'nullable|accepted',
    //             ];
    //         }

    //         $validatedData = $request->validate($validationRules);

    //         // Handle file uploads
    //         if ($request->hasFile('photo')) {
    //             $data['photo'] = $request->file('photo')->store('photos', 'public');
    //         }
    //         if ($request->hasFile('business_logo')) {
    //             $data['business_logo'] = $request->file('business_logo')->store('business_logo', 'public');
    //         }
    //         if ($request->hasFile('y_business_logo')) {
    //             $data['y_business_logo'] = $request->file('y_business_logo')->store('logos', 'public');
    //         }
    //         if ($request->hasFile('pitch_deck')) {
    //             $data['pitch_deck'] = $request->file('pitch_deck')->store('pitch_decks', 'public');
    //         }
    //         if ($request->hasFile('y_pitch_deck')) {
    //             $data['y_pitch_deck'] = $request->file('y_pitch_deck')->store('pitch_decks', 'public');
    //         }
    //         if ($request->hasFile('product_photos')) {
    //             $productPhotos = [];
    //             foreach ($request->file('product_photos') as $index => $photo) {
    //                 if ($photo && $photo->isValid()) {
    //                     $photoName = time() . '_photo_' . $index . '_' . $photo->getClientOriginalName();
    //                     $productPhotos[] = $photo->storeAs('product_photos', $photoName, 'public');
    //                 }
    //             }
    //             $data['product_photos'] = json_encode($productPhotos);
    //         }
    //         if ($request->hasFile('y_product_photos')) {
    //             $yProductPhotos = [];
    //             foreach ($request->file('y_product_photos') as $index => $photo) {
    //                 if ($photo && $photo->isValid()) {
    //                     $photoName = time() . '_photo_' . $index . '_' . $photo->getClientOriginalName();
    //                     $yProductPhotos[] = $photo->storeAs('y_product_photos', $photoName, 'public');
    //                 }
    //             }
    //             $data['y_product_photos'] = json_encode($yProductPhotos);
    //         }
    //         if ($request->hasFile('video_upload')) {
    //             $video = $request->file('video_upload');
    //             $videoName = time() . '_video_' . $video->getClientOriginalName();
    //             $videoPath = 'video/' . $videoName;

    //             try {
    //                 $client = new Client();
    //                 $response = $client->put("https://storage.bunnycdn.com/futuretaikun/{$videoPath}", [
    //                     'headers' => [
    //                         'AccessKey' => env('BUNNYCDN_API_KEY'),
    //                         'Content-Type' => $video->getClientMimeType(),
    //                     ],
    //                     'body' => fopen($video->getRealPath(), 'r'),
    //                 ]);

    //                 if ($response->getStatusCode() === 201 || $response->getStatusCode() === 200) {
    //                     $data['video_upload'] = "https://futuretaikun.b-cdn.net/{$videoPath}";
    //                     Log::info('Video uploaded to BunnyCDN:', ['url' => $data['video_upload']]);
    //                 } else {
    //                     Log::error('Failed to upload video to BunnyCDN', ['status' => $response->getStatusCode()]);
    //                     return response()->json(['success' => false, 'message' => 'Failed to upload video'], 400);
    //                 }
    //             } catch (\Exception $e) {
    //                 Log::error('BunnyCDN upload error:', ['message' => $e->getMessage()]);
    //                 return response()->json(['success' => false, 'message' => 'Error uploading video'], 400);
    //             }
    //         }

    //         if (isset($data['website_links']) && $data['website_links']) {
    //             $data['website_links'] = 'https://' . parse_url($data['website_links'], PHP_URL_HOST);
    //         }
    //         if ($step == 3 && isset($data['company_name']) && is_array($data['company_name'])) {
    //             $companyNames = $data['company_name'] ?? [];
    //             $marketCapitals = $data['more_market_capital'] ?? [];
    //             $stakes = $data['more_your_stake'] ?? [];
    //             $valuations = $data['more_stake_funding'] ?? [];
    //             unset($data['company_name'], $data['more_market_capital'], $data['more_your_stake'], $data['more_stake_funding']);

    //             // Delete existing company records for this user
    //             \App\Models\EntrepreneurCompany::where('entrepreneurs_id', $userId)->delete();

    //             // Create new company records
    //             foreach ($companyNames as $index => $companyName) {
    //                 if (!empty($companyName)) {
    //                     \App\Models\EntrepreneurCompany::create([
    //                         'entrepreneurs_id' => $userId,
    //                         'company_name' => $companyName,
    //                         'more_market_capital' => isset($marketCapitals[$index]) ? (float) $marketCapitals[$index] : null,
    //                         'more_your_stake' => isset($stakes[$index]) ? (float) $stakes[$index] : null,
    //                         'more_stake_funding' => isset($valuations[$index]) ? (float) $valuations[$index] : null,
    //                     ]);
    //                 }
    //             }
    //         }

    //         Log::info('Data to be saved for user_id ' . $userId . ' in step ' . $step . ':', $data);

    //         $entrepreneur = DummyEntrepreneur::updateOrCreate(
    //             ['user_id' => $userId],
    //             $data
    //         );

    //         Log::info('Data saved successfully for user_id ' . $userId . ' in step ' . $step, ['record' => $entrepreneur->toArray()]);

    //         return response()->json(['success' => true, 'message' => 'Step data saved successfully']);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         Log::error('Validation failed in saveStepData:', ['errors' => $e->errors(), 'data' => $request->all()]);
    //         return response()->json(['success' => false, 'errors' => $e->errors()], 422);
    //     } catch (\Exception $e) {
    //         Log::error('Error in saveStepData:', [
    //             'message' => $e->getMessage(),
    //             'line' => $e->getLine(),
    //             'file' => $e->getFile(),
    //             'data' => $request->all(),
    //         ]);
    //         return response()->json(['success' => false, 'message' => 'An error occurred while saving the data'], 500);
    //     }
    // }
    public function saveStepData(Request $request)
    {
        Log::info('Entering saveStepData', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'headers' => $request->headers->all(),
        ]);

        try {
            Log::info('saveStepData request received:', [
                'data' => $request->all(),
                'files' => $request->file()
            ]);

            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'step' => 'required|integer|in:2,3,4',
            ]);

            $userId = $request->input('user_id');
            $step = $request->input('step');
            $data = $request->all();
            unset($data['user_id'], $data['step'], $data['_token']);

            // Step-specific validation (unchanged)
            $validationRules = [];
            if ($step == 2) {
                $validationRules = [
                    'full_name' => 'nullable|string|max:255',
                    'email' => 'nullable|email|unique:dummyentrepreneurs,email,' . $userId . ',user_id',
                    'phone_number' => 'nullable|string',
                    'country_code' => 'nullable|string|max:10',
                    'country' => 'nullable|string',
                    'state' => 'nullable|string',
                    'city' => 'nullable|string',
                    'qualification' => 'nullable|string',
                    'dob' => 'nullable|string',
                    'age' => 'nullable|string',
                    'current_address' => 'nullable|string',
                    'pin_code' => 'nullable',
                    'linkedin_profile' => 'nullable|string',
                ];
            } elseif ($step == 3) {
                $validationRules = [
                    'register_business' => 'nullable|in:0,1',
                ];
                if ($request->input('register_business') == '0') {
                    $validationRules = array_merge($validationRules, [
                        'business_name' => 'nullable|string|max:255',
                        'brand_name' => 'nullable|string|max:255',
                        'business_address' => 'nullable|string',
                        'business_describe' => 'nullable|string',
                        'website_links' => 'nullable|string',
                        'industry' => 'nullable|string',
                        'business_country' => 'nullable|string',
                        'business_state' => 'nullable|string',
                        'business_city' => 'nullable|string',
                        'market_capital' => 'nullable|numeric|min:0',
                        'stake_funding' => 'nullable|numeric|min:0',
                        'your_stake' => 'nullable|numeric|min:0|max:100',
                        'business_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                        'product_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
                        'own_fund' => 'nullable|numeric|min:0',
                        'loan' => 'nullable|numeric|min:0',
                        'invested_amount' => 'nullable|numeric|min:0',
                        'pitch_deck' => 'nullable|file|mimes:pdf|max:10240',
                    ]);
                } else {
                    $validationRules = array_merge($validationRules, [
                        'y_business_name' => 'nullable|string|max:255',
                        'y_brand_name' => 'nullable|string|max:255',
                        'y_describe_business' => 'nullable|string',
                        'y_business_address' => 'nullable|string',
                        'y_business_country' => 'nullable|string',
                        'y_business_state' => 'nullable|string',
                        'y_business_city' => 'nullable|string',
                        'y_zipcode' => 'nullable',
                        'y_type_industries' => 'nullable|string',
                        'y_own_fund' => 'nullable|numeric|min:0',
                        'y_loan' => 'nullable|numeric|min:0',
                        'y_invested_amount' => 'nullable|numeric|min:0',
                        'business_mobile' => 'nullable|string|regex:/^\d{10}$/',
                        'business_email' => 'nullable|email',
                        'business_year' => 'nullable|string',
                        'registration_type_of_entity' => 'nullable|string',
                        'tax_registration_number' => 'nullable|string',
                        'founder_number' => 'nullable|integer|min:1|max:20',
                        'employee_number' => 'nullable|integer|min:1|max:2000',
                        'business_revenue1' => 'nullable|numeric|min:0',
                        'business_revenue2' => 'nullable|numeric|min:0',
                        'business_revenue3' => 'nullable|numeric|min:0',
                        'y_business_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                        'y_product_photos.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
                        'y_pitch_deck' => 'nullable|file|mimes:pdf|max:10240',
                        'website_links' => 'nullable|string',
                    ]);
                }
            } elseif ($step == 4) {
                $validationRules = [
                    'video_upload' => 'nullable|file|mimes:mp4,mov,avi,webm',
                    'agreed_to_terms' => 'nullable|accepted',
                ];
            }

            $validatedData = $request->validate($validationRules);

            // Handle file uploads (unchanged)
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('photos', 'public');
            }
            if ($request->hasFile('business_logo')) {
                $data['business_logo'] = $request->file('business_logo')->store('business_logo', 'public');
            }
            if ($request->hasFile('y_business_logo')) {
                $data['y_business_logo'] = $request->file('y_business_logo')->store('logos', 'public');
            }
            if ($request->hasFile('pitch_deck')) {
                $data['pitch_deck'] = $request->file('pitch_deck')->store('pitch_decks', 'public');
            }
            if ($request->hasFile('y_pitch_deck')) {
                $data['y_pitch_deck'] = $request->file('y_pitch_deck')->store('pitch_decks', 'public');
            }
            if ($request->hasFile('product_photos')) {
                $productPhotos = [];
                foreach ($request->file('product_photos') as $index => $photo) {
                    if ($photo && $photo->isValid()) {
                        $photoName = time() . '_photo_' . $index . '_' . $photo->getClientOriginalName();
                        $productPhotos[] = $photo->storeAs('product_photos', $photoName, 'public');
                    }
                }
                $data['product_photos'] = json_encode($productPhotos);
            }
            if ($request->hasFile('y_product_photos')) {
                $yProductPhotos = [];
                foreach ($request->file('y_product_photos') as $index => $photo) {
                    if ($photo && $photo->isValid()) {
                        $photoName = time() . '_photo_' . $index . '_' . $photo->getClientOriginalName();
                        $yProductPhotos[] = $photo->storeAs('y_product_photos', $photoName, 'public');
                    }
                }
                $data['y_product_photos'] = json_encode($yProductPhotos);
            }
            if ($request->hasFile('video_upload')) {
                $video = $request->file('video_upload');
                $videoName = time() . '_video_' . $video->getClientOriginalName();
                $videoPath = 'video/' . $videoName;

                try {
                    $client = new \GuzzleHttp\Client(); // Ensure GuzzleHttp is installed
                    $response = $client->put("https://storage.bunnycdn.com/futuretaikun/{$videoPath}", [
                        'headers' => [
                            'AccessKey' => env('BUNNYCDN_API_KEY'),
                            'Content-Type' => $video->getClientMimeType(),
                        ],
                        'body' => fopen($video->getRealPath(), 'r'),
                    ]);

                    if ($response->getStatusCode() === 201 || $response->getStatusCode() === 200) {
                        $data['video_upload'] = "https://futuretaikun.b-cdn.net/{$videoPath}";
                        Log::info('Video uploaded to BunnyCDN:', ['url' => $data['video_upload']]);
                    } else {
                        Log::error('Failed to upload video to BunnyCDN', ['status' => $response->getStatusCode()]);
                        return response()->json(['success' => false, 'message' => 'Failed to upload video'], 400);
                    }
                } catch (\Exception $e) {
                    Log::error('BunnyCDN upload error:', ['message' => $e->getMessage()]);
                    return response()->json(['success' => false, 'message' => 'Error uploading video'], 400);
                }
            }

            // Handle website_links
            if (isset($data['website_links']) && $data['website_links']) {
                $data['website_links'] = 'https://' . parse_url($data['website_links'], PHP_URL_HOST);
            }

            // Update or create record in dummyentrepreneurs
            $entrepreneur = DummyEntrepreneur::updateOrCreate(
                ['user_id' => $userId],
                $data
            );

            // Update completed_steps
            $completedSteps = $entrepreneur->completed_steps ? json_decode($entrepreneur->completed_steps, true) : [];
            if (!in_array($step, $completedSteps)) {
                $completedSteps[] = $step;
                $entrepreneur->completed_steps = json_encode($completedSteps);
                $entrepreneur->save();
            }

            Log::info('Data saved successfully for user_id ' . $userId . ' in step ' . $step, ['record' => $entrepreneur->toArray()]);
            return response()->json(['success' => true, 'message' => 'Step data saved successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed in saveStepData:', ['errors' => $e->errors(), 'data' => $request->all()]);
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error in saveStepData:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'data' => $request->all(),
            ]);
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data'], 500);
        }
    }
    public function getStepData(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                Log::warning('User not authenticated for getStepData');
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            $entrepreneur = DummyEntrepreneur::where('user_id', $user->id)->first();
            if (!$entrepreneur) {
                Log::info('No data found in dummyentrepreneurs for user_id: ' . $user->id);
                return response()->json(['message' => 'No saved data found', 'data' => [], 'completed_steps' => []], 200);
            }

            $apiKey = env('COUNTRY_STATE_CITY_API_KEY', 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==');
            $baseUrl = 'https://api.countrystatecity.in/v1';

            // Helper function to convert country name to iso2
            $getCountryIso2 = function ($countryName) use ($apiKey, $baseUrl) {
                if (!$countryName || preg_match('/^[A-Z]{2}$/', $countryName)) {
                    return $countryName; // Already an iso2 code or empty
                }
                try {
                    $response = Http::withHeaders(['X-CSCAPI-KEY' => $apiKey])->get("{$baseUrl}/countries");
                    if ($response->successful()) {
                        $countries = $response->json();
                        $country = collect($countries)->firstWhere('name', $countryName);
                        return $country ? $country['iso2'] : $countryName;
                    }
                } catch (\Exception $e) {
                    Log::error("Error fetching country iso2 for {$countryName}: {$e->getMessage()}");
                }
                return $countryName; // Fallback to original value if API fails
            };

            // Helper function to convert state name to iso2
            $getStateIso2 = function ($countryIso2, $stateName) use ($apiKey, $baseUrl) {
                if (!$countryIso2 || !$stateName || preg_match('/^[A-Z]{2}$/', $stateName)) {
                    return $stateName; // Already an iso2 code, no country, or empty
                }
                try {
                    $response = Http::withHeaders(['X-CSCAPI-KEY' => $apiKey])->get("{$baseUrl}/countries/{$countryIso2}/states");
                    if ($response->successful()) {
                        $states = $response->json();
                        $state = collect($states)->firstWhere('name', $stateName);
                        return $state ? $state['iso2'] : $stateName;
                    }
                } catch (\Exception $e) {
                    Log::error("Error fetching state iso2 for {$stateName}: {$e->getMessage()}");
                }
                return $stateName; // Fallback to original value if API fails
            };

            $stepData = [
                'step2' => [],
                'step3' => [],
                'step4' => [],
            ];

            $step2Fields = [
                'full_name',
                'email',
                'phone_number',
                'country_code',
                'country',
                'state',
                'city',
                'qualification',
                'dob',
                'age',
                'current_address',
                'pin_code',
                'linkedin_profile',
                'photo'
            ];
            foreach ($step2Fields as $field) {
                if (!is_null($entrepreneur->$field)) {
                    $stepData['step2'][$field] = $entrepreneur->$field;
                }
            }

            $step3FieldsNo = [
                'business_name',
                'brand_name',
                'business_address',
                'business_describe',
                'website_links',
                'industry',
                'business_country',
                'business_state',
                'business_city',
                'market_capital',
                'stake_funding',
                'your_stake',
                'business_logo',
                'product_photos',
                'own_fund',
                'loan',
                'invested_amount',
                'pitch_deck'
            ];
            $step3FieldsYes = [
                'y_business_name',
                'y_brand_name',
                'y_describe_business',
                'y_business_address',
                'y_business_country',
                'y_business_state',
                'y_business_city',
                'y_zipcode',
                'y_type_industries',
                'y_own_fund',
                'y_loan',
                'y_invested_amount',
                'business_mobile',
                'business_email',
                'business_year',
                'registration_type_of_entity',
                'tax_registration_number',
                'founder_number',
                'employee_number',
                'business_revenue1',
                'business_revenue2',
                'business_revenue3',
                'y_business_logo',
                'y_product_photos',
                'y_pitch_deck',
                'website_links'
            ];

            if ($entrepreneur->register_business === '0') {
                foreach ($step3FieldsNo as $field) {
                    if (!is_null($entrepreneur->$field)) {
                        if ($field === 'business_country') {
                            $stepData['step3'][$field] = $getCountryIso2($entrepreneur->$field);
                        } elseif ($field === 'business_state') {
                            $countryIso2 = $getCountryIso2($entrepreneur->business_country);
                            $stepData['step3'][$field] = $getStateIso2($countryIso2, $entrepreneur->$field);
                        } else {
                            $stepData['step3'][$field] = $entrepreneur->$field;
                        }
                    }
                }
            } elseif ($entrepreneur->register_business === '1') {
                foreach ($step3FieldsYes as $field) {
                    if (!is_null($entrepreneur->$field)) {
                        if ($field === 'y_business_country') {
                            $stepData['step3'][$field] = $getCountryIso2($entrepreneur->$field);
                        } elseif ($field === 'y_business_state') {
                            $countryIso2 = $getCountryIso2($entrepreneur->y_business_country);
                            $stepData['step3'][$field] = $getStateIso2($countryIso2, $entrepreneur->$field);
                        } else {
                            $stepData['step3'][$field] = $entrepreneur->$field;
                        }
                    }
                }
                $stepData['step3']['register_business'] = '1';
            }

            $step4Fields = ['video_upload', 'agreed_to_terms'];
            foreach ($step4Fields as $field) {
                if (!is_null($entrepreneur->$field)) {
                    $stepData['step4'][$field] = $entrepreneur->$field;
                }
            }

            $completedSteps = $entrepreneur->completed_steps ? json_decode($entrepreneur->completed_steps, true) : [];

            Log::info('Retrieved step data for user_id: ' . $user->id, [
                'data' => $stepData,
                'completed_steps' => $completedSteps
            ]);
            return response()->json([
                'message' => 'Step data retrieved successfully',
                'data' => $stepData,
                'completed_steps' => $completedSteps
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving step data: ' . $e->getMessage());
            return response()->json(['message' => 'Error retrieving step data'], 500);
        }
    }
    public function updateProductLogo(Request $request)
    {
        // Log the raw input for debugging
        Log::info('Update Product Logo Request (Raw):', ['input' => $request->all()]);

        // Validate request
        $validator = \Validator::make($request->all(), [
            'entrepreneur_id' => 'required|exists:entrepreneurs,id',
            'business_logo_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'y_business_logo_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'product_photos_admin.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'y_product_photos_admin.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'business_logo_admin.image' => 'The business logo must be an image.',
            'business_logo_admin.mimes' => 'The business logo must be a file of type: jpeg, png, jpg, gif.',
            'product_photos_admin.*.image' => 'The product photos must be images.',
            'product_photos_admin.*.mimes' => 'The product photos must be files of type: jpeg, png, jpg, gif.',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', ['errors' => $validator->errors()->all()]);
            return response()->json(['status' => 'error', 'message' => 'Validation failed: ' . implode(', ', $validator->errors()->all())], 422);
        }
        try {
            $entrepreneur = Entrepreneur::find($request->entrepreneur_id);
            if (!$entrepreneur) {
                throw new \Exception('Entrepreneur not found.');
            }

            // Ensure storage directories exist and are writable
            $directories = ['business_logos', 'y_business_logos', 'product_photos', 'y_product_photos'];
            foreach ($directories as $dir) {
                $path = storage_path('app/public/' . $dir);
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                    Log::info('Created directory: ' . $path);
                }
                if (!File::isWritable($path)) {
                    throw new \Exception('Directory ' . $path . ' is not writable.');
                }
            }

            // Handle business logo upload
            if ($request->hasFile('business_logo_admin')) {
                Log::info('Storing business logo: ', ['file' => $request->file('business_logo_admin')->getClientOriginalName()]);
                if ($entrepreneur->business_logo_admin) {
                    Storage::delete('public/' . $entrepreneur->business_logo_admin);
                }
                $path = $request->file('business_logo_admin')->store('business_logos', 'public');
                Log::info('Business logo stored at: ', ['path' => $path]);
                $entrepreneur->business_logo_admin = $path;
            }

            // Handle YouTube business logo
            if ($request->hasFile('y_business_logo_admin')) {
                Log::info('Storing YouTube business logo: ', ['file' => $request->file('y_business_logo_admin')->getClientOriginalName()]);
                if ($entrepreneur->y_business_logo_admin) {
                    Storage::delete('public/' . $entrepreneur->y_business_logo_admin);
                }
                $path = $request->file('y_business_logo_admin')->store('y_business_logos', 'public');
                Log::info('YouTube business logo stored at: ', ['path' => $path]);
                $entrepreneur->y_business_logo_admin = $path;
            }

            // Handle product photos upload
            if ($request->hasFile('product_photos_admin')) {
                Log::info('Storing product photos: ', ['count' => count($request->file('product_photos_admin'))]);
                if ($entrepreneur->product_photos_admin) {
                    $oldPhotos = explode(',', $entrepreneur->product_photos_admin);
                    foreach ($oldPhotos as $photo) {
                        Storage::delete('public/' . $photo);
                    }
                }
                $photos = [];
                foreach ($request->file('product_photos_admin') as $photo) {
                    Log::info('Storing product photo: ', ['file' => $photo->getClientOriginalName()]);
                    $path = $photo->store('product_photos', 'public');
                    Log::info('Product photo stored at: ', ['path' => $path]);
                    $photos[] = $path;
                }
                $entrepreneur->product_photos_admin = implode(',', $photos);
            }

            // Handle YouTube product photos
            if ($request->hasFile('y_product_photos_admin')) {
                Log::info('Storing YouTube product photos: ', ['count' => count($request->file('y_product_photos_admin'))]);
                if ($entrepreneur->y_product_photos_admin) {
                    $oldPhotos = explode(',', $entrepreneur->y_product_photos_admin);
                    foreach ($oldPhotos as $photo) {
                        Storage::delete('public/' . $photo);
                    }
                }
                $photos = [];
                foreach ($request->file('y_product_photos_admin') as $photo) {
                    Log::info('Storing YouTube product photo: ', ['file' => $photo->getClientOriginalName()]);
                    $path = $photo->store('y_product_photos', 'public');
                    Log::info('YouTube product photo stored at: ', ['path' => $path]);
                    $photos[] = $path;
                }
                $entrepreneur->y_product_photos_admin = implode(',', $photos);
            }

            if ($entrepreneur->save()) {
                Log::info('Entrepreneur data saved successfully for ID: ', ['id' => $entrepreneur->id]);
                return response()->json(['status' => 'success', 'message' => 'Product and logo data updated successfully.']);
            } else {
                throw new \Exception('Failed to save entrepreneur data.');
            }
        } catch (\Exception $e) {
            Log::error('Error updating product logo: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['status' => 'error', 'message' => 'Failed to update product and logo data: ' . $e->getMessage()], 500);
        }
    }
}