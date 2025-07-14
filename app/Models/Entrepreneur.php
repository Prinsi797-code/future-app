<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrepreneur extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'country',
        'business_name',
        'industry',
        'business_stage',
        'website_links',
        'pitch_video',
        'idea_summary',
        'funding_requirement',
        'pitch_deck',
        'agreed_to_terms',
        'user_id',
        'otp',
        'country_code',
        'otp_expires_at',
        'approved',
        'qualification',
        'age',
        'is_verified',
        'serial_number',
        'state',
        'current_address',
        'city',
        'dob',
        'founder_number',
        'business_state',
        'business_city',
        'business_year',
        'business_year_count',
        'register_business',
        'business_describe',
        'business_revenue1',
        'business_revenue2',
        'business_revenue3',
        'invested_amount',
        'business_address',
        'pin_code',
        'market_capital',
        'your_stake',
        'stake_funding',
        'business_logo',
        'product_photos',
        'business_mobile',
        'business_email',
        'registration_type_of_entity',
        'tax_registration_number',
        'own_fund',
        'loan',
        'employee_number',
        'business_country',
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
        'y_business_logo',
        'y_product_photos',
        'y_stake_funding',
        'y_market_capital',
        'y_your_stake',
        'brand_name',
        'proposed_business_address',
        'y_pitch_deck',
        'reject',
        'reason',
        'remark_market_capital',
        'remark_your_stake',
        'remark_company_value',
        'remark_reason',
        'remark',
        'video_upload',
        'business_logo_admin',
        'y_business_logo_admin',
        'product_photos_admin',
        'y_product_photos_admin',
    ];

    protected $casts = [
        // 'funding_requirement' => 'decimal:2',
        'agreed_to_terms' => 'boolean',
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
    public function investors()
    {
        return $this->belongsToMany(Investor::class, 'investor_entrepreneur')
            ->withPivot('interested', 'remark_market_capital', 'remark_your_stake', 'remark_company_value', 'remark_reason');
    }
    public function companies()
    {
        return $this->hasMany(EntrepreneurCompany::class, 'entrepreneurs_id');
    }
}