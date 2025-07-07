<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function showForm()
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
            ['code' => '+66', 'name' => 'TH'],     // Thailand
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
        ];

        return view('contact', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'country_code' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Contact::create($request->only(['name', 'email', 'country_code', 'phone_number', 'message']));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function support(Request $request)
    {
        return view('support');
    }

    public function termsService(Request $result)
    {
        return view('terms-service');
    }

    public function Guidelines(Request $request)
    {
        return view('guidelines');
    }

    public function privacyPolicy(Request $request)
    {
        return view('policy');
    }
}