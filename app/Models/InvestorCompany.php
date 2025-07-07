<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'investor_id',
        'company_name',
        'market_capital',
        'your_stake',
        'stake_funding',
        'created_at',
        'updated_at'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}