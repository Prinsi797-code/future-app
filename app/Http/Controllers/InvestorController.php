<?php

namespace App\Http\Controllers;

use App\Mail\InterestedNotification;
use App\Mail\InvestorApprovedMail;
use App\Mail\InvestorNewCompanyNotification;
use App\Mail\NewCompanyNotification;
use App\Mail\SendUserLoginInfoMail;
use App\Models\DummyInvestor;
use App\Models\Entrepreneur;
use App\Models\Interest;
use App\Models\InvestorCompany;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Jobs\CleanupInvestorUser;
use App\Models\Investor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvestorController extends Controller
{
    public function showForm($user_id)
    {
        $user = User::find($user_id);

        if (!$user || ($user->role !== 'investor' && $user->role1 !== 'investor')) {
            return redirect()->route('mobile.form');
        }
        // Fetch saved investor data
        $investo = DummyInvestor::where('user_id', $user_id)->first();
        Log::info('Investor Data in showForm', ['investo' => $investo ? $investo->toArray() : 'null']);
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

        $autoDetectedCountry = $this->detectCountryFromPhone($user->phone_number);

        // Set it to $country to use further
        $country = $autoDetectedCountry;

        // Now use it to get the currency symbol
        $currencySymbol = $this->getCurrencySymbol($country);

        // Auto-detect country from phone number
        // $autoDetectedCountry = $this->detectCountryFromPhone($user->phone_number);

        // // Get currency symbol based on country
        // $currencySymbol = $this->getCurrencySymbol($country);

        $investorTypes = [
            'Angel Investor',
            'Venture Capital',
            'Private Equity',
            'Corporate Investor',
            // 'Government Grant',
            // 'Crowdfunding Platform',
            'Other'
        ];

        // Investment ranges with country-specific currency
        $investmentRanges = $this->getInvestmentRanges($currencySymbol, $country);

        $designations = [
            'FOUNDER',
            'CO-FOUNDER',
            'CHAIRMAN',
            'MANAGING DIRECTOR',
            'CEO',
            'OTHER',
        ];
        $investmentExperince = [
            'Below 1 Years',
            '1 to 5 Years',
            '5 Years and Above'
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

        $startupStages = [
            'New Startup Idea',
            'Established Business'
        ];

        $geographies = [
            'North America',
            'Europe',
            'Asia',
            'Middle East',
            'Africa',
            'South America',
            'Oceania'
        ];

        $qualifications = [
            'Undergraduate',
            'Graduate',
            'Postgraduate',
            'Doctorate'
        ];

        $userEmail = $user->email;

        // return view('investor.form', compact('user', 'userEmail', 'qualifications', 'countries', 'country', 'designations', 'investmentExperince', 'autoDetectedCountry', 'investorTypes', 'investmentRanges', 'industries', 'startupStages', 'geographies', 'investo'));
        return view('investor.form-two', compact('user', 'userEmail', 'qualifications', 'countries', 'country', 'designations', 'investmentExperince', 'autoDetectedCountry', 'investorTypes', 'investmentRanges', 'industries', 'startupStages', 'geographies', 'investo'));
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

    public function edit()
    {
        $user = Auth::user();
        $investor = Investor::where('user_id', $user->id)->first();
        //Log::info('Investor Data first', $investor->toArray());

        if (!$investor) {
            // Log::warning('No investor profile found for user', ['user_id' => $user->id]);
            return redirect()->route('investor.form', ['user_id' => $user->id]);
        }

        // Fetch countries from API for company_country
        $apiKey = 'WmtRc2MzTzhLRnltNGNmSjljT3RqakROckhSOFFQSTZqMXBGbVlNUw==';
        $response = Http::withHeaders(['X-CSCAPI-KEY' => $apiKey])
            ->get('https://api.countrystatecity.in/v1/countries');

        // Log API response
        if ($response->successful()) {
            // Log::info('Countries API response', ['countries' => $response->json()]);
        } else {
            Log::error('Failed to fetch countries from API', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        }

        // Use API response for company_country dropdown
        $countries1 = $response->successful() ? $response->json() : [];

        // Hardcoded countries for other purposes (e.g., phone country codes)
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
        Log::info('Investor Data', $investor->toArray());

        // Log auto-detected country and pre-selection value
        $autoDetectedCountry = $this->detectCountryFromPhone($user->phone_number);
        $preSelectedCountry = old('company_country', $investor->company_country ?? $autoDetectedCountry);
        Log::info('Pre-selection values', [
            'autoDetectedCountry' => $autoDetectedCountry,
            'preSelectedCountry' => $preSelectedCountry,
            'company_country' => $investor->company_country
        ]);

        $investorTypes = [
            'Angel Investor',
            'Venture Capital',
            'Private Equity',
            'Corporate Investor',
            'Other'
        ];

        $designations = [
            'FOUNDER',
            'CO-FOUNDER',
            'CHAIRMAN',
            'MANAGING DIRECTOR',
            'CEO',
            'OTHER',
        ];

        $investmentExperince = [
            'Below 1 Years',
            '1 to 5 Years',
            '5 Years and Above'
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

        $startupStages = [
            'New Startup Idea',
            'Established Business'
        ];

        $geographies = [
            'North America',
            'Europe',
            'Asia',
            'Middle East',
            'Africa',
            'South America',
            'Oceania'
        ];

        $qualifications = [
            'Undergraduate',
            'Graduate',
            'Postgraduate',
            'Doctorate'
        ];

        $country = $autoDetectedCountry;
        $currencySymbol = $this->getCurrencySymbol($country);
        $investmentRanges = $this->getInvestmentRanges($currencySymbol, $country);

        return view('investor.edit', compact(
            'investor',
            'countries',
            'countries1',
            'investorTypes',
            'investmentRanges',
            'industries',
            'geographies',
            'startupStages',
            'investmentExperince',
            'designations',
            'qualifications',
            'user',
            'autoDetectedCountry'
        ));
    }

    public function update(Request $request, $id)
    {
        Log::info('Investor profile update attempt:', ['user_id' => $request->user_id, 'investor_id' => $id]);
        $user = Auth::user();
        $investor = Investor::where('user_id', $user->id)->firstOrFail();
        // $investor = Investor::where('id', $id)->where('user_id', $request->user_id)->first();
        if (!$investor) {
            Log::warning('Investor profile not found or unauthorized access:', ['user_id' => $request->user_id, 'investor_id' => $id]);
            return redirect()->route('mobile.form')->with('error', 'Investor profile not found or you are not authorized to update this profile.');
        }

        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'full_name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:investors,email,' . $investor->id,
                'country' => 'nullable|string',
                'investor_type' => 'nullable|string',
                'investment_range' => 'nullable|string',
                'preferred_industries' => 'nullable|array|min:1',
                'preferred_geographies' => 'nullable|array|min:1',
                'preferred_startup_stage' => 'nullable|array|min:1',
                'actively_investing' => 'nullable|in:on,1,true,false,0',
                'linkedin_profile' => 'nullable|string',
                'company_name' => 'nullable|array',
                'market_capital' => 'nullable|array',
                'your_stake' => 'nullable|array',
                'stake_funding' => 'nullable|array',
                'investment_experince' => 'nullable|string',
                'professional_phone' => 'nullable|string',
                'professional_email' => 'nullable|email',
                'website' => 'nullable|string',
                'designation' => 'nullable|string',
                'organization_name' => 'nullable|string',
                'investor_profile' => 'nullable|file|mimes:pdf',
                'phone_number' => 'nullable',
                'country_code' => 'nullable',
                'company_address' => 'nullable|string',
                'company_country' => 'nullable|string',
                'company_state' => 'nullable|string',
                'company_city' => 'nullable|string',
                'company_zipcode' => 'nullable',
                'tax_registration_number' => 'nullable',
                'business_logo' => 'nullable|image|mimes:jpg,jpeg,png',
                'company_country_code' => 'nullable',
                'current_address' => 'nullable',
                'pin_code' => 'nullable',
                'state' => 'nullable',
                'city' => 'nullable',
                'dob' => 'nullable',
                'qualification' => 'nullable',
                'age' => 'nullable',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png',
                'agreed_to_terms' => 'required|accepted',
            ]);

            $data = [
                'investor_profile' => $investor->investor_profile
            ];
            $logoPath = $investor->business_logo;
            $photo = $investor->photo;

            if ($request->hasFile('photo')) {
                if ($investor->photo) {
                    Storage::disk('public')->delete($investor->photo);
                }
                $passport = $request->file('photo');
                $photos = time() . '_logo_' . $passport->getClientOriginalName();
                $photo = $passport->storeAs('investor_photo', $photos, 'public');
            }

            if ($request->hasFile('investor_profile')) {
                if ($investor->investor_profile) {
                    Storage::disk('public')->delete($investor->investor_profile);
                }
                $file = $request->file('investor_profile');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('investor_profile', $filename, 'public');
                $data['investor_profile'] = $path;
            }

            if ($request->hasFile('business_logo')) {
                if ($investor->business_logo) {
                    Storage::disk('public')->delete($investor->business_logo);
                }
                $logo = $request->file('business_logo');
                $logoName = time() . '_logo_' . $logo->getClientOriginalName();
                $logoPath = $logo->storeAs('investor_logos', $logoName, 'public');
            }

            $activelyInvesting = $request->has('actively_investing');

            $investor->update([
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'country' => $request->country,
                'linkedin_profile' => $request->linkedin_profile ? 'https://' . parse_url($request->linkedin_profile, PHP_URL_HOST) : null,
                'investor_type' => $request->investor_type,
                'investment_range' => $request->investment_range,
                'preferred_industries' => json_encode($request->preferred_industries ?? []),
                'preferred_geographies' => json_encode($request->preferred_geographies ?? []),
                'preferred_startup_stage' => json_encode($request->preferred_startup_stage ?? []),
                'investment_experince' => $request->investment_experince,
                'professional_phone' => $request->professional_phone,
                'professional_email' => $request->existing_company == 1 ? $request->professional_email : null,
                'website' => $request->existing_company == 1 ? ($request->website ? 'https://' . parse_url($request->website, PHP_URL_HOST) : null) : null,
                'designation' => $request->existing_company == 1 ? $request->designation : null,
                'organization_name' => $request->existing_company == 1 ? $request->organization_name : null,
                'investor_profile' => $request->existing_company == 1 ? $data['investor_profile'] : null,
                'phone_number' => $request->phone_number,
                'country_code' => $request->country_code,
                'actively_investing' => $activelyInvesting,
                'company_address' => $request->existing_company == 1 ? $request->company_address : null,
                'company_country' => $request->existing_company == 1 ? $request->company_country : null,
                'company_state' => $request->existing_company == 1 ? $request->company_state : null,
                'company_city' => $request->existing_company == 1 ? $request->company_city : null,
                'company_zipcode' => $request->existing_company == 1 ? $request->company_zipcode : null,
                'tax_registration_number' => $request->existing_company == 1 ? $request->tax_registration_number : null,
                'company_country_code' => $request->company_country_code,
                'business_logo' => $request->existing_company == 1 ? $logoPath : null,
                'current_address' => $request->current_address,
                'dob' => $request->dob,
                'pin_code' => $request->pin_code,
                'state' => $request->state,
                'city' => $request->city,
                'qualification' => $request->qualification,
                'age' => $request->age,
                'photo' => $photo,
                'existing_company' => $request->existing_company,
            ]);

            if ($activelyInvesting) {
                InvestorCompany::where('investor_id', $investor->id)->delete();

                $companyNames = $request->company_name ?? [];
                $marketCapitals = $request->market_capital ?? [];
                $stakes = $request->your_stake ?? [];
                $valuations = $request->stake_funding ?? [];

                foreach ($companyNames as $index => $companyName) {
                    if (!empty($companyName)) {
                        InvestorCompany::create([
                            'investor_id' => $investor->id,
                            'company_name' => $companyName,
                            'market_capital' => $marketCapitals[$index] ?? null,
                            'your_stake' => $stakes[$index] ?? null,
                            'stake_funding' => $valuations[$index] ?? null,
                        ]);
                    }
                }
            } else {
                InvestorCompany::where('investor_id', $investor->id)->delete();
            }

            Log::info('Investor profile updated successfully.', ['id' => $investor->id]);

            $dummyInvestor = DummyInvestor::where('user_id', $request->user_id)->first();
            if ($dummyInvestor) {
                Log::info('Deleting dummy investor record', ['user_id' => $request->user_id]);
                $dummyInvestor->delete();
            }

            $investor = Investor::where('user_id', $user->id)->first();
            return redirect()->route('investor.edit')->with('success', 'Investor profile updated successfully!')->with('investor', $investor);

            // return redirect()->route('mobile.form')->with('success', 'Investor profile updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed during update:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating investor:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function store(Request $request)
    {
        Log::info('Investor form submission:', $request->all());

        // Check if user has already submitted investor form
        $existingInvestor = Investor::where('user_id', $request->user_id)->first();
        if ($existingInvestor) {
            Log::info('User already has investor profile:', ['user_id' => $request->user_id]);
            return redirect()->route('mobile.form')->with('success', 'You have already submitted your investor profile.');
        }

        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'full_name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:investors,email',
                'country' => 'nullable|string',
                'investor_type' => 'nullable|string',
                'investment_range' => 'nullable|string',
                'preferred_industries' => 'nullable|array|min:1',
                'preferred_geographies' => 'nullable|array|min:1',
                'preferred_startup_stage' => 'nullable|array|min:1',
                'actively_investing' => 'nullable|in:on,1,true,false,0',
                'linkedin_profile' => 'nullable|string',
                'company_name' => 'nullable|array',
                'market_capital' => 'nullable|array',
                'your_stake' => 'nullable|array',
                'stake_funding' => 'nullable|array',
                'investment_experince' => 'nullable|string',
                'professional_phone' => 'nullable|string',
                'professional_email' => 'nullable|email',
                'website' => 'nullable|string',
                'designation' => 'nullable|string',
                'organization_name' => 'nullable|string',
                'investor_profile' => 'nullable|file|mimes:pdf',
                'phone_number' => 'nullable',
                'country_code' => 'nullable',
                'company_address' => 'nullable|string',
                'company_country' => 'nullable|string',
                'company_state' => 'nullable|string',
                'company_city' => 'nullable|string',
                'company_zipcode' => 'nullable',
                'tax_registration_number' => 'nullable',
                'business_logo' => 'nullable|image',
                'company_country_code' => 'nullable',
                'current_address' => 'nullable',
                'pin_code' => 'nullable',
                'state' => 'nullable',
                'city' => 'nullable',
                'dob' => 'nullable',
                'qualification' => 'nullable',
                'age' => 'nullable',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            ]);

            // Initialize with default values
            $data = [
                'investor_profile' => null
            ];
            $logoPath = null;
            $photo = null;

            if ($request->hasFile('photo')) {
                $passport = $request->file('photo');
                $photos = time() . '_logo_' . $passport->getClientOriginalName();
                $photo = $passport->storeAs('investor_photo', $photos, 'public');
            }

            if ($request->hasFile('investor_profile')) {
                $file = $request->file('investor_profile');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('investor_profile', $filename, 'public');
                $data['investor_profile'] = $path;
            }

            if ($request->hasFile('business_logo')) {
                $logo = $request->file('business_logo');
                $logoName = time() . '_logo_' . $logo->getClientOriginalName();
                $logoPath = $logo->storeAs('investor_logos', $logoName, 'public');
            }

            $user = User::find($request->user_id);

            $activelyInvesting = $request->has('actively_investing');

            $investor = Investor::create([
                'user_id' => $request->user_id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'country' => $request->country,
                'linkedin_profile' => $request->linkedin_profile ? 'https://' . parse_url($request->linkedin_profile, PHP_URL_HOST) : null,
                'investor_type' => $request->investor_type,
                'investment_range' => $request->investment_range,
                'preferred_industries' => json_encode($request->preferred_industries ?? []),
                'preferred_geographies' => json_encode($request->preferred_geographies ?? []),
                'preferred_startup_stage' => json_encode($request->preferred_startup_stage ?? []),
                'investment_experince' => $request->investment_experince,
                'professional_phone' => $request->professional_phone,
                'professional_email' => $request->existing_company == 1 ? $request->professional_email : null,
                'website' => $request->existing_company == 1 ? ($request->website ? 'https://' . parse_url($request->website, PHP_URL_HOST) : null) : null,
                'designation' => $request->existing_company == 1 ? $request->designation : null,
                'organization_name' => $request->existing_company == 1 ? $request->organization_name : null,
                'investor_profile' => $request->existing_company == 1 ? $data['investor_profile'] : null,
                'phone_number' => $request->phone_number,
                'country_code' => $request->country_code,
                'actively_investing' => $activelyInvesting,
                'company_address' => $request->existing_company == 1 ? $request->company_address : null,
                'company_country' => $request->existing_company == 1 ? $request->company_country : null,
                'company_state' => $request->existing_company == 1 ? $request->company_state : null,
                'company_city' => $request->existing_company == 1 ? $request->company_city : null,
                'company_zipcode' => $request->existing_company == 1 ? $request->company_zipcode : null,
                'tax_registration_number' => $request->existing_company == 1 ? $request->tax_registration_number : null,
                'company_country_code' => $request->company_country_code,
                'business_logo' => $request->existing_company == 1 ? $logoPath : null,
                'current_address' => $request->current_address,
                'dob' => $request->dob,
                'pin_code' => $request->pin_code,
                'state' => $request->state,
                'city' => $request->city,
                'qualification' => $request->qualification,
                'age' => $request->age,
                'photo' => $photo,
                'existing_company' => $request->existing_company,
            ]);

            // Save company info only if actively investing
            if ($activelyInvesting) {
                $companyNames = $request->company_name ?? [];
                $marketCapitals = $request->market_capital ?? [];
                $stakes = $request->your_stake ?? [];
                $valuations = $request->stake_funding ?? [];

                foreach ($companyNames as $index => $companyName) {
                    if (!empty($companyName)) {
                        // Clean the stake_funding value by removing commas
                        $cleanValuation = isset($valuations[$index]) ? str_replace(',', '', $valuations[$index]) : null;

                        \App\Models\InvestorCompany::create([
                            'investor_id' => $investor->id,
                            'company_name' => $companyName,
                            'market_capital' => $marketCapitals[$index] ?? null,
                            'your_stake' => $stakes[$index] ?? null,
                            'stake_funding' => $cleanValuation,
                        ]);
                    }
                }
            }

            Log::info('Investor and companies saved.', ['id' => $investor->id]);

            $dummyInvestor = DummyInvestor::where('user_id', $request->user_id)->first();
            if ($dummyInvestor) {
                Log::info('Deleting dummyintvestor record', ['user_id' => $request->user_id]);
                $dummyInvestor->delete();
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('mobile.form')->with('success', 'Investor profile created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating investor:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function myCompanies()
    {
        $user = Auth::user();
        $investor = Investor::where('user_id', $user->id)->first();

        // if (!$investor) {
        //     return redirect()->route('entrepreneur.profile')->withErrors(['error' => 'Please complete your entrepreneur profile first.']);
        // }

        // Get companies using entrepreneur's ID
        $companies = InvestorCompany::where('investor_id', $investor->id)->get();

        return view('investor.my-companies', compact('companies'));
    }

    public function storeCompany(Request $request)
    {

        log::info('storecomapny', $request->all());
        $request->validate([
            'company_name' => 'required|string|max:255',
            'market_capital' => 'required|numeric|min:0',
            'your_stake' => 'required|numeric|between:0,100',
            'stake_funding' => 'required|numeric|min:0',
        ]);
        $investor = Investor::where('user_id', Auth::id())->first();

        if (!$investor) {
            return redirect()->back()->withErrors(['error' => 'Entrepreneur profile not found. Please complete your profile first.']);
        }
        $company = InvestorCompany::create([
            'investor_id' => $investor->id,
            'company_name' => $request->company_name,
            'market_capital' => $request->market_capital,
            'your_stake' => $request->your_stake,
            'stake_funding' => $request->stake_funding,
        ]);

        // Send email notification to admin
        Mail::to('info@futuretaikun.com')->send(new InvestorNewCompanyNotification($company, $investor));

        return redirect()->route('investor.companies')->with('success', 'Company added successfully!');
    }
    // public function toggleApproval(Request $request)
    // {
    //     $investor = Investor::find($request->id);

    //     if ($investor) {
    //         $investor->approved = $request->approved;
    //         $investor->save();

    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['success' => false], 404);
    // }
    public function toggleApproval(Request $request)
    {
        $investor = Investor::find($request->id);

        if (!$investor) {
            return response()->json(['success' => false, 'message' => 'Investor not found'], 404);
        }

        $investor->approved = $request->approved;

        // Generate serial number if approved and not already assigned
        if ($request->approved && empty($investor->serial_number)) {
            do {
                // Generate random 10-digit number
                $randomNumber = 'SIN' . str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            } while (Investor::where('serial_number', $randomNumber)->exists());

            $investor->serial_number = $randomNumber;
        }

        $investor->save();

        if ($request->approved) {
            try {
                Mail::to($investor->email)->send(new InvestorApprovedMail($investor));
                Log::info("Profile Verify mail sent successfully to {$investor->email}");
            } catch (\Exception $e) {
                Log::error("Failed to send approval mail to {$investor->email}. Error: " . $e->getMessage());
            }
        }

        return response()->json(['success' => true]);
    }

    public function getInvestore(Request $request)
    {
        $investores = Investor::all();
        $investore = Investor::query()
            ->paginate(5)
            ->appends($request->except('page')); // Preserve query parameters except 'page'

        if ($investore->currentPage() > $investore->lastPage()) {
            return redirect()->route('admin.entrepreneurs', array_merge($request->except('page'), ['page' => 1]));
        }

        return view('investor', compact('investore', 'investores'));
    }
    public function getCompanies($id)
    {
        $companies = \App\Models\InvestorCompany::where('investor_id', $id)->get();
        return response()->json($companies);
    }

    public function ApprovedInvestor(Request $request)
    {
        $approvedInvestors = Investor::where('approved', 1)->get();

        return view('investors.approved', compact('approvedInvestors'));
    }

    // public function markInterested(Request $request)
    // {
    //     $entrepreneur = Entrepreneur::findOrFail($request->id);

    //     // Check if already marked interested
    //     if (
    //         Interest::where('entrepreneur_id', $entrepreneur->id)
    //             ->where('investor_id', Auth::id())->exists()
    //     ) {
    //         return response()->json(['success' => false, 'message' => 'Already interested']);
    //     }

    //     // Create interest entry
    //     Interest::create([
    //         'entrepreneur_id' => $entrepreneur->id,
    //         'investor_id' => Auth::id()
    //     ]);

    //     // Send mail to entrepreneur with CC to admin(s)
    //     Mail::to($entrepreneur->email)
    //         ->cc(['info@futuretaikun.com'])
    //         ->send(new InterestedNotification(Auth::user()->name));

    //     return response()->json(['success' => true]);
    // }
    public function markInterested(Request $request)
    {
        \Log::info('Request data: ', $request->all()); // Log request data as an array
        try {
            $request->validate([
                'entrepreneur_id' => 'exists:entrepreneurs,id', // Removed 'required'
                'offer_type' => 'in:same,counter', // Removed 'required'
                'market_capital' => 'nullable|numeric|min:0', // Replaced 'required_if' with 'nullable'
                'your_stake' => 'nullable|numeric|min:0|max:100', // Replaced 'required_if' with 'nullable'
                'stake_funding' => 'nullable|numeric|min:0', // Replaced 'required_if' with 'nullable'
                'remark_reason' => 'nullable|string', // Replaced 'required_if' with 'nullable'
                'counter_market_capital' => 'nullable|numeric|min:0', // Replaced 'required_if' with 'nullable'
                'counter_your_stake' => 'nullable|numeric|min:0|max:100', // Replaced 'required_if' with 'nullable'
                'counter_stake_funding' => 'nullable|numeric|min:0', // Replaced 'required_if' with 'nullable'
                'counter_reason' => 'nullable|string', // Replaced 'required_if' with 'nullable'
            ]);
            $entrepreneur = Entrepreneur::findOrFail($request->entrepreneur_id);
            $country = $entrepreneur->country;
            // \Log::info('Entrepreneur data: ', $entrepreneur->toArray()); // Log entrepreneur as array

            // Check if already marked interested
            if (Interest::where('entrepreneur_id', $entrepreneur->id)->where('investor_id', Auth::id())->exists()) {
                return response()->json(['success' => false, 'message' => 'Already interested']);
            }

            // Create interest entry
            $interest = Interest::create([
                'entrepreneur_id' => $entrepreneur->id,
                'investor_id' => Auth::id(),
                'market_capital' => $request->offer_type === 'same' ? $request->market_capital : $request->counter_market_capital,
                'your_stake' => $request->offer_type === 'same' ? $request->your_stake : $request->counter_your_stake,
                'company_value' => $request->offer_type === 'same' ? $request->stake_funding : $request->counter_company_value,
                'reason' => $request->offer_type === 'same' ? $request->remark_reason : $request->counter_reason,
                'is_counter_offer' => $request->offer_type === 'counter' ? true : false,
            ]);

            // Send mail to entrepreneur with CC to admin(s)
            try {
                Mail::to($entrepreneur->email)
                    ->cc(['info@futuretaikun.com'])
                    ->send(new InterestedNotification(
                        Auth::user()->name,
                        $request->offer_type,
                        $request->offer_type === 'same' ? $request->market_capital : null,
                        $request->offer_type === 'same' ? $request->your_stake : null,
                        $request->offer_type === 'same' ? $request->stake_funding : null,
                        $request->offer_type === 'same' ? $request->remark_reason : null,
                        $request->offer_type === 'counter' ? $request->counter_market_capital : null,
                        $request->offer_type === 'counter' ? $request->counter_your_stake : null,
                        $request->offer_type === 'counter' ? $request->counter_company_value : null,
                        $request->offer_type === 'counter' ? $request->counter_reason : null,
                        $country
                    ));
            } catch (\Exception $mailException) {
                \Log::error('Mail sending failed: ' . $mailException->getMessage());
                // Continue even if mail fails, as interest is already recorded
            }

            return response()->json([
                'success' => true,
                'message' => $request->offer_type === 'counter' ? 'Counter offer submitted successfully' : 'Interest submitted successfully'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', $e->errors()),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Mark Interested Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.',
            ], 500);
        }
    }
    public function downloadCSV(Request $request)
    {
        $investors = Investor::all(); // your query with ->get()

        $filename = 'investor_data_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($investors) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Serial Number', 'Full Name', 'Phone Number', 'Email', 'Country']);

            foreach ($investors as $index => $investor) {
                fputcsv($file, [
                    $index + 1,
                    $investor->full_name,
                    $investor->phone_number,
                    $investor->email,
                    $investor->country,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function saveStepData(Request $request)
    {
        Log::info('Entering saveStepData', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'headers' => $request->headers->all(),
            'data' => $request->all(),
            'files' => array_keys($request->file())
        ]);

        try {
            // Basic validation
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'step' => 'required|integer|in:2,3,4',
            ]);

            $userId = $request->input('user_id');
            $step = $request->input('step');
            $data = $request->all();
            unset($data['user_id'], $data['step'], $data['_token']);

            foreach (['photo', 'business_logo', 'investor_profile'] as $fileField) {
                if (!$request->hasFile($fileField) || !$request->file($fileField)->isValid()) {
                    $request->request->remove($fileField);
                    // Also remove from files array
                    $request->files->remove($fileField);
                }
            }

            // Step-specific validation and allowed fields
            $validationRules = [];
            $allowedFields = [];
            if ($step == 2) {
                $validationRules = [
                    'full_name' => 'nullable|string|max:255',
                    'email' => 'nullable|email|unique:investors,email,' . $userId . ',user_id',
                    'phone_number' => 'nullable|string',
                    'country_code' => 'nullable|string|max:10',
                    'country' => 'nullable|string',
                    'state' => 'nullable|string',
                    'city' => 'nullable|string',
                    'current_address' => 'nullable|string',
                    'pin_code' => 'nullable|string',
                    'linkedin_profile' => 'nullable|string',
                    'dob' => 'nullable|string',
                    'age' => 'nullable|string',
                    'qualification' => 'nullable|string',
                    'photo' => 'nullable|image|mimes:jpg,jpeg,png',
                ];
                $allowedFields = [
                    'full_name',
                    'email',
                    'phone_number',
                    'country_code',
                    'country',
                    'state',
                    'city',
                    'current_address',
                    'pin_code',
                    'linkedin_profile',
                    'dob',
                    'age',
                    'qualification',
                    'photo'
                ];
            } elseif ($step == 3) {
                $validationRules = [
                    'existing_company' => 'nullable|in:0,1',
                    'investment_experince' => 'nullable|string',
                    'investor_type' => 'nullable|string',
                    'investment_range' => 'nullable|string',
                    'preferred_startup_stage' => 'nullable|array',
                    'preferred_startup_stage.*' => 'string',
                ];
                $allowedFields = ['existing_company', 'investment_experince', 'investor_type', 'investment_range', 'preferred_startup_stage'];
                if ($request->input('existing_company') == '1') {
                    $validationRules = array_merge($validationRules, [
                        'organization_name' => 'nullable|string|max:255',
                        'company_address' => 'nullable|string',
                        'company_country' => 'nullable|string',
                        'company_state' => 'nullable|string',
                        'company_city' => 'nullable|string',
                        'company_zipcode' => 'nullable|string',
                        'professional_email' => 'nullable|email',
                        'website' => 'nullable|string',
                        'tax_registration_number' => 'nullable|string',
                        'designation' => 'nullable|string',
                        'professional_phone' => 'nullable|string',
                        'company_country_code' => 'nullable|string|max:10',
                        'business_logo' => 'nullable|image|mimes:jpg,jpeg,png',
                        'investor_profile' => 'nullable|file|mimes:pdf',
                    ]);
                    $allowedFields = array_merge($allowedFields, [
                        'organization_name',
                        'company_address',
                        'company_country',
                        'company_state',
                        'company_city',
                        'company_zipcode',
                        'professional_email',
                        'website',
                        'tax_registration_number',
                        'designation',
                        'professional_phone',
                        'company_country_code',
                        'business_logo',
                        'investor_profile'
                    ]);
                }
            } elseif ($step == 4) {
                $validationRules = [
                    'preferred_industries' => 'nullable|array',
                    'preferred_industries.*' => 'string',
                    'preferred_geographies' => 'nullable|array',
                    'preferred_geographies.*' => 'string',
                    'actively_investing' => 'nullable|in:0,1',
                ];
                $allowedFields = [
                    'preferred_industries',
                    'preferred_geographies',
                    'actively_investing'
                ];
            }

            $validatedData = $request->validate($validationRules);

            // Remove empty file inputs to avoid triggering validation
            foreach (['photo', 'business_logo', 'investor_profile'] as $fileField) {
                if (!$request->hasFile($fileField) || !$request->file($fileField)->isValid()) {
                    $request->request->remove($fileField);
                }
            }


            // Filter data to include only allowed fields
            $data = array_intersect_key($data, array_flip($allowedFields));

            // Handle file uploads
            if ($request->hasFile('photo')) {
                try {
                    $photo = $request->file('photo');
                    $photoName = time() . '_photo_' . str_replace([' ', ':', '/'], '_', $photo->getClientOriginalName());
                    $data['photo'] = $photo->storeAs('investor_photo', $photoName, 'public');
                    Log::info('Photo uploaded successfully', ['path' => $data['photo']]);
                } catch (\Exception $e) {
                    Log::error('Failed to upload photo', ['error' => $e->getMessage()]);
                    throw new \Exception('Failed to upload photo: ' . $e->getMessage());
                }
            }
            if ($request->hasFile('business_logo')) {
                try {
                    $logo = $request->file('business_logo');
                    $logoName = time() . '_logo_' . str_replace([' ', ':', '/'], '_', $logo->getClientOriginalName());
                    $data['business_logo'] = $logo->storeAs('investor_logos', $logoName, 'public');
                    Log::info('Business logo uploaded successfully', ['path' => $data['business_logo']]);
                } catch (\Exception $e) {
                    Log::error('Failed to upload business logo', ['error' => $e->getMessage()]);
                    throw new \Exception('Failed to upload business logo: ' . $e->getMessage());
                }
            }
            if ($request->hasFile('investor_profile')) {
                try {
                    $file = $request->file('investor_profile');
                    $fileName = time() . '_profile_' . str_replace([' ', ':', '/'], '_', $file->getClientOriginalName());
                    $data['investor_profile'] = $file->storeAs('investor_profile', $fileName, 'public');
                    Log::info('Investor profile uploaded successfully', ['path' => $data['investor_profile']]);
                } catch (\Exception $e) {
                    Log::error('Failed to upload investor profile', ['error' => $e->getMessage()]);
                    throw new \Exception('Failed to upload investor profile: ' . $e->getMessage());
                }
            }

            // Handle URLs
            if (isset($data['website']) && $data['website']) {
                $parsedUrl = parse_url($data['website'], PHP_URL_HOST);
                $data['website'] = $parsedUrl ? 'https://' . $parsedUrl : $data['website'];
            }
            if (isset($data['linkedin_profile']) && $data['linkedin_profile']) {
                $parsedUrl = parse_url($data['linkedin_profile'], PHP_URL_HOST);
                $data['linkedin_profile'] = $parsedUrl ? 'https://' . $parsedUrl : $data['linkedin_profile'];
            }

            // Convert array fields to JSON only if present and relevant
            if ($step == 4) {
                if (isset($data['preferred_industries']) && is_array($data['preferred_industries'])) {
                    $data['preferred_industries'] = json_encode($data['preferred_industries']);
                }
                if (isset($data['preferred_geographies']) && is_array($data['preferred_geographies'])) {
                    $data['preferred_geographies'] = json_encode($data['preferred_geographies']);
                }
            }
            if ($step == 3 && isset($data['preferred_startup_stage']) && is_array($data['preferred_startup_stage'])) {
                $data['preferred_startup_stage'] = json_encode($data['preferred_startup_stage']);
            }

            // Conditionally set fields to null if existing_company is 0
            if ($step == 3 && $request->input('existing_company') == '0') {
                $data['organization_name'] = null;
                $data['company_address'] = null;
                $data['company_country'] = null;
                $data['company_state'] = null;
                $data['company_city'] = null;
                $data['company_zipcode'] = null;
                $data['professional_email'] = null;
                $data['website'] = null;
                $data['tax_registration_number'] = null;
                $data['designation'] = null;
                $data['professional_phone'] = null;
                $data['company_country_code'] = null;
                $data['business_logo'] = null;
                $data['investor_profile'] = null;
            }

            // Explicitly exclude unwanted fields
            unset($data['company_name'], $data['market_capital'], $data['your_stake'], $data['stake_funding']);

            // Update or create record in dummyinvestors
            $investor = DummyInvestor::updateOrCreate(
                ['user_id' => $userId],
                $data
            );

            // Update completed_steps
            $completedSteps = $investor->completed_steps ? json_decode($investor->completed_steps, true) : [];
            if (!in_array($step, $completedSteps)) {
                $completedSteps[] = $step;
                $investor->completed_steps = json_encode(array_unique(array_map('intval', $completedSteps)));
                $investor->save();
            }

            Log::info('Data saved successfully for user_id ' . $userId . ' in step ' . $step, [
                'record' => $investor->toArray(),
                'completed_steps' => $completedSteps
            ]);
            return response()->json(['success' => true, 'message' => 'Step data saved successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed in saveStepData:', [
                'errors' => $e->errors(),
                'data' => $request->all(),
                'files' => array_keys($request->file())
            ]);
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error in saveStepData:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'data' => $request->all(),
                'files' => array_keys($request->file())
            ]);
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data: ' . $e->getMessage()], 500);
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

            $investo = DummyInvestor::where('user_id', $user->id)->first();
            if (!$investo) {
                Log::info('No data found in investors for user_id: ' . $user->id);
                return response()->json(['message' => 'No saved data found', 'data' => [], 'completed_steps' => []], 200);
            }

            $stepData = [
                'step2' => [],
                'step3' => [],
                'step4' => [],
            ];

            // Step 2 fields
            $step2Fields = [
                'full_name',
                'email',
                'phone_number',
                'country_code',
                'country',
                'state',
                'city',
                'current_address',
                'pin_code',
                'linkedin_profile',
                'dob',
                'age',
                'qualification',
                'photo'
            ];

            foreach ($step2Fields as $field) {
                if (!is_null($investo->$field)) {
                    $stepData['step2'][$field] = $investo->$field;
                }
            }

            // Step 3 fields
            $step3Fields = [
                'existing_company',
                'investment_experince',
                'investor_type',
                'investment_range',
                'preferred_startup_stage',
                'professional_phone',
                'professional_email',
                'website',
                'designation',
                'organization_name',
                'company_address',
                'company_country',
                'company_state',
                'company_city',
                'company_zipcode',
                'tax_registration_number',
                'company_country_code',
                'business_logo',
                'investor_profile'
            ];
            foreach ($step3Fields as $field) {
                if (!is_null($investo->$field)) {
                    if ($field === 'preferred_startup_stage' && $investo->$field) {
                        $stepData['step3'][$field] = json_decode($investo->$field, true);
                    } else {
                        $stepData['step3'][$field] = $investo->$field;
                    }
                }
            }
            // Only include company-specific fields if existing_company is '1'
            if ($investo->existing_company !== '1') {
                $companyFields = [
                    'organization_name',
                    'company_address',
                    'company_country',
                    'company_state',
                    'company_city',
                    'company_zipcode',
                    'professional_email',
                    'website',
                    'tax_registration_number',
                    'designation',
                    'professional_phone',
                    'company_country_code',
                    'business_logo',
                    'investor_profile'
                ];
                foreach ($companyFields as $field) {
                    unset($stepData['step3'][$field]);
                }
            }

            // Step 4 fields
            $step4Fields = [
                'preferred_industries',
                'preferred_geographies',
                'actively_investing',
                'company_name',
                'market_capital',
                'your_stake',
                'stake_funding'
            ];
            foreach ($step4Fields as $field) {
                if (!is_null($investo->$field)) {
                    if (in_array($field, ['preferred_industries', 'preferred_geographies', 'company_name', 'market_capital', 'your_stake', 'stake_funding']) && $investo->$field) {
                        $stepData['step4'][$field] = json_decode($investo->$field, true);
                    } else {
                        $stepData['step4'][$field] = $investo->$field;
                    }
                }
            }
            // Only include company-related fields if actively_investing is true
            if (!$investo->actively_investing) {
                unset($stepData['step4']['company_name']);
                unset($stepData['step4']['market_capital']);
                unset($stepData['step4']['your_stake']);
                unset($stepData['step4']['stake_funding']);
            }

            $completedSteps = $investo->completed_steps ? json_decode($investo->completed_steps, true) : [];

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

    public function updatePhotosLogo(Request $request)
    {
        // Log the raw input for debugging
        Log::info('Update Product Logo Request (Raw):', ['input' => $request->all()]);

        // Validate request
        $validator = \Validator::make($request->all(), [
            'investor_id' => 'required|exists:investors,id',
            'business_logo_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'photo_admin.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'business_logo_admin.image' => 'The business logo must be an image.',
            'business_logo_admin.mimes' => 'The business logo must be a file of type: jpeg, png, jpg, gif.',
            'photo_admin.image' => 'The product photos must be images.',
            'photo_admin.mimes' => 'The product photos must be files of type: jpeg, png, jpg, gif.',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', ['errors' => $validator->errors()->all()]);
            return response()->json(['status' => 'error', 'message' => 'Validation failed: ' . implode(', ', $validator->errors()->all())], 422);
        }

        try {
            $investor = Investor::find($request->investor_id);
            if (!$investor) {
                throw new \Exception('Entrepreneur not found.');
            }

            // Ensure storage directories exist and are writable
            $directories = ['investor_logos', 'investor_photo'];
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
                if ($investor->business_logo_admin) {
                    Storage::delete('public/' . $investor->business_logo_admin);
                }
                $path = $request->file('business_logo_admin')->store('investor_logos', 'public');
                Log::info('Business logo stored at: ', ['path' => $path]);
                $investor->business_logo_admin = $path;
            }

            if ($request->hasFile('photo_admin')) {
                Log::info('Storing business logo: ', ['file' => $request->file('photo_admin')->getClientOriginalName()]);
                if ($investor->photo_admin) {
                    Storage::delete('public/' . $investor->photo_admin);
                }
                $photos = $request->file('photo_admin')->store('investor_photo', 'public');
                Log::info('Photos stored at: ', ['path' => $path]);
                $investor->photo_admin = $photos;
            }

            if ($investor->save()) {
                Log::info('Investor data saved successfully for ID: ', ['id' => $investor->id]);
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