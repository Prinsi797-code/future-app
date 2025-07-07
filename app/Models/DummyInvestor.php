<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyInvestor extends Model
{
    use HasFactory;
    protected $table = 'dummyinvestors';
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'country',
        'linkedin_profile',
        'investor_type',
        'investment_range',
        'preferred_industries',
        'preferred_geographies',
        'preferred_startup_stage',
        'actively_investing',
        'investor_profile',
        'otp',
        'user_id',
        'company_name',
        'market_capital',
        'your_stake',
        'stake_funding',
        'country_code',
        'investment_experince',
        'professional_phone',
        'professional_email',
        'website',
        'designation',
        'organization_name',
        'otp_expires_at',
        'approved',
        'is_verified',
        'serial_number',
        'company_address',
        'company_country',
        'company_state',
        'company_city',
        'company_zipcode',
        'tax_registration_number',
        'business_logo',
        'company_country_code',
        'current_address',
        'state',
        'city',
        'pin_code',
        'dob',
        'qualification',
        'photo',
        'age',
        'existing_company',
        'company_name',
        'market_capital',
        'your_stake',
        'stake_funding'
    ];

    protected $casts = [
        'preferred_industries' => 'array',
        'preferred_geographies' => 'array',
        'actively_investing' => 'boolean',
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
    ];
}